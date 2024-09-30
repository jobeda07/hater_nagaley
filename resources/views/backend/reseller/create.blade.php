@extends('admin.admin_master')
@section('admin')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<section class="content-main">
    <div class="content-header">
        <h2 class="content-title">Reseller Create</h2>
        <div class="">
            <a href="{{ route('reseller.index') }}" class="btn btn-primary"><i class="material-icons md-list"></i> Reseller List</a>
        </div>
    </div> 
    <div class="row justify-content-center">
    	<div class="col-sm-8">
    		<div class="card">
		        <div class="card-body">
		            <div class="row">
		                <div class="col-md-12">
		                	{{-- @if(count($errors))
		                        @foreach ($errors->all() as $error)
		                           <p class="alert alert-danger alert-dismissible fade show"> {{ $error}} </p>
		                        @endforeach
	                        @endif --}}
		                    <form method="POST" action="{{ route('reseller.store') }}" enctype="multipart/form-data">
								@csrf
								<div class="form-group">
									<label for="name" class="col-form-label col-md-4 fw-bold">Name : *</label>
									<input type="text" class="form-control" name="name" placeholder="Name" id="name" value="{{ old('name') }}" required/>
									@error('name')
										<div class="text-danger" style="font-weight: bold;">{{ $message }}</div>
									@enderror
								</div>
								<div class="form-group">
									<label for="username" class="col-form-label col-md-4 fw-bold">User Name : *</label>
									<input type="text" class="form-control" name="username" placeholder="Username" id="username" value="{{ old('username') }}" required/>
									@error('username')
										<div class="text-danger" style="font-weight: bold;">{{ $message }}</div>
									@enderror
								</div>
								<div class="form-group">
									<label for="phone" class="col-form-label col-md-4 fw-bold">Phone Number : *</label>
									<input type="number" class="form-control" name="phone" id="phone" placeholder="Phone Number" value="{{ old('phone') }}" required/>
									@error('phone')
										<div class="text-danger" style="font-weight: bold;">{{ $message }}</div>
									@enderror
								</div>
								<div class="form-group">
									<label for="email" class="col-form-label col-md-4 fw-bold">Email : *</label>
									<input type="email" class="form-control" name="email" id="email" placeholder="Email" value="{{ old('email') }}" required/>
									@error('email')
										<div class="text-danger" style="font-weight: bold;">{{ $message }}</div>
									@enderror
								</div>
								<div class="form-group">
									<label for="password" class="col-form-label col-md-4 fw-bold">Password : *</label>
									<input type="password" class="form-control" name="password" placeholder="Password" id="password" autocomplete="new-password" required/>
									<span>password must be at least 8 characters</span>
									@error('password')
										<div class="text-danger" style="font-weight: bold;">{{ $message }}</div>
									@enderror
								</div>
								<div class="form-group">
									<label class="col-form-label col-md-4 fw-bold">Confirm password : *</label>
									<input type="password" class="form-control" placeholder="Confirm password" name="password_confirmation" required/>
									@error('password')
										<div class="text-danger" style="font-weight: bold;">{{ $message }}</div>
									@enderror
								</div>
								<div class="form-group">
									<label for="reseller_discount_percent" class="col-form-label col-md-4 fw-bold">Discount Percentage :</label>
									<input type="text" class="form-control" name="reseller_discount_percent" id="reseller_discount_percent" placeholder="Discount amount in percentage" value="{{ old('reseller_discount_percent') }}"/>
									@error('reseller_discount_percent')
										<div class="text-danger" style="font-weight: bold;">{{ $message }}</div>
									@enderror
								</div>
								<div class="form-group">
									<label for="wallet_default_amount" class="col-form-label col-md-4 fw-bold">Wallet Default Amount :</label>
									<input type="number" class="form-control" name="wallet_default_amount" required id="wallet_default_amount" placeholder="Add Default amount that can't withdraw" min="1" value="{{ old('wallet_default_amount') }}"/>
									@error('wallet_default_amount')
										<div class="text-danger" style="font-weight: bold;">{{ $message }}</div>
									@enderror
								</div>
								<div class="form-group">
									<label for="wallet_balance" class="col-form-label col-md-4 fw-bold">Wallet Amount Advance ADD :</label>
									<input type="number" class="form-control" name="wallet_balance" id="wallet_balance" placeholder="Add Advance amount in Wallet" min="1" value="{{ old('wallet_balance') }}"/>
									@error('wallet_balance')
										<div class="text-danger" style="font-weight: bold;">{{ $message }}</div>
									@enderror
								</div>
								<div class="row mb-4 justify-content-sm-end mt-30">
									<div class="col-lg-3 col-md-4 col-sm-5 col-6">
									<button type="submit" class="btn btn-primary" name="login">Submit</button>
									</div>
								</div>
							</form>
		                </div>
		            </div>
		            <!-- .row // -->
		        </div>
		        <!-- card body .// -->
		    </div>
		    <!-- card .// -->
    	</div>
    </div>
</section>
@endsection

@push('footer-script')
<!-- Shop Cover Photo Show -->
    <script type="text/javascript">
        $(document).ready(function(){
            $('#image2').change(function(e){
                var reader = new FileReader();
                reader.onload = function(e){
                    $('#showImage2').attr('src',e.target.result);
                }
                reader.readAsDataURL(e.target.files['0']);
            });
        });
    </script>
    <!-- Nid Card Show -->
    <script type="text/javascript">
        $(document).ready(function(){
            $('#image3').change(function(e){
                var reader = new FileReader();
                reader.onload = function(e){
                    $('#showImage3').attr('src',e.target.result);
                }
                reader.readAsDataURL(e.target.files['0']);
            });
        });
    </script>
    <!-- Trade license Show -->
    <script type="text/javascript">
        $(document).ready(function(){
            $('#image4').change(function(e){
                var reader = new FileReader();
                reader.onload = function(e){
                    $('#showImage4').attr('src',e.target.result);
                }
                reader.readAsDataURL(e.target.files['0']);
            });
        });
    </script>
@endpush