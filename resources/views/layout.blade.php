<!DOCTYPE html>
<html lang="en">

<head>
    @include('assets.header')
    @yield('header')
</head>

<body id="page-top">

<!-- Page Wrapper -->
<div id="wrapper">

    <!-- Sidebar -->
    @include('libs.sidebar')
    <!-- End of Sidebar -->

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

        <!-- Main Content -->
        <div id="content">

            <!-- Topbar -->
            @include('libs.navbar')
            <!-- End of Topbar -->

            <!-- Begin Page Content -->
            <div class="container-fluid">
                <div class="content">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-lg-12">
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
                </div>
                @yield('content')
            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- End of Main Content -->

        <!-- Footer -->
        <footer class="sticky-footer bg-white">
            <div class="container my-auto">
                <div class="copyright text-center my-auto">
                    <span>Copyright &copy; Yayasan Pembangunan Citra Insan Indonesia 2023</span>
                </div>
            </div>
        </footer>
        <!-- End of Footer -->

    </div>
    <!-- End of Content Wrapper -->

</div>
<!-- End of Page Wrapper -->

<!-- Scroll to Top Button-->
<a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
</a>

<!-- Logout Modal-->
<div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
     aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Yakin ingin keluar?</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">Klik "Keluar" jika kamu ingin keluar dari akunmu</div>
            <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-dismiss="modal">Batal</button>
                <a class="btn btn-primary" href="{{url('logout')}}">Keluar</a>
            </div>
        </div>
    </div>
</div>

@include('assets.footer')
@yield('footer')

</body>

</html>
