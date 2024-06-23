<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Model\StockOpnameDetail;
use Exception;
use DB;
use Storage;
use Auth;


class StockOpnameDetailController extends Controller
{
    protected $model;
    protected $metaModule;

    function __construct (){
        $this->model = New StockOpnameDetail();
        $this->metaModule = 'stock-opname';
    }

    public function index()
    {
        $datas = $this->model::with('createdBy')->get();
        return view('pages.'.$this->metaModule.'.index', compact('datas'));
    }

    public function destroy($id)
    {
        $this->model::where('id', $id)->delete();
        return redirect()->back()->withAlert('Item deleted successfully');
    }

    public function store(Request $request)
    {
        DB::beginTransaction();
        try {
            $validator = $this->validator($request);
            if ($validator['status'] == 'error') return redirect()->back()->withDanger($validator['message']);
            $data = $this->model;

            $data->stock_opname_id = $request->stock_opname_id;
            $data->item_id = $request->item_id;
            
            $data->first_stock = $request->first_stock;
            $data->last_stock = $request->last_stock;

            $data->qty = $data->last_stock - $data->first_stock;
            
            $data->remarks = $request->remarks;

            $data->save();
            DB::commit();
            return redirect()->back()->withAlert('Item Added successfully');
        } catch (Exception $e) {
            DB::rollback();
            return redirect()->back()->withDanger($e->getMessage());
        }
    }

    public function validator ($request) {
        $validator = Validator::make($request->all(), [
            'item_id' => 'required|max:150',
            'last_stock' => 'required|max:4',
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
