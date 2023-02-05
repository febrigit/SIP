@extends('layout')
@section('division')
    active
@endsection
@section('content')
    @php
        $mode = $data->id ? 'Edit' : 'Tambah';
        $btnLbl = $data->id ? 'Simpan Perubahan' : 'Simpan Data';
    @endphp
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="row mb-3">
                        <div class="col-md-4"><h5 class="m-0">{{ $mode }} Divisi Baru</h5></div>
                        <div class="col-md-8"><a href="{{route('division.index')}}" class="btn btn-primary float-right">Daftar Divisi</a></div>
                    </div>
                    <div class="card mb-5">
                        @if (!$data->id)
                            <form method="post" action="{{route('division.store')}}">
                        @else
                            <form method="post" action="{{url('dashboard/division/'.$data->id)}}">
                            @method('PUT')
                        @endif
                        @csrf
                        <div class="card-body">
                            <div class="row">
                                <div class="col-12 col-md-6">
                                    <div class="form-group">
                                        <label>Kode <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" name="code" value="{{ $data->code }}">
                                    </div>
                                </div>
                                <div class="col-12 col-md-6">
                                    <div class="form-group">
                                        <label>Nama <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" name="name" value="{{ $data->name }}">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer pb-5">
                            <button class="btn btn-success float-right">{{ $btnLbl }}</button>
                        </div>
                        </form>
                    </div>
                </div>
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
@endsection
