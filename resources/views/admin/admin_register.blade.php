<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <title>Admin Register</title>
        <meta http-equiv="x-ua-compatible" content="ie=edge" />
        <meta name="description" content="" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <meta property="og:title" content="" />
        <meta property="og:type" content="" />
        <meta property="og:url" content="" />
        <meta property="og:image" content="" />
        <!-- Favicon -->
        <link rel="shortcut icon" type="image/x-icon" href="{{ asset('backend/assets/imgs/theme/favicon.svg ' ) }}" />
        <!-- Template CSS -->
        <link href="{{ asset('backend/assets/css/main.css?v=1.1 ' ) }}" rel="stylesheet" type="text/css" />
        <!-- toastr css -->
        <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    </head>

    <body>
        <main>
            <section class="content-main">
                <div class="card mx-auto card-login shadow-lg" style="margin-top: 0px;">
                    <div class="card-body">

                        <!-- start login aleart message show -->
                            @if(Session::has('error'))
                            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                              <strong>{{ session::get('error') }}</strong>
                              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                              </button>
                            </div>
                            @endif
                            <!-- end login aleart message show -->

                        <h4 class="card-title mb-4 text-center">Sign Up</h4>
                        <form action="{{ route('admin.register.store') }}" method="post">
                            @csrf
                            <div class="mb-3">
                                <label class="form-label" for="name">Username</label>
                                <input class="form-control" id="name" placeholder="User Name " type="text" name="name" />
                                @error('name')
                                    <span class="text-danger" style="font-weight: bold;">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label class="form-label" for="email">Email</label>
                                <input class="form-control" id="email" placeholder="Your email" type="text" name="email" />
                                @error('email')
                                    <span class="text-danger" style="font-weight: bold;">{{ $message }}</span>
                                @enderror
                            </div>
                            <!-- form-group// -->
                            <div class="mb-3">
                                <label class="form-label" for="password">Password</label>
                                <input class="form-control" placeholder="Password" id="password" type="password" name="password" />
                                @error('password')
                                    <span class="text-danger" style="font-weight: bold;">{{ $message }}</span>
                                @enderror
                            </div>
                            <!-- form-group// -->
                            <!-- form-group// -->
                            <div class="mb-3">
                                <label class="form-label" for="rtpassword">Re-type Password</label>
                                <input class="form-control" placeholder="Confirm Password" type="password" name="password_confirmation" id="rtpassword" />
                                @error('password_confirmation')
                                    <span class="text-danger" style="font-weight: bold;">{{ $message }}</span>
                                @enderror
                            </div>
                            <!-- form-group// -->
                            <div class="mb-4">
                                <button type="submit" class="btn btn-primary w-100 justify-content-center">Register</button>
                            </div>
                            <!-- form-group// -->
                        </form>
                        <p class="text-center small text-muted mb-15">or sign up with</p>
                       
                        <p class="text-center mb-4">Already have an account? <a href="{{ route('login_form') }}">Sign in now</a></p>
                    </div>
                </div>
            </section>
        </main>
        <script src="{{ asset('backend/assets/js/vendors/jquery-3.6.0.min.js ') }}"></script>
        <script src="{{ asset('backend/assets/js/vendors/bootstrap.bundle.min.js ') }}"></script>
        <script src="{{ asset('backend/assets/js/vendors/jquery.fullscreen.min.js ') }}"></script>
        <!-- Main Script -->
        <script src="{{ asset('backend/assets/js/main.js?v=1.1" type="text/javascript ') }}"></script>

        <!-- toastr js -->
        <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

        <script type="text/javascript">
            @if(Session::has('success'))
                toastr.warning("{{Session::get('success') }}");
            @endif
            @if(Session::has('info'))
                toastr.info("{{Session::get('info') }}");
            @endif
        </script>
    </body>
</html>
