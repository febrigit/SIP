<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\DataTables;
use App\User;
use App\Model\Role;
use Exception;
use DB;
use Auth;


class UserController extends Controller
{
    protected $model;
    protected $metaModule;

    function __construct (){
        $this->model = New User();
        $this->metaModule = 'user';
    }

    public function index()
    {
        $datas = $this->model::where('id', '!=', 1)->get();
        return view('pages.'.$this->metaModule.'.index', compact('datas'));
    }

    public function create()
    {
        $data = $this->model;
        $roles = Role::get();
        return view('pages.'.$this->metaModule.'.form', compact('data', 'roles'));
    }

    public function edit($id)
    {
        $data = $this->model::find($id);
        $roles = Role::get();
        return view('pages.'.$this->metaModule.'.form', compact('data', 'roles'));
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

    public function store(Request $request)
    {
        DB::beginTransaction();
        try {
            $validator = $this->validator($request);
            if ($validator['status'] == 'error') return redirect()->back()->withDanger($validator['message']);

            $data = $this->model;
            $data->name = $request->name;
            $data->email = $request->email;
            $data->username = $request->username;
            $data->password = Hash::make($request->password);
            $data->role_id = $request->role_id;
            $data->remember_token = Hash::make($request->password);
            $data->created_by = Auth::user()->id;
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
            $data->name = $request->name;
            $data->email = $request->email;
            $data->created_by = Auth::user()->id;
            $data->username = $request->username;
            $data->role_id = $request->role_id;
            if ($request->password) $data->password = Hash::make($request->password);

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
            'email' => 'required|max:150',
            'name' => 'required|max:255',
            'role_id' => 'required',
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
