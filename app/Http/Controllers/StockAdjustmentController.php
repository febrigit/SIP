<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Model\StockAdjustment;
use App\Model\Item;
use App\Model\ItemLog;
use App\Helpers;
use Exception;
use DB;
use Storage;
use Auth;


class StockAdjustmentController extends Controller
{
    protected $model;
    protected $metaModule;

    function __construct (){
        $this->model = New StockAdjustment();
        $this->metaModule = 'stock-adjustment';
    }

    public function index()
    {
        $datas = $this->model::orderBy('id', 'DESC')->get();
        $items = Item::get();
        return view('pages.'.$this->metaModule.'.index', compact('datas', 'items'));
    }

    public function create($id)
    {
        $data = $this->model;
        $item = Item::find($id);
        return view('pages.'.$this->metaModule.'.form', compact('data', 'item'));
    }


    public function show($id)
    {
        $data = $this->model::find($id);
        return view('pages.'.$this->metaModule.'.detail', compact('data'));
    }

    public function destroy($id)
    {
        $data = $this->model::find($id);

        $item = Item::find($data->item_id);
        $item->stock = $item->stock - $data->qty;
        $item->save();

        $log = new ItemLog();
        $log = $log->storeLog($data, 'StockAdjustment', $data->id);
        
        $data->delete();
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

        return 'ADJ-'.str_pad($no, 7, '0', STR_PAD_LEFT);
    }

    public function store(Request $request)
    {
        DB::beginTransaction();
        try {
            $validator = $this->validator($request);
            if ($validator['status'] == 'error') return redirect()->back()->withDanger($validator['message']);

            $data = $this->model;
            $data->code = $this->generateCode();

            $data->item_id = $request->item_id;
            $data->first_stock = $request->first_stock;
            $data->last_stock = $request->last_stock;
            
            $data->qty = $data->last_stock - $data->first_stock;

            $data->remarks = $request->remarks;
            $data->created_by = Auth::user()->id;
            
            $data->save();

            $item = Item::find($data->item_id);
            $item->stock = $data->last_stock;
            $item->save();

            $log = new ItemLog();
            $log = $log->storeLog($data, 'StockAdjustment', $data->id);

            DB::commit();
            return redirect()->route($this->metaModule.'.index')->withAlert('Data saved successfully');
        } catch (Exception $e) {
            DB::rollback();
            return redirect()->back()->withDanger($e->getMessage());
        }
    }

    public function validator ($request) {
        $validator = Validator::make($request->all(), [
            'last_stock' => 'required|max:150',
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

}
