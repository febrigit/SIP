@extends('layout')
@section('coa')
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
                                <a href="{{route('coa.index')}}" class="loat-left"><i class="fa fa-arrow-left mr-2"></i></a>
                                Detail Chart Of Account
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
                                                <td>Nama</td>
                                                <td>:</td>
                                                <td>{{ $data->name }}</td>
                                            </tr>
                                            <tr>
                                                <td>Golongan</td>
                                                <td>:</td>
                                                <td>{{ $data->golongan }}</td>
                                            </tr>
                                            <tr>
                                                <td>Induk</td>
                                                <td>:</td>
                                                <td>{{ $data->induk }}</td>
                                            </tr>
                                            <tr>
                                                <td>Tipe</td>
                                                <td>:</td>
                                                <td>{{ $data->tipe }}</td>
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
