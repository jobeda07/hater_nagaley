@extends('admin.admin_master')
@section('admin')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<section class="content-main">
    <div class="content-header">
        <h2 class="content-title">Add Shipping Method</h2>
        <div class="">
            <a href="{{ route('shipping.index') }}" class="btn btn-primary"><i class="material-icons md-plus"></i> Shipping List</a>
        </div>
    </div> 
    <div class="row justify-content-center">
    	<div class="col-sm-8">
    		<div class="card">
		        <div class="card-body">
		            <div class="row">
		                <div class="col-md-12">
		                    <form method="post" action="{{ route('shipping.store') }}">
		                    	@csrf
		                        <div class="mb-4">
		                           	<label for="name" class="col-form-label col-md-3" style="font-weight: bold;"> Shipping Method Name:</label>
		                            <input class="form-control" id="name" type="text" name="name" placeholder="Enter name" value="{{old('name')}}">
		                            @error('name')
                                        <p class="text-danger">{{$message}}</p>
                                    @enderror
		                        </div>

		                        <div class="mb-4">
		                        	<label for="type" class="col-form-label col-md-3" style="font-weight: bold;">Type:</label>
	                                <select name="type" id="type" class="form-control" required="" onchange="shippingChange()">
	                                	<option>Please Select Shipping</option>
	                                    <option value="1">Inside Dhaka</option>
	                                    <option value="2">Outside Dhaka</option>
	                                </select>
		                        </div>

		                        <div class="mb-4 d-none" id="shipping_charge">
		                           	<label for="shipping_charge" class="col-form-label col-md-3" style="font-weight: bold;"> Shipping Charge:</label>
		                           	<input type="number" name="shipping_charge"  class="form-control shipping_charge">
		                            @error('shipping_charge')
                                        <p class="text-danger">{{$message}}</p>
                                    @enderror
		                        </div>

		                        <div class="mb-4">
		                          <label for="time" class="col-form-label col-md-2" style="font-weight: bold;"> Shipping Time:</label>
		                           	<input type="text" name="time" id="time" placeholder="Enter shipping Time" class="form-control " value="{{old('time')}}">
		                           	@error('time')
                                        <p class="text-danger">{{$message}}</p>
                                    @enderror
		                        </div>

		                        <div class="mb-4">
		                            <div class="custom-control custom-switch">
		                                <input type="checkbox" class="form-check-input me-2 cursor" name="status" id="status" value="1">
		                                <label class="form-check-label cursor" for="status">Status</label>
		                            </div>
                                </div>
		                        
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
		        <!-- card body .// -->
		    </div>
		    <!-- card .// -->
    	</div>
    </div>
</section>


<script type="text/javascript">
	// Shipping Charge
    function shippingChange() {
       var type = $('#type').val();

        if(type == '1' || type == '2'){
           $('#shipping_charge').removeClass('d-none');
        }else{
           $('#shipping_charge').addClass('d-none');
        }
    }
</script>
@endsection