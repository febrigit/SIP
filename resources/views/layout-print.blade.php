<!DOCTYPE html>
<html lang="en">

<head>
    @include('assets.header')
    @yield('header')
    <style>
        body {
            background: white;
            margin: 0px;
            padding: 0px;
        }
    </style>
</head>

<body id="page-top">

    <div class="container-fluid pl-5 pr-5">
        @yield('content')
    </div>

<!-- End of Page Wrapper -->

<!-- Scroll to Top Button-->
<a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
</a>

@include('assets.footer')
@yield('footer')
<script type="text/javascript">
        window.print();
    setTimeout(() => {
        window.close();
    }, 1000);
</script>
</body>

</html>
