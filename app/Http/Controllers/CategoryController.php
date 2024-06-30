<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Model\Category;
use App\Helpers;
use Exception;
use DB;
use Storage;
use Auth;


class CategoryController extends Controller
{
    protected $model;
    protected $metaModule;

    function __construct (){
        $this->model = New Category();
        $this->metaModule = 'category';
    }

    public function index()
    {
        if(Helpers::checkPermission('read-'.$this->metaModule) == false) return view('pages.error-access');

        $datas = $this->model::get();
        return view('pages.'.$this->metaModule.'.index', compact('datas'));
    }

    public function create()
    {
        if(Helpers::checkPermission('create-'.$this->metaModule) == false) return view('pages.error-access');

        $data = $this->model;
        return view('pages.'.$this->metaModule.'.form', compact('data'));
    }

    public function edit($id)
    {
        if(Helpers::checkPermission('update-'.$this->metaModule) == false) return view('pages.error-access');

        $data = $this->model::find($id);
        return view('pages.'.$this->metaModule.'.form', compact('data'));
    }

    public function show($id)
    {
        if(Helpers::checkPermission('read-'.$this->metaModule) == false) return view('pages.error-access');

        $data = $this->model::find($id);
        return view('pages.'.$this->metaModule.'.detail', compact('data'));
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
            $data->name = $request->name;
            $data->slug = $request->slug;
            $data->created_by = Auth::user()->id;
            $data->save();

            DB::commit();
            return redirect()->route($this->metaModule.'.index')->withAlert('Data saved successfully');
        } catch (Exception $e) {
            DB::rollback();
            return redirect()->back()->withDanger($e->getMessage());
        }
    }

    public function update(Request $request, $id)
    {
        if(Helpers::checkPermission('update-'.$this->metaModule) == false) return view('pages.error-access');

        DB::beginTransaction();
        try {
            $validator = $this->validator($request);
            if ($validator['status'] == 'error') return redirect()->back()->withDanger($validator['message']);

            $data = $this->model::find($id);
            $data->name = $request->name;
            $data->slug = $request->slug;
            $data->updated_by = Auth::user()->id;

            $data->save();

            DB::commit();
            return redirect()->route($this->metaModule.'.index')->withAlert('Data updated successfully');
        } catch (Exception $e) {
            DB::rollback();
            return redirect()->back()->withDanger($e->getMessage());
        }
    }

    public function validator ($request) {
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:150',
            'slug' => 'required|max:150',
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
