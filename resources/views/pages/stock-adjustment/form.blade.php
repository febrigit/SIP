@extends('layout')
@section('stock-adjustment')
    active
@endsection
@section('content')
    @php
        $metaTitle = 'Stock Adjustment';
        $metaModule = 'stock-adjustment';
        $mode = 'Add';
        $btnLbl = 'Save';
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
                        <form method="post" action="{{route($metaModule.'.store')}}" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="item_id" value="{{ $item->id }}">
                        <input type="hidden" name="first_stock" value="{{ $item->stock }}">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-4 col-12">
                                    <table class="table compact table-bordered">
                                        <tr>
                                            <td>Code</td>
                                            <td>:</td>
                                            <td>{{ $item->code }}</td>
                                        </tr>
                                        <tr>
                                            <td>Name</td>
                                            <td>:</td>
                                            <td>{{ $item->name }}</td>
                                        </tr>
                                        <tr>
                                            <td>Position</td>
                                            <td>:</td>
                                            <td>{{ $item->position->name }}</td>
                                        </tr>
                                        <tr>
                                            <td>Remarks</td>
                                            <td>:</td>
                                            <td>{{ $item->remarks }}</td>
                                        </tr>
                                        <tr>
                                            <td>Last Stock</td>
                                            <td>:</td>
                                            <td>{{ $item->stock }} {{ $item->unit->code }}</td>
                                        </tr>
                                    </table>
                                </div>
                                <div class="col-md-8 col-12">
                                    <div class="row">
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label>New Stock<span class="text-danger">*</span></label>
                                                <input type="number" class="form-control" name="last_stock" value="{{ $data->last_stock }}" required>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Remarks</label>
                                                <textarea class="form-control" name="remarks"></textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer pb-5">
                            <a class="btn btn-success float-right"  data-toggle="modal" data-target="#saveModal"><i class="fa fa-check"></i> {{ $btnLbl }}</a>

                            <div class="modal fade" id="saveModal" role="dialog">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h4 class="modal-title">Save new stock item "{{$item->name}}"</h4>
                                        </div>
                                        <div class="modal-body">
                                            Are you sure want to save this data ?<br>
                                            Data that has been saved cannot be changed.
                                        </div>
                                        <div class="modal-footer">
                                            <button  class="btn btn-primary">Yes</button>
                                            <a class="btn btn-warning" data-dismiss="modal">No, Cancel</a>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
