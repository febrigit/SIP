@extends('layout')
@section('stock-opname')
    active
@endsection
@section('content')
    @php
        $metaTitle = 'Stock Opname';
        $metaModule = 'stock-opname';
    @endphp
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="row mb-3">
                        <div class="col-md-6 padding-xs">
                            <h5 class="m-0">
                                <a href="{{route($metaModule.'.index')}}" class="loat-left"><i class="fa fa-arrow-left mr-2"></i></a>
                                Detail {{ $metaTitle }}
                                @if($data->status == 'DRAFT')
                                <span class="badge badge-warning">{{ $data->status }}</span>
                                @else
                                <span class="badge badge-primary">{{ $data->status }} </span>
                                @endif
                            </h5>
                        </div>
                        <div class="col-md-6">
                            <a class="btn-primary btn float-right" data-toggle="modal" data-target="#submitedModal"><i class="fa fa-check"></i> Submit Data </a>

                            <div class="modal fade" id="submitedModal" role="dialog">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h4 class="modal-title">Submit data "{{$data->code}}"</h4>
                                        </div>
                                        <div class="modal-body">
                                            Are you sure want to submit this data ?<br>
                                            Data that has been submitted cannot be changed.
                                        </div>
                                        <div class="modal-footer">
                                            <form method="POST" action="{{url($metaModule.'/'.$data->id.'/submit')}}">
                                                @csrf
                                                @method('PUT')
                                                <button  class="btn btn-primary">Yes</button>
                                            </form>
                                            <button type="button" class="btn btn-warning" data-dismiss="modal">No, Cancel</button>
                                        </div>
                                    </div>
                                </div>
                            </div>

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
                                                <td>Date</td>
                                                <td>:</td>
                                                <td>{{ $data->date }}</td>
                                            </tr>
                                            <tr>
                                                <td>Remarks</td>
                                                <td>:</td>
                                                <td>{{ $data->remarks }}</td>
                                            </tr>
                                            <tr>
                                                <td>Created By</td>
                                                <td>:</td>
                                                <td>{{ $data->createdBy->name }}</td>
                                            </tr>
                                            @if($data->status!='DRAFT')
                                            <tr>
                                                <td>Submitted By</td>
                                                <td>:</td>
                                                <td>{{ $data->submittedBy->name }}</td>
                                            </tr>
                                            <tr>
                                                <td>Submitted At</td>
                                                <td>:</td>
                                                <td>{{ $data->submitted_at }}</td>
                                            </tr>
                                            @endif
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card">
                        <div class="card-body">
                            <div class="col-12">
                                <table class="table  hover table-striped" id="datatable">
                                    <thead>
                                    <tr>
                                        <th width="30px">No</th>
                                        <th>Item</th>
                                        <th>First Stock</th>
                                        <th>Last Stock</th>
                                        <th>Diff</th>
                                        <th>Unit</th>
                                        <th>Remarks</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($data->stockOpnameDetail as $item)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>({{ $item->item->code }}) {{ $item->item->name }}</td>
                                            <td>{{ number_format($item->first_stock) }}</td>
                                            <td>{{ number_format($item->last_stock) }}</td>
                                            <td>{{ number_format($item->qty) }}</td>
                                            <td> {{ $item->item->unit->code }}</td>
                                            <td>{{ $item->remarks }}</td>
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
