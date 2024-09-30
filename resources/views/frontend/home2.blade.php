@extends('layouts.frontend')
@section('content-frontend-model')
@endsection
@section('content-frontend')
    @push('css')
        <style>
            .container-fluid {
                max-width: 1610px;
                margin: auto;
            }

            .vertical-megamenu.category-item li a img {
                width: 22px;
                height: 22px;
                margin-right: 5px;
                display: inline-block;
            }

            .categories-dropdown-wrap.style-2 ul li:last-child {
                margin-bottom: 0
            }

            .categories-dropdown-wrap ul li a {
                font-weight: 600 !important;
            }

            .categories-dropdown-wrap.style-2 h4 {
                background: #0f1528;
                color: #fff;
                padding: 10px;
                border-radius: 10px 10px 0 0;
                margin-bottom: 10px;
                text-transform: capitalize;
                font-size: 20px;
            }

            .categories-dropdown-wrap.style-2 {
                padding: 0;
            }

            .vertical-megamenu.category-item {
                width: 100%;
            }

            ul.vertical-megamenu.category-item {
                padding: 10px;
                padding-top: 0;
            }

            .vertical-megamenu.category-item li a {
                position: relative;
                width: 100%
            }

            .categories-dropdown-wrap.style-2 ul li ul.subcategory {
                position: absolute;
                left: 100%;
                z-index: 999;
                background: #fff;
                border: 1px solid #ddd;
                padding: 10px;
                transition: all .5s ease-in-out;
                opacity: 0;
                width: 100%;
                visibility: hidden;
            }

            .categories-dropdown-wrap.style-2 ul li ul.subcategory li {
                width: 100%;
                margin: 0;
            }

            .categories-dropdown-wrap.style-2 ul li:hover ul.subcategory {
                opacity: 1;
                visibility: visible;
            }


            /* Normal desktop :1200px. */
            @media (min-width: 1200px) and (max-width: 1500px) {}


            /* Normal desktop :992px. */
            @media (min-width: 992px) and (max-width: 1200px) {}


            /* Tablet desktop :768px. */
            @media (min-width: 768px) and (max-width: 991px) {}


            /* small mobile :320px. */
            @media (max-width: 767px) {

                .footer-mid .widget-title {
                    margin: 0;
                    margin-bottom: 10px !important;
                }

                .product-cart-wrap.style-2 .product-content-wrap {
                    margin-top: 0;
                }
                .product-cart-wrap.style-2 .product-content-wrap .deals-content {
                    padding: 10px;
                }
                .product-card-bottom {
                    {{--  flex-direction: column;  --}}
                    margin-top: 0 !important;
                }
                .product-cart-wrap .product-card-bottom .add-cart .add {
                    padding: 6px;
                    text-align: center;
                }
            }

            /* Large Mobile :480px. */
            @media only screen and (min-width: 480px) and (max-width: 767px) {
                
            }
        </style>
    @endpush

    @include('frontend.common.add_to_cart_modal')
    <section class="home-slider position-relative mb-30">
        <div class="container-fluid">
            <div class="row g-4">
                <div class="col-xl-2 col-lg-3 d-none d-lg-flex">
                    <div class="categories-dropdown-wrap style-2 font-heading mt-30 w-100">
                        <div class="categori-dropdown-inner">
                            <h4><i class="fa fa-bars"></i> categories</h4>
                            <ul class="vertical-megamenu category-item">
                                @foreach (get_categories()->take(12) as $category)
                                    <li><a href="{{ route('product.category', $category->slug) }}"><img
                                                src="{{ asset($category->image) }}" alt="">
                                            @if (session()->get('language') == 'bangla')
                                                {{ $category->name_bn }}
                                            @else
                                                {{ $category->name_en }}
                                            @endif
                                            @if ($category->sub_categories && count($category->sub_categories) > 0)
                                                <i class="fi-rs-angle-right"></i>
                                            @endif
                                        </a>
                                        @if ($category->sub_categories && count($category->sub_categories) > 0)
                                            <ul class="subcategory">
                                                @foreach ($category->sub_categories as $sub_category)
                                                    <li><a href="{{ route('product.category', $sub_category->slug) }}">
                                                            @if (session()->get('language') == 'bangla')
                                                                {{ $sub_category->name_bn }}
                                                            @else
                                                                {{ $sub_category->name_en }}
                                                            @endif
                                                        </a></li>
                                                @endforeach
                                            </ul>
                                        @endif
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-xl-10 col-lg-9">
                    <div class="slider__active">
                        @foreach ($sliders as $slider)
                         <a href="{{$slider->slider_url}}">
                            <div class="single__slider">
                                <img src="{{ asset($slider->slider_img) }}" alt="">
                            </div>
                         </a>
                        @endforeach
                    </div>

                </div>
            </div>
        </div>
    </section>
    <!--End hero slider-->

    {{-- category start --}}
    <div class="home__category">
        <div class="container-fluid">
            <div class="section-title">
                <h3>Top Categories</h3>
            </div>
                <div class="cat-product-container">
            @foreach ($featured_category as $item)
            <a href="{{ route('product.category', $item->slug) }}">
                <div class="cat-pro-wrapper">
                    <div class="cat-pro-img-container">
                      <img src="{{ asset($item->image) }}" alt="" />
                    </div>
                    <div class="cat-pro-name">
                        <a href="{{ route('product.category', $item->slug) }}" class="cat-pro-text">
                            @if (session()->get('language') == 'bangla')
                                {{ $item->name_bn }}
                            @else
                                {{ $item->name_en }}
                            @endif
                      </a>
                    </div>
                </div>
            </a>
            @endforeach
                </div>
        </div>
    </div>
    {{-- category end --}}
    
    <!-- Campaign Slider Start-->
	@php
        $campaign = \App\Models\Campaing::where('status', 1)->where('is_featured', 1)->first();
    @endphp
    
    @if($campaign)
        @php
            $start_diff = date_diff(date_create($campaign->flash_start ?? ''), date_create(date('d-m-Y H:i:s')));
            $end_diff = date_diff(date_create(date('d-m-Y H:i:s')), date_create($campaign->flash_end ?? ''));
        @endphp
        
        @if ($start_diff->invert == 0 && $end_diff->invert == 0)
        <section class="common-product section-padding">
    	    <div class="container wow animate__animated animate__fadeIn">
    	        <div class="section-title">
    	            <div class="title">
    	                <h3>My Campaign Sell</h3>
    
    	                <div class="deals-countdown-wrap">
    	                    <div class="deals-countdown" data-countdown="{{ date(('Y-m-d H:i:s'), strtotime($campaign->flash_end)) }}"></div>
    	                </div>
    	            </div>
    	            <a href="#" class="btn btn-sm btn-primary">View more</a>
    	        </div>
    	        <div class="carausel-5-columns-cover position-relative">
    	        	<div class="slider-arrow slider-arrow-2 carausel-5-columns-common-arrow" id="carausel-5-columns-common-arrows"></div>
    	            <div class="carausel-5-columns-common carausel-arrow-center" id="carausel-5-columns-common">
    	            	@foreach($campaign->campaing_products->take(20) as $campaing_product)
    	            		@php
                                $product = \App\Models\Product::find($campaing_product->product_id);
                            @endphp
                            @if ($product != null && $product->status != 0)
    	                		@include('frontend.common.product_grid_view',['product' => $product])
    	                	@endif
    	                @endforeach
    	            </div>
    	        </div>
    	    </div>
    	</section>
        @endif
    @endif
	<!-- Campaign Slider End-->

    <section class="product-tabs section-padding position-relative">
        <div class="container-fluid">
            <div class="section-title style-2 wow animate__animated animate__fadeIn">
                <h3>Featured Products</h3>
                <ul class="nav nav-tabs links" id="myTab" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active" id="nav-tab-one" data-bs-toggle="tab" data-bs-target="#tab-one"
                            type="button" role="tab" aria-controls="tab-one" aria-selected="true">All</button>
                    </li>
                    @foreach (get_categories()->take(5) as $category)
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="nav-tab-two" data-bs-toggle="tab"
                                data-bs-target="#category{{ $category->id }}" type="button" role="tab"
                                aria-controls="tab-two" aria-selected="false">{{ $category->name_en }}</button>
                        </li>
                    @endforeach
                </ul>
            </div>
            <!--End nav-tabs-->
            <div class="tab-content common-product" id="myTabContent">
                <div class="tab-pane fade show active" id="tab-one" role="tabpanel" aria-labelledby="tab-one">
                    <div class="carausel-6-columns-common-cover position-relative">
                        <div class="slider-arrow slider-arrow-2 carausel-6-columns-common"
                            id="carausel-6-columns-common-arrows"></div>
                        <div class="carausel-6-columns-common carausel-arrow-center" id="carausel-6-columns-common">
                            @forelse($products as $product)
                                @include('frontend.common.product_grid_view')
                                <!--end product card-->
                            @empty
                                @if (session()->get('language') == 'bangla')
                                    <h5 class="text-danger">এখানে কোন পণ্য খুঁজে পাওয়া যায়নি!</h5>
                                @else
                                    <h5 class="text-danger">No products were found here!</h5>
                                @endif
                            @endforelse
                        </div>
                    </div>
                    <!--End product-grid-4-->
                </div>
                <!--En tab one-->
                @foreach (get_categories() as $category)
                    <div class="tab-pane fade" id="category{{ $category->id }}" role="tabpanel" aria-labelledby="tab-two">
                        @php
                            $products = get_category_products($category->slug);
                        @endphp
                        <div class="row product-grid-4">
                            @forelse($products as $product)
                                @include('frontend.common.product_grid_view')
                            @empty
                                @if (session()->get('language') == 'bangla')
                                    <h5 class="text-danger">এখানে কোন পণ্য খুঁজে পাওয়া যায়নি!</h5>
                                @else
                                    <h5 class="text-danger">No products were found here!</h5>
                                @endif
                            @endforelse
                        </div>
                        <!--End product-grid-4-->
                    </div>
                @endforeach
                <!--En tab two-->
            </div>
            <!--End tab-content-->
        </div>
    </section>
    <!--Products Tabs-->

    <section class="banners mb-25">
        <div class="container-fluid">
            <div class="row g-4">
                @foreach ($home_banners->skip(2)->take(3) as $banner)
                    <div class="col-lg-3 col-md-6">
                        <div class="banner-img wow animate__animated animate__fadeInUp" data-wow-delay="0">
                            <img src="{{ asset($banner->banner_img) }}" class="img-fluid" alt="" />
                            <div class="banner-text">
                                <h4>
                                    @if (session()->get('language') == 'bangla')
                                        {{ $banner->title_bn }}
                                    @else
                                        {{ $banner->title_en }}
                                    @endif
                                </h4>
                                <a href="{{ $banner->banner_url }}" class="btn btn-xs">Shop Now <i
                                        class="fi-rs-arrow-small-right"></i></a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
    <!--End banners-->

    @if(count($home2_featured_categories) > 0)
    @foreach($home2_featured_categories->take(5) as $home2_featured_category)
        @if(count($home2_featured_category->products) > 0)
            <section class="common-product section-padding">
                <div class="container wow animate__animated animate__fadeIn">
                    <div class="section-title">
                        @if (count($home2_featured_category->products->where('status', 1)) > 0)
                        <div class="title">
                            <h3>
                                
                                    
                                    @if(session()->get('language') == 'bangla') 
                                        {{
                                            $home2_featured_category->name_bn 
                                        }}
                                    @else
                                        {{
                                            $home2_featured_category->name_en 
                                        }} 
                                    @endif
                            </h3>
                        </div>
                        <a href="{{ route('product.category', $home2_featured_category->slug) }}" class="btn btn-sm btn-primary">View more</a>
                     @endif
                    </div>
                    <div class="carausel-5-columns-cover position-relative">
                        <div class="carausel-5-columns-common carausel-arrow-center" id="carausel-5-columns-common{{$home2_featured_category->id}}">
                            
                                @forelse($home2_featured_category->products as $product)
                                    @if ($product->status == 1)
                                    @include('frontend.common.product_grid_view')
                                    @endif
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
            </section>
            @endif
        @endforeach
    @endif
    <!--Products Tabs-->
    <!--End 4 banners-->
    @if (count($todays_sale) > 0)
        <section class="section-padding pb-5">
            <div class="container-fluid">
                <div class="section-title wow animate__animated animate__fadeIn">
                    <h3 class="">Daily Best Sells</h3>
                    <ul class="nav nav-tabs links" id="myTab-2" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link active" id="nav-tab-one-1" data-bs-toggle="tab"
                                data-bs-target="#tab-one-1" type="button" role="tab" aria-controls="tab-one"
                                aria-selected="true"></button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="nav-tab-two-1" data-bs-toggle="tab" data-bs-target="#tab-two-1"
                                type="button" role="tab" aria-controls="tab-two" aria-selected="false"></button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="nav-tab-three-1" data-bs-toggle="tab"
                                data-bs-target="#tab-three-1" type="button" role="tab" aria-controls="tab-three"
                                aria-selected="false"></button>
                        </li>
                    </ul>
                </div>
                <div class="row justify-content-center">
                    <div class="col-lg-9 col-md-12 wow animate__animated animate__fadeIn" data-wow-delay=".4s">
                        <div class="tab-content" id="myTabContent-1">
                            <div class="tab-pane fade show active" id="tab-one-1" role="tabpanel"
                                aria-labelledby="tab-one-1">
                                <div class="carausel-4-columns-cover arrow-center position-relative">
                                    <div class="slider-arrow slider-arrow-2 carausel-4-columns-arrow"
                                        id="carausel-4-columns-arrows"></div>
                                    <div class="carausel-4-columns carausel-arrow-center" id="carausel-4-columns">
                                        @foreach ($todays_sale as $today_product)
                                            @php
                                                $product = \App\Models\Product::find($today_product->product_id);
                                            @endphp
                                            @if ($product)
                                                @include('frontend.common.product_grid_view', [
                                                    'product' => $product,
                                                ])
                                            @endif
                                        @endforeach
                                        <!--End product Wrap-->
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--End tab-content-->
                    </div>
                    <!--End Col-lg-9-->
                </div>
            </div>
        </section>
    @endif

    @if (count($hot_deals) > 0)
        <!-- Start Hot Deals -->
        <section class="section-padding pb-5">
            <div class="container-fluid">
                <div class="section-title wow animate__animated animate__fadeIn" data-wow-delay="0">
                    <h3 class="">Hot Deals</h3>
                    <a class="show-all btn btn-primary text-white" href="{{ route('hot_deals.all') }}">
                        All Deals
                        <i class="fi-rs-angle-right"></i>
                    </a>
                </div>
                <div class="row">
                    @foreach ($hot_deals as $product)
                        @include('frontend.common.deals')
                        <!--end product card-->
                    @endforeach
                </div>
            </div>
        </section>
        <!-- End Hot Deals -->
    @endif

    <!--End Deals-->
    <section class="section-padding">
        <div class="container-fluid">
            <div class="row">
                <div class="col-xl-3 col-lg-4 col-md-6 mb-sm-5 mb-md-0 col-sm-6  col-12 wow animate__animated animate__fadeInUp"
                    data-wow-delay="0">
                    <h4 class="section-title style-1 mb-30 animated animated">Top Selling</h4>
                    <div class="product-list-small animated animated">
                        @foreach ($product_top_sellings as $product_top_selling)
                            <article class="row align-items-center hover-up">
                                <figure class="col-md-4 mb-0">
                                    <a href="{{ route('product.details', $product_top_selling->slug) }}">
                                        @if (
                                            $product_top_selling->product_thumbnail &&
                                                $product_top_selling->product_thumbnail != '' &&
                                                $product_top_selling->product_thumbnail != 'Null')
                                            <img class="default-img"
                                                src="{{ asset($product_top_selling->product_thumbnail) }}"
                                                alt="" />
                                        @else
                                            <img class="img-lg mb-3" src="{{ asset('upload/no_image.jpg') }}"
                                                alt="" />
                                        @endif
                                    </a>
                                </figure>
                                <div class="col-md-8 mb-0">
                                    <h6>
                                        <a href="{{ route('product.details', $product_top_selling->slug) }}">
                                            @if (session()->get('language') == 'bangla')
                                                {{ $product_top_selling->name_bn }}
                                            @else
                                                {{ $product_top_selling->name_en }}
                                            @endif
                                        </a>
                                    </h6>
                                    <div class="product-rate-cover">
                                        <div class="product-rate d-inline-block">
                                            <div class="product-rating" style="width: 90%"></div>
                                        </div>
                                        <span class="font-small ml-5 text-muted"> (4.0)</span>
                                    </div>
                                    @php
                                        if (auth()->check() && auth()->user()->role == 7) {
                                            if ($product_top_selling->discount_type == 1) {
                                                $price_after_discount = $product_top_selling->reseller_price - $product_top_selling->discount_price;
                                            } elseif ($product_top_selling->discount_type == 2) {
                                                $price_after_discount = $product_top_selling->reseller_price - ($product_top_selling->reseller_price * $product_top_selling->discount_price) / 100;
                                            }
                                        } else {
                                            if ($product_top_selling->discount_type == 1) {
                                                $price_after_discount = $product_top_selling->regular_price - $product_top_selling->discount_price;
                                            } elseif ($product_top_selling->discount_type == 2) {
                                                $price_after_discount = $product_top_selling->regular_price - ($product_top_selling->regular_price * $product_top_selling->discount_price) / 100;
                                            }
                                        }
                                    @endphp

                                    @if ($product_top_selling->discount_price > 0)
                                        @if (auth()->check() && auth()->user()->role == 7)
                                            <div class="product-price">
                                                <span class="price">৳{{ $price_after_discount }}</span>
                                                <span class="old-price">৳{{ $product_top_selling->reseller_price }}</span>
                                            </div>
                                        @else
                                            <div class="product-price">
                                                <span class="price">৳{{ $price_after_discount }}</span>
                                                <span class="old-price">৳{{ $product_top_selling->regular_price }}</span>
                                            </div>
                                        @endif
                                    @else
                                        @if (auth()->check() && auth()->user()->role == 7)
                                            <div class="product-price">
                                                <span class="price">৳{{ $product_top_selling->reseller_price }}</span>
                                            </div>
                                        @else
                                            <div class="product-price">
                                                <span class="price">৳{{ $product_top_selling->regular_price }}</span>
                                            </div>
                                        @endif
                                    @endif
                                </div>
                            </article>
                        @endforeach
                    </div>
                </div>
                <div class="col-xl-3 col-lg-4 col-md-6 mb-md-0 wow  col-sm-6 col-12 animate__animated animate__fadeInUp"
                    data-wow-delay=".1s">
                    <h4 class="section-title style-1 mb-30 animated animated">Trending Products</h4>
                    <div class="product-list-small animated animated">
                        @foreach ($product_trendings as $product_trending)
                            <article class="row align-items-center hover-up">
                                <figure class="col-md-4 mb-0">
                                    <a href="{{ route('product.details', $product_trending->slug) }}">
                                        @if (
                                            $product_trending->product_thumbnail &&
                                                $product_trending->product_thumbnail != '' &&
                                                $product_trending->product_thumbnail != 'Null')
                                            <img class="default-img"
                                                src="{{ asset($product_trending->product_thumbnail) }}" alt="" />
                                        @else
                                            <img class="img-lg mb-3" src="{{ asset('upload/no_image.jpg') }}"
                                                alt="" />
                                        @endif
                                    </a>
                                </figure>
                                <div class="col-md-8 mb-0">
                                    <h6>
                                        <a href="{{ route('product.details', $product_trending->slug) }}">
                                            @if (session()->get('language') == 'bangla')
                                                {{ $product_trending->name_bn }}
                                            @else
                                                {{ $product_trending->name_en }}
                                            @endif
                                        </a>
                                    </h6>
                                    <div class="product-rate-cover">
                                        <div class="product-rate d-inline-block">
                                            <div class="product-rating" style="width: 90%"></div>
                                        </div>
                                        <span class="font-small ml-5 text-muted"> (4.0)</span>
                                    </div>
                                    @php
                                        if (auth()->check() && auth()->user()->role == 7) {
                                            if ($product_trending->discount_type == 1) {
                                                $price_after_discount = $product_trending->reseller_price - $product_trending->discount_price;
                                            } elseif ($product_trending->discount_type == 2) {
                                                $price_after_discount = $product_trending->reseller_price - ($product_trending->reseller_price * $product_trending->discount_price) / 100;
                                            }
                                        } else {
                                            if ($product_trending->discount_type == 1) {
                                                $price_after_discount = $product_trending->regular_price - $product_trending->discount_price;
                                            } elseif ($product_trending->discount_type == 2) {
                                                $price_after_discount = $product_trending->regular_price - ($product_trending->regular_price * $product_trending->discount_price) / 100;
                                            }
                                        }
                                    @endphp
                                    @if ($product_trending->discount_price > 0)
                                        @if (auth()->check() && auth()->user()->role == 7)
                                            <div class="product-price">
                                                <span class="price">৳{{ $price_after_discount }}</span>
                                                <span class="old-price">৳{{ $product_trending->reseller_price }}</span>
                                            </div>
                                        @else
                                            <div class="product-price">
                                                <span class="price">৳{{ $price_after_discount }}</span>
                                                <span class="old-price">৳{{ $product_trending->regular_price }}</span>
                                            </div>
                                        @endif
                                    @else
                                        @if (auth()->check() && auth()->user()->role == 7)
                                            <div class="product-price">
                                                <span class="price">৳{{ $product_trending->reseller_price }}</span>
                                            </div>
                                        @else
                                            <div class="product-price">
                                                <span class="price">৳{{ $product_trending->regular_price }}</span>
                                            </div>
                                        @endif
                                    @endif
                                </div>
                            </article>
                        @endforeach
                    </div>
                </div>
                <div class="col-xl-3 col-lg-4 col-md-6 mb-sm-5 mb-md-0 col-sm-6  col-12 wow animate__animated animate__fadeInUp"
                    data-wow-delay=".2s">
                    <h4 class="section-title style-1 mb-30 animated animated">Recently added</h4>
                    <div class="product-list-small animated animated">
                        @foreach ($product_recently_adds as $product_recently_add)
                            <article class="row align-items-center hover-up">
                                <figure class="col-md-4 mb-0">
                                    <a href="{{ route('product.details', $product_recently_add->slug) }}">
                                        @if (
                                            $product_recently_add->product_thumbnail &&
                                                $product_recently_add->product_thumbnail != '' &&
                                                $product_recently_add->product_thumbnail != 'Null')
                                            <img class="default-img"
                                                src="{{ asset($product_recently_add->product_thumbnail) }}"
                                                alt="" />
                                        @else
                                            <img class="img-lg mb-3" src="{{ asset('upload/no_image.jpg') }}"
                                                alt="" />
                                        @endif
                                    </a>
                                </figure>
                                <div class="col-md-8 mb-0">
                                    <h6>
                                        <a href="{{ route('product.details', $product_recently_add->slug) }}">
                                            @if (session()->get('language') == 'bangla')
                                                {{ $product_recently_add->name_bn }}
                                            @else
                                                {{ $product_recently_add->name_en }}
                                            @endif
                                        </a>
                                    </h6>
                                    <div class="product-rate-cover">
                                        <div class="product-rate d-inline-block">
                                            <div class="product-rating" style="width: 90%"></div>
                                        </div>
                                        <span class="font-small ml-5 text-muted"> (4.0)</span>
                                    </div>
                                    @php
                                        if (auth()->check() && auth()->user()->role == 7) {
                                            if ($product_recently_add->discount_type == 1) {
                                                $price_after_discount = $product_recently_add->reseller_price - $product_recently_add->discount_price;
                                            } elseif ($product_recently_add->discount_type == 2) {
                                                $price_after_discount = $product_recently_add->reseller_price - ($product_recently_add->reseller_price * $product_recently_add->discount_price) / 100;
                                            }
                                        } else {
                                            if ($product_recently_add->discount_type == 1) {
                                                $price_after_discount = $product_recently_add->regular_price - $product_recently_add->discount_price;
                                            } elseif ($product_recently_add->discount_type == 2) {
                                                $price_after_discount = $product_recently_add->regular_price - ($product_recently_add->regular_price * $product_recently_add->discount_price) / 100;
                                            }
                                        }
                                    @endphp
                                    @if ($product_recently_add->discount_price > 0)
                                        @if (auth()->check() && auth()->user()->role == 7)
                                            <div class="product-price">
                                                <span class="price">৳{{ $price_after_discount }}</span>
                                                <span
                                                    class="old-price">৳{{ $product_recently_add->reseller_price }}</span>
                                            </div>
                                        @else
                                            <div class="product-price">
                                                <span class="price">৳{{ $price_after_discount }}</span>
                                                <span class="old-price">৳{{ $product_recently_add->regular_price }}</span>
                                            </div>
                                        @endif
                                    @else
                                        @if (auth()->check() && auth()->user()->role == 7)
                                            <div class="product-price">
                                                <span class="price">৳{{ $product_recently_add->reseller_price }}</span>
                                            </div>
                                        @else
                                            <div class="product-price">
                                                <span class="price">৳{{ $product_recently_add->regular_price }}</span>
                                            </div>
                                        @endif
                                    @endif
                                </div>
                            </article>
                        @endforeach
                    </div>
                </div>
                <div class="col-xl-3 col-lg-4 col-md-6 mb-sm-5 mb-md-0 col-sm-6  col-12 wow animate__animated animate__fadeInUp"
                    data-wow-delay=".3s">
                    <h4 class="section-title style-1 mb-30 animated animated">Top Rated</h4>
                    <div class="product-list-small animated animated">
                        @foreach ($product_top_rates as $product_top_rate)
                            <article class="row align-items-center hover-up">
                                <figure class="col-md-4 mb-0">
                                    <a href="{{ route('product.details', $product_top_rate->slug) }}">
                                        @if (
                                            $product_top_rate->product_thumbnail &&
                                                $product_top_rate->product_thumbnail != '' &&
                                                $product_top_rate->product_thumbnail != 'Null')
                                            <img class="default-img"
                                                src="{{ asset($product_top_rate->product_thumbnail) }}" alt="" />
                                        @else
                                            <img class="img-lg mb-3" src="{{ asset('upload/no_image.jpg') }}"
                                                alt="" />
                                        @endif
                                    </a>
                                </figure>
                                <div class="col-md-8 mb-0">
                                    <h6>
                                        <a href="{{ route('product.details', $product_top_rate->slug) }}">
                                            @if (session()->get('language') == 'bangla')
                                                {{ $product_top_rate->name_bn }}
                                            @else
                                                {{ $product_top_rate->name_en }}
                                            @endif
                                        </a>
                                    </h6>
                                    <div class="product-rate-cover">
                                        <div class="product-rate d-inline-block">
                                            <div class="product-rating" style="width: 90%"></div>
                                        </div>
                                        <span class="font-small ml-5 text-muted"> (4.0)</span>
                                    </div>
                                    @php
                                        if (auth()->check() && auth()->user()->role == 7) {
                                            if ($product_top_rate->discount_type == 1) {
                                                $price_after_discount = $product_top_rate->reseller_price - $product_top_rate->discount_price;
                                            } elseif ($product_top_rate->discount_type == 2) {
                                                $price_after_discount = $product_top_rate->reseller_price - ($product_top_rate->reseller_price * $product_top_rate->discount_price) / 100;
                                            }
                                        } else {
                                            if ($product_top_rate->discount_type == 1) {
                                                $price_after_discount = $product_top_rate->regular_price - $product_top_rate->discount_price;
                                            } elseif ($product_top_rate->discount_type == 2) {
                                                $price_after_discount = $product_top_rate->regular_price - ($product_top_rate->regular_price * $product_top_rate->discount_price) / 100;
                                            }
                                        }
                                    @endphp
                                    @if ($product_top_rate->discount_price > 0)
                                        @if (auth()->check() && auth()->user()->role == 7)
                                            <div class="product-price">
                                                <span class="price">৳{{ $price_after_discount }}</span>
                                                <span class="old-price">৳{{ $product_top_rate->reseller_price }}</span>
                                            </div>
                                        @else
                                            <div class="product-price">
                                                <span class="price">৳{{ $price_after_discount }}</span>
                                                <span class="old-price">৳{{ $product_top_rate->regular_price }}</span>
                                            </div>
                                        @endif
                                    @else
                                        @if (auth()->check() && auth()->user()->role == 7)
                                            <div class="product-price">
                                                <span class="price">৳{{ $product_top_rate->reseller_price }}</span>
                                            </div>
                                        @else
                                            <div class="product-price">
                                                <span class="price">৳{{ $product_top_rate->regular_price }}</span>
                                            </div>
                                        @endif
                                    @endif
                                </div>
                            </article>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--End 4 columns-->
@endsection