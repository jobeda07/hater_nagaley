@extends('layouts.frontend')
@section('content-frontend')
@include('frontend.common.add_to_cart_modal')
@section('title')
Category Nest Online Shop
@endsection
<main class="main">
    <div class="page-header mt-30 mb-50">
        <div class="container">
            {{-- <div class="archive-header" style="background-image: url({{ asset($category->image) }});"> --}}
            <div class="archive-header">
                <div class="row align-items-center">
                    <div class="col-12">
                        <h2 class="mb-15">
                        	@if(session()->get('language') == 'bangla') 
                                {{ $category->name_bn }}
                            @else 
                                {{ $category->name_en }} 
                            @endif
                        </h2>
                        <div class="breadcrumb">
                            <a href="{{ route('home')}}" rel="nofollow"><i class="fi-rs-home mr-5"></i>Home</a>
                            <span></span>
                            @if(session()->get('language') == 'bangla') 
                                {{ $category->name_bn }}
                            @else 
                                {{ $category->name_en }} 
                            @endif
                        </div>
                    </div>
                    {{-- <div class="col-xl-9 text-end d-none d-xl-block">
                        <ul class="tags-list">
                        	@foreach(get_categories()->sub_categories as $subcategory)
                            <li class="hover-up">
                                <a href="{{ route('product.category', $sub_category->slug) }}">
                                	<i class="fi-rs-cross mr-10"></i>
                                	@if(session()->get('language') == 'bangla') 
	                                    {{ $sub_category->name_bn }}
	                                @else 
	                                    {{ $sub_category->name_en }} 
	                                @endif
                                </a>
                            </li>
	                  		@endforeach
                        </ul>
                    </div> --}}
                </div>
            </div>
        </div>
    </div>
    <div class="container mb-30">
        <div class="row">
            @foreach($subcategories as $key => $subcategory)
            <div class="card-2 mr-20 bg-9 d-flex flex-column justify-content-center align-items-center wow animate__ animate__fadeInUp slick-slide slick-current slick-active" data-wow-delay=".1s" data-slick-index="0" aria-hidden="false" tabindex="0" style="width: 137px; visibility: visible; animation-delay: 0.1s; animation-name: fadeInUp;">
                <figure class="img-hover-scale overflow-hidden">
		             <a href="{{ route('product.category', $subcategory->slug) }}">
                    	@if($subcategory->image && $subcategory->image != '' && $subcategory->image != 'Null')
		                    <img class="default-img" src="{{ asset($subcategory->image) }}" alt="" />
		                @else
		                    <img class="img-lg mb-3" src="{{ asset('upload/no_image.jpg') }}" alt="" />
		                @endif
                    </a>
                </figure>
                <h6>
                	<a href="{{ route('product.category', $subcategory->slug) }}" tabindex="0">{{ $subcategory->name_en }}</a>
                </h6>
              <!--   <span>26 items</span> -->
            </div>
            @endforeach
        </div>
    </div>
    <div class="container mb-30">
        <div class="row">
            <div class="col-lg-4-5">
                <div class="shop-product-fillter">
                    <div class="totall-product">
                        <p>We found <strong class="text-brand">{{ count($products)}}</strong> items for you!</p>
                    </div>
                    <div class="sort-by-product-area">
                        <div class="sort-by-cover d-flex">
                            <div class="row">
                                <div class="form-group col-lg-6 col-6 col-md-6">
                                    <div class="custom_select">
                                        <select class="form-control select-active" onchange="filter()" name="brand">
                                            <option value="">All Brands</option>
                                            @foreach (\App\Models\Brand::all() as $brand)
                                                <option value="{{ $brand->slug }}" @if ($brand_id == $brand->id) selected @endif >{{ $brand->name_en ?? 'Null' }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>  
                                <div class="form-group col-lg-6 col-6 col-md-6">
                                    <div class="custom_select">
                                        <select class="form-control select-active" name="sort_by" onchange="filter()">
                                            <option value="newest" @if ($sort_by =='newest') selected @endif>Newest</option>
                                            <option value="oldest" @if ($sort_by =='oldest') selected @endif >Oldest</option>
                                            <option value="price-asc" @if ($sort_by == 'price-asc') selected @endif >Price Low to High</option>
                                            <option value="price-desc" @if ($sort_by == 'price-desc') selected @endif >Price High to Low</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row product-grid">
                	@forelse($products as $product)
                        @include('frontend.common.product_grid_view',['product' => $product])
	                @empty
                        @if(session()->get('language') == 'bangla') 
	                        <h5 class="text-danger">এখানে কোন পণ্য খুঁজে পাওয়া যায়নি!</h5> 
	                    @else 
	                       	<h5 class="text-danger">No products were found here!</h5> 
	                    @endif
	                @endforelse
                    <!--end product card-->
                </div>
                <!--product grid-->
                <div class="pagination-area mt-20 mb-20">
                    <nav aria-label="Page navigation example">
                        <ul class="pagination justify-content-end">
                            {{ $products->links() }}
                        </ul>
                    </nav>
                </div>
            </div>
            <div class="col-lg-1-5 primary-sidebar sticky-sidebar">
                <!-- Fillter By Price -->
                @include('frontend.common.filterby')
            	<!-- SideCategory -->
                @include('frontend.common.sidecategory')
            </div>
        </div>
    </div>
</main>
@endsection
@push('footer-script')
    <script type="text/javascript">
        function filter(){
            $('#search-form').submit();
            //$("input:text").val("Glenn Quagmire");
        }
    </script>
    
    <script type="text/javascript">
        function sort_price_filter(){
           var start = $('#slider-range-value1').html();
           var end = $('#slider-range-value2').html();
           $('#filter_price_start').val(start);
           $('#filter_price_end').val(end);
           $('#search-form').submit();
        }
    </script>

    <script type="text/javascript">
        (function ($) {
            ("use strict");
            // Slider Range JS
            if ($("#slider-range").length) {
                $(".noUi-handle").on("click", function () {
                    $(this).width(50);
                });
                var rangeSlider = document.getElementById("slider-range");
                var moneyFormat = wNumb({
                    decimals: 0,
                    // thousand: ",",
                    // prefix: "$"
                });
                var start_price = document.getElementById("filter_price_start").value;
                var end_price = document.getElementById("filter_price_end").value;
                noUiSlider.create(rangeSlider, {
                    start: [start_price, end_price],
                    step: 1,
                    range: {
                        min: [1],
                        max: [10000]
                    },
                    format: moneyFormat,
                    connect: true
                });

                // Set visual min and max values and also update value hidden form inputs
                rangeSlider.noUiSlider.on("update", function (values, handle) {
                    document.getElementById("slider-range-value1").innerHTML = values[0];
                    document.getElementById("slider-range-value2").innerHTML = values[1];
                    document.getElementsByName("min-value").value = moneyFormat.from(values[0]);
                    document.getElementsByName("max-value").value = moneyFormat.from(values[1]);

                    // if(values[0]>1 || values[1]<200000){
                    //     //sort_price_filter();
                    // }
                    //sort_price_filter();
                    //console.log(handle);
                });
                
            }
        })(jQuery);
    </script>
@endpush