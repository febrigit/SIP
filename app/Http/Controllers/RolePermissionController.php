<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Model\Role;
use App\Model\RolePermission;
use App\Helpers;
use App\Model\Permission;
use Exception;
use DB;
use Storage;
use Auth;


class RolePermissionController extends Controller
{
    protected $model;
    protected $metaModule;

    function __construct (){
        $this->model = New RolePermission();
        $this->metaModule = 'role-permission';
    }

    public function create($role_id)
    {
        if(Helpers::checkPermission('create-'.$this->metaModule) == false) return view('pages.error-access');

        $data = $this->model;
        $role = Role::find($role_id);
        $rolePermissions = RolePermission::whereRoleId($role_id)->get();
        $permissions = Permission::whereNotIn('id', collect($rolePermissions)->pluck('permission_id'))->get();
        return view('pages.'.$this->metaModule.'.form', compact('data','role', 'permissions', 'rolePermissions'));
    }

    public function destroy($id)
    {
        if(Helpers::checkPermission('delete-'.$this->metaModule) == false) return view('pages.error-access');

        $this->model::where('id', $id)->delete();
        return redirect()->back()->withAlert('Data deleted successfully');
    }

    public function store(Request $request)
    {
        if(Helpers::checkPermission('create-'.$this->metaModule) == false) return view('pages.error-access');

        DB::beginTransaction();
        try {
            $validator = $this->validator($request);
            if ($validator['status'] == 'error') return redirect()->back()->withDanger($validator['message']);

            $data = $this->model;
            $data->role_id = $request->role_id;
            $data->permission_id = $request->permission_id;
            $data->created_by = Auth::user()->id;
            $data->save();

            DB::commit();
            return redirect()->back()->withAlert('Data saved successfully');
        } catch (Exception $e) {
            DB::rollback();
            return redirect()->back()->withDanger($e->getMessage());
        }
    }

    public function validator ($request) {
        $validator = Validator::make($request->all(), [
            'role_id' => 'required',
            'permission_id' => 'required',
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
