@extends('layout')
@section('program')
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
                        <div class="col-md-4 padding-xs">
                            <h5 class="m-0">
                                <a href="{{route('program.index')}}" class="loat-left"><i class="fa fa-arrow-left mr-2"></i></a>
                                {{ $mode }} Program Baru
                            </h5>
                        </div>
                    </div>
                    <div class="card mb-5">
                        @if (!$data->id)
                            <form method="post" action="{{route('program.store')}}">
                        @else
                            <form method="post" action="{{url('dashboard/program/'.$data->id)}}">
                            @method('PUT')
                        @endif
                        @csrf
                        <div class="card-body">
                            <div class="row">
                                <div class="col-12 col-md-3">
                                    <div class="form-group">
                                        <label>Kode <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" name="code" value="{{ $data->code }}">
                                    </div>
                                </div>
                                <div class="col-12 col-md-5">
                                    <div class="form-group">
                                        <label>Nama Program <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" name="name" value="{{ $data->name }}">
                                    </div>
                                </div>
                                <div class="col-12 col-md-4">
                                    <div class="form-group">
                                        <label>PM <span class="text-danger">*</span></label>
                                        <select name="pm_id" class="form-control">
                                            <option value=""></option>
                                            @foreach ($users as $pm)
                                            <option value="{{$pm->id}}" {{ $data->pm_id == $pm->id ? 'selected' : '' }}>{{$pm->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-12 col-md-3">
                                    <div class="form-group">
                                        <label>Waktu Mulai <span class="text-danger">*</span></label>
                                        <input type="date" class="form-control" name="start_date" value="{{ $data->start_date }}">
                                    </div>
                                </div>
                                <div class="col-12 col-md-3">
                                    <div class="form-group">
                                        <label>Waktu Selesai <span class="text-danger">*</span></label>
                                        <input type="date" class="form-control" name="end_date" value="{{ $data->end_date }}">
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
