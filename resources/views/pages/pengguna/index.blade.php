@extends('layout')
@section('pengguna')
    active
@endsection
@section('header')
    <link href="https://cdn.datatables.net/1.10.7/css/jquery.dataTables.min.css" rel="stylesheet" type="text/css" />
@endsection
@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row mb-3">
                <div class="col-md-4"><h5 class="m-0">Daftar Pengguna</h5></div>
                <div class="col-md-8"><a href="{{route('pengguna.create')}}" class="btn btn-primary float-right">Tambah Pengguna</a></div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body table-responsive">
                                <table class="table compact hover" id="datatable">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Nama</th>
                                            <th>Email</th>
                                            <th>Divisi</th>
                                            <th>Role</th>
                                            <th>...</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($datas as $item)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $item->name  }}</td>
                                                <td>{{ $item->email  }}</td>
                                                <td>{{ $item->division_code  }}</td>
                                                <td>{{ $item->role  }}</td>
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
                                                            <h4 class="modal-title">Hapus pengguna "{{$item->name}}"</h4>
                                                        </div>
                                                        <div class="modal-body">Kamu yakin ingin menghapus pengguna ini?</div>
                                                        <div class="modal-footer">
                                                            <form method="POST" action="{{url('dashboard/pengguna/'.$item->id)}}">
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
