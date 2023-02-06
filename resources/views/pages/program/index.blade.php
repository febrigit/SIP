@extends('layout')
@section('program')
    active
@endsection
@section('header')
@endsection
@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row mb-3 padding-xs">
                <div class="col-md-6 col-sm-6 col-xs-6"><h5 class="m-0">Program</h5></div>
                <div class="col-md-6 col-sm-6 col-xs-6"><a href="{{route('program.create')}}" class="btn btn-primary float-right btn-md"><i class="fa fa-plus"></i>Tambah</a></div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <div class=" table-responsive table-responsive-sm">

                                <table class="table compact hover" id="datatable">
                                    <thead>
                                        <tr>
                                            <th width="30px">No</th>
                                            <th width="50px">...</th>
                                            <th>Kode</th>
                                            <th>Nama Program</th>
                                            <th>PM</th>
                                            <th>Waktu Mulai</th>
                                            <th>Waktu Selesai</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($datas as $item)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>

                                                    <div class="btn-group">
                                                        <button type="button " class="btn btn-outline-info btn-xs dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                            <i class="fa fa-ellipsis-vertical"></i>
                                                        </button>
                                                        <div class="dropdown-menu dropdown-menu-right">
                                                            <a class="dropdown-item" href="{{ url('dashboard/program/'.$item->id) }}">Detail</a>
                                                            <div class="dropdown-divider"></div>
                                                            <a class="dropdown-item" href="{{ url('dashboard/program/'.$item->id.'/edit') }}">Edit</a>
                                                            <a class="dropdown-item" data-toggle="modal" data-target="#delete{{$item->id}}">Hapus</a>
                                                        </div>
                                                      </div>

                                                    <div class="btn btn-group p-0">
                                                    </div>
                                                </td>
                                                <td>{{ $item->code  }}</td>
                                                <td>{{ $item->name  }}</td>
                                                <td>{{ $item->pm ? $item->pm->name : '' }}</td>
                                                <td>{{\App\Helpers::datetime_format($item->start_date, "date")}}</td>
                                                <td>{{\App\Helpers::datetime_format($item->end_date, "date")}}</td>
                                            </tr>
                                            <div class="modal fade" id="delete{{$item->id}}" role="dialog">
                                                <div class="modal-dialog">
                                                    <!-- Modal content-->
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h4 class="modal-title">Hapus pengguna "{{$item->name}}"</h4>
                                                        </div>
                                                        <div class="modal-body">Kamu yakin ingin menghapus pengguna ini?</div>
                                                        <div class="modal-footer">
                                                            <form method="POST" action="{{url('dashboard/program/'.$item->id)}}">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button  class="btn btn-danger">Ya</button>
                                                            </form>
                                                            <button type="button" class="btn btn-warning" data-dismiss="modal">Tidak, batal</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </div>
@endsection
@section('footer')
@endsection
