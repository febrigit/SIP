<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Model\Item;
use App\Model\ItemLog;
use App\Model\Position;
use App\Model\Unit;
use App\Helpers;
use Exception;
use DB;
use Storage;
use Auth;


class ItemController extends Controller
{
    protected $model;
    protected $metaModule;

    function __construct (){
        $this->model = New Item();
        $this->metaModule = 'item';
    }

    public function index()
    {
        $datas = $this->model::with('position', 'unit')->get();
        return view('pages.'.$this->metaModule.'.index', compact('datas'));
    }

    public function create()
    {
        $data = $this->model;
        $positions = Position::get();
        $units = Unit::get();
        return view('pages.'.$this->metaModule.'.form', compact('data', 'positions', 'units'));
    }

    public function edit($id)
    {
        $data = $this->model::find($id);
        $positions = Position::get();
        $units = Unit::get();
        return view('pages.'.$this->metaModule.'.form', compact('data', 'positions', 'units'));
    }

    public function show($id)
    {
        $data = $this->model::find($id);
        $logs = ItemLog::orderBy('id', 'DESC')->whereItemId($id)->get();
        return view('pages.'.$this->metaModule.'.detail', compact('data', 'logs'));
    }

    public function destroy($id)
    {
        $this->model::where('id', $id)->delete();
        return redirect()->back()->withAlert('Data deleted successfully');
    }

    public function store(Request $request)
    {
        DB::beginTransaction();
        try {
            $validator = $this->validator($request);
            if ($validator['status'] == 'error') return redirect()->back()->withDanger($validator['message']);

            $data = $this->model;
            $data->code = $request->code;
            $data->name = $request->name;
            $data->position_id = $request->position_id;
            $data->unit_id = $request->unit_id;
            $data->remarks = $request->remarks;

            $data->save();
            DB::commit();
            return redirect()->route($this->metaModule.'.index')->withAlert('Data saved successfully');
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
            $data->code = $request->code;
            $data->name = $request->name;
            $data->position_id = $request->position_id;
            $data->unit_id = $request->unit_id;
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
            'code' => 'required|max:150',
            'name' => 'required|max:150',
            'position_id' => 'required|max:150',
            'unit_id' => 'required|max:150',
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
