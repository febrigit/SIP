@extends('layout')
@section('user')
    active
@endsection
@section('content')
    @php
        $mode = $data->id ? 'Edit' : 'Tambah';
        $btnLbl = $data->id ? 'Simpan Perubahan' : 'Simpan Data';
    @endphp
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="row mb-3">
                        <div class="col-md-4 padding-xs">
                            <h5 class="m-0">
                                <a href="{{route('user.index')}}" class="loat-left"><i class="fa fa-arrow-left mr-2"></i></a>
                                {{ $mode }} Pengguna Baru
                            </h5>
                        </div>
                    </div>
                    <div class="card mb-5">
                        @if (!$data->id)
                            <form method="post" action="{{route('user.store')}}">
                        @else
                            <form method="post" action="{{url('dashboard/user/'.$data->id)}}">
                            @method('PUT')
                        @endif
                        @csrf
                        <div class="card-body">
                            <div class="row">
                                <div class="col-12 col-md-6">
                                    <div class="form-group">
                                        <label>Nama Lengkap <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" name="name" value="{{ $data->name }}">
                                    </div>
                                </div>
                                <div class="col-12 col-md-6">
                                    <div class="form-group">
                                        <label>Email <span class="text-danger">*</span></label>
                                        <input type="email" class="form-control" name="email"  value="{{ $data->email }}">
                                    </div>
                                </div>
                                <div class="col-12 col-md-3">
                                    <div class="form-group">
                                        <label>No Telp <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" name="no_telp"  value="{{ $data->no_telp }}">
                                    </div>
                                </div>
                                <div class="col-12 col-md-3">
                                    <div class="form-group">
                                        <label>Role <span class="text-danger">*</span></label>
                                        <select name="role" class="form-control">
                                            <option value=""></option>
                                            <option value="SUPERADMIN" @if($data->role=='SUPERADMIN') selected @endif>SUPERADMIN</option>
                                            <option value="ADMIN" @if($data->role=='ADMIN') selected @endif>ADMIN</option>
                                            <option value="STAFF" @if($data->role=='STAFF') selected @endif>STAFF</option>
                                            <option value="PROJECT MANAGER" @if($data->role=='PROJECT MANAGER') selected @endif>PROJECT MANAGER</option>
                                            <option value="PURCHASING" @if($data->role=='PURCHASING') selected @endif>PURCHASING</option>
                                            <option value="FINANCE" @if($data->role=='FINANCE') selected @endif>FINANCE</option>
                                            <option value="FINANCE MANAGER" @if($data->role=='FINANCE MANAGER') selected @endif>FINANCE MANAGER</option>
                                        </select>
                                    </div>
                                </div>
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
                            <button class="btn btn-success float-right">{{ $btnLbl }}</button>
                        </div>
                        </form>
                    </div>
                </div>
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
@endsection
