@extends('admin.admin_master')
@section('admin')
<section class="content-main">
    <div class="content-header">
        <h2 class="content-title">Create New Reseller</h2>
        {{-- <div>
            <a href="#" class="btn btn-primary"><i class="material-icons md-plus"></i> Create Reseller</a>
        </div> --}}
    </div>
    </div>
    <div class="card mb-4">
        <div class="card-body">
            <div class="page-content pt-10 pb-10">
                <div class="container">
                    <div class="row">
                        <div class="col-xl-8 col-lg-10 col-md-12 m-auto">
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="login_wrap widget-taber-content background-white">
                                        <div class="padding_eight_all bg-white">
                                            <form method="POST" action="{{ route('resellerApply') }}" class="needs-validation" novalidate>
                                                @csrf
                                                <div class="form-group">
                                                    <label for="name" class="fw-900">Name : *</label>
                                                    <input type="text" name="name" placeholder="Name" id="name" value="{{ old('name') }}" required/>
                                                    @error('name')
                                                        <div class="text-danger" style="font-weight: bold;">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                                <div class="form-group">
                                                    <label for="username" class="fw-900">User Name : *</label>
                                                    <input type="text" name="username" placeholder="Username" id="username" value="{{ old('username') }}" required/>
                                                    @error('username')
                                                        <div class="text-danger" style="font-weight: bold;">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                                <div class="form-group">
                                                    <label for="phone" class="fw-900">Phone Number : *</label>
                                                    <input type="number" name="phone" id="phone" placeholder="Phone Number" value="{{ old('phone') }}" required/>
                                                    @error('phone')
                                                        <div class="text-danger" style="font-weight: bold;">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                                <div class="form-group">
                                                    <label for="email" class="fw-900">Email : *</label>
                                                    <input type="email" name="email" id="email" placeholder="Email" value="{{ old('email') }}" required/>
                                                    @error('email')
                                                        <div class="text-danger" style="font-weight: bold;">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                                <div class="form-group">
                                                    <label for="password" class="fw-900">Password : *</label>
                                                    <input type="password" name="password" placeholder="Password" id="password" autocomplete="new-password" required/>
                                                    <span>password must be at least 8 characters</span>
                                                    @error('password')
                                                        <div class="text-danger" style="font-weight: bold;">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                                <div class="form-group">
                                                    <label class="fw-900">Confirm password : *</label>
                                                    <input type="password" placeholder="Confirm password" name="password_confirmation" required/>
                                                    @error('password')
                                                        <div class="text-danger" style="font-weight: bold;">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                                <div class="login_footer form-group mb-50">
                                                    <div class="chek-form">
                                                        <div class="custome-checkbox">
                                                            <input class="form-check-input" type="checkbox" name="checkbox" id="exampleCheckbox12" value="" required/>
                                                            <label class="form-check-label" for="exampleCheckbox12"><span>I agree to terms &amp; Policy.</span></label>
                                                        </div>
                                                    </div>
                                                    <a href="#"><i class="fi-rs-book-alt mr-5 text-muted"></i>Lean more</a>
                                                </div>
                                                <div class="form-group mb-30">
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                    <button type="submit" class="btn btn-primary" name="login">Submit &amp; Register</button>
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
            <!-- table-responsive //end -->
        </div>
        <!-- card-body end// -->
    </div>
</section>
@endsection
