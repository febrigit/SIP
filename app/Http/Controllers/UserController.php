<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\DataTables;

use App\User;
use DB;


class UserController extends Controller
{
    public function index()
    {
        $datas = User::get();
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
        return redirect()->back()->withAlert('Data dihapus');
    }

    public function store(Request $request)
    {
        $validator = $this->validator($request);
        if ($validator['status'] == 'error') return redirect()->back()->withDanger($validator['message']);

        $simpan = new User;
        $simpan->name = $request->name;
        $simpan->email = $request->email;
        $simpan->username = $request->username;
        $simpan->password = Hash::make($request->password);
        $simpan->role = $request->role;
        $simpan->no_telp = $request->no_telp;
        $simpan->remember_token = Hash::make($request->password);
        $simpan->save();
        return redirect()->route('user.index')->withAlert('Data berhasil disimpan');
    }

    public function update(Request $request, $id)
    {
        $validator = $this->validator($request);
        if ($validator['status'] == 'error') return redirect()->back()->withDanger($validator['message']);

        if ($request->password)
        {
            User::where('id', $id)
                ->update([
                    'name' => $request->name,
                    'email' => $request->email,
                    'no_telp' => $request->no_telp,
                    'username' => $request->username,
                    'password' => Hash::make($request->password),
                    'role' => $request->role,
                ]);
        }else{
            User::where('id', $id)
                ->update([
                    'name' => $request->name,
                    'email' => $request->email,
                    'no_telp' => $request->no_telp,
                    'username' => $request->username,
                    'role' => $request->role,
                ]);
        }
        return redirect()->route('user.index')->withAlert('Data berhasil diperbarui');
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
