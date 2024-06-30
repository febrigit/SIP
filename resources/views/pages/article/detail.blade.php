@extends('layout')
@php
    $metaModule = 'article';
@endphp
@section($metaModule)
    active
@endsection
@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12 col-xs-12 mb-5">
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
                            <div class="row">
                                <div class="col-12 mb-3 text-center">
                                    <img src="{{asset($data->path)}}" class="img-fluid" alt="..."  onerror="this.src='https://upload.wikimedia.org/wikipedia/commons/7/75/No_image_available.png';" style="max-height: 300px">
                                </div>
                                <div class="col-12">
                                    <div class="table-responsive">
                                        <table class="table compact">
                                            <tr>
                                                <td>Name</td>
                                                <td>:</td>
                                                <td>{{ $data->name }}</td>
                                            </tr>
                                            <tr>
                                                <td>Category</td>
                                                <td>:</td>
                                                <td>{{ $data->category->name }}</td>
                                            </tr>
                                            <tr>
                                                <td>By</td>
                                                <td>:</td>
                                                <td>{{ $data->user->name }}</td>
                                            </tr>
                                            <tr>
                                                <td colspan="3">
                                                    <div class="mb-3">Description :</div>
                                                    <div>{!! nl2br($data->description) !!}</div>
                                                </td>
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
                        </div>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
