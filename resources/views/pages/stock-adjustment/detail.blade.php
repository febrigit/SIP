@extends('layout')
@section('stock-adjustment')
    active
@endsection
@section('content')
    @php
        $metaTitle = 'Stock Adjustment';
        $metaModule = 'stock-adjustment';
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
                    <div class="card mb-5">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6 col-12">
                                    <table class="table compact">
                                        <tr>
                                            <td>Code</td>
                                            <td>:</td>
                                            <td>{{ $data->code }}</td>
                                        </tr>
                                        <tr>
                                            <td>Item</td>
                                            <td>:</td>
                                            <td>({{ $data->item->code }}) {{ $data->item->name }}</td>
                                        </tr>
                                        <tr>
                                            <td>First Stock</td>
                                            <td>:</td>
                                            <td>{{ $data->first_stock }} {{ $data->item->unit->code }}</td>
                                        </tr>
                                        <tr>
                                            <td>Last Stock</td>
                                            <td>:</td>
                                            <td>{{ $data->last_stock }} {{ $data->item->unit->code }}</td>
                                        </tr>
                                        <tr>
                                            <td>Diff</td>
                                            <td>:</td>
                                            <td>{{ $data->qty }} {{ $data->item->unit->code }}</td>
                                        </tr>
                                        <tr>
                                            <td>Remarks</td>
                                            <td>:</td>
                                            <td>{{ $data->remarks }}</td>
                                        </tr>
                                        <tr>
                                            <td>By</td>
                                            <td>:</td>
                                            <td>{{ $data->createdBy->name }}</td>
                                        </tr>

                                        <tr>
                                            <td>Date</td>
                                            <td>:</td>
                                            <td>{{ $data->created_at }}</td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
@endsection
