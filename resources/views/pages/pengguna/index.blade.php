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
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="m-0">Daftar Pengguna</h5>
                            <a href="{{route('pengguna.create')}}" class="btn btn-primary float-right">Tambah Pengguna Baru</a>
                        </div>
                        <div class="card-body table-responsive">
                            <table class="table" id="datatable">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Nama</th>
                                        <th>Email</th>
                                        <th>Role</th>
                                        <th>...</th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.row -->

            @foreach(\App\User::orderBy('id','desc')->get() as $item)
                <div class="modal fade" id="delete{{$item->id}}" role="dialog">
                    <div class="modal-dialog">
                        <!-- Modal content-->
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title">Hapus pengguna "{{$item->nama}}"</h4>
                            </div>
                            <div class="modal-body">Kamu yakin ingin menghapus pengguna ini?</div>
                            <div class="modal-footer">
                                <form method="POST" action="{{url('dashboard/pengguna/'.$item->id)}}">
                                    @csrf
                                    @method('DELETE')
                                    <button  class="btn btn-danger">YES</button>
                                </form>
                                <button type="button" class="btn btn-warning" data-dismiss="modal">NO, CANCEL</button>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach

        </div><!-- /.container-fluid -->
    </div>
@endsection
@section('footer')
    <script src="https://cdn.datatables.net/1.10.7/js/jquery.dataTables.min.js"></script>
    <script>
        $(function() {
            $('#datatable').DataTable({
                processing: true,
                serverSide: true,
                ajax: '{{route('get.pengguna')}}',
                columns: [
                    { data: 'id', name: 'id' },
                    { data: 'nama', name: 'nama' },
                    { data: 'email', name: 'email' },
                    { data: 'role', name: 'role' },
                    { data: 'action', name: 'action', orderable: false, searchable: false },
                ]
            });
        });
    </script>
@endsection
