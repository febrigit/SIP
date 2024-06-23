@extends('layout')
@section('dashboard')
    active
@endsection
@section('header')
<style>
    .container {
        padding: 1rem;
        min-width: 100%;
    }
</style>
@endsection
@section('content')


@php
$role = Auth::user()->role;

$menuPermission = \App\Helpers::initPermission();

// $menuPermission = [

// 'master-title' => ['SUPERADMIN', 'ADMIN', 'PROJECT MANAGER', 'FINANCE', 'FINANCE MANAGER', 'PURCHASING', 'DIREKTUR'],

// //  master
//     'user' => ['SUPERADMIN', 'ADMIN', 'PROJECT MANAGER', 'FINANCE', 'FINANCE MANAGER', 'PURCHASING', 'DIREKTUR'],
//     'coa' => ['SUPERADMIN', 'ADMIN', 'PROJECT MANAGER', 'FINANCE', 'FINANCE MANAGER', 'PURCHASING', 'DIREKTUR'],
//     'vendor' => ['SUPERADMIN', 'ADMIN', 'PROJECT MANAGER', 'FINANCE', 'FINANCE MANAGER', 'PURCHASING', 'DIREKTUR'],
//     'bank-account' => ['SUPERADMIN', 'ADMIN', 'PROJECT MANAGER', 'FINANCE', 'FINANCE MANAGER', 'PURCHASING', 'DIREKTUR'],
//     'funding' => ['SUPERADMIN', 'ADMIN', 'PROJECT MANAGER', 'FINANCE', 'FINANCE MANAGER', 'PURCHASING', 'DIREKTUR'],
//     'program' => ['SUPERADMIN', 'ADMIN', 'PROJECT MANAGER', 'FINANCE', 'FINANCE MANAGER', 'PURCHASING', 'DIREKTUR'],
//     'meta' => ['SUPERADMIN', 'ADMIN', 'PROJECT MANAGER', 'FINANCE', 'FINANCE MANAGER', 'PURCHASING', 'DIREKTUR'],
//     'general-setting' => ['SUPERADMIN', 'ADMIN', 'PROJECT MANAGER', 'FINANCE', 'FINANCE MANAGER', 'PURCHASING', 'DIREKTUR'],
// //  transaksi 
//     'activity-budget-request' => ['SUPERADMIN', 'ADMIN', 'STAFF', 'PROJECT MANAGER', 'FINANCE', 'FINANCE MANAGER', 'PURCHASING', 'DIREKTUR'],
//     'lar' => ['SUPERADMIN', 'ADMIN', 'STAFF', 'PROJECT MANAGER', 'FINANCE', 'FINANCE MANAGER', 'PURCHASING', 'DIREKTUR'],
//     'purchase-request' => ['SUPERADMIN', 'ADMIN', 'STAFF', 'PROJECT MANAGER', 'FINANCE', 'FINANCE MANAGER', 'PURCHASING', 'DIREKTUR'],
//     'purchase-order' => ['SUPERADMIN', 'ADMIN', 'PROJECT MANAGER', 'FINANCE', 'FINANCE MANAGER', 'PURCHASING', 'DIREKTUR'],
//     'travel-advance-request' => ['SUPERADMIN', 'ADMIN', 'STAFF', 'PROJECT MANAGER', 'FINANCE', 'FINANCE MANAGER', 'PURCHASING', 'DIREKTUR'],
//     'ter' => ['SUPERADMIN', 'ADMIN', 'STAFF', 'PROJECT MANAGER', 'FINANCE', 'FINANCE MANAGER', 'PURCHASING', 'DIREKTUR'],
//     'voucher' => ['SUPERADMIN', 'ADMIN', 'PROJECT MANAGER', 'FINANCE', 'FINANCE MANAGER', 'PURCHASING', 'DIREKTUR'],
// ]             
@endphp


