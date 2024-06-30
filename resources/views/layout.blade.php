<!DOCTYPE html>
<html lang="en">

<head>
    @include('assets.header')
    @yield('header')
</head>

<body id="page-top">
<div id="wrapper">

    @include('libs.sidebar')

    <div id="content-wrapper" class="d-flex flex-column">

        <div id="content">
            <div id="app">
                @include('libs.navbar')

                <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-12">
                            @if (Session::has('sweet_alert.alert'))
                                @if(Session::get('sweet_alert.icon') == 'success')
                                    <div class="alert alert-success" role="alert">
                                        {!! Session::get('sweet_alert.text') !!}
                                    </div>
                                @endif
                                
                                @if(Session::get('sweet_alert.icon') == 'error')
                                    <div class="alert alert-danger" role="alert">
                                        {!! Session::get('sweet_alert.text') !!}
                                    </div>
                                @endif
                            @endif

                            @if (session('status'))
                                <div class="alert alert-success mb-3" role="alert">
                                    {{ session('status') }}
                                </div>
                            @elseif (session('alert'))
                                <div class="alert alert-info mb-3" role="alert">
                                    {{ session('alert') }}
                                </div>
                            @elseif (session('danger'))
                                <div class="alert alert-danger mb-3" role="alert">
                                    {{ session('danger') }}
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
                    @yield('content')
            </div>
        </div>

        <footer class="sticky-footer bg-white">
            <div class="container my-auto">
                <div class="copyright text-center my-auto">
                    <span>Copyright &copy; SIP</span>
                </div>
            </div>
        </footer>

    </div>

</div>

<a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
</a>

<div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
     aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Confirmation</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">Are you sure want to Logout?</div>
            <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                <a class="btn btn-primary" href="{{url('logout')}}">Yes, Logout</a>
            </div>
        </div>
    </div>
</div>

@include('assets.footer')
@yield('footer')

</body>

</html>
