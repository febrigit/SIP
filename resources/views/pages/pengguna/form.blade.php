@extends('layout')
@section('pengguna')
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
                        <div class="col-md-4"><h5 class="m-0">{{ $mode }} Pengguna Baru</h5></div>
                        <div class="col-md-8"><a href="{{route('pengguna.index')}}" class="btn btn-primary float-right">Daftar Pengguna</a></div>
                    </div>
                    <div class="card mb-5">
                        @if (!$data->id)
                            <form method="post" action="{{route('pengguna.store')}}">
                        @else
                            <form method="post" action="{{url('dashboard/pengguna/'.$data->id)}}">
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
                                <div class="col-12 col-md-6">
                                    <div class="form-group">
                                        <label>Division <span class="text-danger">*</span></label>
                                        <select name="division_code" class="form-control">
                                            <option value=""></option>
                                            @foreach ($division as $divisi) 
                                            <option value="{{$divisi->code}}" {{ $data->code == $divisi->code ? 'selected' : '' }}>{{$divisi->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-12 col-md-6">
                                    <div class="form-group">
                                        <label>Role <span class="text-danger">*</span></label>
                                        <select name="role" class="form-control">
                                            <option value=""></option>
                                            <option value="ADMIN">ADMIN</option>
                                            <option value="AUDITEE">AUDITEE</option>
                                            <option value="AUDITOR">AUDITOR</option>
                                            <option value="AUDITOR PUSAT">AUDITOR PUSAT</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-12 col-md-12">
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
