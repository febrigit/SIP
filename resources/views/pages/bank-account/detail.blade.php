@extends('layout')
@section('bank-account')
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
                                <a href="{{route('bank-account.index')}}" class="loat-left"><i class="fa fa-arrow-left mr-2"></i></a>
                                Detail Akun Bank
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
                                                <td>Kode</td>
                                                <td>:</td>
                                                <td>{{ $data->code }}</td>
                                            </tr>
                                            <tr>
                                                <td>Nama Bank</td>
                                                <td>:</td>
                                                <td>{{ $data->name }}</td>
                                            </tr>
                                            <tr>
                                                <td>Rekening</td>
                                                <td>:</td>
                                                <td>{{ $data->number }}</td>
                                            </tr>
                                            <tr>
                                                <td>Nama Rekening</td>
                                                <td>:</td>
                                                <td>{{ $data->account_name }}</td>
                                            </tr>
                                            <tr>
                                                <td>Saldo</td>
                                                <td>:</td>
                                                <td>{{ $data->balance }}</td>
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
