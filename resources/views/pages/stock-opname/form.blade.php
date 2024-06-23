@extends('layout')
@section('stock-opname')
    active
@endsection
@section('content')
    @php
        $metaTitle = 'Stock Opname';
        $metaModule = 'stock-opname';
        $mode = $data->id ? 'Edit' : 'Add';
        $btnLbl = $data->id ? 'Save Changes' : 'Save';

        $metaModuleDetail = 'stock-opname-detail';
    @endphp
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    @if (!$data->id)
                    <form method="post" action="{{route($metaModule.'.store')}}" enctype="multipart/form-data">
                    @else
                        <form method="post" action="{{url($metaModule.'/'.$data->id)}}" enctype="multipart/form-data">
                        @method('PUT')
                    @endif
                    @csrf
                        <div class="row mb-3">
                            <div class="col-md-6 padding-xs">
                                <h5 class="m-0">
                                    <a href="{{route($metaModule.'.index')}}" class="loat-left"><i class="fa fa-arrow-left mr-2"></i></a>
                                    {{ $mode }} {{ $metaTitle }}
                                    
                                    @if($data->id)
                                        @if($data->status == 'DRAFT')
                                        <span class="badge badge-warning">{{ $data->status }}</span>
                                        @else
                                        <span class="badge badge-primary">{{ $data->status }} </span>
                                        <i><small>By: {{ $data->submittedBy->name ?? '' }} at {{ $data->submitted_at }}</small></i>
                                        @endif
                                    @endif
                                </h5>
                            </div>
                            <div class="col-md-6 pull-right">
                                <button class="btn btn-success float-right"><i class="fa fa-check"></i> {{ $btnLbl }}</button>
                            </div>
                        </div>
                        <div class="card mb-2">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-12 col-md-2">
                                        <div class="form-group">
                                            <label>Code <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" name="code" value="{{ $data->code }}" disabled>
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-3">
                                        <div class="form-group">
                                            <label>Date <span class="text-danger">*</span></label>
                                            <input type="date" class="form-control" name="date" value="{{ $data->date }}" required>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label>Remarks</label>
                                            <textarea class="form-control" name="remarks">{{ $data->remarks }}</textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                
                </div>
            </div>
            @if ($data->id)
            <div class="row">
                <div class="col-6 col-xs-12">
                    <div class="card mb-2">
                        <div class="card-header">
                            List Item
                        </div>
                        <div class="card-body table-responsive">
                            <table class="table compact table-sm hover table-striped" id="datatable">
                                <thead>
                                <tr>
                                    <th width="30px">No</th>
                                    <th width="200">Item</th>
                                    <th>Stock</th>
                                    <th>Stock (Real)</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($items as $item)
                                    
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>({{ $item->code }}) {{ $item->name }}</td>
                                        <td><b>{{ $item->stock }} {{ $item->unit->code }}</td>
                                        <td class="text-center">
                                            <form method="post" action="{{route($metaModuleDetail.'.store')}}" enctype="multipart/form-data">
                                                <input type="hidden" name="stock_opname_id" value="{{ $data->id }}">
                                                <input type="hidden" name="item_id" value="{{ $item->id }}">
                                                <input type="hidden" name="first_stock" value="{{ $item->stock }}">
                                                @csrf
                                                <div class="input-group mb-3">
                                                    <input type="number" class="form-control" name="last_stock" required>
                                                    <input type="text" name="remarks" class="form-control" placeholder="Remarks">
                                                    <div class="input-group-append">
                                                        <button type="submit" class="btn-primary btn" ><i class="fa fa-check"></i></button>
                                                    </div>
                                                </div>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <div class="col-6 col-xs-12">
                    <div class="card mb-2">
                        <div class="card-header">
                            List Item Has SO
                        </div>
                        <div class="card-body table-responsive">
                            <table class="table compact table-sm hover table-striped" id="datatable2">
                                <thead>
                                <tr>
                                    <th width="30px">No</th>
                                    <th>Item</th>
                                    <th>First Stock</th>
                                    <th>Last Stock</th>
                                    <th>Diff</th>
                                    <th>Unit</th>
                                    <th>Remarks</th>
                                    <th width="40px">...</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($data->stockOpnameDetail as $item)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $item->item->name }}</td>
                                        <td>{{ number_format($item->first_stock) }}</td>
                                        <td>{{ number_format($item->last_stock) }}</td>
                                        <td>{{ number_format($item->qty) }}</td>
                                        <td> {{ $item->item->unit->code }}</td>
                                        <td><small>{{ $item->remarks }}</small></td>
                                        <td class="text-left"><a class="text-danger btn" data-toggle="modal" data-target="#delete{{$item->id}}"><i class="fa fa-trash"></i> </a> </td>
                                    </tr>
                                    <div class="modal fade" id="delete{{$item->id}}" role="dialog">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h4 class="modal-title">Delete data "{{$item->item->name}}"</h4>
                                                </div>
                                                <div class="modal-body">Are you sure want to delete this data?</div>
                                                <div class="modal-footer">
                                                    <form method="POST" action="{{url($metaModuleDetail.'/'.$item->id)}}">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button  class="btn btn-danger">Yes</button>
                                                    </form>
                                                    <button type="button" class="btn btn-warning" data-dismiss="modal">No, Cancel</button>
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
            @endif
    </div>
@endsection
