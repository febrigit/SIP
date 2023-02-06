<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\DataTables;

use App\Model\Coa;
use DB;


class CoaController extends Controller
{
    public function index()
    {
        $datas = Coa::get();
        return view('pages.coa.index', compact('datas'));
    }

    public function create()
    {
        $data = new Coa();
        return view('pages.coa.form', compact('data'));
    }

    public function edit($id)
    {
        $data = Coa::find($id);
        return view('pages.coa.form', compact('data'));
    }

    public function show($id)
    {
        $data = Coa::find($id);
        return view('pages.coa.detail', compact('data'));
    }

    public function destroy($id)
    {
        Coa::where('id', $id)->delete();
        return redirect()->back()->withAlert('Data dihapus');
    }

    public function store(Request $request)
    {
        $validator = $this->validator($request);
        if ($validator['status'] == 'error') return redirect()->back()->withDanger($validator['message']);

        $data = new Coa;
        $data->code = $request->code;
        $data->name = $request->name;
        $data->induk = $request->induk;
        $data->golongan = $request->golongan;
        $data->tipe = $request->tipe;
        $data->save();
        return redirect()->route('Coa.index')->withAlert('Data berhasil disimpan');
    }

    public function update(Request $request, $id)
    {
        $validator = $this->validator($request);
        if ($validator['status'] == 'error') return redirect()->back()->withDanger($validator['message']);

        $data = Coa::find($id);
        $data->code = $request->code;
        $data->name = $request->name;
        $data->induk = $request->induk;
        $data->golongan = $request->golongan;
        $data->tipe = $request->tipe;
        $data->update();

        return redirect()->route('Coa.index')->withAlert('Data berhasil diperbarui');
    }

    public function validator ($request) {
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:255',
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
