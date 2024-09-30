@extends('admin.admin_master')
@section('admin')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<section class="content-main">
    <div class="content-header">
        <h2 class="content-title">Payment Methods Configuration</h2>
        
    </div> 
		<div class="row">
			@if ($errors->any())
			    <div class="alert alert-danger">
			        <ul>
			            @foreach ($errors->all() as $error)
			                <li>{{ $error }}</li>
			            @endforeach
			        </ul>
			    </div>
			@endif
		
        	<div class="col-sm-6">
				<div class="card">
					<div class="card-header">
						<h3>bKash</h3>
					</div>
		        	<div class="card-body" style="font-size: 12px;">
		        		<form method="post" action="{{ route('paymentMethod.update') }}" enctype="multipart/form-data">
							@csrf
							<input type="hidden" name="payment_method" value="bkash">
							<div class="form-group row mb-2">
	                            <input type="hidden" name="types[]" value="BKASH_CHECKOUT_APP_KEY">
	                            <div class="col-md-4">
	                                <label class="col-from-label">{{ __('BKASH CHECKOUT APP KEY')}}</label>
	                            </div>
	                            <div class="col-md-8">
	                                <input type="text" class="form-control" name="BKASH_CHECKOUT_APP_KEY" value="{{  env('BKASH_CHECKOUT_APP_KEY') }}" placeholder="{{__('BKASH CHECKOUT APP KEY')}}" required>
	                            </div>
	                        </div>
	                        <div class="form-group row mb-2">
	                            <input type="hidden" name="types[]" value="BKASH_CHECKOUT_APP_SECRET">
	                            <div class="col-md-4">
	                                <label class="col-from-label">{{__('BKASH CHECKOUT APP SECRET')}}</label>
	                            </div>
	                            <div class="col-md-8">
	                                <input type="text" class="form-control" name="BKASH_CHECKOUT_APP_SECRET" value="{{  env('BKASH_CHECKOUT_APP_SECRET') }}" placeholder="{{__('BKASH CHECKOUT APP SECRET')}}" required>
	                            </div>
	                        </div>
	                        <div class="form-group row mb-2">
	                            <input type="hidden" name="types[]" value="BKASH_CHECKOUT_USER_NAME">
	                            <div class="col-md-4">
	                                <label class="col-from-label">{{__('BKASH CHECKOUT USER NAME')}}</label>
	                            </div>
	                            <div class="col-md-8">
	                                <input type="text" class="form-control" name="BKASH_CHECKOUT_USER_NAME" value="{{  env('BKASH_CHECKOUT_USER_NAME') }}" placeholder="{{__('BKASH CHECKOUT USER NAME')}}" required>
	                            </div>
	                        </div>
	                        <div class="form-group row mb-2">
	                            <input type="hidden" name="types[]" value="BKASH_CHECKOUT_PASSWORD">
	                            <div class="col-md-4">
	                                <label class="col-from-label">{{__('BKASH CHECKOUT PASSWORD')}}</label>
	                            </div>
	                            <div class="col-md-8">
	                                <input type="text" class="form-control" name="BKASH_CHECKOUT_PASSWORD" value="{{  env('BKASH_CHECKOUT_PASSWORD') }}" placeholder="{{__('BKASH CHECKOUT PASSWORD')}}" required>
	                            </div>
	                        </div>
	                        <div class="form-group row mb-2">
	                            <div class="col-md-4">
	                                <label class="col-from-label">{{__('Bkash Sandbox Mode')}}</label>
	                            </div>
	                            <div class="col-md-8">
	                                <label class="aiz-switch aiz-switch-success mb-0">
	                                    <input value="1" name="bkash_sandbox" type="checkbox" @if (get_setting('bkash_sandbox') == 1)
	                                        checked
	                                    @endif>
	                                    <span class="slider round"></span>
	                                </label>
	                            </div>
	                        </div>
	                        <div class="form-group mb-0 text-right">
	                            <button type="submit" class="btn btn-sm btn-primary">{{__('Save')}}</button>
	                        </div>
						</form>
		        	</div>
		        	<!-- card body .// -->
			    </div>
			    <!-- card .// -->   
			</div>
			<div class="col-sm-6">
				<div class="card">
					<div class="card-header">
						<h3>Nagad</h3>
					</div>
		        	<div class="card-body" style="font-size: 12px;">
		        		<form method="post" action="{{ route('paymentMethod.update') }}" enctype="multipart/form-data">
							@csrf
							<input type="hidden" name="payment_method" value="nagad">

							<div class="form-group row mb-2">
	                            <input type="hidden" name="types[]" value="NAGAD_MODE">
	                            <div class="col-md-4">
	                                <label class="col-from-label">{{__('NAGAD MODE')}}</label>
	                            </div>
	                            <div class="col-md-8">
	                            <input type="text" class="form-control" name="NAGAD_MODE" value="{{  env('NAGAD_MODE') }}" placeholder="{{__('NAGAD MODE')}}" required>
	                            </div>
	                        </div>
	                        <div class="form-group row mb-2">
	                            <input type="hidden" name="types[]" value="NAGAD_MERCHANT_ID">
	                            <div class="col-md-4">
	                                <label class="col-from-label">{{__('NAGAD MERCHANT ID')}}</label>
	                            </div>
	                            <div class="col-md-8">
	                                <input type="text" class="form-control" name="NAGAD_MERCHANT_ID" value="{{  env('NAGAD_MERCHANT_ID') }}" placeholder="{{__('NAGAD MERCHANT ID')}}" required>
	                            </div>
	                        </div>
	                        <div class="form-group row mb-2">
	                            <input type="hidden" name="types[]" value="NAGAD_MERCHANT_NUMBER">
	                            <div class="col-md-4">
	                                <label class="col-from-label">{{__('NAGAD MERCHANT NUMBER')}}</label>
	                            </div>
	                            <div class="col-md-8">
	                                <input type="text" class="form-control" name="NAGAD_MERCHANT_NUMBER" value="{{  env('NAGAD_MERCHANT_NUMBER') }}" placeholder="{{__('NAGAD MERCHANT NUMBER')}}" required>
	                            </div>
	                        </div>
	                        <div class="form-group row mb-2">
	                            <input type="hidden" name="types[]" value="NAGAD_PG_PUBLIC_KEY">
	                            <div class="col-md-4">
	                                <label class="col-from-label">{{__('NAGAD PG PUBLIC KEY')}}</label>
	                            </div>
	                            <div class="col-md-8">
	                                <input type="text" class="form-control" name="NAGAD_PG_PUBLIC_KEY" value="{{  env('NAGAD_PG_PUBLIC_KEY') }}" placeholder="{{__('NAGAD PG PUBLIC KEY')}}" required>
	                            </div>
	                        </div>
	                        <div class="form-group row mb-2">
	                            <input type="hidden" name="types[]" value="NAGAD_MERCHANT_PRIVATE_KEY">
	                            <div class="col-md-4">
	                                <label class="col-from-label">{{__('NAGAD MERCHANT PRIVATE KEY')}}</label>
	                            </div>
	                            <div class="col-md-8">
	                                <input type="text" class="form-control" name="NAGAD_MERCHANT_PRIVATE_KEY" value="{{  env('NAGAD_MERCHANT_PRIVATE_KEY') }}" placeholder="{{__('NAGAD MERCHANT PRIVATE KEY')}}" required>
	                            </div>
	                        </div>
	                        <div class="form-group mb-0 text-right">
	                            <button type="submit" class="btn btn-sm btn-primary">{{__('Save')}}</button>
	                        </div>
						</form>
		        	</div>
		        	<!-- card body .// -->
			    </div>
			    <!-- card .// -->   
			</div>
			<div class="col-sm-6">
				<div class="card">
					<div class="card-header">
						<h3>SSL Commerz</h3>
					</div>
		        	<div class="card-body" style="font-size: 12px;">
		        		<form method="post" action="{{ route('paymentMethod.update') }}" enctype="multipart/form-data">
							@csrf
							<input type="hidden" name="payment_method" value="sslcommerz">

							<div class="form-group row mb-2">
	                            <input type="hidden" name="types[]" value="SSLCZ_STORE_ID">
	                            <div class="col-md-4">
	                                <label class="col-from-label">{{__('Sslcz Store Id')}}</label>
	                            </div>
	                            <div class="col-md-8">
	                                <input type="text" class="form-control" name="SSLCZ_STORE_ID" value="{{  env('SSLCZ_STORE_ID') }}" placeholder="{{__('Sslcz Store Id')}}" required>
	                            </div>
	                        </div>
	                        <div class="form-group row mb-2">
	                            <input type="hidden" name="types[]" value="SSLCZ_STORE_PASSWD">
	                            <div class="col-md-4">
	                                <label class="col-from-label">{{__('Sslcz store password')}}</label>
	                            </div>
	                            <div class="col-md-8">
	                                <input type="text" class="form-control" name="SSLCZ_STORE_PASSWD" value="{{  env('SSLCZ_STORE_PASSWD') }}" placeholder="{{__('Sslcz store password')}}" required>
	                            </div>
	                        </div>
	                        <div class="form-group row mb-2">
	                            <div class="col-md-4">
	                                <label class="col-from-label">{{__('Sslcommerz Sandbox Mode')}}</label>
	                            </div>
	                            <div class="col-md-8">
	                                <label class="aiz-switch aiz-switch-success mb-0">
	                                    <input value="1" name="sslcommerz_sandbox" type="checkbox" @if (get_setting('sslcommerz_sandbox') == 1)
	                                        checked
	                                    @endif>
	                                    <span class="slider round"></span>
	                                </label>
	                            </div>
	                        </div>
	                        <div class="form-group mb-0 text-right">
	                            <button type="submit" class="btn btn-sm btn-primary">{{__('Save')}}</button>
	                        </div>
						</form>
		        	</div>
		        	<!-- card body .// -->
			    </div>
			    <!-- card .// -->   
			</div>
			<div class="col-sm-6">
				<div class="card">
					<div class="card-header">
						<h3>Aamarpay</h3>
					</div>
		        	<div class="card-body" style="font-size: 12px;">
		        		<form method="post" action="{{ route('paymentMethod.update') }}" enctype="multipart/form-data">
							@csrf
							<input type="hidden" name="payment_method" value="aamarpay">

							<div class="form-group row mb-2">
	                            <input type="hidden" name="types[]" value="AAMARPAY_STORE_ID">
	                            <div class="col-md-4">
	                                <label class="col-from-label">{{__('Aamarpay Store Id')}}</label>
	                            </div>
	                            <div class="col-md-8">
	                                <input type="text" class="form-control" name="AAMARPAY_STORE_ID" value="{{  env('AAMARPAY_STORE_ID') }}" placeholder="{{__('Aamarpay Store Id')}}" required>
	                            </div>
	                        </div>
	                        <div class="form-group row mb-2">
	                            <input type="hidden" name="types[]" value="AAMARPAY_SIGNATURE_KEY">
	                            <div class="col-md-4">
	                                <label class="col-from-label">{{__('Aamarpay signature key')}}</label>
	                            </div>
	                            <div class="col-md-8">
	                                <input type="text" class="form-control" name="AAMARPAY_SIGNATURE_KEY" value="{{  env('AAMARPAY_SIGNATURE_KEY') }}" placeholder="{{__('Aamarpay signature key')}}" required>
	                            </div>
	                        </div>
	                        <div class="form-group row mb-2">
	                            <div class="col-md-4">
	                                <label class="col-from-label">{{__('Aamarpay Sandbox Mode')}}</label>
	                            </div>
	                            <div class="col-md-8">
	                                <label class="aiz-switch aiz-switch-success mb-0">
	                                    <input value="1" name="aamarpay_sandbox" type="checkbox" @if (get_setting('aamarpay_sandbox') == 1)
	                                        checked
	                                    @endif>
	                                    <span class="slider round"></span>
	                                </label>
	                            </div>
	                        </div>
	                        <div class="form-group mb-0 text-right">
	                            <button type="submit" class="btn btn-sm btn-primary">{{__('Save')}}</button>
	                        </div>
						</form>
		        	</div>
		        	<!-- card body .// -->
			    </div>
			    <!-- card .// -->   
			</div>
		
		<!-- col-6 //-->

		</div>
</section>

@endsection



@push('footer-script')

@endpush