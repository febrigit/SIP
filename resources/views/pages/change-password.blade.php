@extends('layout')
@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="row mb-3">
                        <div class="col-md-4 padding-xs">
                            <h5 class="m-0">
                                Change Password
                            </h5>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-4">
                            <div class="card mb-5">
                                <form method="post" action="{{route('save.change-password')}}">
                                @csrf
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="form-group">
                                                <label>New Password <span class="text-danger">*</span></label>
                                                <input type="password" class="form-control" name="new_password" required>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="form-group">
                                                <label>Re-type Password <span class="text-danger">*</span></label>
                                                <input type="password" class="form-control" name="renew_password" required>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-footer pb-5">
                                    <button class="btn btn-success float-right">Save Changes</button>
                                </div>
                                </form>
                            </div>
                        </div>
                    </div>


                </div>
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
@endsection
