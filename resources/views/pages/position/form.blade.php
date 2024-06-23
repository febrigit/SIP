@extends('layout')
@section('position')
    active
@endsection
@section('content')
    @php
        $metaTitle = 'Position';
        $metaModule = 'position';
        $mode = $data->id ? 'Edit' : 'Add';
        $btnLbl = $data->id ? 'Save Changes' : 'Save';
    @endphp
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="row mb-3">
                        <div class="col-md-4 padding-xs">
                            <h5 class="m-0">
                                <a href="{{route($metaModule.'.index')}}" class="loat-left"><i class="fa fa-arrow-left mr-2"></i></a>
                                {{ $mode }} {{ $metaTitle }}
                            </h5>
                        </div>
                    </div>
                    <div class="card mb-5">
                        @if (!$data->id)
                            <form method="post" action="{{route($metaModule.'.store')}}" enctype="multipart/form-data">
                        @else
                            <form method="post" action="{{url($metaModule.'/'.$data->id)}}" enctype="multipart/form-data">
                            @method('PUT')
                        @endif
                        @csrf
                        <div class="card-body">
                            <div class="row">
                                <div class="col-12 col-md-2">
                                    <div class="form-group">
                                        <label>Code <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" name="code" value="{{ $data->code }}" required>
                                    </div>
                                </div>
                                <div class="col-12 col-md-4">
                                    <div class="form-group">
                                        <label>Name <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" name="name" value="{{ $data->name }}" required>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-group">
                                        <label>Remarks</label>
                                        <textarea class="form-control" rows="12" name="remarks">{{ $data->remarks }}</textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer pb-5">
                            <button class="btn btn-success float-right"><i class="fa fa-check"></i> {{ $btnLbl }}</button>
                        </div>
                        </form>
                    </div>
                </div>
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
@endsection
