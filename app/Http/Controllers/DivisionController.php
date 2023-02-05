<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\DataTables;

use App\User;
use App\Model\Division;


class DivisionController extends Controller
{
    public function index()
    {
        $datas = Division::get();
        return view('pages.division.index', compact('datas'));
    }

    public function create()
    {
        $data = new Division();
        return view('pages.division.form', compact('data'));
    }

    public function destroy($id)
    {
        Division::where('id', $id)->delete();
        return redirect()->back()->withAlert('Divisi dihapus');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'code' => 'required',
            'name' => 'required|max:255',
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

        $data = new Division;
        $data->code = $request->code;
        $data->name = $request->name;
        $data->save();
        return redirect()->route('division.index')->withAlert('divisi berhasil disimpan');
    }

    public function edit($id)
    {
        $data = Division::find($id);
        return view('pages.division.form', compact('data'));
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'code' => 'required|max:20',
            'name' => 'required|max:255',
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

        Division::where('id', $id)
            ->update([
                'code' => $request->code,
                'name' => $request->name,
            ]);
        return redirect()->route('division.index')->withAlert('Data divisi berhasil diperbarui');
    }
}
