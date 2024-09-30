@extends('layouts.frontend')
@push('css')
	<style>
	    .app-figure {
	        width: 100% !important;
	        margin: 0px auto;
	        border: 0px solid red;
	        padding: 20px;
	        position: relative;
	        text-align: center;
	    }
	    .MagicZoom {
	        display: none;
	    }
	    .MagicZoom.Active {
	        display: block;
	    }
	    .selectors { margin-top: 10px; }
	    .selectors .mz-thumb img { max-width: 56px; }

	    @media  screen and (max-width: 1023px) {
	        .app-figure { width: 99% !important; margin: 20px auto; padding: 0; }
	    }
	</style>
	<!-- Image zoom -->
    <link rel="stylesheet" href="{{asset('frontend/magiczoomplus/magiczoomplus.css')}}" />
@endpush
@section('content-frontend')
 <main class="main">
	<div class="page-header breadcrumb-wrap">
	    <div class="container">

	        <div class="breadcrumb">
	            <a href="{{ route('product.category', $product->category->slug) }}" rel="nofollow"><i class="fi-rs-home mr-5"></i>
	            	@if(session()->get('language') == 'bangla')
                        {{ $product->category->name_bn ?? 'No Category'}}
                    @else
                        {{ $product->category->name_en ?? 'No Category'}}
                    @endif
	            </a>
	        </div>
	    </div>
	</div>
	<div class="container mb-30">
	    <div class="row">
	        <div class="col-xl-11 col-lg-12 m-auto">
	            <div class="row">
	                <div class="col-xl-12">
	                    <div class="product-detail accordion-detail">
	                        <div class="row mb-50 mt-30">
	                            <div class="col-md-6 col-sm-12 col-xs-12 mb-md-0 mb-sm-5">

	                                <!-- Product Zoom Image -->
	                                <div class="app-figure" id="zoom-fig">
								        <a id="Zoom-1" class="MagicZoom" title="Product Images."
								            href="{{ asset($product->product_thumbnail) }}?h=1400"
								            data-zoom-image-2x="{{ asset($product->product_thumbnail) }}"
								            data-image-2x="{{ asset($product->product_thumbnail) }}"
								        >
								            <img id="product_zoom_img" style="max-width: 500px;max-height: 500px;" src="{{ asset($product->product_thumbnail ) }}" srcset="{{ asset($product->product_thumbnail) }}" alt=""/>
								        </a>
								        <div class="selectors mt-30">
								        	@foreach($product->multi_imgs as $img)
								            <a
								            	class="me-4"
								                data-zoom-id="Zoom-1"
								                href="{{ asset($img->photo_name ) }}"
								                data-image="{{ asset($img->photo_name ) }}"
								                data-zoom-image-2x="{{ asset($img->photo_name ) }}"
								                data-image-2x="{{ asset($img->photo_name ) }}"
								            >
								                <img style="height: 100px !important;" srcset="{{ asset($img->photo_name ) }}"/>
								            </a>
								            @endforeach
								        </div>
								        <div class="selectors mt-30">
                                           @if($product->product_video)
        										<div  class="app-figure" >
        											<iframe width="560" height="315" src="{{ $product->product_video }}" frameborder="0" allowfullscreen></iframe>
        										</div>
        									@endif
                                        </div>
								    </div>
								    <!-- Product Zoom Image End -->
	                            </div>
	                            <div class="col-md-6 col-sm-12 col-xs-12">
	                                <div class="detail-info pr-30 pl-30">
	                                	@php
	                                		$discount = 0;

											if(auth()->check() && auth()->user()->role==7){
												$amount = $product->reseller_price;

											}else{
												$amount = $product->regular_price;
												if($product->discount_price > 0){
													if($product->discount_type == 1){
														$discount = $product->discount_price;
														$amount = $product->regular_price - $discount;
													}else if($product->discount_type == 2){
														$discount = $product->regular_price * $product->discount_price / 100;
														$amount = $product->regular_price - $discount;
													}else{
														$amount = $product->regular_price;
													}
												}
											}
		                          		@endphp
                                      @if ($product->discount_price > 0)
                                            @if(auth()->check() && auth()->user()->role==7)
                                              <span class="stock-status out-stock" style="display: none"> 3 % Off </span>
                                            @else
                                                @if ($product->discount_type == 1)
                                                    <span class="stock-status out-stock"> ৳{{  $discount }} Off </span>
                                                @elseif ($product->discount_type == 2)
                                                    <span class="stock-status out-stock"> {{  $product->discount_price }}% Off </span>
                                                @endif
                                            @endif
                                        @endif

			                            <input type="hidden" id="discount_amount" value="{{ $discount }}">

	                                    <h2 class="title-detail">
	                                    	@if(session()->get('language') == 'bangla')
			                                    {{ $product->name_bn }}
			                                @else
			                                    {{ $product->name_en }}
			                                @endif
	                                    </h2>
	                                    <!-- <div class="product-detail-rating">
	                                        <div class="product-rate-cover text-end">
	                                            <div class="product-rate d-inline-block">
	                                                <div class="product-rating" style="width: 90%"></div>
	                                            </div>
	                                            <span class="font-small ml-5 text-muted"> (32 reviews)</span>
	                                        </div>
	                                    </div> -->
	                                    <div class="clearfix product-price-cover">
	                                        <div class="product-price primary-color float-left">
	                                        	@if($product->discount_price <= 0)
													@if(auth()->check() && auth()->user()->role==7)
														<span class="current-price text-brand">৳{{ number_format($product->reseller_price) }}</span>
													@else
	                                        	 		<span class="current-price text-brand">৳{{ $product->regular_price }}</span>
													@endif
					                            @else
	                                                <span class="current-price text-brand">৳{{ $amount }}</span>
                                                    @if(auth()->check() && auth()->user()->role ==7)
                                                            <span class="save-price font-md color3 ml-15"  style="display:none;"> ৳{{ $discount }} Off </span>
                                                    @else
                                                        @if ($product->discount_type == 1)
                                                            <span class="save-price font-md color3 ml-15"> ৳{{ $discount }} Off </span>
                                                        @elseif ($product->discount_type == 2)
                                                            <span class="save-price font-md color3 ml-15">{{ $product->discount_price }}% Off</span>
                                                        @endif
                                                    @endif
													@if(auth()->check() && auth()->user()->role==7)
														<span class="old-price font-md ml-15"  style="display:none;">৳{{ number_format($product->reseller_price) }}</span>
													@else
	                                                	<span class="old-price font-md ml-15">৳{{ $product->regular_price }}</span>
													@endif
					                            @endif
	                                        </div>
	                                    </div>
										@if(auth()->check() && auth()->user()->role==7)
											<div class="mb-10">
												<span>Regular Price: <span class="text-info">৳ {{ $product->regular_price }}</span></span>
											</div>
										@endif
	                                    {{-- <div class="short-desc mb-30">
	                                        <p class="font-lg">
	                                        	@if(session()->get('language') == 'bangla')
							                        {!! $product->description_bn ?? 'No Decsription' !!}
							                    @else
													{!! $product->description_en ?? 'No Decsription' !!}
							                    @endif
	                                        </p>
	                                    </div> --}}
	                                    <form id="choice_form">
		                                    <div class="row " id="choice_attributes">
		                                    	@if($product->is_varient)
		                                    		@php $i=0; @endphp
		                                    		@foreach(json_decode($product->attribute_values) as $attribute)
			                                    		@php
			                                    			$attr = get_attribute_by_id($attribute->attribute_id);
			                                    			$i++;
			                                    		@endphp
			                                    		<div class="attr-detail attr-size mb-30">
					                                        <strong class="mr-10">{{ $attr->name }}: </strong>
					                                        <input type="hidden" name="attribute_ids[]" id="attribute_id_{{ $i }}" value="{{ $attribute->attribute_id }}">
							                                <input type="hidden" name="attribute_names[]" id="attribute_name_{{ $i }}" value="{{ $attr->name }}">
															<input type="hidden" id="attribute_check_{{ $i }}" value="0">
															<input type="hidden" id="attribute_check_attr_{{ $i }}" value="0">
					                                        <ul class="list-filter size-filter font-small">
					                                        	@foreach($attribute->values as $value)
						                                            <li>
						                                            	<a href="#" onclick="selectAttribute('{{ $attribute->attribute_id }}{{ $attr->name }}', '{{ $value }}', '{{ $product->id }}', '{{ $i }}')" style="border: 1px solid #7E7E7E;">{{ $value }}</a>
						                                            </li>
					                                            @endforeach
					                                            <input type="hidden" name="attribute_options[]" id="{{ $attribute->attribute_id }}{{ $attr->name }}" class="attr_value_{{ $i }}">
					                                        </ul>
					                                    </div>
				                                    @endforeach
				                                    <input type="hidden" id="total_attributes" value="{{ count(json_decode($product->attribute_values)) }}">
			                                    	<!-- @foreach(json_decode($product->attribute_values) as $attribute)
			                                    		@php
			                                    			$attr = get_attribute_by_id($attribute->attribute_id);
			                                    			$i++;
			                                    		@endphp
						                                <div class="form-group col-lg-4">
						                                	<input type="hidden" name="attribute_ids[]" id="attribute_id_{{ $i }}" value="{{ $attribute->attribute_id }}">
						                                	<input type="hidden" name="attribute_names[]" id="attribute_name_{{ $i }}" value="{{ $attr->name }}">
				                                		<label style=" font-weight:bold;color: black;">Chose {{ $attr->name }}<span>**</span></label>
						                                    <div class="custom_select">
						                                        <select class="form-control select-active" name="attribute_options[]" id="attribute_option_{{ $i }}">
						                                            <option value="">--Chose {{ $attr->name }}--</option>

						                                           	@foreach($attribute->values as $value)
																		<option value="{{ $value }}">{{ $value }}</option>
																	@endforeach

						                                        </select>
						                                    </div>
						                                </div>
					                                @endforeach -->
				                                @endif
				                            </div>
			                        	</form>

										<div class="row" id="attribute_alert">

										</div>

	                                    <!-- <div class="attr-detail attr-size mb-30">
	                                        <strong class="mr-10">Size / Weight: </strong>
	                                        <ul class="list-filter size-filter font-small">
	                                            <li><a href="#">50g</a></li>
	                                            <li class="active"><a href="#">60g</a></li>
	                                            <li><a href="#">80g</a></li>
	                                            <li><a href="#">100g</a></li>
	                                            <li><a href="#">150g</a></li>
	                                        </ul>
	                                    </div> -->
	                                    <div class="detail-extralink mb-20 align-items-baseline d-flex">
	                                    	<div class="mr-10">
	                                    		<span class="">Quantity:</span>
	                                    	</div>
	                                        <div class="detail-qty border radius">
	                                            <a href="#" class="qty-down"><i class="fi-rs-angle-small-down"></i></a>
	                                            <input type="text" name="quantity" class="qty-val" value="1" min="1" id="qty">
	                                            <a href="#" class="qty-up"><i class="fi-rs-angle-small-up"></i></a>
	                                        </div>

											<div class="row" id="qty_alert">

											</div>
	                                    </div>
	                                    <div class="detail-extralink mb-50">
	                                        <div class="product-extra-link2">

	                                        	<input type="hidden" id="product_id" value="{{ $product->id }}"  min="1">

	                                        	<input type="hidden" id="pname" value="{{ $product->name_en }}">

	                                        	<input type="hidden" id="product_price" value="{{ $amount }}">

	                                        	<input type="hidden" id="minimum_buy_qty" value="{{ $product->minimum_buy_qty }}" >
	                                        	<input type="hidden" id="stock_qty" value="{{ $product->stock_qty }}">

	                                        	<input type="hidden" id="pvarient" value="">

												<input type="hidden" id="buyNowCheck" value="0">

												<div class="d-none show_cart_btn">
												    <button type="submit" class="button button-add-to-cart" onclick="addToCart()"><i class="fi-rs-shoppi ng-cart"></i>Add to cart</button>
    	                                            <button type="submit" class="button button-add-to-cart ml-5 bg-danger" onclick="buyNow()"><i class="fi-rs-shoppi ng-cart"></i>Buy Now</button>
												</div>
												<div class="remove_qty_btn">
                                                    @if($product->stock_qty>0)
        	                                            <button type="submit" class="button button-add-to-cart" onclick="addToCart()"><i class="fi-rs-shoppi ng-cart"></i>Add to cart</button>

        	                                            <button type="submit" class="button button-add-to-cart ml-5 bg-danger" onclick="buyNow()"><i class="fi-rs-shoppi ng-cart"></i>Buy Now</button>
                                                    @else
                                                        <p class="stock_out" style="color: #DD1D21 !important;"><i class="fas fa-window-close mr-5"></i>Stock Out</p>
                                                    @endif
    	                                            {{-- <a aria-label="Add To Wishlist" class="action-btn hover-up" href="#"><i class="fi-rs-heart"></i></a>

    	                                            <a aria-label="Compare" class="action-btn hover-up" href="#"><i class="fi-rs-shuffle"></i></a> --}}
	                                            </div>
	                                        </div>

	                                    </div>
										<div class="row mb-3" id="stock_alert">

										</div>
	                                    <div class="font-xs">
	                                        <ul class="mr-50 float-start">
	                                            <li class="mb-5">Regular Price: <span class="text-brand" style="font-size: 14px !important;" >{{ $product->regular_price }}</span></li>
	                                            <li class="mb-5">Stock: <span class="text-brand product_att_stock" style="font-size: 14px !important;">{{ $product->stock_qty}}</span></li>
	                                            <li class="mb-5">Category:<span class="text-brand" style="font-size: 14px !important;">
	                                            	{{ $product->category->name_en ?? 'No Category'}}
	                                            </span></li>
	                                        </ul>
	                                        <ul class="float-start">
												@if($product->wholesell_price > 0)
													<li class="mb-5" style="font-size: 14px !important;"><a href="https://wa.me/+8801633178160" target="_blank">This product is available in wholesale & Please contact with our whatsapp.</a></li>
												@endif
	                                            <li class="mb-5">Brand:
	                                            	<a href="#" rel="tag">
	                                            		{{ $product->brand->name_en ?? 'No Brand'}}
	                                            	</a>
	                                            </li>
	                                        </ul>
	                                    </div>
	                                </div>
	                                <!-- Detail Info -->
	                            </div>
	                        </div>
	                        <div class="product-info">
	                            <div class="tab-style3">
	                                <ul class="nav nav-tabs text-uppercase">
	                                    <li class="nav-item">
	                                        <a class="nav-link active" id="Description-tab" data-bs-toggle="tab" href="#Description">Description</a>
	                                    </li>
	                                    <!--<li class="nav-item">-->
	                                    <!--    <a class="nav-link" id="Additional-info-tab" data-bs-toggle="tab" href="#Additional-info">Additional info</a>-->
	                                    <!--</li>-->
										 @if(get_setting('multi_vendor')->value)
										    <li class="nav-item">
												<a class="nav-link" id="Vendor-info-tab" data-bs-toggle="tab" href="#Vendor-info">Seller</a>
											</li>
										@endif
                                        <li class="nav-item">
                                            <a class="nav-link" id="reviews-tab" data-bs-toggle="tab" href="#reviews">Reviews</a>
                                        </li>
	                                </ul>
	                                <div class="tab-content shop_info_tab entry-main-content">
	                                    <div class="tab-pane fade show active" id="Description">
	                                        <div class="">
	                                            <p>
	                                            	@if(session()->get('language') == 'bangla')
														{!! $product->description_bn ?? 'No Product Long Descrption' !!}
								                    @else
														{!! $product->description_en ?? 'No Product Logn Descrption' !!}
								                    @endif
	                                            </p>
	                                        </div>
	                                    </div>
	                                    {{-- <div class="tab-pane fade" id="Additional-info">
	                                        <table class="font-md">
	                                            <tbody>
                                                	<tr class="stand-up">
	                                                    <th>Product Code</th>
	                                                    <td>
	                                                        <p>{{$product->product_code ?? 'No Product Code'}}</p>
	                                                    </td>
	                                                </tr>
	                                                <tr class="folded-wo-wheels">
	                                                    <th>Product Size</th>
	                                                    <td>
	                                                        <p>{{$product->product_size_en ?? 'No Product Size'}}</p>
	                                                    </td>
	                                                </tr>
	                                                <tr class="folded-w-wheels">
	                                                    <th>Product Color</th>
	                                                    <td>
	                                                        <p>{{$product->product_color_en ?? 'No Product Color'}}</p>
	                                                    </td>
	                                                </tr>
	                                            </tbody>
	                                        </table>
	                                    </div> --}}
										 @if(get_setting('multi_vendor')->value)
										    @php
										        $vendor = \App\Models\Vendor::where('id', $product->vendor_id)->first();
										    @endphp
										    @if($vendor)
    											<div class="tab-pane fade" id="Vendor-info">
    												<div class="vendor-logo d-flex mb-30 align-items-center">
    													<img src="{{ asset($vendor->shop_profile) }}" alt="" />
    													<div class="vendor-name ml-15">
    														<h6>
    															<a href="{{ route('vendor.product', $vendor->slug) }}">{{ $vendor->shop_name }}</a>
    														</h6>
    														<!--<div class="product-rate-cover text-end">-->
    														<!--	<div class="product-rate d-inline-block">-->
    														<!--		<div class="product-rating" style="width: 90%"></div>-->
    														<!--	</div>-->
    														<!--	<span class="font-small ml-5 text-muted"> (32 reviews)</span>-->
    														<!--</div>-->
    													</div>
    												</div>
    												<ul class="contact-infor mb-50">
    													<li><img src="{{asset('frontend')}}/assets/imgs/theme/icons/icon-location.svg" alt="" /><strong>Address: </strong> <span>{{ $vendor->address }}</span></li>
    													<!--<li><img src="{{asset('frontend')}}/assets/imgs/theme/icons/icon-contact.svg" alt="" /><strong>Contact Seller:</strong><span>(+91) - 540-025-553</span></li>-->
    												</ul>
    												<!--<div class="d-flex mb-55">-->
    												<!--	<div class="mr-30">-->
    												<!--		<p class="text-brand font-xs">Rating</p>-->
    												<!--		<h4 class="mb-0">92%</h4>-->
    												<!--	</div>-->
    												<!--	<div class="mr-30">-->
    												<!--		<p class="text-brand font-xs">Ship on time</p>-->
    												<!--		<h4 class="mb-0">100%</h4>-->
    												<!--	</div>-->
    												<!--	<div>-->
    												<!--		<p class="text-brand font-xs">Chat response</p>-->
    												<!--		<h4 class="mb-0">89%</h4>-->
    												<!--	</div>-->
    												<!--</div>-->
    												<p>
    													{{ $vendor->description }}
    												</p>
    											</div>
											@endif
										@endif
                                        <div class="tab-pane fade" id="reviews">
                                            <div class="product__review__system">
                                                <h6>Youre reviewing:</h6>
                                                <h5 class="pt-4 pb-5">
                                                    @if (session()->get('language') == 'bangla')
                                                        {{ $product->name_bn }}
                                                    @else
                                                        {{ $product->name_en }}
                                                    @endif
                                                </h5>
                                                <form action="{{ route('review.store') }}" method="post">
                                                    @csrf
                                                    <input type="hidden" name="product_id"
                                                        value="{{ $product->id }}">
                                                    <input type="hidden" name="user_id"
                                                        value="{{ Auth::user()->id ?? 'null' }}">
                                                    <div class="product__rating" style="padding-bottom:30px;padding-top:20px;">
                                                        <label for="rating" style="font-size: 20px;color:green;font-weight:bold">Rating:<span
                                                                class="text-danger">*</span></label>
                                                        <div class="rating-checked">
                                                            <input type="radio" name="rating"
                                                                value="5" style="--r: #ffb301" />
                                                            <input type="radio" name="rating"
                                                                value="4" style="--r: #ffb301" />
                                                            <input type="radio" name="rating"
                                                                value="3" style="--r: #ffb301" />
                                                            <input type="radio" name="rating"
                                                                value="2" style="--r: #ffb301" />
                                                            <input type="radio" name="rating"
                                                                value="1" style="--r: #ffb301" />
                                                        </div>
                                                        @error('rating')
                                                            <p class="text-danger">{{ $message }}</p>
                                                        @enderror
                                                    </div>
                                                    <div class="review__form">
                                                        <div class="row">
                                                            {{-- <div class="col-md-6 col-12">
                                                                <div class="form-group">
                                                                    <label for="name" style="font-size: 18px;">Name <span
                                                                            class="text-danger">*</span></label>
                                                                    <input type="text" name="name"
                                                                        id="name"
                                                                        value="{{ old('name') }}">
                                                                    @error('name')
                                                                        <p class="text-danger">{{ $message }}
                                                                        </p>
                                                                    @enderror
                                                                </div>
                                                            </div> --}}
                                                            {{-- <div class="col-md-6 col-12">
                                                                <div class="form-group">
                                                                    <label for="summary">Summary <span
                                                                            class="text-danger">*</span></label>
                                                                    <input type="text" name="summary"
                                                                        id="summary"
                                                                        value="{{ old('summary') }}">
                                                                    @error('summary')
                                                                        <p class="text-danger">{{ $message }}
                                                                        </p>
                                                                    @enderror
                                                                </div>
                                                            </div> --}}
                                                            <div class="col-md-6 col-12">
                                                                <div class="form-group">
                                                                    <label for="review" style="font-size: 20px;">Review <span
                                                                            class="text-danger">*</span></label>
                                                                    <input type="text" name="review"
                                                                        id="review"
                                                                        value="{{ old('review') }}">
                                                                    @error('review')
                                                                        <p class="text-danger">{{ $message }}
                                                                        </p>
                                                                    @enderror
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <button type="submit" class="btn btn-info">Submit
                                                            Review</button>
                                                    </div>
                                                </form>
                                                <div class="review_list">
                                                    @php
                                                        $data = \App\Models\Review::where('product_id', $product->id)
                                                            ->latest()
                                                            ->get();
                                                    @endphp
                                                    @foreach ($data as $value)
                                                        @if ($value->status == 1)
                                                            <div class="single-review-item">
                                                                <div class="rating">
                                                                    @if ($value->rating == '1')
                                                                        <i class="fa fa-star"></i>
                                                                    @elseif($value->rating == '2')
                                                                        <i class="fa fa-star"></i>
                                                                        <i class="fa fa-star"></i>
                                                                    @elseif($value->rating == '3')
                                                                        <i class="fa fa-star"></i>
                                                                        <i class="fa fa-star"></i>
                                                                        <i class="fa fa-star"></i>
                                                                    @elseif($value->rating == '4')
                                                                        <i class="fa fa-star"></i>
                                                                        <i class="fa fa-star"></i>
                                                                        <i class="fa fa-star"></i>
                                                                        <i class="fa fa-star"></i>
                                                                    @elseif($value->rating == '5')
                                                                        <i class="fa fa-star"></i>
                                                                        <i class="fa fa-star"></i>
                                                                        <i class="fa fa-star"></i>
                                                                        <i class="fa fa-star"></i>
                                                                        <i class="fa fa-star"></i>
                                                                    @endif
                                                                </div>
                                                                <h5 class="review-title">{{ $value->summary }}
                                                                </h5>
                                                                <h6 class="review-user">{{ $value->name }}
                                                                </h6>
                                                                <span
                                                                    class="review-description">{!! $value->review !!}</span>
                                                            </div>
                                                        @endif
                                                    @endforeach
                                                </div>
                                            </div>
                                        </div>
	                                </div>
	                            </div>
	                        </div>
	                        <div class="row mt-60">
	                            <div class="col-12">
	                                <h2 class="section-title style-1 mb-30">Related products</h2>
	                            </div>
	                            <div class="col-12">
	                                <div class="row related-products">
	                                	@forelse($relatedProduct as $product)
                	                    	@include('frontend.common.product_grid_view',['product' => $product])
                	                    	<!--end product card-->
	                                    @empty
						                    @if(session()->get('language') == 'bangla')
						                        <h5 class="text-danger">এখানে কোন পণ্য খুঁজে পাওয়া যায়নি!</h5>
						                    @else
						                       <h5 class="text-danger">No products were found here!</h5>
						                    @endif
					                  	@endforelse
	                                </div>
	                            </div>
	                        </div>
	                    </div>
	                </div>

	            </div>
	        </div>
	    </div>
	</div>
</main>
@endsection

@push('footer-script')
<!-- Image zoom -->
    <script src="{{asset('frontend/magiczoomplus/magiczoomplus.js')}}"></script>
	<script>
		var mzOptions = {
			zoomWidth: "400px",
			zoomHeight: "400px",
			zoomDistance: 15,
			expandZoomMode: "magnifier",
			expandZoomOn: "always",
			variableZoom: true,
			// lazyZoom: true,
			// selectorTrigger: "hover"
		};
	</script>
@endpush
