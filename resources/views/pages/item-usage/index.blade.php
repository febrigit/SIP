@extends('layout')
@section('item-usage')
    active
@endsection
@section('header')
@endsection
@section('content')
    @php
        $metaTitle = 'Item Usage';
        $metaModule = 'item-usage';
    @endphp
    <div class="content">
        <div class="container-fluid">
            <div class="row mb-3 padding-xs">
                <div class="col-md-6 col-sm-6 col-xs-6"><h5 class="m-0">{{ $metaTitle }}</h5></div>
                <div class="col-md-6 col-sm-6 col-xs-6"><a href="{{route($metaModule.'.create')}}" class="btn btn-primary float-right btn-md btn-rounded"><i class="fa fa-plus"></i> Add</a></div>
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
                                            <th>By</th>
                                            <th>Date</th>
                                            <th>Status</th>
                                            <th>Remarks</th>
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
                                                            @if($item->status == 'DRAFT')
                                                                <div class="dropdown-divider"></div>
                                                                <a class="dropdown-item" href="{{ url($metaModule.'/'.$item->id.'/edit') }}">Edit</a>
                                                                <a class="dropdown-item" data-toggle="modal" data-target="#delete{{$item->id}}">Delete</a>
                                                            @endif
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>{{ $item->code }}</td>
                                                <td>{{ $item->createdBy->name }}</td>
                                                <td>{{ $item->date }}</td>
                                                <td>
                                                    @if($item->status == 'DRAFT')
                                                    <span class="badge badge-warning">{{ $item->status }}</span>
                                                    @else
                                                    <span class="badge badge-primary">{{ $item->status }} </span> <br>
                                                    <i><small>By: {{ $item->submittedBy->name ?? '' }} at {{ $item->submitted_at }}</small></i>
                                                    @endif
                                                </td>
                                                <td>{{ $item->remarks }}</td>
                                            </tr>
                                            <div class="modal fade" id="delete{{$item->id}}" role="dialog">
                                                <div class="modal-dialog">
                                                    <!-- Modal content-->
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h4 class="modal-title">Delete data "{{$item->code}}"</h4>
                                                        </div>
                                                        <div class="modal-body">Are you sure want to delete this data?</div>
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
