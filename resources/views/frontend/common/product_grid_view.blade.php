<div class="col-lg-1-5 col-md-4 col-sm-12 col-12">
    <div class="product-cart-wrap mb-30 wow animate__animated animate__fadeIn" data-wow-delay=".1s">
        <div class="product-img-action-wrap">
            <div class="product-img product-img-zoom">
                <a href="{{ route('product.details',$product->slug) }}">
                    @if($product->product_thumbnail && $product->product_thumbnail != '' && $product->product_thumbnail != '')
                        <img class="default-img lazyload img-responsive" data-original="{{ asset($product->product_thumbnail) }}" src="{{ asset($product->product_thumbnail) }}" alt="">
                        <img class="hover-img" data-original="{{ asset($product->product_thumbnail) }}" src="{{ asset($product->product_thumbnail) }}"alt="" />
                    @else
                        <img class="img-lg mb-3" data-original="{{ asset('upload/no_image.jpg') }}" alt="" />
                    @endif
                </a>
            </div>
            <div class="product-action-1 d-flex">
                <a aria-label="Quick view" id="{{ $product->id }}" onclick="productView(this.id)" class="action-btn" data-bs-toggle="modal" data-bs-target="#quickViewModal"><i class="fi-rs-eye"></i></a>
            </div>
            <!-- start product discount section -->
          	@php
                if(auth()->check() && auth()->user()->role==7){
                    if($product->discount_type == 1){
                        $price_after_discount = $product->reseller_price - $product->discount_price;
                    }elseif($product->discount_type == 2){
                        $price_after_discount = $product->reseller_price - ($product->reseller_price * $product->discount_price / 100);
                    }
                }else{
                    if($product->discount_type == 1){
                        $price_after_discount = $product->regular_price - $product->discount_price;
                    }elseif($product->discount_type == 2){
                        $price_after_discount = $product->regular_price - ($product->regular_price * $product->discount_price / 100);
                    }
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
        </div>
        <div class="product-content-wrap">
            {{-- @php
                $couponCode = getCoupon();
                $coupon = \App\Models\Coupon::where('coupon_code', $couponCode)->first();
                $showCoupon = false;
                if ($coupon && $coupon->product_id != null) {
                    $couponProductIds = explode(',', $coupon->product_id);
                    if (in_array($product->id, $couponProductIds)) {
                        $showCoupon = true;
                    }
                }
            @endphp
            @if($showCoupon)
                <span class="coupon_code">Coupon: {{ $couponCode }}</span>
            @endif --}}
            <h2 class="mt-3" style="height: 20px;">
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

            <div class="product-category" style="margin-top: 20px">
                <span rel="tag">
                    {{ $product->brand->name_en ?? 'No Brand'}}
                </span>
            </div>

            <div class="product-category">
                @if($product->unit_id)
                    <div class="">
                  	    <span class="unit">Unit: </span>
                  	    <span class="unit text-brand fw-900"> {{ $product->unit_weight }} {{ $product->unit->name ?? '' }} </span>
                    </div>
              	@endif
                <a href="{{ route('product.category', $product->category->slug) }}">
                    @if(session()->get('language') == 'bangla')
                        {{ $product->category->name_bn }}
                    @else
                        {{ $product->category->name_en }}
                    @endif
                </a>
            </div>
            <div class="product-card-bottom">
            	@if ($product->discount_price > 0)
                    @if(auth()->check() && auth()->user()->role==7)
                        <div class="product-price">
                            <span class="price">৳{{ $product->reseller_price }}</span>
                            <!--<span class="old-price">৳{{ $product->reseller_price }}</span>-->
                        </div>
                    @else
                        <div class="product-price">
                            <span class="price">৳{{ $price_after_discount }}</span>
                            <span class="old-price">৳{{ $product->regular_price }}</span>
                        </div>
                    @endif
                @else
                    @if (auth()->check() && auth()->user()->role==7)
                        <div class="product-price">
                            <span class="price">৳{{ $product->reseller_price }}</span>
                        </div>
                    @else
                        <div class="product-price">
                            <span class="price">৳{{ $product->regular_price }}</span>
                        </div>
                    @endif
                @endif
                <div class="add-cart">
                    @if($product->is_varient == 1)
                            <a class="add" id="{{ $product->id }}" onclick="productView(this.id)" data-bs-toggle="modal" data-bs-target="#quickViewModal"><i class="fi-rs-shopping-cart mr-5"></i>Add </a>
                    @else
                        @if($product->stock_qty>0)
                            <input type="hidden" id="pfrom" value="direct">
                            <input type="hidden" id="product_product_id" value="{{ $product->id }}"  min="1">
                            <input type="hidden" id="{{ $product->id }}-product_pname" value="{{ $product->name_en }}">
                            <a class="add" onclick="addToCartDirect({{ $product->id }})" ><i class="fi-rs-shopping-cart mr-5"></i>Add </a>
                        @else
                             <p class="stock_out"><i class="fas fa-window-close mr-5"></i>Stock Out</p>
                        @endif
                    @endif
                </div>
            </div>
            @if (auth()->check() && auth()->user()->role==7)
                <div>
                    <span>Regular Price: <span class="text-info">৳ {{ $product->regular_price }}</span></span>
                    <input type="hidden" id="regular_price" name="regular_price" value="{{ $product->regular_price }}"  min="1">
                </div>
            @endif
        </div>
    </div>
</div>
