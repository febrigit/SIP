@extends('layout')
@php
    $metaModule = 'role-permission';
    $mode = $data->id ? 'Edit' : 'Add';
    $btnLbl = $data->id ? 'Save Changes' : 'Save';
@endphp
@section('role')
    active
@endsection
@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="row mb-3">
                        <div class="col-12 padding-xs">
                            <h5 class="m-0">
                                <a href="{{route('role.index')}}" class="loat-left"><i class="fa fa-arrow-left mr-2"></i></a>
                                {{ $mode }} {{ App\Helpers::kebabToTitle($metaModule) }}
                            </h5>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-12">
                            <div class="card mb-3">
                                <div class="card-body">
                                    <h4>Role : {{ $role->name }}</h4>
                                </div>
                            </div>
                        </div>
                        
                        @if(\App\Helpers::checkPermission('create-'.$metaModule))
                        <div class="col-md-6 col-12">
                            <div class="card mb-5">
                                <div class="card-header">List Permission</div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table compact hover table-sm" id="datatable2">
                                            <thead>
                                                <tr>
                                                    <th width="30px">No</th>
                                                    <th>Permission</th>
                                                    <th>Slug</th>
                                                    <th width="50px">...</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($permissions as $permit)
                                                <tr>
                                                    <td>{{ $loop->iteration }}</td>
                                                    <td>{{ $permit->name }}</td>
                                                    <td>{{ $permit->slug }}</td>
                                                    <td>
                                                        <form method="post" action="{{route($metaModule.'.store')}}" enctype="multipart/form-data">
                                                            @csrf
                                                            <input type="hidden" value="{{$role->id}}" name="role_id">
                                                            <input type="hidden" value="{{$permit->id}}" name="permission_id">
                                                            <button class="btn btn-primary float-right btn-xs"><i class="fa fa-plus"></i> Add</button>
                                                        </form>
                                                    </td>
                                                </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endif

                        @if(\App\Helpers::checkPermission('delete-'.$metaModule))
                        <div class="col-md-6 col-12">
                            <div class="card mb-5">
                                <div class="card-header">Active Permission</div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table compact hover table-sm" id="datatable">
                                            <thead>
                                                <tr>
                                                    <th width="30px">No</th>
                                                    <th>Permission</th>
                                                    <th>Slug</th>
                                                    <th width="35px">Log</th>
                                                    <th width="10px">...</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($rolePermissions as $item)
                                                <tr>
                                                    <td>{{ $loop->iteration }}</td>
                                                    <td>{{ $item->permission->name }}</td>
                                                    <td>{{ $item->permission->slug }}</td>
                                                    <td>@include('libs.logs', ['data' => $item])</td>
                                                    <td>
                                                        <form method="POST" action="{{url($metaModule.'/'.$item->id)}}">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button class="btn btn-danger float-right btn-xs"><i class="fa fa-trash"></i></button>
                                                        </form>
                                                    </td>
                                                </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endif

                    </div>

                </div>
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
@endsection
