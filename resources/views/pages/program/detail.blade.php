@extends('layout')
@section('program')
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
                                <a href="{{route('program.index')}}" class="loat-left"><i class="fa fa-arrow-left mr-2"></i></a>
                                Detail Program
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
                                                <td>Nama Program</td>
                                                <td>:</td>
                                                <td>{{ $data->name }}</td>
                                            </tr>
                                            <tr>
                                                <td>PM</td>
                                                <td>:</td>
                                                <td>{{ $data->pm ? $data->pm->name : '' }}</td>
                                            </tr>
                                            <tr>
                                                <td>Waktu Mulai</td>
                                                <td>:</td>
                                                <td>{{\App\Helpers::datetime_format($data->start_date, "date")}}</td>
                                            </tr>
                                            <tr>
                                                <td>Waktu Selesai</td>
                                                <td>:</td>
                                                <td>{{\App\Helpers::datetime_format($data->end_date, "date")}}</td>
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
