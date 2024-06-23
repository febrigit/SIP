@extends('layout')
@section('stock-adjustment')
    active
@endsection
@section('header')
@endsection
@section('content')
    @php
        $metaTitle = 'Stock Adjustment';
        $metaModule = 'stock-adjustment';
    @endphp
    <div class="content">
        <div class="container-fluid">
            <div class="row mb-3 padding-xs">
                <div class="col-md-6 col-sm-6 col-xs-6"><h5 class="m-0">{{ $metaTitle }}</h5></div>
                <div class="col-md-6 col-sm-6 col-xs-6"><a class="btn btn-primary float-right btn-md btn-rounded" data-toggle="modal" data-target="#listItemModal"><i class="fa fa-plus"></i> Add</a></div>

                <div class="modal fade" id="listItemModal" role="dialog">
                    <div class="modal-dialog  modal-lg">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title">Choose Item</h4>
                            </div>
                            <div class="modal-body">
                                <div class="table-responsive table-responsive-sm">
                                    <table class="table compact hover table-sm" id="datatable2">
                                        <thead>
                                            <tr>
                                                <th width="30px">No</th>
                                                <th>Code</th>
                                                <th>Name</th>
                                                <th>Stock</th>
                                                <th width="50px">...</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($items as $item)
                                                <tr>
                                                    <td>{{ $loop->iteration }}</td>
                                                    <td>{{ $item->code }}</td>
                                                    <td>{{ $item->name }}</td>
                                                    <td>{{ number_format($item->stock) }} {{ $item->unit->code }}</td>
                                                    <td><a href="{{route($metaModule.'.create', ['stock_adjustment' => $item->id])}}" class="btn btn-success float-right btn-xs btn-rounded"><i class="fa fa-arrows-up-down"></i> Adjust Stock</a></td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            
                            <div class="table-responsive table-responsive-sm">
                                <table class="table compact hover table-sm" id="datatable">
                                    <thead>
                                        <tr>
                                            <th width="30px">No</th>
                                            <th width="50px">...</th>
                                            <th>Code</th>
                                            <th>Item</th>
                                            <th>First Stock</th>
                                            <th>Last Stock</th>
                                            <th>Diff</th>
                                            <th>Unit</th>
                                            <th>Remarks</th>
                                            <th>By</th>
                                            <th>Date</th>
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
                                                            <a class="dropdown-item" href="{{ url($metaModule.'/'.$item->id.'') }}">Detail</a>
                                                            <div class="dropdown-divider"></div>
                                                            <a class="dropdown-item" data-toggle="modal" data-target="#delete{{$item->id}}">Delete</a>
                                                        </div>
                                                      </div>
                                                </td>
                                                <td>{{ $item->code }}</td>
                                                <td>{{ $item->item->code }} | {{ $item->item->name }}</td>
                                                <td>{{ number_format($item->first_stock) }}</td>
                                                <td><b>{{ number_format($item->last_stock) }}</b></td>
                                                <td>{{ number_format($item->qty) }}</td>
                                                <td>{{ $item->item->unit->code }}</td>
                                                <td>{{ $item->createdBy->name }}</td>
                                                <td>{{ $item->remarks }}</td>
                                                <td>{{ $item->created_at }}</td>
                                            </tr>
                                            <div class="modal fade" id="delete{{$item->id}}" role="dialog">
                                                <div class="modal-dialog">
                                                    <!-- Modal content-->
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h4 class="modal-title">Delete data "{{$item->code}}"</h4>
                                                        </div>
                                                        <div class="modal-body">Are you sure want to delete this data? stock item will be restore</div>
                                                        <div class="modal-footer">
                                                            <form method="POST" action="{{url($metaModule.'/'.$item->id)}}">
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
            </div>
        </div><!-- /.container-fluid -->
    </div>
@endsection
@section('footer')
@endsection
