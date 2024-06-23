@extends('layout')
@section('item-usage')
    active
@endsection
@section('content')
    @php
        $metaTitle = 'Item Usage';
        $metaModule = 'item-usage';
        $mode = $data->id ? 'Edit' : 'Add';
        $btnLbl = $data->id ? 'Save Changes' : 'Save';

        $metaModuleDetail = 'item-usage-detail';
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
                    
                    @if ($data->id)
                    <div class="card mb-2">
                        <div class="card-header">
                            <div class="row">
                                <div class="col-6">List Item</div>
                                <div class="col-6 pull-right">
                                    <a class="btn btn-primary btn-sm float-right" data-toggle="collapse" href="#addItemCollapse" aria-controls="addItemCollapse">
                                        <i class="fa fa-plus"></i> Add Item
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6 col-sm-12 collapse" id="addItemCollapse">
                                    <form method="post" action="{{route($metaModuleDetail.'.store')}}" enctype="multipart/form-data">
                                    @csrf
                                    <input type="hidden" name="item_usage_id" value="{{ $data->id }}">
                                    <div class="card mb-2">
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>Code <span class="text-danger">*</span></label>
                                                        <select name="item_id" class="form-control" required>
                                                            @foreach ($items as $val)
                                                                <option value="{{$val->id}}" @if($data->item_id == $val->id) selected @endif>{{ $val->name }} ({{ $val->unit->code }})</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-sm-2">
                                                    <div class="form-group">
                                                        <label>Qty <span class="text-danger">*</span></label>
                                                        <input type="number" class="form-control" name="qty" required>
                                                    </div>
                                                </div>
                                                <div class="col-sm-4 pt-4">
                                                    <button class="btn btn-success"><i class="fa fa-check"></i> Save Item</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    </form>
                                </div>
                                <div class="col-12">
                                    <table class="table compact table-sm hover table-striped">
                                        <tr>
                                            <th width="30px">No</th>
                                            <th>Item</th>
                                            <th>Quantity</th>
                                            <th width="150px">...</th>
                                        </tr>
                                        @foreach($data->itemUsageDetail as $item)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $item->item->name }}</td>
                                                <td>{{ $item->qty }} {{ $item->item->unit->code }}</td>
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
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endif
                </div>
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
@endsection
