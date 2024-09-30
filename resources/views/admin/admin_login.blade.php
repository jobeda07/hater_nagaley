<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <title>Admin Login</title>
        <meta http-equiv="x-ua-compatible" content="ie=edge" />
        <meta name="description" content="" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <meta property="og:title" content="" />
        <meta property="og:type" content="" />
        <meta property="og:url" content="" />
        <meta property="og:image" content="" />
         <!-- Favicon -->
        @php
            $logo = get_setting('site_favicon');
        @endphp
        @if($logo != null)
            <link rel="shortcut icon" type="image/x-icon" href="{{ asset(get_setting('site_favicon')->value ?? ' ') }}" />
        @else
            <link rel="shortcut icon" type="image/x-icon" href="{{ asset('upload/no_image.jpg') }}" alt="{{ env('APP_NAME') }}" />
        @endif
        <!-- Template CSS -->
        <link href="{{ asset('backend/assets/css/main.css?v=1.1 ' ) }}" rel="stylesheet" type="text/css" />
        <!-- toastr css -->
        <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    </head>

    <body>
        <main>
            <section class="content-main">
                <div class="card mx-auto card-login shadow-lg" style="margin-top: 70px;">
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

                        <h4 class="card-title mb-4 text-center">Admin Login</h4>
                        <form action="{{ route('admin.login') }}" method="post">
                        @csrf
                            <div class="mb-3">
                                <input class="form-control" placeholder="Username or email" type="text" id="email" name="email" value="{{old('email')}}"/>
                                @error('email')
                                    <span class="text-danger" style="font-weight: bold;">{{ $message }}</span>
                                @enderror
                            </div>
                            <!-- form-group// -->
                            <div class="mb-3">
                                <input class="form-control" placeholder="Password" id="password" type="password" name="password" />
                                @error('password')
                                    <span class="text-danger" style="font-weight: bold;">{{ $message }}</span>
                                @enderror
                            </div>
                            <!-- form-group// -->
                            <div class="mb-3">
                                <a href="{{ route('password.request') }}" class="float-end font-sm text-muted">Forgot password?</a>
                                <label class="form-check">
                                    <input type="checkbox" class="form-check-input" checked="" />
                                    <span class="form-check-label">Remember</span>
                                </label>
                            </div>
                            <!-- form-group form-check .// -->
                            <div class="mb-4">
                                <button type="submit" class="btn btn-primary w-100 justify-content-center">Login</button>
                            </div>
                            <!-- form-group// -->
                        </form>
                        <style type="text/css">
                            table, tbody, tfoot, thead, tr, th, td{
                                border: 1px solid #dee2e6 !important;
                            }
                            th{
                                font-weight: bolder !important;
                            }
                            .custom_input input, button, select, optgroup, textarea {
                                margin: 0;
                                font-family: inherit;
                                font-size: inherit;
                                line-height: inherit;
                                border: none;
                                width: 72px;
                            }
                        </style>
                        <p class="text-center small text-muted mb-15">or sign up with</p>
                       
                        <p class="text-center mb-4">Don't have account? <a href="{{ route('admin.regester') }}">Sign up</a></p>
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

        <!-- all toastr message show -->
        <script>
            @if(Session::has('message'))
            var type = "{{ Session::get('alert-type','info') }}"
            switch(type){
                case 'info':
                toastr.info(" {{ Session::get('message') }} ");
                break;

                case 'success':
                toastr.success(" {{ Session::get('message') }} ");
                break;

                case 'warning':
                toastr.warning(" {{ Session::get('message') }} ");
                break;

                case 'error':
                toastr.error(" {{ Session::get('message') }} ");
                break; 
            }
            @endif 
        </script>

        <!-- 3 color toastr message show -->
        <script type="text/javascript">
            @if(Session::has('success'))
                toastr.success("{{Session::get('success') }}");
            @endif
            @if(Session::has('warning'))
                toastr.warning("{{Session::get('warning') }}");
            @endif
            @if(Session::has('info'))
                toastr.info("{{Session::get('info') }}");
            @endif
        </script>
    </body>
</html>