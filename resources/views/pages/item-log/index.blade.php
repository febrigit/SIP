@extends('layout')
@section('item-log')
    active
@endsection
@section('header')
@endsection
@section('content')
    @php
        $metaTitle = 'Item Log';
        $metaModule = 'item-log';
    @endphp
    <div class="content">
        <div class="container-fluid">
            <div class="row mb-3 padding-xs">
                <div class="col-md-6 col-sm-6 col-xs-6"><h5 class="m-0">{{ $metaTitle }}</h5></div>
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
                                        @foreach($datas as $item)
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
        </div><!-- /.container-fluid -->
    </div>
@endsection
@section('footer')
@endsection
