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
                            <h5 class="m-0">Tambah Pengguna Baru</h5>
                            <a href="{{route('pengguna.index')}}" class="btn btn-primary float-right">Daftar Pengguna</a>
                        </div>
                        <div class="card-body">
                            <form method="post" action="{{route('pengguna.store')}}">
                                @csrf
                                <div class="form-group">
                                    <label>Nama Lengkap <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="nama">
                                </div>
                                <div class="form-group">
                                    <label>Email <span class="text-danger">*</span></label>
                                    <input type="email" class="form-control" name="email">
                                </div>
                                <div class="form-group">
                                    <label>Role <span class="text-danger">*</span></label>
                                    <select name="role" class="form-control">
                                        <option value=""></option>
                                        <option value="ADM">ADMIN</option>
                                        <option value="COP">CORPORATE SECRETARY</option>
                                        <option value="INT">INTERNAL AUDIT</option>
                                        <option value="ACC">ASSESSMENT & CONSULTATION</option>
                                        <option value="LRN">LEARNING</option>
                                        <option value="RCM">RESIDENCE & MICE</option>
                                        <option value="FHC">FINANCE & HUMAN CAPITAL</option>
                                        <option value="FEQ">FACILITY EQUIPMENT & QHSEE</option>
                                        <option value="KMT">KNOWLEDGE MANAGEMENT</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Password <span class="text-danger">*</span></label>
                                    <input type="password" class="form-control" name="password">
                                </div>

                                <button class="btn btn-success float-right">SIMPAN</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
@endsection
