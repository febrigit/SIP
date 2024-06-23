@extends('layout')
@section('item')
    active
@endsection
@section('content')
    @php
        $metaTitle = 'Item';
        $metaModule = 'item';
    @endphp
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="row mb-3">
                        <div class="col-md-4 padding-xs">
                            <h5 class="m-0">
                                <a href="{{route($metaModule.'.index')}}" class="loat-left"><i class="fa fa-arrow-left mr-2"></i></a>
                                Detail {{ $metaTitle }}
                            </h5>
                        </div>
                    </div>
                    <div class="card mb-3">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-12">
                                    <div class="table-responsive">
                                        <table class="table compact">
                                            <tr>
                                                <td>Code</td>
                                                <td>:</td>
                                                <td>{{ $data->code }}</td>
                                            </tr>
                                            <tr>
                                                <td>Name</td>
                                                <td>:</td>
                                                <td>{{ $data->name }}</td>
                                            </tr>
                                            <tr>
                                                <td>Position</td>
                                                <td>:</td>
                                                <td>{{ $data->position->name }}</td>
                                            </tr>
                                            <tr>
                                                <td>Stock</td>
                                                <td>:</td>
                                                <td>{{ $data->stock }} {{ $data->unit->code }}</td>
                                            </tr>
                                            <tr>
                                                <td>Remarks</td>
                                                <td>:</td>
                                                <td>{{ $data->remarks }}</td>
                                            </tr>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        </form>
                    </div>
                </div>
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            
                            <div class="table-responsive table-responsive-sm">
                                <table class="table compact hover table-sm" id="datatable">
                                    <thead>
                                        <tr>
                                            <th width="30px">No</th>
                                            <th>Trans</th>
                                            <th>Item</th>
                                            <th>First Stock</th>
                                            <th>Last Stock</th>
                                            <th>Diff</th>
                                            <th>Unit</th>
                                            <th>By</th>
                                            <th>Date</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($logs as $item)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>
                                                    @php
                                                        if($item->ref == 'ItemReceive') $link = url('item-receive/'.$item->ref_id);
                                                        if($item->ref == 'ItemUsage') $link = url('item-usage/'.$item->ref_id);
                                                        if($item->ref == 'StockAdjustment') $link = url('stock-adjustment/'.$item->ref_id);
                                                        if($item->ref == 'StockOpname') $link = url('stock-opname/'.$item->ref_id);
                                                    @endphp
                                                    <a href="{{$link}}" class="text-primary" target="_blank">
                                                        <b>{{ $item->transaction_code }}</b>
                                                    </a>
                                                </td>
                                                <td>{{ $item->item->code }} | {{ $item->item->name }}</td>
                                                <td>{{ number_format($item->first_stock) }}</td>
                                                <td><b>{{ number_format($item->last_stock) }}</b></td>
                                                <td>{{ number_format($item->qty) }}</td>
                                                <td>{{ $item->item->unit->code }}</td>
                                                <td>{{ $item->createdBy->name }}</td>
                                                <td>{{ $item->created_at }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
@endsection
