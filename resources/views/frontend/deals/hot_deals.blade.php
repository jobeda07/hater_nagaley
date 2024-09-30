@extends('layouts.frontend')
@section('content-frontend')
@include('frontend.common.add_to_cart_modal')
<main class="main">
	<div class="container mb-30 mt-60">
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
	            <div class="row product-grid gutters-5">
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
                <!-- Pagination -->
	            <div class="pagination-area mt-20 mb-20">
	                <nav aria-label="Page navigation example">
	                    <ul class="pagination justify-content-end">
	                        {{ $products->links() }}
	                    </ul>
	                </nav>
	            </div>
                <!-- Pagination -->
	        </div>
            <!-- Side Filter Start -->
	        <div class="col-lg-1-5 primary-sidebar sticky-sidebar">
                <form action="{{ URL::current() }}" method="GET">
                <div class="card">
                    <div class="sidebar-widget price_range range border-0">
                        <h5 class="mb-20">By Price</h5>
                        <div class="price-filter mb-20">
                            <div class="price-filter-inner">
                                <div id="slider-range" class="mb-20"></div>
                                <div class="d-flex justify-content-between">
                                    <div class="caption">From: <strong id="slider-range-value1" class="text-brand"></strong></div>
                                    <div class="caption">To: <strong id="slider-range-value2" class="text-brand"></strong></div>
                                </div>
                            </div>
                        </div>
                        <h5 class="mb-20">Category</h5>
                        <div class="custome-checkbox">
                            @foreach(get_categories() as $category)
                                <div class="mb-2">
                                    @php
                                        $checked = [];
                                        if(isset($_GET['filtercategory'])){
                                            $checked = $_GET['filtercategory'];
                                        }
                                    @endphp
                                    <input class="form-check-input" type="checkbox" name="filtercategory[]" id="category_{{$category->id}}" value="{{$category->name_en}}" 
                                        @if(in_array($category->name_en, $checked)) checked @endif
                                    />
                                    <label class="form-check-label" for="category_{{$category->id}}">
                                        <span>
                                            @if(session()->get('language') == 'bangla') 
                                                {{ $category->name_bn }}
                                            @else 
                                                {{ $category->name_en }} 
                                            @endif 
                                        </span>
                                    </label>
                                    <span class="float-end">{{ count($category->products) }}</span>
                                    <br>
                                </div>
                            @endforeach
                        </div>
                        <button type="submin" class="btn btn-sm btn-default mt-20 mb-10" ><i class="fi-rs-filter mr-5"></i> Fillter</button>
                    </div>
                </div>
                </form>
                <!-- {{-- <form class="" id="search-form">
                    <input type="hidden" id="filter_price_start" name="filter_price_start">
                    <input type="hidden" id="filter_price_end" name="filter_price_end">
                </form> --}} -->
	        </div>
            <!-- Side Filter End -->
	    </div>
	</div>
</main>
@endsection