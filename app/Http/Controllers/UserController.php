<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\DataTables;

class UserController extends Controller
{
    public function index()
    {
        return view('pages.pengguna.index');
    }

    public function get_pengguna()
    {
        $data = User::orderBy('id', 'desc');
        return DataTables::of($data)
            ->addColumn('action', function ($data){
                $edit = '<a class="btn btn-warning" href="'.url('dashboard/pengguna/'.$data->id.'/edit').'">edit</a>';
                $delete = '<a class="btn btn-danger" data-toggle="modal" data-target="#delete'.$data->id.'">delete</a>';
                return '<div class="btn btn-group">'.$edit.$delete.'</div>';
            })
            ->rawColumns(['action'])
            ->make(true);
    }

    public function create()
    {
        return view('pages.pengguna.add');
    }

    public function destroy($id)
    {
        User::where('id', $id)->delete();
        return redirect()->back()->withAlert('Pengguna dihapus');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|max:150',
            'nama' => 'required|max:255',
            'password' => 'required|max:255',
            'role' => 'required',
        ]);

        if ($validator->fails())
        {
            $messages = '';
            foreach ($validator->getMessageBag()->toArray() as $key => $value)
            {
                $messages .= $value[0] .' ';
            }
            return redirect()->back()->withDanger($messages);
        }

        $simpan = new User;
        $simpan->nama = $request->nama;
        $simpan->email = $request->email;
        $simpan->password = Hash::make($request->password);
        $simpan->role = $request->role;
        $simpan->remember_token = Hash::make($request->password);
        $simpan->save();
        return redirect()->route('pengguna.index')->withAlert('Pengguna berhasil disimpan');
    }

    public function edit($id)
    {
        $data = User::find($id);
        return view('pages.pengguna.edit', compact('id','data'));
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|max:150',
            'nama' => 'required|max:255',
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
            return redirect()->back()->withDanger($messages);
        }

        if ($request->password)
        {
            User::where('id', $id)
                ->update([
                    'nama' => $request->nama,
                    'email' => $request->email,
                    'password' => Hash::make($request->password),
                    'role' => $request->role,
                ]);
        }else{
            User::where('id', $id)
                ->update([
                    'nama' => $request->nama,
                    'email' => $request->email,
                    'role' => $request->role,
                ]);
        }
        return redirect()->route('pengguna.index')->withAlert('Data pengguna berhasil diperbarui');
    }
}
