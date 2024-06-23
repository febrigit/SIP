<!DOCTYPE html>
<html lang="en">

<head>
    @include('assets.header')
</head>

<body class="bg-gradient-light">

<div class="container">

    <!-- Outer Row -->
    <div class="row justify-content-center">

        <div class="col-12 col-md-6 p-0 mt-5">
            <div class="card o-hidden border-0 shadow-lg my-5">
                <div class="card-body p-0">
                    <!-- Nested Row within Card Body -->
                    <div class="row">
                        <div class="col-12">
                            <div class="p-5">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="text-left">
                                            <h1 class="h5 text-gray-900 mb-4">SIGOEDANG <hr> <small>Login</</h1>
                                        </div>
                                    </div>
                                </div>
                                <form method="post" action="{{url('login')}}" class="user">
                                    @if (session('notif'))
                                        <div class="alert alert-warning">
                                            {{ session('notif') }}
                                        </div>
                                    @endif
                                    @csrf
                                    <div class="form-group">
                                        <input type="text" name="username" class="form-control form-control-user" placeholder="Username">
                                    </div>
                                    <div class="form-group">
                                        <input type="password" name="password" class="form-control form-control-user" placeholder="">
                                    </div>
                                    
                                    <button class="btn btn-primary btn-user btn-block">
                                        Login
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="text-center">Copyright &copy; SIGOEDANG</div>
        </div>
    </div>

</div>

@include('assets.footer')

</body>

</html>
