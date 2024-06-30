@extends('layout')
@php
    $metaModule = 'user';
@endphp
@section('user')
    active
@endsection
@section('content')
    @php
        $mode = $data->id ? 'Edit' : 'Add';
        $btnLbl = $data->id ? 'Save Changes' : 'Save';
    @endphp
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="row mb-3">
                        <div class="col-md-4 padding-xs">
                            <h5 class="m-0">
                                <a href="{{route($metaModule.'.index')}}" class="loat-left"><i class="fa fa-arrow-left mr-2"></i></a>
                                {{ $mode }} User
                            </h5>
                        </div>
                    </div>
                    <div class="card mb-5">
                        @if (!$data->id)
                            <form method="post" action="{{route($metaModule.'.store')}}">
                        @else
                            <form method="post" action="{{url($metaModule.'/'.$data->id)}}">
                            @method('PUT')
                        @endif
                        @csrf
                        <div class="card-body">
                            <div class="row">
                                <div class="col-12 col-md-4">
                                    <div class="form-group">
                                        <label>Name <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" name="name" value="{{ $data->name }}">
                                    </div>
                                </div>
                                <div class="col-12 col-md-4">
                                    <div class="form-group">
                                        <label>Email <span class="text-danger">*</span></label>
                                        <input type="email" class="form-control" name="email"  value="{{ $data->email }}">
                                    </div>
                                </div>
                                <div class="col-12 col-md-4">
                                    <div class="form-group">
                                        <label>Role <span class="text-danger">*</span></label>
                                        <select name="role_id" class="form-control" required>
                                            @foreach ($roles as $val)
                                                <option value="{{$val->id}}" @if($data->role_id == $val->id) selected @endif>{{ $val->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-12 col-md-3">
                                    <div class="form-group">
                                        <label>Username <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" name="username"  value="{{ $data->username }}">
                                    </div>
                                </div>
                                <div class="col-12 col-md-3">
                                    <div class="form-group">
                                        <label>Password <span class="text-danger">*</span></label>
                                        <input type="password" class="form-control" name="password">
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
