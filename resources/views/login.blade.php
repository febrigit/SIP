<!DOCTYPE html>
<html lang="en">

<head>
    @include('assets.header')
</head>

<body class="bg-gradient-light">

<div class="container">

    <!-- Outer Row -->
    <div class="row justify-content-center">

        <div class="col-xl-10 col-lg-12 col-md-9">
            <div class="card o-hidden border-0 shadow-lg my-5">
                <div class="card-body p-0">
                    <!-- Nested Row within Card Body -->
                    <div class="row">
                        <div class="col-lg-6 d-none d-lg-block bg-login-image"></div>
                        <div class="col-lg-6">
                            <div class="p-5">
                                <div class="row">
                                    <div class="col-md-3">
                                        <img src="{{asset('img/new-logo-pmli.png')}}" height="30" width="70">
                                    </div>
                                    <div class="col-md-9">
                                        <div class="text-left">
                                            <h1 class="h5 text-gray-900 mb-4">E-AUDIT<br>PELINDO PEMBELAJARAN & KONSULTASI</h1>
                                        </div>
                                    </div>
                                </div>
                                <form method="post" action="{{url('login')}}" class="user">
                                    @csrf
                                    <div class="form-group">
                                        <input type="email" name="email" class="form-control form-control-user" placeholder="Masukan Akun Email">
                                    </div>
                                    <div class="form-group">
                                        <input type="password" name="password" class="form-control form-control-user" placeholder="Password">
                                    </div>
                                    <button class="btn btn-primary btn-user btn-block">
                                        Login
                                    </button>
                                </form>

                                @if (session('notif'))
                                    <div class="alert alert-warning mt-3">
                                        {{ session('notif') }}
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <span>Copyright &copy; PT Pendidikan Maritim dan Logistik Indonesia 2022</span>
    </div>

</div>

@include('assets.footer')

</body>

</html>
