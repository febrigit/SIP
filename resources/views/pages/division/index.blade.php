@extends('layout')
@section('division')
    active
@endsection
@section('header')
    <link href="https://cdn.datatables.net/1.10.7/css/jquery.dataTables.min.css" rel="stylesheet" type="text/css" />
@endsection
@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row mb-3">
                <div class="col-md-4"><h5 class="m-0">Daftar Divisi</h5></div>
                <div class="col-md-8"><a href="{{route('division.create')}}" class="btn btn-primary float-right">Tambah Divisi</a></div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body table-responsive">
                                <table class="table compact hover" id="datatable">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Kode</th>
                                            <th>Nama</th>
                                            <th>...</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($datas as $item)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $item->code  }}</td>
                                                <td>{{ $item->name  }}</td>
                                                <td>
                                                    <div class="btn btn-group p-0">
                                                        <a class="btn btn-warning btn-sm" href="{{ url('dashboard/division/'.$item->id.'/edit') }}">Edit</a>
                                                        <a class="btn btn-danger btn-sm" data-toggle="modal" data-target="#delete{{$item->id}}">Hapus</a>
                                                    </div>
                                                </td>
                                            </tr>
                                            <div class="modal fade" id="delete{{$item->id}}" role="dialog">
                                                <div class="modal-dialog">
                                                    <!-- Modal content-->
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h4 class="modal-title">Hapus Divisi "{{$item->name}}"</h4>
                                                        </div>
                                                        <div class="modal-body">Kamu yakin ingin menghapus division ini?</div>
                                                        <div class="modal-footer">
                                                            <form method="POST" action="{{url('dashboard/division/'.$item->id)}}">
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
        </div><!-- /.container-fluid -->
    </div>
@endsection
@section('footer')
    <script src="https://cdn.datatables.net/1.10.7/js/jquery.dataTables.min.js"></script>
    <script>
        $(function() {
            $('#datatable').DataTable({
                processing: true,
                processing: true,
            });
        });
    </script>
@endsection
