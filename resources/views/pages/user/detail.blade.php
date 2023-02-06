@extends('layout')
@section('user')
    active
@endsection
@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="row mb-3">
                        <div class="col-md-4 padding-xs">
                            <h5 class="m-0">
                                <a href="{{route('user.index')}}" class="loat-left"><i class="fa fa-arrow-left mr-2"></i></a>
                                Detail Pengguna
                            </h5>
                        </div>
                    </div>
                    <div class="card mb-5">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-12">
                                    <div class="table-responsive">
                                        <table class="table compact">
                                            <tr>
                                                <td>Nama</td>
                                                <td>:</td>
                                                <td>{{ $data->name }}</td>
                                            </tr>
                                            <tr>
                                                <td>Email</td>
                                                <td>:</td>
                                                <td>{{ $data->email }}</td>
                                            </tr>
                                            <tr>
                                                <td>No Telp</td>
                                                <td>:</td>
                                                <td>{{ $data->no_telp }}</td>
                                            </tr>
                                            <tr>
                                                <td>Role</td>
                                                <td>:</td>
                                                <td>{{ $data->role }}</td>
                                            </tr>
                                            <tr>
                                                <td>Jabatan</td>
                                                <td>:</td>
                                                <td>{{ $data->jabatan }}</td>
                                            </tr>
                                            <tr>
                                                <td>Username</td>
                                                <td>:</td>
                                                <td>{{ $data->username }}</td>
                                            </tr>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        </form>
                    </div>
                </div>
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
@endsection