<div class="container">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
    </div>
{{-- 
    <div class="row">
        @if(isset($my_data['ActivityBudgetRequest']) && $my_data['ActivityBudgetRequest'] > 0)
        <div class="col mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                Cash Advance</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $my_data['ActivityBudgetRequestApproved'] }} <small> / {{ $my_data['ActivityBudgetRequest'] }}</small></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endif
        @if(isset($my_data['Lar']) && $my_data['Lar'] > 0)
        <div class="col mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                Lar</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $my_data['LarApproved'] }}<small> / {{ $my_data['Lar'] }}</small></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endif
        @if(isset($my_data['TravelAdvanceRequest']) && $my_data['TravelAdvanceRequest'] > 0)
        <div class="col mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                Travel Advance</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $my_data['TravelAdvanceRequestApproved'] }}<small> / {{ $my_data['TravelAdvanceRequest'] }}</small></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endif
        @if(isset($my_data['Ter']) && $my_data['Ter'] > 0)
        <div class="col mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                TER</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $my_data['TerApproved'] }}<small> / {{ $my_data['Ter'] }}</small></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endif
        @if(isset($my_data['PurchaseOrder']) && $my_data['PurchaseOrder'] > 0)
        <div class="col mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                Purchase Order</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $my_data['PurchaseOrderApproved'] }}<small> / {{ $my_data['PurchaseOrder'] }}</small></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endif
        @if(isset($my_data['PurchaseRequest']) && $my_data['PurchaseRequest'] > 0)
        <div class="col mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                Purchase Request</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $my_data['PurchaseRequestApproved'] }}<small> / {{ $my_data['PurchaseRequest'] }}</small></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endif
        @if(isset($my_data['Voucher']) && $my_data['Voucher'] > 0)
        <div class="col mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                Voucher</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $my_data['VoucherApproved'] }}<small> / {{ $my_data['Voucher'] }}</small></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endif
        @if(isset($my_data['Additional']) && $my_data['Additional'] > 0)
        <div class="col mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                Additional</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $my_data['AdditionalApproved'] }}<small> / {{ $my_data['Additional'] }}</small></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endif
    </div>

    <div class="row">
        <div class="col-12 col-md-3 mb-4">
            <div class="card shadow">
                <div class="card-header">
                    <h6 class="m-0 font-weight-bold text-primary">Outstanding</h6>
                </div>
                <div class="card-body p-0">
                    <table class="table table-hovered compact m-0">
                        @if (isset($need_create['needLar']) && $need_create['needLar'] > 0)
                        <tr>
                            <td class="p-1 pl-3 pt-2">CA Menunggu LAR</td>
                            <td class="p-1">
                                <a href="{{ route('lar.index') }}" class="badge badge-{{$need_create['needLar'] > 0 ? 'secondary' : 'secondary'}}"><h6 class="mb-0 p-1">{{ $need_create['needLar'] }}</h6></a>
                            </td>
                        </tr>
                        @endif
                        @if (isset($need_create['needTer']) && $need_create['needTer'] > 0)
                        <tr>
                            <td class="p-1 pl-3 pt-2">TA Menunggu TER</td>
                            <td class="p-1">
                                <a href="{{ route('ter.index') }}" class="badge badge-{{$need_create['needTer'] > 0 ? 'secondary' : 'secondary'}}"><h6 class="mb-0 p-1">{{ $need_create['needTer'] }}</h6></a>
                            </td>
                        </tr>
                        @endif
                        @if(in_array($role, $menuPermission['purchase-order']))
                            @if (isset($need_create['needPo']) && $need_create['needPo'] > 0)
                            <tr>
                                <td class="p-1 pl-3 pt-2">PR Menunggu PO</td>
                                <td class="p-1">
                                    <a href="{{ route('purchase-order.index') }}" class="badge badge-{{$need_create['needPo'] > 0 ? 'secondary' : 'secondary'}}"><h6 class="mb-0 p-1">{{ $need_create['needPo'] }}</h6></a>

                                </td>
                            </tr>
                            @endif
                        @endif
                        @if(in_array($role, $menuPermission['voucher']))
                            @if (isset($need_create['needVoucherActivityBudgetRequest']) && $need_create['needVoucherActivityBudgetRequest'] > 0)
                            <tr>
                                <td class="p-1 pl-3 pt-2">CA Menunggu Voucher</td>
                                <td class="p-1">
                                    <a href="{{ route('voucher.index') }}" class="badge badge-{{$need_create['needVoucherActivityBudgetRequest'] > 0 ? 'secondary' : 'secondary'}}"><h6 class="mb-0 p-1">{{ $need_create['needVoucherActivityBudgetRequest'] }}</h6></a>

                                </td>
                            </tr>
                            @endif
                            @if (isset($need_create['needVoucherTravelAdvanceRequest']) && $need_create['needVoucherTravelAdvanceRequest'] > 0)
                            <tr>
                                <td class="p-1 pl-3 pt-2">TA Menunggu Voucher</td>
                                <td class="p-1">
                                    <a href="{{ route('voucher.index') }}" class="badge badge-{{$need_create['needVoucherTravelAdvanceRequest'] > 0 ? 'secondary' : 'secondary'}}"><h6 class="mb-0 p-1">{{ $need_create['needVoucherTravelAdvanceRequest'] }}</h6></a>

                                </td>
                            </tr>
                            @endif
                            @if (isset($need_create['needVoucherLar']) && $need_create['needVoucherLar'] > 0)
                            <tr>
                                <td class="p-1 pl-3 pt-2">LAR Menunggu Voucher</td>
                                <td class="p-1">
                                    <a href="{{ route('voucher.index') }}" class="badge badge-{{$need_create['needVoucherLar'] > 0 ? 'secondary' : 'secondary'}}"><h6 class="mb-0 p-1">{{ $need_create['needVoucherLar'] }}</h6></a>
                                
                                </td>
                            </tr>
                            @endif
                            @if (isset($need_create['needVoucherTer']) && $need_create['needVoucherTer'] > 0)
                            <tr>
                                <td class="p-1 pl-3 pt-2">Ter Menunggu Voucher</td>
                                <td class="p-1">
                                    <a href="{{ route('voucher.index') }}" class="badge badge-{{$need_create['needVoucherTer'] > 0 ? 'secondary' : 'secondary'}}"><h6 class="mb-0 p-1">{{ $need_create['needVoucherTer'] }}</h6></a>

                                </td>
                            </tr>
                            @endif
                            @if (isset($need_create['needVoucherAdditional']) && $need_create['needVoucherAdditional'] > 0)
                            <tr>
                                <td class="p-1 pl-3 pt-2">Additional Menunggu Voucher</td>
                                <td class="p-1">
                                    <a href="{{ route('voucher.index') }}" class="badge badge-{{$need_create['needVoucherAdditional'] > 0 ? 'secondary' : 'secondary'}}"><h6 class="mb-0 p-1">{{ $need_create['needVoucherAdditional'] }}</h6></a>
                                </td>
                            </tr>
                            @endif
                        @endif
                    </table>
                </div>
            </div>
        </div>


        <div class="col-12 col-md-3">
            <div class="card shadow">
                <div class="card-header">
                    <h6 class="m-0 font-weight-bold text-primary">Menugggu Approval Anda</h6>
                </div>
                <div class="card-body p-0">
                    <table class="table table-hovered compact m-0">
                        @if (isset($need_approval['ActivityBudgetRequest']) && $need_approval['ActivityBudgetRequest'] > 0)
                        <tr>
                            <td class="p-1 pl-3 pt-2">Activity Budget Request</td>
                            <td class="p-1">
                                <a href="{{ route('activity-budget-request.index', ['status_approval=REQUESTED']) }}" class="badge badge-{{$need_approval['ActivityBudgetRequest'] > 0 ? 'warning' : 'secondary'}}"><h6 class="mb-0 p-1">{{ $need_approval['ActivityBudgetRequest'] }}</h6></a>
                            </td>
                        </tr>
                        @endif
                        @if (isset($need_approval['PurchaseRequest']) && $need_approval['PurchaseRequest'] > 0)
                        <tr>
                            <td class="p-1 pl-3 pt-2">Purchase Request</td>
                            <td class="p-1">
                                <a href="{{ route('purchase-request.index', ['status_approval=REQUESTED']) }}" class="badge badge-{{$need_approval['PurchaseRequest'] > 0 ? 'warning' : 'secondary'}}"><h6 class="mb-0 p-1">{{ $need_approval['PurchaseRequest'] }}</h6></a>
                            </td>
                        </tr>
                        @endif
                        @if (isset($need_approval['PurchaseOrder']) && $need_approval['PurchaseOrder'] > 0)
                        <tr>
                            <td class="p-1 pl-3 pt-2">Purchase Order</td>
                            <td class="p-1">
                                <a href="{{ route('purchase-order.index', ['status_approval=REQUESTED']) }}" class="badge badge-{{$need_approval['PurchaseOrder'] > 0 ? 'warning' : 'secondary'}}"><h6 class="mb-0 p-1">{{ $need_approval['PurchaseOrder'] }}</h6></a>

                            </td>
                        </tr>
                        @endif
                        @if (isset($need_approval['TravelAdvanceRequest']) && $need_approval['TravelAdvanceRequest'] > 0)
                        <tr>
                            <td class="p-1 pl-3 pt-2">Travel Advance Request</td>
                            <td class="p-1">
                                <a href="{{ route('travel-advance-request.index', ['status_approval=REQUESTED']) }}" class="badge badge-{{$need_approval['TravelAdvanceRequest'] > 0 ? 'warning' : 'secondary'}}"><h6 class="mb-0 p-1">{{ $need_approval['TravelAdvanceRequest'] }}</h6></a>

                            </td>
                        </tr>
                        @endif
                        @if (isset($need_approval['Lar']) && $need_approval['Lar'] > 0)
                        <tr>
                            <td class="p-1 pl-3 pt-2">LAR</td>
                            <td class="p-1">
                                <a href="{{ route('lar.index', ['status_approval=REQUESTED']) }}" class="badge badge-{{$need_approval['Lar'] > 0 ? 'warning' : 'secondary'}}"><h6 class="mb-0 p-1">{{ $need_approval['Lar'] }}</h6></a>

                            </td>
                        </tr>
                        @endif
                        @if (isset($need_approval['Ter']) && $need_approval['Ter'] > 0)
                        <tr>
                            <td class="p-1 pl-3 pt-2">TER</td>
                            <td class="p-1">
                                <a href="{{ route('ter.index', ['status_approval=REQUESTED']) }}" class="badge badge-{{$need_approval['Ter'] > 0 ? 'warning' : 'secondary'}}"><h6 class="mb-0 p-1">{{ $need_approval['Ter'] }}</h6></a>
        
                            </td>
                        </tr>
                        @endif
                        @if (isset($need_approval['Voucher']) && $need_approval['Voucher'] > 0)
                        <tr>
                            <td class="p-1 pl-3 pt-2">Voucher</td>
                            <td class="p-1">
                                <a href="{{ route('voucher.index', ['status_approval=REQUESTED']) }}" class="badge badge-{{$need_approval['Voucher'] > 0 ? 'warning' : 'secondary'}}"><h6 class="mb-0 p-1">{{ $need_approval['Voucher'] }}</h6></a>

                            </td>
                        </tr>
                        @endif
                    </table>
                </div>
            </div>
        </div>

        @php
            $notifications = \App\Model\Notification::with('by')->whereUserTo(Auth::user()->id)->orderBy('id', 'DESC')->get();
            $total = count($notifications);
        @endphp
        <div class="col-md-6">
            <div class="card shadow mb-4">
                <div class="card-header">
                    <h6 class="m-0 font-weight-bold text-primary">Notifikasi</h6>
                </div>
                <div class="card-body p-0">
                    <div style="overflow: scroll; max-height:400px;">
                        @foreach ($notifications as $item) 
                            <form method="post"  action="{{ route('notification.read', ['id='.$item->id]) }}">
                                @csrf
                                <button type="submit" class="dropdown-item d-flex align-items-center pointer">
                                    <div class="row p-2" style="border-bottom: 1px solid rgb(204, 200, 200); width: 100%">
                                        <div class="col">
                                            <span class="font-weight-bold">{{ $item->title }} </span>
                                        </div>
                                        <div class="col">
                                            <span class="">{{ $item->description }}</span>
                                        </div>
                                        <div class="col">
                                            <div class="small text-gray-500">{{\App\Helpers::datetime_format($item->created_at, "datetime")}}</div>
                                        </div>
                                        <div class="col">
                                            <div class="small text-gray-600"><i>oleh : {{ $item->by ? $item->by->name : '' }}</i></div>
                                        </div>
                                    </div>
                                </button>
                            </form>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>

        <div class="col-12 col-md-12">
            <div class="card">
                <div class="card-header">Program Saya</div>
                <div class="card-body p-0" >
                    <div class=" table-responsive table-responsive-sm">
                        <table class="table compact hover table-sm table-striped">
                            <thead>
                                <tr>
                                    <th width="30px">No</th>
                                    <th>Kode</th>
                                    <th>Nama Program</th>
                                    <th>Lokasi</th>
                                    <th>Cost Center</th>
                                    <th>PM</th>
                                    <th>Waktu Mulai</th>
                                    <th>Waktu Selesai</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($my_program as $item)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $item->code  }}</td>
                                        <td>{{ $item->name  }}</td>
                                        <td>{{ $item->location  }}</td>
                                        <td>{{ $item->cost_center  }}</td>
                                        <td>{{ $item->pm ? $item->pm->name : '' }}</td>
                                        <td>{{\App\Helpers::datetime_format($item->start_date, "date")}}</td>
                                        <td>{{\App\Helpers::datetime_format($item->end_date, "date")}}</td>
                                        <td>{{ $item->status  }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
        </div>
    </div> --}}

    <!-- Content Row -->
{{-- 
    <div class="row">

        <!-- Area Chart -->
        <div class="col-xl-8 col-lg-7">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Development Approach</h6>
                </div>
                <div class="card-body">
                    <p>SB Admin 2 makes extensive use of Bootstrap 4 utility classes in order to reduce
                        CSS bloat and poor page performance. Custom CSS classes are used to create
                        custom components and custom utility classes.</p>
                    <p class="mb-0">Before working with this theme, you should become familiar with the
                        Bootstrap framework, especially the utility classes.</p>
                </div>
            </div>
        </div>

        <!-- Pie Chart -->
        <div class="col-xl-4 col-lg-5">
            <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Status Laporan Hasil Audit</h6>
                </div>
                <!-- Card Body -->
                <div class="card-body">
                    <div class="chart-pie pt-4 pb-2">
                        <canvas id="myPieChart"></canvas>
                    </div>
                    <div class="mt-4 text-center small">
                        <span class="mr-2">
                            <i class="fas fa-circle text-primary"></i> Review
                        </span>
                        <span class="mr-2">
                            <i class="fas fa-circle text-warning"></i> Revisi
                        </span>
                        <span class="mr-2">
                            <i class="fas fa-circle text-success"></i> Disetujui
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div> --}}
</div>
@endsection
@section('footer')
    <!-- Page level plugins -->
    {{-- <script src="{{asset('sbadmin/vendor/chart.js/Chart.min.js')}}"></script> --}}

    <!-- Page level custom scripts -->
    {{-- <script src="{{asset('sbadmin/js/demo/chart-area-demo.js')}}"></script> --}}
    {{-- <script src="{{asset('sbadmin/js/demo/chart-pie-demo.js')}}"></script> --}}
@endsection
