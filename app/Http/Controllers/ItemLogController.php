<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Model\ItemLog;
use App\Model\Item;
use App\Helpers;
use Exception;
use DB;
use Storage;
use Auth;


class ItemLogController extends Controller
{
    protected $model;
    protected $metaModule;

    function __construct (){
        $this->model = New ItemLog();
        $this->metaModule = 'item-log';
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
        $data = $this->model::with('itemLogDetail.item')->find($id);
        $items = Item::get();
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

        return 'USG-'.str_pad($no, 7, '0', STR_PAD_LEFT);
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
            return redirect()->route($this->metaModule.'.edit',['item_usage' => $data->id])->withAlert('Data saved successfully');
        } catch (Exception $e) {
            DB::rollback();
            return redirect()->back()->withDanger($e->getMessage());
        }
    }

}
