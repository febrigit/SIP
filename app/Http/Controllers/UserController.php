<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\DataTables;
use App\User;
use Exception;
use DB;


class UserController extends Controller
{
    public function index()
    {
        $datas = User::where('id', '!=', 1)->get();
        return view('pages.user.index', compact('datas'));
    }

    public function create()
    {
        $data = new User();
        return view('pages.user.form', compact('data'));
    }

    public function edit($id)
    {
        $data = User::find($id);
        return view('pages.user.form', compact('data'));
    }

    public function show($id)
    {
        $data = User::find($id);
        return view('pages.user.detail', compact('data'));
    }

    public function destroy($id)
    {
        User::where('id', $id)->delete();
        return redirect()->back()->withAlert('Data deleted successfully');
    }

    public function store(Request $request)
    {
        DB::beginTransaction();
        try {
            $validator = $this->validator($request);
            if ($validator['status'] == 'error') return redirect()->back()->withDanger($validator['message']);

            $data = new User;
            $data->name = $request->name;
            $data->email = $request->email;
            $data->username = $request->username;
            $data->password = Hash::make($request->password);
            $data->role = $request->role;
            $data->remember_token = Hash::make($request->password);
            $data->save();
            DB::commit();
            return redirect()->route('user.index')->withAlert('Data saved successfully');
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

            $data = new User;
            $data->name = $request->name;
            $data->email = $request->email;
            $data->username = $request->username;
            $data->role = $request->role;
            if ($request->password) $data->password =  Hash::make($request->password);
            $data->save();

            DB::commit();
            return redirect()->route('user.index')->withAlert('Data updated successfully');
        } catch (Exception $e) {
            DB::rollback();
            return redirect()->back()->withDanger($e->getMessage());
        }
    }

    public function validator ($request) {
        $validator = Validator::make($request->all(), [
            'email' => 'required|max:150',
            'name' => 'required|max:255',
            'password' => 'max:255',
            'role' => 'required',
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
