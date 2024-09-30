@extends('layouts.frontend')
@section('content-frontend')
    <main class="main pages">
        <div class="page-header breadcrumb-wrap">
            <div class="container">
                <div class="breadcrumb">
                    <a href="{{route('home')}}" rel="nofollow"><i class="fi-rs-home mr-5"></i>Home</a>
                    <span></span> Pages <span></span> Login
                </div>
            </div>
        </div>
        <div class="page-content pt-150 pb-150">
            <div class="container">
                <div class="row">
                    <div class="col-xl-8 col-lg-10 col-md-12 m-auto">
                        <div class="row">
                            <div class="col-lg-6 pr-30 d-none d-lg-block" style="background-color: #c0bdc1">
                                @php
                                    $logo = get_setting('site_logo');
                                @endphp
                                @if ($logo != null)
                                    <img class="border-radius-15"
                                        src="{{ asset(get_setting('site_logo')->value ?? 'null') }}"
                                        alt="{{ env('APP_NAME') }}">
                                @else
                                    <img src="{{ asset('upload/no_image.jpg') }}" alt="{{ env('APP_NAME') }}"
                                        class="border-radius-15">
                                @endif
                                
                                <!--<img class="border-radius-15" src="{{asset('frontend/assets/imgs/page/login-1.png')}}" alt="" />-->
                            </div>
                            <div class="col-lg-6 col-md-8">
                                <div class="login_wrap widget-taber-content background-white">
                                    <div class="padding_eight_all bg-white">
                                        <div class="heading_s1">
                                            <h1 class="mb-5">Login</h1>
                                            <p class="mb-30">Don't have an account? <a href="{{ route('register') }}">Create here</a></p>
                                        </div>
                                        <form method="POST" action="{{ route('otp_login') }}" class="row g-3 needs-validation" novalidate>
                                            @csrf
                                            <div class="form-group">
                                                <input type="number" name="phone" placeholder="Phone *" value="{{ old('phone') }}" autofocus/>
                                                @error('phone')
                                                    <div class="text-danger" style="font-weight: bold;">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            <div class="login_footer form-group mb-50">
                                                <div class="chek-form">
                                                    <div class="custome-checkbox">
                                                        <input class="form-check-input" type="checkbox" name="checkbox" id="exampleCheckbox1" value="1" />
                                                        <label class="form-check-label" for="exampleCheckbox1"><span>{{ __('Remember me') }}</span></label>
                                                    </div>
                                                </div>
                                                 @if (Route::has('password.request'))
                                                    <a class="text-muted" href="{{ route('password.request') }}">
                                                        {{ __('Forgot your password?') }}
                                                    </a>
                                                @endif
                                            </div>
                                            <div class="form-group">
                                                <button type="submit" class="btn btn-heading btn-block hover-up"><i class="fa-solid fa-arrow-right-to-bracket"></i>{{ __('Log in') }}</button>
                                            </div>
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
