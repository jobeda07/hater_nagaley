@extends('admin.admin_master')
@section('admin')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<section class="content-main">
    <div class="content-header">
        <h2 class="content-title">Change Password</h2>
    </div>
    <div class="card">
        <div class="card-body">
            <div class="row gx-5">
               @include('admin.body.asidebar')
                <div class="col-lg-9">
                    <section class="content-body p-xl-4">
                        @if(count($errors))
                        @foreach ($errors->all() as $error)
                           <p class="alert alert-danger alert-dismissible fade show"> {{ $error}} </p>
                        @endforeach

                        @endif
                        <form method="post" action="{{ route('update.password') }}">
                            @csrf
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="row gx-3">
                                        <div class="col-12 mb-3">
                                            <label class="form-label">Old Password</label>
                                            <input class="form-control" type="password" placeholder=""  name="oldpassword" />
                                        </div>
                                        <!-- col .// -->
                                        <div class="col-12 mb-3">
                                            <label class="form-label">New Password</label>
                                            <input class="form-control" type="password" placeholder=""  name="newpassword" />
                                        </div>
                                        <div class="col-12 mb-3">
                                            <label class="form-label">Confirm Password</label>
                                            <input class="form-control" type="password" placeholder=""  name="confirm_password" />
                                        </div>
                                    </div>
                                    <!-- row.// -->
                                </div>
                            </div>
                            <button class="btn btn-primary" type="submit">Save changes</button>
                        </form>
                    </section>
                    <!-- content-body .// -->
                </div>
                <!-- col.// -->
            </div>
            <!-- row.// -->
        </div>
        <!-- card body end// -->
    </div>
    <!-- card end// -->
</section>
@endsection