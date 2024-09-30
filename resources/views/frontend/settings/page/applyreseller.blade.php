@extends('layouts.frontend')
@section('content-frontend')
 <main class="main">
        <div class="page-header breadcrumb-wrap">
            <div class="container">
                <div class="breadcrumb">
                    <a href="{{route('home')}}" rel="nofollow"><i class="fi-rs-home mr-5"></i>Home</a>
                    <span></span> Reseller
                    <span></span> Apply Reseller
                </div>
            </div>
        </div>
        <div class="container mb-80 mt-50">
            <div class="row">
                <div class="col-lg-6 offset-lg-3 col-12 col-sm-12">
                   <div class="login_wrap widget-taber-content background-white " >
                        <h3 class="text-center mb-3">Apply as a Reseller</h3>
                        <div class="padding_eight_all bg-white card p-4" style="box-shadow: rgba(99, 99, 99, 0.2) 0px 2px 8px 0px;">
                           
                            <form method="POST" action="{{ route('resellerApply') }}"
                                class="needs-validation" novalidate>
                                @csrf
                                <div class="form-group">
                                    <label for="name" class="fw-900">Name : <span class="text-danger">*</span></label>
                                    <input type="text" name="name" placeholder="Name"
                                        id="name" value="{{ old('name') }}" required />
                                    @error('name')
                                        <div class="text-danger" style="font-weight: bold;">
                                            {{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="username" class="fw-900">User Name : <span class="text-danger">*</span></label>
                                    <input type="text" name="username" placeholder="Username"
                                        id="username" value="{{ old('username') }}" required />
                                    @error('username')
                                        <div class="text-danger" style="font-weight: bold;">
                                            {{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="phone" class="fw-900">Phone Number : <span class="text-danger">*</span></label>
                                    <input type="number" name="phone" id="phone"
                                        placeholder="Phone Number" value="{{ old('phone') }}"
                                        required />
                                    @error('phone')
                                        <div class="text-danger" style="font-weight: bold;">
                                            {{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="email" class="fw-900">Email : <span class="text-danger">*</span></label>
                                    <input type="email" name="email" id="email"
                                        placeholder="Email" value="{{ old('email') }}" required />
                                    @error('email')
                                        <div class="text-danger" style="font-weight: bold;">
                                            {{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="password" class="fw-900">Password : <span class="text-danger">*</span></label>
                                    <input type="password" name="password" placeholder="Password"
                                        id="password" autocomplete="new-password" required />
                                    <span>password must be at least 8 characters</span>
                                    @error('password')
                                        <div class="text-danger" style="font-weight: bold;">
                                            {{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label class="fw-900">Confirm password : <span class="text-danger">*</span></label>
                                    <input type="password" placeholder="Confirm password"
                                        name="password_confirmation" required />
                                    @error('password')
                                        <div class="text-danger" style="font-weight: bold;">
                                            {{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="login_footer form-group mb-50">
                                    <div class="chek-form">
                                        <div class="custome-checkbox">
                                            <input class="form-check-input" type="checkbox" name="checkbox" id="exampleCheckbox13" value="" required />
                                            <label class="form-check-label" for="exampleCheckbox13"><span>I agree to terms &amp; Policy.</span></label>
                                        </div>
                                    </div>
                                    <a href="#"><i class="fi-rs-book-alt mr-5 text-muted"></i>Lean more</a>
                                </div>
                                <div class="form-group mb-30 seller__btn">
                                    <button type="submit" class="btn-primary " name="login">Submit &amp; Register</button>
                                </div>
                                <p class="font-xs text-muted"><strong>Note:</strong>Your personal
                                    data will be used to support your experience throughout this
                                    website, to manage access to your account, and for other
                                    purposes described in our privacy policy</p>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection