@extends('admin.admin_master')
@section('admin')
<style type="text/css">
    table, tbody, tfoot, thead, tr, th, td{
        border: 1px solid #dee2e6 !important;
    }
    th{
        font-weight: bolder !important;
    }
    .dataTables_wrapper .dataTables_length{
           margin-bottom: 10px;
    }
</style>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<section class="content-main">
    <div class="content-header">
        <h2 class="content-title">Product wise stock report</h2>
    </div>
    <div class="row justify-content-center">
    	<div class="col-sm-10">
    		<div class="card">
		        <div class="card-body">
		            <div class="row">
		                <div class="col-md-12">
		                   <div class="card-body">
				                <form action="{{ route('stock_report.index') }}" method="GET">
				                    <div class="form-group row mb-3">
				                        <label class="col-md-6 col-form-label">Sort by Category : {{ $categories->name_en ?? ''}}</label>
				                        <div class="col-md-4">
				                        	<div class="custom_select">
				                        		<select class="form-select select-active select-nice" aria-label="Default select example" name="category_id"  id="category_id"  onchange="selectFunction()">
				                        		    <option value="">Select Category</option>
    											    @foreach (\App\Models\Category::all() as $key => $category)
    				                                    <option id="{{ $category->id }}" value="{{ $category->id }}">{{ $category->name_en }}</option>
    				                                @endforeach
    											</select>
				                        	</div>
				                        </div>
				                        <div class="col-md-2">
				                            <button class="btn btn-primary" type="submit">Filter</button>
				                        </div>
				                    </div>
				                </form>
				                <table id="example" class="table table-bordered table-hover mb-0">
                                    <thead>
                                         <tr>
				                            <th class="text-left">SKU</th>
				                            <th class="text-left">Product Name</th>
				                            <th class="text-center">Variant</th>
				                            <th class="text-center">Entry Date</th>
				                            <th class="text-center">Purchase Price</th>
				                            <th class="text-center">Sale Price</th>
				                            <th class="text-center">Profit</th>
				                            <th class="text-center">Stock Qty</th>
				                            <th class="text-center">Stock Value</th>
				                        </tr>
                                    </thead>
                                    @php
                                        $amount=0;
                                        $sum1=0;
                                    @endphp
				                    @if($products->count() > 0)
                                    <tbody>
                                        @foreach ($products as $key => $product)
					                        	@if($product->is_varient)
					                        		@foreach ($product->stocks as $key => $stock)
                                                    <tr>
						                                <td>{{ $product->product_code }}</td>
						                                <td>{{ $product->name_en }}</td>
						                                <td class="text-center">{{ $stock->varient }}</td>
						                                <td class="text-center">{{ date_format(date_create($product->created_at),"d M Y" ) }}</td>
						                                <td class="text-center">{{ $product->purchase_price }}tk </td>
						                                <td class="text-center">{{ $product->regular_price }}tk</td>
						                                <td class="text-center">{{ ($product->regular_price - $product->purchase_price) }}tk</td>
						                                <td class="text-center">{{ $stock->qty }}</td>
						                                <td class="text-center">{{ $product->purchase_price }} x {{ $stock->qty }} = {{ $stock->qty * $product->purchase_price}}tk</td>
						                            </tr>
						                            @endforeach
					                        	@else
						                            <tr>
						                                <td>{{ $product->product_code }}</td>
						                                <td>{{ $product->name_en }}</td>
						                                <td class="text-center">-</td>
						                                <td class="text-center">{{ date_format(date_create($product->created_at),"d M Y" ) }}</td>
						                                <td class="text-center">{{ $product->purchase_price }}tk</td>
						                                <td class="text-center">{{ $product->regular_price }}tk</td>
						                                <td class="text-center">{{ ($product->regular_price - $product->purchase_price) }}tk</td>
						                                <td class="text-center">{{ $product->stock_qty }}</td>
						                                <td class="text-center">{{ $product->purchase_price }} x {{ $product->stock_qty }} = {{ $product->stock_qty * $product->purchase_price }}tk</td>
						                            </tr>
					                            @endif
					                        @php
					                        $amount+=$product->stock_qty;
                                              $sum1+=$product->stock_qty * $product->purchase_price;
                                            @endphp
                                            @endforeach
                                    </tbody>
                                        <tfoot>
                                            <tr>
                                                <td colspan="7" class="text-center"></td>
                                                <td class="text-center">Sum : {{ $amount }}</td>
                                                <td class="text-center">Sum : {{ $sum1 }}</td>
                                            </tr>
                                        </tfoot>
                                     @else
					                    <tbody>
					                       
					                    </tbody>
				                    @endif
                                </table>
				            </div>
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
<script>
    function selectFunction(){
      const select = document.getElementById("category_id").value
    //   console.log(select);
    // $('#select').attr('selected', true)
    //console.log(select);
    }
    //const select = document.getElementById("category_id");
    // console.log(document.getElementById("category_id"));
    // console.log('hello');
</script>
@endpush