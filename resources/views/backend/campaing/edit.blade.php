@extends('admin.admin_master')
@section('admin')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<section class="content-main">
    <div class="content-header">
        <h2 class="content-title">Campaign Edit</h2>
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
		                    <form method="post" action="{{ route('campaing.update',$campaing->id) }}" enctype="multipart/form-data">
		                    	@csrf
		                    	@method('PUT')

		                        <div class="mb-4">
		                           <label for="name_en" class="col-form-label" style="font-weight: bold;"> Name (English):</label>
		                            <input class="form-control" id="name_en" type="text" name="name_en" placeholder="Write campaing name english" value="{{$campaing->name_en}}">
		                            @error('name_en')
	                                    <p class="text-danger">{{$message}}</p>
	                                @enderror
		                        </div>
		                        <div class="mb-4">
		                          <label for="name_bn" class="col-form-label" style="font-weight: bold;"> Name (Bangla):</label>
		                            <input class="form-control" id="name_bn" type="text" name="name_bn" placeholder="Write campaing name bangla" value="{{$campaing->name_bn}}">
		                        </div>

		                        <div class="mb-4">
		                        	<label for="text" style="font-weight: bold;">Date:</label>
									<input type="hidden" id="flashStartDate" value="{{ $campaing->flash_start }}">
									<input type="hidden" id="flashEndDate" value="{{ $campaing->flash_end }}">
		                        	<input type="text" name="date_range" class="form-control" placeholder="Select date" id="date" value="{{$campaing->date_range}}">
		                        </div>

		                        <div class="mb-4">
	                         		<label for="products" class="col-form-label" style="font-weight: bold;">Products:</label>
					                <div class="custom_select cit-multi-select">
	                                    <select name="products[]" class="form-control select-active w-100 form-select select-nice"  id="products" multiple="multiple" data-placeholder="Choose Product">
						                	@foreach(\App\Models\Product::orderBy('created_at', 'desc')->get() as $product)
						                		@php
			                                        $campaing_product = \App\Models\CampaingProduct::where('campaing_id', $campaing->id)->where('product_id', $product->id)->first();
			                                    @endphp
			                                    <option value="{{$product->id}}" <?php if($campaing_product != null) echo "selected";?> >{{ $product->name_en }}</option>
			                                @endforeach
	                                    </select>
	                                </div>
		                        </div>

			                    <div class="form-group" id="discount_table">

                    			</div>
		                        
		                        <div class="mb-2 col-sm-6">
	                                <img id="mainThmb" class="rounded avatar-lg mb-3" src="{{ asset($campaing->campaing_image) }}" alt="Card image cap" width="100px" height="80px;">
	                           </div>
	                            <div class="col-sm-12 mb-4">
	                                <label for="image" class="col-form-label" style="font-weight: bold;">Campaign Photo:</label>
	                                <input name="campaing_image" class="form-control" type="file" id="image" onChange="mainThamUrl(this)">
	                                <!-- Hidden Image -->
	                                <input type="hidden" name="campaing_image_old" value="{{ $campaing->campaing_image }}">
	                            </div>

		                        <div class="mb-4">
                                    <div class="demo-checkbox">             
                                        <input type="checkbox" id="md_checkbox_29" class="form-check-input cursor" name="is_featured" value="1" {{ $campaing->is_featured == 1 ? 'checked': '' }}>
                                        <label for="md_checkbox_29" class="form-check-label cursor" style="font-weight: bold; padding-left: 8px;">Is Features</label>
                                    </div>
                                </div>

		                        <div class="mb-4">
		                            <div class="custom-control custom-switch">
		                                <input type="checkbox" class="form-check-input me-2 cursor" name="status" id="status" value="1" {{ $campaing->status == 1 ? 'checked': '' }}>
		                                <label class="form-check-label cursor" for="status" style="font-weight: bold;">Status</label>
		                            </div>
                                </div>
		                        
		                        <div class="row mb-4 justify-content-sm-end">
									<div class="col-lg-3 col-md-4 col-sm-5 col-6">
										<input type="submit" class="btn btn-primary" value="Update">
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

        get_flash_deal_discount();

        $('#products').on('change', function(){
            get_flash_deal_discount();
        });

        function get_flash_deal_discount(){
            var product_ids = $('#products').val();
            if(product_ids.length > 0){
                $.post('{{ route('flash_deals.product_discount_edit') }}', {_token:'{{ csrf_token() }}', product_ids:product_ids, campaing_id:{{ $campaing->id }}}, function(data){
                    $('#discount_table').html(data);
                });
            }
            else{
                $('#discount_table').html(null);
            }
        }
    });
</script>

<script>
	$(function() {
		var startDate = $('#flashStartDate').val();
		var endDate = $('#flashEndDate').val();
		//startDate = startDate.toString();
		//alert('asd');
		$('input[name="date_range"]').daterangepicker({
			timePicker: true,
			startDate: startDate,
			endDate: endDate,
			locale: {
			format: 'DD-MM-Y HH:mm:ss'
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