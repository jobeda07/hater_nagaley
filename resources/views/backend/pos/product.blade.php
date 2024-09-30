@foreach($products as $product)
@if($product->is_varient)
    @foreach ($product->stocks->where('qty', '>', 0) as $key => $stock)
        <div class="col-sm-2 col-xs-6 product-thumb product-row-list addToCartBtn" data-id={{ $stock->id }} data-product_id="{{ $product->id }}">
            <div class="card mb-4">
                <div class="card-body">
                    <div class="product-image">
                        @if($stock->image && $stock->image != '' && $stock->image != 'Null')
                            <img class="default-img" src="{{ asset($stock->image) }}" alt="" />
                        @else
                            <img class="default-img" src="{{ asset('upload/no_image.jpg') }}" alt="" />
                        @endif
                    </div>
                    <p style="font-size: 10px; font-weight: bold; line-height: 15px; height: 30px;">
                        <?php $p_name_en =  strip_tags(html_entity_decode($product->name_en))?>
                        {{ Str::limit($p_name_en, $limit = 30, $end = '. . .') }}
                    </p>
                    <p style="font-size: 10px; font-weight: bold; line-height: 10px; height: 15px;">
                        Size: {{ $stock->varient }}
                    </p>
                    <p style="font-size: 10px; font-weight: bold; line-height: 10px; height: 15px;">
                        Stock: {{ $stock->qty }}
                    </p>
                    <div>
                        <div class="product-price">
                            <span class="price text-primary">৳{{ $stock->price }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
@else
    <div class="col-sm-2 col-xs-6 product-thumb product-row-list addToCartBtn" data-product_id="{{ $product->id }}">
        <div class="card mb-4">
            <div class="card-body">
                <div class="product-image">
                    @if($product->product_thumbnail && $product->product_thumbnail != '' && $product->product_thumbnail != 'Null')
                        <img class="default-img" src="{{ asset($product->product_thumbnail) }}" alt="" />
                    @else
                        <img class="default-img" src="{{ asset('upload/no_image.jpg') }}" alt="" />
                    @endif
                </div>
                <p style="font-size: 10px; font-weight: bold; line-height: 15px; height: 30px;">
                    <?php $p_name_en =  strip_tags(html_entity_decode($product->name_en))?>
                    {{ Str::limit($p_name_en, $limit = 30, $end = '. . .') }}
                </p>
                <p style="font-size: 10px; font-weight: bold; line-height: 10px; height: 15px;">
                        Stock: {{ $product->stock_qty }}
                    </p>
                <div>
                    @if ($product->discount_price > 0)
                        @php
                            if($product->discount_type == 1){
                                $price_after_discount = $product->regular_price - $product->discount_price;
                            }elseif($product->discount_type == 2){
                                $price_after_discount = $product->regular_price - ($product->regular_price * $product->discount_price / 100);
                            }
                        @endphp
                        <div class="product-price">
                            <del class="old-price">৳{{ $product->regular_price }}</del>
                            <span class="price text-primary">৳{{ $price_after_discount }}</span>
                        </div>
                    @else
                        <div class="product-price">
                            <span class="price text-primary">৳{{ $product->regular_price }}</span>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endif
@endforeach
