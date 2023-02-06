<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\DataTables;

use App\Model\BankAccount;
use DB;


class BankAccountController extends Controller
{
    public function index()
    {
        $datas = BankAccount::get();
        return view('pages.bank-account.index', compact('datas'));
    }

    public function create()
    {
        $data = new BankAccount();
        return view('pages.bank-account.form', compact('data'));
    }

    public function edit($id)
    {
        $data = BankAccount::find($id);
        return view('pages.bank-account.form', compact('data'));
    }

    public function show($id)
    {
        $data = BankAccount::find($id);
        return view('pages.bank-account.detail', compact('data'));
    }


    public function destroy($id)
    {
        BankAccount::where('id', $id)->delete();
        return redirect()->back()->withAlert('Data dihapus');
    }

    public function store(Request $request)
    {
        $validator = $this->validator($request);
        if ($validator['status'] == 'error') return redirect()->back()->withDanger($validator['message']);

        $data = new BankAccount;
        $data->code = $request->code;
        $data->name = $request->name;
        $data->induk = $request->induk;
        $data->golongan = $request->golongan;
        $data->tipe = $request->tipe;
        $data->save();
        return redirect()->route('bank-account.index')->withAlert('Data berhasil disimpan');
    }

    public function update(Request $request, $id)
    {
        $validator = $this->validator($request);
        if ($validator['status'] == 'error') return redirect()->back()->withDanger($validator['message']);

        $data = BankAccount::find($id);
        $data->code = $request->code;
        $data->name = $request->name;
        $data->induk = $request->induk;
        $data->golongan = $request->golongan;
        $data->tipe = $request->tipe;
        $data->update();

        return redirect()->route('bank-account.index')->withAlert('Data berhasil diperbarui');
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
