@extends('layout')
@section('pengguna')
    active
@endsection
@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="m-0">Ubah Pengguna</h5>
                            <a href="{{route('pengguna.index')}}" class="btn btn-primary float-right">Daftar Pengguna</a>
                        </div>
                        <div class="card-body">
                            <form method="post" action="{{url('dashboard/pengguna/'.$id)}}">
                                @method('PUT')
                                @csrf
                                <div class="form-group">
                                    <label>Nama Lengkap <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="nama" value="{{$data->nama}}">
                                </div>
                                <div class="form-group">
                                    <label>Email <span class="text-danger">*</span></label>
                                    <input type="email" class="form-control" name="email" value="{{$data->email}}">
                                </div>
                                <div class="form-group">
                                    <label>Role <span class="text-danger">*</span></label>
                                    <select name="role" class="form-control">
                                        <option value=""></option>
                                        <option value="ADM" {{$data->role == "ADM" ? "selected" : ""}}>ADMIN</option>
                                        <option value="COP" {{$data->role == "COP" ? "selected" : ""}}>CORPORATE SECRETARY</option>
                                        <option value="INT" {{$data->role == "INT" ? "selected" : ""}}>INTERNAL AUDIT</option>
                                        <option value="ACC" {{$data->role == "ACC" ? "selected" : ""}}>ASSESSMENT & CONSULTATION</option>
                                        <option value="LRN" {{$data->role == "LRN" ? "selected" : ""}}>LEARNING</option>
                                        <option value="RCM" {{$data->role == "RCM" ? "selected" : ""}}>RESIDENCE & MICE</option>
                                        <option value="FHC" {{$data->role == "FHC" ? "selected" : ""}}>FINANCE & HUMAN CAPITAL</option>
                                        <option value="FEQ" {{$data->role == "FEQ" ? "selected" : ""}}>FACILITY EQUIPMENT & QHSEE</option>
                                        <option value="KMT" {{$data->role == "KMT" ? "selected" : ""}}>KNOWLEDGE MANAGEMENT</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Password</label>
                                    <input type="password" class="form-control" name="password">
                                </div>
                                <a href="{{route('pengguna.index')}}" class="btn btn-warning">KEMBALI</a>
                                <button class="btn btn-success float-right">PERBARUI</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
@endsection
