@extends('layout')
@php
    $metaModule = 'permission';
@endphp
@section($metaModule)
    active
@endsection
@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-4 col-xs-12">
                    <div class="row mb-3">
                        <div class="col-12 padding-xs">
                            <h5 class="m-0">
                                <a href="{{route($metaModule.'.index')}}" class="loat-left"><i class="fa fa-arrow-left mr-2"></i></a>
                                Detail {{ App\Helpers::kebabToTitle($metaModule) }}
                            </h5>
                        </div>
                    </div>
                    @if(\App\Helpers::checkPermission('read-'.$metaModule))
                    <div class="card">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table compact">
                                    <tr>
                                        <td>Name</td>
                                        <td>:</td>
                                        <td>{{ $data->name }}</td>
                                    </tr>
                                    <tr>
                                        <td>Slug</td>
                                        <td>:</td>
                                        <td>{{ $data->slug }}</td>
                                    </tr>
                                    <tr>
                                        <td colspan="3">
                                            @include('libs.logs', $data)
                                        </td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
