@forelse($pos_cart_data as $cart)
    @php
        if ($cart->stock_id) {
            $stock = App\Models\ProductStock::find($cart->stock_id);
            if ($cart->product->discount_type == 1) {
                $price_after_discount = $stock->price - $cart->product->discount_price;
            } elseif ($cart->product->discount_type == 2) {
                $price_after_discount = $stock->price - ($stock->price * $cart->product->discount_price) / 100;
            }
            $price = $cart->product->discount_price ? $price_after_discount : $stock->price;
        } else {
            if ($cart->product->discount_type == 1) {
                $price_after_discount = $cart->product->regular_price - $cart->product->discount_price;
            } elseif ($cart->product->discount_type == 2) {
                $price_after_discount = $cart->product->regular_price - ($cart->product->regular_price * $cart->product->discount_price) / 100;
            }
            $price = $cart->product->discount_price ? $price_after_discount : $cart->product->regular_price;
        }
    @endphp
    <tr class="cart__product">
        <td style="width: 45%;">
            <!-- product title -->
            <h5 class="cart__product_title">
                {!! Str::limit($cart->product->name_en, 70, ' ...') !!}
                @if($productStock = App\Models\ProductStock::find($cart->stock_id))
                   <span> {{ $productStock->varient }}</span>
                @endif
            </h5>
            <!-- product cart price -->
            <p class="product_cart_price"><span class="product_price_amount">
                    {{ __($price) }}{{ __($setting->site_currency) }}
                </span></p>
        </td>
        <td style="width: 30%;" >
            <!-- product quantity -->
            <div class="input-group quantity__btn__change">
                <input type="hidden" value="{{ $cart->product_id }}" class="product_id">
                <input type="hidden" value="{{ $cart->stock_id }}" class="stock_id">
                <!-- decress btn -->
                <button type="button" class="input-group-text rounded-0 bg-navy add_btn decress_quantity changeQuantity quantityChange"
                    data-type="-"><i class="fa-solid fa-minus"></i></button>
                <!-- quantity input -->
                <input class="form-control text-center quantity_input quantity__number" value="{{ $cart->quantity }}" min="1"
                    max="" type="text" name="quantity" disabled>
                <!-- incress -->
                <button type="button" class="input-group-text rounded-0 bg-navy add_btn incress_quantity changeQuantity quantityChange"
                    data-type="+"><i class="fa-solid fa-plus"></i></button>
            </div>
            <!-- select type -->
            <div class="input-group mt-2">
            </div>
        </td>
        <td style="width:15%">
            @php
                $subtotal = $price * $cart->quantity;
                $buyingprice = $cart->product->purchase_price;
                $buyingsubtotal = $buyingprice * $cart->quantity;
            @endphp
            <!-- item subtotal -->
            <p class="product_item_subtotal text-center"><span
                    class="subtotal__amount">{{ number_format($subtotal, 2) }}
                    {{ __($setting->site_currency) }}</span></p></span>
            <p class="product_itembuying_subtotal text-center" style="display:none"><span
                    class="buyingsubtotal__amount">{{ $buyingsubtotal }}</span></p></span>
        </td>
        <td style="width: 10%;" class="text-center">
            <button type="button" class="cart_actionBtn btn_main misty-color remove-posCart" data-id="{{ $cart->id }}"
                data-page="1">
                <i class="fa-solid fa-trash"></i>
            </button>
        </td>
    </tr>
    @empty
     <div class="text-center pt-10 pb-10" id="no_product_text">
        <span>No Product Added</span>
    </div>
@endforelse

