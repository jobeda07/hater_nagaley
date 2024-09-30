@extends('admin.admin_master')
@section('admin')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<section class="content-main">
    <div class="content-header">
        <h2 class="content-title">Campaign Add</h2>
        <div class="">
            <a href="{{ route('campaing.index') }}" class="btn btn-primary"><i class="material-icons md-plus"></i> Campaign List</a>
        </div>
    </div> 
    <div class="row justify-content-center">
    	<div class="col-sm-8">
    		<div class="card">
		        <div class="card-body">
		            <div class="row">
		                <div class="col-md-12">
		                    <form method="post" action="{{ route('campaing.store') }}" enctype="multipart/form-data">
		                    	@csrf

		                        <div class="mb-4">
		                           <label for="name_en" class="col-form-label" style="font-weight: bold;"> Name (English):</label>
		                            <input class="form-control" id="name_en" type="text" name="name_en" placeholder="Write campaing name english" value="{{old('name_en')}}">
		                            @error('name_en')
	                                    <p class="text-danger">{{$message}}</p>
	                                @enderror
		                        </div>
		                        <div class="mb-4">
		                          <label for="name_bn" class="col-form-label" style="font-weight: bold;"> Name (Bangla):</label>
		                            <input class="form-control" id="name_bn" type="text" name="name_bn" placeholder="Write campaing name bangla" value="{{old('name_bn')}}">
		                        </div>

		                        <div class="mb-4">
		                        	<label for="text" style="font-weight: bold;">Date:</label>
		                        	<input type="text" name="date_range" class="form-control" placeholder="Select date" id="date" value="">
		                        </div>

		                        <div class="mb-4">
	                         		<label for="products" class="col-form-label" style="font-weight: bold;">Products:</label>
					                <div class="custom_select cit-multi-select">
	                                    <select name="products[]" class="form-control select-active w-100 form-select select-nice"  id="products" multiple="multiple" data-placeholder="Choose Product">
						                	@foreach(\App\Models\Product::orderBy('created_at', 'desc')->get() as $product)
			                                    <option value="{{$product->id}}">{{ $product->name_en }}</option>
			                                @endforeach
	                                    </select>
	                                </div>
		                        </div>

			                    <div class="form-group" id="discount_table">

                    			</div>

		                        <div class="mb-4">
		                        	<img src="" class="p-2" id="mainThmb"><br>
		                         	<label for="image" class="col-form-label" style="font-weight: bold;">Campaign Photo:</label>
		                            <input name="campaing_image" class="form-control" type="file" id="image" onChange="mainThamUrl(this)">
		                            @error('campaing_image')
	                                    <p class="text-danger">{{$message}}</p>
	                                @enderror
		                        </div>

		                        <div class="mb-4">
                                    <div class="demo-checkbox">             
                                        <input type="checkbox" id="md_checkbox_29" class="form-check-input cursor" name="is_featured" value="1">
                                        <label for="md_checkbox_29" class="form-check-label cursor" style="font-weight: bold; padding-left: 8px;">Is Features</label>
                                    </div>
                                </div>

		                        <div class="mb-4">
		                            <div class="custom-control custom-switch">
		                                <input type="checkbox" class="form-check-input me-2 cursor" name="status" id="status" value="1">
		                                <label class="form-check-label cursor" for="status" style="font-weight: bold;">Status</label>
		                            </div>
                                </div>

		                        <!-- <div class="mb-4">
		                            <div class="custom-control custom-switch">
		                                <input type="checkbox" class="form-check-input" name="flash_sell" id="flash" value="1">
		                                <label class="form-check-label" for="flash">flash Sell</label>
		                            </div>
                                </div> -->
                        		<!-- <div class="" id="flas_end" ></div> -->
		                        
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
@endsection

@push('footer-script')

<script type="text/javascript">
    $(document).ready(function(){
        $('#products').on('change', function(){
            var product_ids = $('#products').val();
            if(product_ids.length > 0){
                $.post('{{ route('flash_deals.product_discount') }}', {_token:'{{ csrf_token() }}', product_ids:product_ids}, function(data){
                    $('#discount_table').html(data);
                    
                });
            }
            else{
                $('#discount_table').html(null);
            }
        });
    });
</script>

<script>
	$(function() {

	$('input[name="date_range"]').daterangepicker({
	    timePicker: true,
	    startDate: moment().startOf('hour'),
	    endDate: moment().startOf('hour').add(32, 'hour'),
	    locale: {
	      format: 'DD-MM-Y HH:mm:ss'
	    }
	});

	 
	});
</script>

<script type="text/javascript">
	function mainThamUrl(input){
		if (input.files && input.files[0]) {
			var reader = new FileReader();
			reader.onload = function(e){
				$('#mainThmb').attr('src',e.target.result).width(100).height(80);
			};
			reader.readAsDataURL(input.files[0]);
		}
	}	
</script>
@endpush