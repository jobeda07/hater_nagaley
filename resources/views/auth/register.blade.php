@extends('layouts.frontend')
@section('content-frontend')
    <main class="main pages">
        <div class="page-header breadcrumb-wrap">
            <div class="container">
                <div class="breadcrumb">
                    <a href="{{route('home')}}" rel="nofollow"><i class="fi-rs-home mr-5"></i>Home</a>
                    <span></span> Pages <span></span> My Account
                </div>
            </div>
        </div>
        <div class="page-content pt-150 pb-150">
            <div class="container">
                <div class="row">
                    <div class="col-xl-8 col-lg-10 col-md-12 m-auto">
                        <div class="row">
                            <div class="col-lg-6 col-md-8">
                                <div class="login_wrap widget-taber-content background-white">
                                    <div class="padding_eight_all bg-white">
                                        <div class="heading_s1">
                                            <h1 class="mb-5">Create an Account</h1>
                                            <p class="mb-30">Already have an account? <a href="{{route('login')}}">Login</a></p>
                                        </div>
                                        <form method="POST" action="{{ route('register') }}" class="needs-validation" novalidate>
                                            @csrf
                                            <div class="form-group">
                                                <label for="name" class="fw-900">Name : *</label>
                                                <input type="text" name="name" placeholder="Name" id="name" value="{{ old('name') }}" />
                                                @error('name')
                                                    <div class="text-danger" style="font-weight: bold;">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                                <label for="username" class="fw-900">User Name : *</label>
                                                <input type="text" name="username" placeholder="Username" id="username" value="{{ old('username') }}" />
                                                @error('username')
                                                    <div class="text-danger" style="font-weight: bold;">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                                <label for="phone" class="fw-900">Phone Number : *</label>
                                                <input type="number" name="phone" id="phone" placeholder="Phone Number" value="{{ old('phone') }}"/>
                                                @error('phone')
                                                    <div class="text-danger" style="font-weight: bold;">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                                <label for="email" class="fw-900">Email : *</label>
                                                <input type="email" name="email" id="email" placeholder="Email" value="{{ old('email') }}"/>
                                                @error('email')
                                                    <div class="text-danger" style="font-weight: bold;">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                                <label for="password" class="fw-900">Password : *</label>
                                                <input type="password" name="password" placeholder="Password" id="password" autocomplete="new-password"/>
                                                <span>password must be at least 8 characters</span>
                                                @error('password')
                                                    <div class="text-danger" style="font-weight: bold;">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                                <label class="fw-900">Confirm password : *</label>
                                                <input type="password" placeholder="Confirm password" name="password_confirmation"/>
                                                @error('password')
                                                    <div class="text-danger" style="font-weight: bold;">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            <div class="login_footer form-group mb-50">
                                                <div class="chek-form">
                                                    <div class="custome-checkbox">
                                                        <input class="form-check-input" type="checkbox" name="checkbox" id="exampleCheckbox12" value="" />
                                                        <label class="form-check-label" for="exampleCheckbox12"><span>I agree to terms &amp; Policy.</span></label>
                                                    </div>
                                                </div>
                                                <a href="#"><i class="fi-rs-book-alt mr-5 text-muted"></i>Lean more</a>
                                            </div>
                                            <div class="form-group mb-30">
                                                <button type="submit" class="btn btn-fill-out btn-block hover-up font-weight-bold" name="login">Submit &amp; Register</button>
                                            </div>
                                            <p class="font-xs text-muted"><strong>Note:</strong>Your personal data will be used to support your experience throughout this website, to manage access to your account, and for other purposes described in our privacy policy</p>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <script>
        // Example starter JavaScript for disabling form submissions if there are invalid fields
    (function () {
      'use strict'

      // Fetch all the forms we want to apply custom Bootstrap validation styles to
      var forms = document.querySelectorAll('.needs-validation')

      // Loop over them and prevent submission
      Array.prototype.slice.call(forms)
        .forEach(function (form) {
          form.addEventListener('submit', function (event) {
            if (!form.checkValidity()) {
              event.preventDefault()
              event.stopPropagation()
            }

            form.classList.add('was-validated')
          }, false)
        })
    })()
    </script>
@endsection