<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\DataTables;

use App\User;
use App\Model\Division;


class UserController extends Controller
{
    public function index()
    {
        $datas = User::get();
        return view('pages.pengguna.index', compact('datas'));
    }

    // public function get_pengguna()
    // {
    //     $data = User::whereNull('deleted_at')->orderBy('id', 'desc');
    //     return DataTables::of($data)
    //         ->addColumn('action', function ($data){
    //             $edit = '<a class="btn btn-warning btn-sm" href="'.url('dashboard/pengguna/'.$data->id.'/edit').'">Edit</a>';
    //             $delete = '<a class="btn btn-danger btn-sm" data-toggle="modal" data-target="#delete'.$data->id.'">Hapus</a>';
    //             return '<div class="btn btn-group">'.$edit.$delete.'</div>';
    //         })
    //         ->rawColumns(['action'])
    //         ->make(true);
    // }

    public function create()
    {
        $data = new User();
        $division = Division::get();
        return view('pages.pengguna.form', compact('data', 'division'));
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
            'name' => 'required|max:255',
            'password' => 'required|max:255',
            'role' => 'required',
            'division_code' => 'required',
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
        $simpan->name = $request->name;
        $simpan->email = $request->email;
        $simpan->password = Hash::make($request->password);
        $simpan->role = $request->role;
        $simpan->division_code = $request->division_code;
        $simpan->remember_token = Hash::make($request->password);
        $simpan->save();
        return redirect()->route('pengguna.index')->withAlert('Pengguna berhasil disimpan');
    }

    public function edit($id)
    {
        $data = User::find($id);
        $division = Division::get();
        return view('pages.pengguna.form', compact('data', 'division'));
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|max:150',
            'name' => 'required|max:255',
            'password' => 'max:255',
            'role' => 'required',
            'division_code' => 'required',
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
                    'name' => $request->name,
                    'email' => $request->email,
                    'password' => Hash::make($request->password),
                    'role' => $request->role,
                    'division_code' => $request->division_code,
                ]);
        }else{
            User::where('id', $id)
                ->update([
                    'name' => $request->name,
                    'email' => $request->email,
                    'role' => $request->role,
                    'division_code' => $request->division_code,
                ]);
        }
        return redirect()->route('pengguna.index')->withAlert('Data pengguna berhasil diperbarui');
    }
}
