<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\DataTables;

use App\Model\Funding;
use DB;


class FundingController extends Controller
{
    public function index()
    {
        $datas = Funding::get();
        return view('pages.funding.index', compact('datas'));
    }

    public function create()
    {
        $data = new Funding();
        return view('pages.funding.form', compact('data'));
    }

    public function edit($id)
    {
        $data = Funding::find($id);
        return view('pages.funding.form', compact('data'));
    }

    public function show($id)
    {
        $data = Funding::find($id);
        return view('pages.funding.detail', compact('data'));
    }

    public function destroy($id)
    {
        Funding::where('id', $id)->delete();
        return redirect()->back()->withAlert('Data dihapus');
    }

    public function store(Request $request)
    {
        $validator = $this->validator($request);
        if ($validator['status'] == 'error') return redirect()->back()->withDanger($validator['message']);

        $simpan = new Funding;
        $simpan->name = $request->name;
        $simpan->save();
        return redirect()->route('funding.index')->withAlert('Data berhasil disimpan');
    }

    public function update(Request $request, $id)
    {
        $validator = $this->validator($request);
        if ($validator['status'] == 'error') return redirect()->back()->withDanger($validator['message']);

        Funding::where('id', $id)
            ->update([
                'name' => $request->name
            ]);

        return redirect()->route('funding.index')->withAlert('Data berhasil diperbarui');
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
