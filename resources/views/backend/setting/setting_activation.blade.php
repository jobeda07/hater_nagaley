@extends('admin.admin_master')
@section('admin')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<section class="content-main">
    <div class="content-header">
        <h2 class="content-title">Activation</h2>
    </div>
    <div class="">
    	<form method="post" action="{{ route('update.setting') }}" enctype="multipart/form-data">
	    	@csrf
		    <div class="row">
	            <div class="col-md-12">
					<div class="card">
						<div class="card-header">
							<h3>Application Activations</h3>
						</div>
				        <div class="card-body">
	                    	<div class="row">
	                    		<div class="col-sm-6 mb-3">
		                           <label for="multi_vendor" class="col-form-label" style="font-weight: bold;">Multi Vendor :</label>
		                           	<input type="hidden" name="types[]" value="multi_vendor">
									<select name="multi_vendor" id="multi_vendor" class="form-control">
										<option value="1"{{ get_setting('multi_vendor')->value == 1 ? ' Selected' : '' }}>Active</option>
										<option value="0"{{ get_setting('multi_vendor')->value == 0 ? ' Selected' : '' }}>Inactive</option>
									</select>
		                            @error('multi_vendor')
		                                <p class="text-danger">{{$message}}</p>
		                            @enderror
		                        </div>
                                <div class="col-sm-6 mb-3">
                                    <label for="vendor_comission" class="col-form-label" style="font-weight: bold;">Vendor Comission :</label>
                                     <div class="input-group">
                                         <div class="input-group-prepend">
                                           <div class="input-group-text">%</div>
                                         </div>
                                         <input type="hidden" name="types[]" value="vendor_comission">
                                         <input class="form-control" type="text" name="vendor_comission" id="vendor_comission" placeholder="Write Site name" value="{{ get_setting('vendor_comission')->value ?? 'Null' }}">
                                     </div>
                                     @error('vendor_comission')
                                         <p class="text-danger">{{$message}}</p>
                                     @enderror
                                 </div>
		                        <div class="col-sm-6 mb-3">
									<label for="otp_system" class="col-form-label" style="font-weight: bold;">OTP System :</label>
										<input type="hidden" name="types[]" value="otp_system">
									 <select name="otp_system" id="otp_system" class="form-control">
										 <option value="1"{{ get_setting('otp_system')->value == 1 ? ' Selected' : '' }}>Active</option>
										 <option value="0"{{ get_setting('otp_system')->value == 0 ? ' Selected' : '' }}>Inactive</option>
									 </select>
									 @error('otp_system')
										 <p class="text-danger">{{$message}}</p>
									 @enderror
								</div>
	                    	</div>
	                    	<!-- Row End -->
	                    	<div class="row">
				        		<div class="col-sm-6 mb-3">
									<label for="guest_checkout" class="col-form-label" style="font-weight: bold;">Guest Checkout :</label>
										<input type="hidden" name="types[]" value="guest_checkout">
									 <select name="guest_checkout" id="otp_system" class="form-control">
										 <option value="1"{{ get_setting('guest_checkout')->value == 1 ? ' Selected' : '' }}>Active</option>
										 <option value="0"{{ get_setting('guest_checkout')->value == 0 ? ' Selected' : '' }}>Inactive</option>
									 </select>
									 @error('guest_checkout')
										 <p class="text-danger">{{$message}}</p>
									 @enderror
								</div>
				        	</div>
				        	<!-- Row End// -->
				        </div>
				        <!-- card body .// -->
				    </div>
				    <!-- card .// -->


				</div>
				<!-- col-6 //-->
			</div>
			<div class="row mb-4 justify-content-sm-end">
				<div class="col-lg-3 col-md-4 col-sm-5 col-6">
					<input type="submit" class="btn btn-primary" value="Update">
				</div>
			</div>
		</form>
		<!-- .row // -->
	</div>
</section>

@endsection

@push('footer-script')
    <!--Site favicon Show -->
    <script type="text/javascript">
        $(document).ready(function(){
            $('#site_favicon').change(function(e){
                var reader = new FileReader();
                reader.onload = function(e){
                    $('#showFavicon').attr('src',e.target.result);
                }
                reader.readAsDataURL(e.target.files['0']);
            });
        });
    </script>

    <!--Site footer logo Show -->
    <script type="text/javascript">
        $(document).ready(function(){
            $('#site_footer_logo').change(function(e){
                var reader = new FileReader();
                reader.onload = function(e){
                    $('#showFooter').attr('src',e.target.result);
                }
                reader.readAsDataURL(e.target.files['0']);
            });
        });
    </script>

@endpush
