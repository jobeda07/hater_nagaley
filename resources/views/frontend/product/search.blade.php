@extends('layouts.frontend')
@section('content-frontend')
@include('frontend.common.add_to_cart_modal')

<main class="main">
	<div class="container mb-30 mt-60">
	    <div class="row">
	        <div class="col-lg-4-5">
	            <div class="sort-by-product-area">
                    <div class="sort-by-cover d-flex">
                        <div class="row">
                            <div class="form-group col-lg-6 col-12 col-md-6">
                                <div class="custom_select">
                                    <select class="form-control select-active" onchange="filter()" name="brand">
                                        <option value="">All Brands</option>
                                        @foreach (\App\Models\Brand::all() as $brand)
                                            <option value="{{ $brand->slug }}" @if ($brand_id == $brand->id) selected @endif >{{ $brand->name_en ?? 'Null' }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>  
                            <div class="form-group col-lg-6 col-12 col-md-6">
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
	                <div class="col-lg-1-5 col-md-4 col-12 col-sm-12">
                        <div class="product-cart-wrap mb-30 wow animate__animated animate__fadeIn" data-wow-delay=".1s">
                            <div class="product-img-action-wrap">
                                <div class="product-img product-img-zoom">
                                    <a href="{{ route('product.details',$product->slug) }}">
                                        @if($product->product_thumbnail && $product->product_thumbnail != '' && $product->product_thumbnail != 'Null')
                                            <img class="default-img" src="{{ asset($product->product_thumbnail) }}" alt="" />
                                            <img class="hover-img" src="{{ asset($product->product_thumbnail) }}" alt="" />
                                        @else
                                            <img class="img-lg mb-3" src="{{ asset('upload/no_image.jpg') }}" alt="" />
                                        @endif
                                    </a>
                                </div>
                                <div class="product-action-1 d-flex">
                                    <a aria-label="Add To Wishlist" class="action-btn" href="#"><i class="fi-rs-heart"></i></a>
                                    <a aria-label="Compare" class="action-btn" onclick="addToCompare({{ $product->id }})"><i class="fi-rs-shuffle"></i></a>
                                    <a aria-label="Quick view" id="{{ $product->id }}" onclick="productView(this.id)" class="action-btn" data-bs-toggle="modal" data-bs-target="#quickViewModal"><i class="fi-rs-eye"></i></a>
                                </div>
                                <!-- start product discount section -->
                                  @php
                                    if($product->discount_type == 1){
                                        $price_after_discount = $product->regular_price - $product->discount_price;
                                    }elseif($product->discount_type == 2){
                                        $price_after_discount = $product->regular_price - ($product->regular_price * $product->discount_price / 100);
                                    }
                                  @endphp
                    
                                @if($product->discount_price > 0)
                                <div class="product-badges-right product-badges-position-right product-badges-mrg">
                                        @if($product->discount_type == 1)
                                            <span class="hot">৳{{ $product->discount_price }} off</span>
                                        @elseif($product->discount_type == 2)
                                            <span class="hot">{{ $product->discount_price }}% off</span>
                                        @endif
                                </div>
                                @endif
                    
                                <!-- <div class="product-badges product-badges-position product-badges-mrg">
                                    <span class="hot">New</span>
                                </div> -->
                               
                            </div>
                            <div class="product-content-wrap">
                                <h2 class="mt-3" style="height: 40px;">
                                    <a href="{{ route('product.details',$product->slug) }}">
                                        @if(session()->get('language') == 'bangla')
                                            <?php $p_name_bn =  strip_tags(html_entity_decode($product->name_bn))?>
                                            {{ Str::limit($p_name_bn, $limit = 30, $end = '. . .') }}
                                        @else
                                            <?php $p_name_en =  strip_tags(html_entity_decode($product->name_en))?>
                                            {{ Str::limit($p_name_en, $limit = 30, $end = '. . .') }}
                                        @endif
                                    </a>
                                </h2>
                                <div class="product-category">
                                    <a href="{{ route('product.category', $product->category->slug) }}">
                                        @if(session()->get('language') == 'bangla') 
                                            {{ $product->category->name_bn }}
                                        @else 
                                            {{ $product->category->name_en }} 
                                        @endif
                                    </a>
                                </div>
                                <div class="product-rate-cover">
                                    <div class="product-rate d-inline-block">
                                        <div class="product-rating" style="width: 90%"></div>
                                    </div>
                                    <span class="font-small ml-5 text-muted"> (0)</span>
                                </div>
                                <!-- <div>
                                    <span class="font-small text-muted">By <a href="#">NestFood</a></span>
                                </div> -->
                                <div class="product-card-bottom">
                                    @if ($product->discount_price > 0)
                                        <div class="product-price">
                                              <span class="price">৳{{ $price_after_discount }}</span>
                                              <span class="old-price">৳{{ $product->regular_price }}</span>
                                        </div>
                                    @else
                                        <div class="product-price">
                                            <span class="price">৳{{ $product->regular_price }}</span>
                                        </div>
                                    @endif
                                    <div class="add-cart">
                                        @if($product->is_varient == 1)
                                            <a class="add" id="{{ $product->id }}" onclick="productView(this.id)" data-bs-toggle="modal" data-bs-target="#quickViewModal"><i class="fi-rs-shopping-cart mr-5"></i>Add </a>
                                        @else
                                            <input type="hidden" id="pfrom" value="direct">
                                            <input type="hidden" id="product_product_id" value="{{ $product->id }}"  min="1">
                                            <input type="hidden" id="{{ $product->id }}-product_pname" value="{{ $product->name_en }}">
                                            <a class="add" onclick="addToCartDirect({{ $product->id }})" ><i class="fi-rs-shopping-cart mr-5"></i>Add </a>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
	                </div>
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
                <div class="justify-content-center">
                    
                </div>
	           
	        </div>
            <!-- Side Filter Start -->
	        <div class="col-lg-1-5 primary-sidebar sticky-sidebar">
	        </div>
            <!-- Side Filter End -->
	    </div>
	</div>
</main>
@endsection