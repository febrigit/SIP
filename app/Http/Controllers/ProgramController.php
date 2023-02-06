<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\DataTables;

use App\Model\Program;
use App\User;
use DB;


class ProgramController extends Controller
{
    public function index()
    {
        $datas = Program::with('pm')->get();
        return view('pages.program.index', compact('datas'));
    }

    public function create()
    {
        $data = new Program();
        $users = User::get();
        return view('pages.program.form', compact('data', 'users'));
    }

    public function edit($id)
    {
        $data = Program::find($id);
        $users = User::get();
        return view('pages.program.form', compact('data', 'users'));
    }

    public function show($id)
    {
        $data = Program::with('pm')->find($id);
        return view('pages.program.detail', compact('data'));
    }


    public function destroy($id)
    {
        Program::where('id', $id)->delete();
        return redirect()->back()->withAlert('Data dihapus');
    }

    public function store(Request $request)
    {
        $validator = $this->validator($request);
        if ($validator['status'] == 'error') return redirect()->back()->withDanger($validator['message']);

        $data = new Program;
        $data->code = $request->code;
        $data->name = $request->name;
        $data->pm_id = $request->pm_id;
        $data->start_date = $request->start_date;
        $data->end_date = $request->end_date;
        $data->save();
        return redirect()->route('program.index')->withAlert('Data berhasil disimpan');
    }

    public function update(Request $request, $id)
    {
        $validator = $this->validator($request);
        if ($validator['status'] == 'error') return redirect()->back()->withDanger($validator['message']);

        $data = Program::find($id);
        $data->code = $request->code;
        $data->name = $request->name;
        $data->pm_id = $request->pm_id;
        $data->start_date = $request->start_date;
        $data->end_date = $request->end_date;
        $data->update();

        return redirect()->route('program.index')->withAlert('Data berhasil diperbarui');
    }

    public function validator ($request) {
        $validator = Validator::make($request->all(), [
            'code' => 'required|max:255',
            'name' => 'required|max:255',
            'pm_id' => 'required',
            'start_date' => 'required',
            'end_date' => 'required',
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
