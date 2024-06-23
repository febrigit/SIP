<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Model\StockOpname;
use App\Model\ItemLog;
use App\Model\Item;
use App\Helpers;
use Exception;
use DB;
use Storage;
use Auth;


class StockOpnameController extends Controller
{
    protected $model;
    protected $metaModule;

    function __construct (){
        $this->model = New StockOpname();
        $this->metaModule = 'stock-opname';
    }

    public function index()
    {
        $datas = $this->model::orderBy('id', 'DESC')->get();
        return view('pages.'.$this->metaModule.'.index', compact('datas'));
    }

    public function create()
    {
        $data = $this->model;
        return view('pages.'.$this->metaModule.'.form', compact('data'));
    }

    public function edit($id)
    {
        $data = $this->model::with('stockOpnameDetail.item')->find($id);
        $hasSo = collect($data->stockOpnameDetail)->pluck('item_id');

        $items = Item::whereNotIn('id', $hasSo)->get();
        return view('pages.'.$this->metaModule.'.form', compact('data', 'items'));
    }

    public function show($id)
    {
        $data = $this->model::find($id);
        return view('pages.'.$this->metaModule.'.detail', compact('data'));
    }

    public function destroy($id)
    {
        $this->model::where('id', $id)->delete();
        return redirect()->back()->withAlert('Data deleted successfully');
    }

    public function generateCode () {
        $data = $this->model::orderBy('id', 'DESC')->withTrashed()->first();
        if ($data) {
            $no = (int) explode('-', $data->code)[1];
            $no = $no + 1;
        } else {
            $no = '0000001';
        }

        return 'SO-'.str_pad($no, 7, '0', STR_PAD_LEFT);
    }

    public function store(Request $request)
    {
        DB::beginTransaction();
        try {
            $validator = $this->validator($request);
            if ($validator['status'] == 'error') return redirect()->back()->withDanger($validator['message']);

            $data = $this->model;
            $data->code = $this->generateCode();

            $data->date = $request->date;
            $data->remarks = $request->remarks;
            $data->created_by = Auth::user()->id;

            $data->save();
            DB::commit();
            return redirect()->route($this->metaModule.'.edit',['stock_opname' => $data->id])->withAlert('Data saved successfully');
        } catch (Exception $e) {
            DB::rollback();
            return redirect()->back()->withDanger($e->getMessage());
        }
    }

    public function update(Request $request, $id)
    {
        DB::beginTransaction();
        try {
            $validator = $this->validator($request);
            if ($validator['status'] == 'error') return redirect()->back()->withDanger($validator['message']);

            $data = $this->model::find($id);

            $data->date = $request->date;
            $data->remarks = $request->remarks;

            $data->save();
            DB::commit();
            return redirect()->route($this->metaModule.'.index')->withAlert('Data updated successfully');
        } catch (Exception $e) {
            DB::rollback();
            return redirect()->back()->withDanger($e->getMessage());
        }
    }

    public function validator ($request) {
        $validator = Validator::make($request->all(), [
            'date' => 'required|max:150',
        ]);

        if ($validator->fails())
        {
            $messages = '';
            foreach ($validator->getMessageBag()->toArray() as $key => $value)
            {
                $messages .= $value[0] .' ';
            }
            return ['status'=>'error', 'message'=>$messages];
        }
        return ['status'=>'success', 'message'=>'success'];
    }

    public function submit(Request $request, $id)
    {
        DB::beginTransaction();
        try {

            $data = $this->model::find($id);

            $data->submitted_by = Auth::user()->id;
            $data->submitted_at = date('Y-m-d h:i:s');
            $data->status = 'SUBMITTED';

            $data->save();

            foreach ($data->stockOpnameDetail as $val) {
                $item = Item::find($val->item_id);
                $item->stock = $item->stock - $val->qty;
                $item->save();

                $log = new ItemLog();
                $log = $log->storeLog($val, 'StockOpname', $data->id);
            }

            DB::commit();
            return redirect()->back()->withAlert('Data submited successfully');
            
        } catch (Exception $e) {
            DB::rollback();
            return redirect()->back()->withDanger($e->getMessage());
        }
    }

}
