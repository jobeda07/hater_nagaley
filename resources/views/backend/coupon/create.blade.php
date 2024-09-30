@extends('admin.admin_master')
@section('admin')
@push('css')
<style>
    .hidden {
        display: none;
    }
span.select2.select2-container.select2-container--default {
    width: 100% !important;
}
</style>
@endpush
<section class="content-main">
    <div class="content-header">
        <h2 class="content-title">Coupon Add</h2>
        <div class="">
            <a href="{{ route('coupons.index') }}" class="btn btn-primary"><i class="material-icons md-plus"></i> Coupon List</a>
        </div>
    </div>
    <div class="row justify-content-center">
        <div class="row">
            <div class="col-md-8 mx-auto">
				<form method="post" action="{{ route('coupons.store') }}" enctype="multipart/form-data">
					@csrf

					<div class="card">
						<div class="card-header">
							<h3>Coupon</h3>
						</div>
			        	<div class="card-body">
			        		<div class="row">
			                	<div class="col-md-6 mb-4">
			                        <label for="coupon_code" class="col-form-label" style="font-weight: bold;">Coupon Code:<span class="text-danger">*</span></label>
			                        <input class="form-control" id="coupon_code" type="text" name="coupon_code" placeholder="Write Coupon Code" required>
			                        @error('coupon_code')
			                            <p class="text-danger">{{$message}}</p>
			                        @enderror
			                    </div>

			                    <div class="col-md-6 mb-4">
		                         	<label for="discount_type" class="col-form-label" style="font-weight: bold;">Discount Type:<span class="text-danger">*</span></label>
					                <div class="custom_select">
	                                    <select class="form-control select-active w-100 form-select select-nice" name="discount_type" id="discount_type" required>
						                	<option value="1">Fixed Amount</option>
		                            		<option value="0">Percent %</option>
	                                    </select>
	                                </div>
		                        </div>

		                        <div class="col-md-6 mb-4">
		                          	<label for="discount" class="col-form-label" style="font-weight: bold;">Discount Amount/Percent:<span class="text-danger">*</span></label>
		                            <input class="form-control" id="discount" type="number" name="discount" placeholder="Write discount amount/percent" min="0" value="0" required>
		                        </div>

		                        <div class="col-md-6 mb-4">
		                          	<label for="limit_per_user" class="col-form-label" style="font-weight: bold;">Use Limit Per User: <span class="text-danger">*</span></label>
		                            <input class="form-control" id="limit_per_user" type="number" name="limit_per_user" placeholder="Write use limit per user" min="0" value="0" required>
			                        @error('limit_per_user')
		                                <p class="text-danger">{{$message}}</p>
		                            @enderror
		                        </div>

		                        <div class="col-md-6 mb-4">
		                          	<label for="total_use_limit" class="col-form-label" style="font-weight: bold;">Total Use Limit: <span class="text-danger">*</span></label>
		                            <input class="form-control" id="total_use_limit" type="number" name="total_use_limit" placeholder="Enter total use limit" required min="0">
			                        @error('total_use_limit')
		                                <p class="text-danger">{{$message}}</p>
		                            @enderror
		                        </div>

								<div class="col-md-6 mb-4">
		                          	<label for="expire_date" class="col-form-label" style="font-weight: bold;">Expire Date: <span class="text-danger">*</span></label>
		                            <input class="form-control" id="expire_date" type="date" name="expire_date" min="0" required>
		                        </div>

        	                    <div class="col-md-6 mb-4">
                                    <label for="type" class="col-form-label" style="font-weight: bold;">Coupon For: <span class="text-danger">*</span></label>
                                    <div class="custom_select">
                                        <select class="form-control select-active w-100 form-select select-nice" name="type" id="type" onchange="toggleCustomerDropdown()" required>
                                            <option>Select Customer</option>
                                            <option value="1">All Customer</option>
                                            <option value="0">Specific Customer</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-6 mb-4" id="customerDropdown" style="display: none;">
                                    <label for="user_id" class="col-form-label" style="font-weight: bold;">Customer:</label>
                                    <div class="custom_select cit-multi-select">
                                        <select class="form-control select-active w-100 form-select select-nice" name="user_id[]" id="user_id" multiple="multiple" data-placeholder="User id">
                                            @foreach($users as $user)
                                                <option value="{{ $user->id }}">{{ $user->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
			        		</div>
                            <div class="row">
                                <div class="col-md-6 mb-4">
                                    <label for="type" class="col-form-label" style="font-weight: bold;">Coupon For: <span class="text-danger">*</span></label>
                                    <div class="custom_select">
                                        <select class="form-control select-active w-100 form-select select-nice" name="producttype" id="producttype" onchange="toggleProductDropdown()" required>
                                            <option>Select Product</option>
                                            <option value="1">All Product</option>
                                            <option value="0">Specific Product</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-6 mb-4" id="productDropdown" style="display: none;">
                                    <label for="product_id" class="col-form-label" style="font-weight: bold;">Product:</label>
                                    <div class="custom_select cit-multi-select">
                                        <select class="form-control select-active w-100 form-select select-nice" name="product_id[]" id="product_id" multiple="multiple" data-placeholder="Product id">
                                            @foreach($Products as $Product)
                                                <option value="{{ $Product->id }}">{{ $Product->name_en }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
			        		<!-- Row //-->

			        		<div class="row">
		                        <div class="col-md-12 mb-4">
		                          	<label for="description" class="col-form-label" style="font-weight: bold;">Description:</label>
		                            <textarea name="description" id="description" rows="2" cols="2" class="form-control" placeholder="Write Description"></textarea>
		                        </div>
		                        <!-- Description End -->
			        		</div>
			        		<div class="row">
                          		<div class="custom-control custom-switch">
                                    <input type="checkbox" class="form-check-input me-2 cursor" name="status" id="status" checked value="1">
                                    <label class="form-check-label cursor" for="status">Status</label>
                                </div>
	                        </div>
	                        <!-- Row //-->
			        	</div>
			        	<!-- card body .// -->
				    </div>
				    <!-- card .// -->

				    <div class="row mb-4 justify-content-sm-end">
						<div class="col-lg-3 col-md-4 col-sm-5 col-6">
							<input type="submit" class="btn btn-primary" value="Submit">
						</div>
					</div>
			    </form>
			</div>
        </div>
        <!-- .row // -->
    </div>
</section>
@push('footer-script')
<script>
    function toggleCustomerDropdown() {
        var customerDropdown = document.getElementById("customerDropdown");
        //customerDropdown.style.display = "none";

        if (document.getElementById("type").value === "0") {
            customerDropdown.style.display = "block";
        } else {
            customerDropdown.style.display = "none";
        }
    }

    // JavaScript code
    function toggleVisibility() {
        var customerDropdown = document.getElementById('customerDropdown');
        customerDropdown.classList.toggle('hidden');
    }
</script>
<script>
    function toggleProductDropdown() {
        var productDropdown = document.getElementById("productDropdown");
        if (document.getElementById("producttype").value === "0") {
            productDropdown.style.display = "block";
        } else {
            productDropdown.style.display = "none";
        }
    }
    function toggleVisibility(){
        var productDropdown = document.getElementById('productDropdown');
        productDropdown.classList.toggle('hidden');
    }
</script>
@endpush
@endsection
