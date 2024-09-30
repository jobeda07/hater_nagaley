@extends('layouts.frontend')
@section('content-frontend')
@include('frontend.common.add_to_cart_modal')
@section('title')
    Categories Online Shop
@endsection
	<div class="page-header breadcrumb-wrap">
        <div class="container">
            <div class="breadcrumb">
                <a href="{{ route('home') }}" rel="nofollow"><i class="fi-rs-home mr-5"></i>Home</a>
                <span> Categories </span>
            </div>
        </div>
    </div>
    <div class="container mb-30 mt-30">
        <div class="row">
            <div class="col-lg-12">
                <a class="shop-filter-toogle" href="#">
                    <span class="fi-rs-filter mr-5"></span>
                    Filters
                    <i class="fi-rs-angle-small-down angle-down"></i>
                    <i class="fi-rs-angle-small-up angle-up"></i>
                </a>
                <div class="shop-product-fillter-header">
                    <div class="row">
                    	@foreach(get_categories() as $category)
                        <div class="col-md-6">
                            <div class="card">
                            	<div class="category_header">
                                    <a href="{{ route('product.category', $category->slug) }}" class="align-items-center d-flex d-inline-block">
                                        <img src="{{ asset($category->image) }}" class="img-fluid category_image" alt="{{ env('APP_NAME') }}">
                                        <h4 class="category-title">
                                            @if(session()->get('language') == 'bangla') 
                                                {{ $category->name_bn }}
                                            @else 
                                                {{ $category->name_en }} 
                                            @endif
                                        </h4>
                                    </a> <hr>   
                                </div>
                                @if($category->sub_categories && count($category->sub_categories) > 0)
                                    <div class="gutters-5 row">
                                        @foreach($category->sub_categories as $subcategory)
                                    		<div class="col-lg-4 col-md-6 col-6">
    	                                		<div class="ms-2">
                                                    <div class="subcategory-header">
        	                                			<a class="d-inline-block" href="{{ route('product.category', $subcategory->slug) }}">
        			                                        <h6 class="mb-sm-3 mb-2 subcategory-title">
        			                                        	@if(session()->get('language') == 'bangla') 
                                                                	{{ $subcategory->name_bn }}
        	                                                    @else 
        	                                                        {{ $subcategory->name_en }} 
        	                                                    @endif
                                                        	</h6>
        			                                    </a>
                                                    </div>
                                                    @if($subcategory->sub_sub_categories && count($subcategory->sub_sub_categories) > 0)
    			                                    <ul class="mb-3">
    	                                                @foreach($subcategory->sub_sub_categories as $subsubcategory)
    	                                        		<li class="ms-sm-2 ms-0 mb-1">
                                                            <div class="subsubcategory-header">
        	                                        			<a class="d-inline-block" href="{{ route('product.category', $subsubcategory->slug) }}">
        	                                        				<p class="subsubcategory-title">
        	                                        					@if(session()->get('language') == 'bangla') 
                                                                        	{{ $subsubcategory->name_bn }}
        	                                                            @else 
        	                                                                {{ $subsubcategory->name_en }} 
        	                                                            @endif
                                                                	</p>
        	                                        			</a>
                                                            </div>
    	                                        		</li>
    	                                        		@endforeach
    	                                        	</ul>
                                                    @endif
    			                                </div>
                                    		</div>
                                    	@endforeach
                                    </div>
                                @endif
                            </div>
                        </div>
                        @endforeach
						{{-- Col-6 //--}}
                    </div>
					{{-- Row // --}}
                </div>
            </div>
        </div>
    </div>
@endsection