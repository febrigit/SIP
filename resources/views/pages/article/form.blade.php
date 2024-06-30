@extends('layout')
@php
    $metaModule = 'article';
    $mode = $data->id ? 'Edit' : 'Add';
    $btnLbl = $data->id ? 'Save Changes' : 'Save';
@endphp
@section($metaModule)
    active
@endsection
@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12 col-xs-12">
                    <div class="row mb-3">
                        <div class="col-12 padding-xs">
                            <h5 class="m-0">
                                <a href="{{route($metaModule.'.index')}}" class="loat-left"><i class="fa fa-arrow-left mr-2"></i></a>
                                {{ $mode }} {{ App\Helpers::kebabToTitle($metaModule) }}
                            </h5>
                        </div>
                    </div>
                    <div class="card mb-5">
                        @if (!$data->id)
                            <form method="post" action="{{route($metaModule.'.store')}}" enctype="multipart/form-data">
                        @else
                            <form method="post" action="{{url($metaModule.'/'.$data->id)}}" enctype="multipart/form-data">
                            @method('PUT')
                        @endif
                        @csrf
                        <div class="card-body">
                            <div class="row">
                                <div class="col-4 col-xs-12">
                                    <div class="form-group">
                                        <label>Name <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" name="name" value="{{ $data->name }}" required>
                                    </div>
                                </div>
                                <div class="col-4 col-xs-12">
                                    <div class="form-group">
                                        <label>Category <span class="text-danger">*</span></label>
                                        <select name="category_id" class="form-control" required>
                                            @foreach ($categories as $val)
                                                <option value="{{$val->id}}" @if($data->category_id == $val->id) selected @endif>{{ $val->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-4 col-xs-12">
                                    <div class="form-group">
                                        <label>Image File <span class="text-danger">*).jpeg/jpg/.png</span></label>
                                        <input class="form-control" type="file" name="image">
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-group">
                                        <label>Description</label>
                                        <textarea class="text-editor" rows="30" name="description">{{ $data->description }}</textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer pb-5">
                            @if(\App\Helpers::checkPermission('create-'.$metaModule) || \App\Helpers::checkPermission('update-'.$metaModule))
                            <button class="btn btn-success float-right"><i class="fa fa-check"></i> {{ $btnLbl }}</button>
                            @endif
                        </div>
                        </form>
                    </div>
                </div>
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
@endsection