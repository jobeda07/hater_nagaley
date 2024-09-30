@extends('layouts.frontend')
@push('css')
    <style>
        /*Address select design*/
        .address_select_custom .custom_select .select2-container {
            width: 95% !important;
            max-width: 95%;
        }
        .address_select_custom .custom_select .select2-container--default .select2-selection--single {
            height: 59px;
        }
        .address_select_custom .custom_select .select2-container--default .select2-selection--single .select2-selection__arrow {
            top: 16px;
        }
        .address_select_custom .custom_select .select2-container--default .select2-selection--single .select2-selection__rendered {
            line-height: 59px;
        }
        /*Model select design*/
        .custom_address_modal.custom_select .select2-container {
            width: 95% !important;
            max-width: 95%;
        }
        .custom_address_modal.custom_select .select2-container--default .select2-selection--single {
            height: 59px;
        }
        .custom_address_modal.custom_select .select2-container--default .select2-selection--single .select2-selection__arrow {
            top: 16px;
        }
        .custom_address_modal.custom_select .select2-container--default .select2-selection--single .select2-selection__rendered {
            line-height: 59px;
        }
    </style>
    <script>
        $(document).ready(function() {
            $('#payment_checkout').show();
            $('#payment_prepayment').hide();
        });
    </script>
@endpush
@section('content-frontend')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <main class="main">
        <div class="page-header breadcrumb-wrap">
            <div class="container">
                <div class="breadcrumb">
                    <a href="{{ route('home') }}" rel="nofollow"><i class="fi-rs-home mr-5"></i>Home</a>
                    <span></span> Shop
                    <span></span> Checkout
                </div>
            </div>
        </div>
        <div class="container mb-80 mt-50">
            <div class="row">
                <div class="col-lg-8 mb-40">
                    <h1 class="heading-2 mb-10">Checkout</h1>
                    <div class="d-flex justify-content-between">
                        <h6 class="text-body">There are <span class="text-brand" id="total_cart_qty"></span> product(s) in your cart</h6>
                        {{-- @php
                            $couponCode = getCoupon();
                        @endphp
                        @if ($couponCode)
                            <h6 class="text-body">Coupon code is <span class="text-brand"
                                    id="">{{ $couponCode }}</span></h6>
                        @endif --}}
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-7">
                    <div class="row mb-50">

                        {{--<div class="col-lg-6">
                            <form method="post" class="apply-coupon">
                                <input type="text" placeholder="Enter Coupon Code...">
                                <button class="btn  btn-md" name="login">Apply Coupon</button>
                            </form>
                        </div>--}}
                    </div>
                <form action="@if(auth()->check() && auth()->user()->prepaid_amount > 0) {{ route('checkout.completePayment') }} @else {{ route('checkout.payment') }} @endif" method="post">
                    @csrf
                    <div class="row">
                        <div class="d-flex">
                            <h4 class="mb-30 col-9">Billing Details</h4>
                        </div>

                        <div class="row">
                            <div class="form-group col-lg-6">
                                <label for="name" class="fw-bold text-black"><span class="text-danger">*</span> Name </label>
                                <input type="text" required="" id="name" name="name" placeholder="Full Name" value="{{ Auth::user()->name ?? old('name') }}">
                                @error('name')
                                    <p class="text-danger">{{$message}}</p>
                                @enderror
                            </div>
                            <div class="form-group col-lg-6">
                                <label for="phone" class="fw-bold text-black"><span class="required text-danger">*</span> Phone </label>
                                <input required="" type="number" name="phone" placeholder="Phone" id="phone" value="{{ Auth::user()->phone ?? old('phone') }}">
                                @error('phone')
                                    <p class="text-danger">{{$message}}</p>
                                @enderror
                            </div>

                            <div class="form-group col-lg-6">
                                <label for="email" class="fw-bold text-black">Email</label>
                                <input id="email" type="email" name="email" placeholder="Email address *" value="{{ Auth::user()->email ?? old('email') }}">
                            </div>

                            @if(auth()->check() && auth()->user()->role!=7)
                                @php
                                    $id = Auth::user()->id;
                                    $addresses = App\Models\Address::where('user_id', $id)->latest()->get();
                                @endphp

                                <div class="form-group col-lg-6">
                                    <label for="address_id" class="fw-bold text-black col-form-label"><span class="text-danger">*</span>Address</label>
                                    <div class="form-row">
                                        <div class="col-10 float-start address_select_custom">
                                            <div class="custom_select custom_address_modal">
                                                <select class="form-select select-active select-nice" aria-label="Default select example"  name="address_id" id="address_id" required>
                                                    <option selected>Select Address</option>
                                                        @foreach($addresses as $address)
                                                            <option value="{{ $address->id}}">{{ ucwords($address->address) }}</option>
                                                        @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <a class="btn btn-small col-1 float-start"  data-bs-toggle="modal" id="closeModalAddress" data-bs-target="#staticBackdrop"><i class="fas fa-plus"></i></a>
                                    </div>
                                </div>
                            @endif
                        </div>

                        @if(!auth()->check() || (auth()->check() && auth()->user()->role==7))
                        <div class="row shipping_calculator">
                            <div class="form-group col-lg-6 address_select_custom">
                                <div class="custom_select custom_address_modal">
                                    <label for="division_id" class="fw-bold text-black"><span class="text-danger">*</span> Division</label>
                                    <select class="form-control select-active"  name="division_id" id="division_id" required>
                                        <option value="">Select Division</option>

                                        @foreach(get_divisions() as $division)
                                          <option value="{{ $division->id }}">{{ ucwords($division->division_name_en) }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group col-lg-6 address_select_custom">
                                <div class="custom_select custom_address_modal">
                                    <label for="district_id" class="fw-bold text-black"><span class="text-danger">*</span> District</label>
                                    <select class="form-control select-active" name="district_id" id="district_id" required>
                                        <option selected=""  value="">Select District</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group col-lg-6 address_select_custom">
                                <div class="custom_select custom_address_modal">
                                    <label for="upazilla_id" class="fw-bold text-black"><span class="text-danger">*</span> Upazilla</label>
                                    <select class="form-control select-active" name="upazilla_id" id="upazilla_id" required>
                                        <option selected=""  value="">Select Upazilla</option>

                                    </select>
                                </div>
                            </div>
                            <div class="form-group col-lg-6">
                                <label for="address" class="fw-bold text-black"><span class="text-danger">*</span> Address</label>
                                <textarea name="address" id="address" class="form-control" placeholder="Address" required>{{ old('address') }}</textarea>
                                @error('address')
                                    <p class="text-danger">{{$message}}</p>
                                @enderror
                            </div>
                        </div>
                        @else
                            @if(!(auth()->check() && auth()->user()->role==7))
                                <div class="card bg-lite-main mb-2 d-none selected_address">
                                    <div class="card-header bg-main">
                                        Selected Address
                                    </div>
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-sm-4">
                                                <p>Division: <span class="ms-1" id="dynamic_division"> </span></p>
                                                <input type="hidden" id="dynamic_division_input" name="division_id">
                                            </div>
                                            <div class="col-sm-4">
                                                <p>District: <span class="ms-1" id="dynamic_district"> </span></p>
                                                <input type="hidden" id="dynamic_district_input" name="district_id">
                                            </div>
                                            <div class="col-sm-4">
                                                <p>Upazilla: <span class="ms-1" id="dynamic_upazilla"> </span></p>
                                                <input type="hidden" id="dynamic_upazilla_input" name="upazilla_id">
                                            </div>
                                            <div class="col-sm-12 mt-2">
                                                <p>Address: <span class="ms-1" id="dynamic_address"> </span></p>
                                                <input type="hidden" id="dynamic_address_input" name="address">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        @endif
                        <div class="form-group col-lg-6 address_select_custom">
                            <div class="custom_select">
                                <label for="shipping_id" class="fw-bold text-black col-12"><span class="text-danger">*</span> Shipping</label>
                                <select class="form-control select-active col-12" name="shipping_id" id="shipping_id" required>
                                    <option value="">--Select--</option>
                                    @foreach ($shippings as $key => $shipping)
                                        <option value="{{ $shipping->id }}">@if($shipping->type == 1) Inside Dhaka @else Outside Dhaka @endif </option>
                                    @endforeach
                                </select>
                                @error('shipping_id')
                                    <p class="text-danger">{{$message}}</p>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group col-lg-6">
                            <label for="comment" class="fw-bold text-black">Comments</label>
                            <textarea name="comment" id="comment" class="form-control" placeholder="Additional information"></textarea>
                        </div>
                    </div>
                </div>
                <div class="col-lg-5">
                    <div class="border p-40 cart-totals ml-30 mb-50">
                        <div class="d-flex align-items-end justify-content-between mb-30">
                            <h4>Your Order</h4>
                            <h6 class="text-muted">Subtotal</h6>
                        </div>
                        <div class="divider-2 mb-30"></div>
                        <div class="table-responsive order_table checkout">
                            <table class="table no-border">
                                <tbody id="">
                                    @foreach ($carts as $cart)
                                    <tr>
                                        <td class="image product-thumbnail"><img src="/{{$cart->options->image}}" alt="#"></td>
                                        <td>
                                            <h6 class="w-160 mb-5"><a href="{{ route('product.details', $cart->options->slug) }}" class="text-heading">{{$cart->name}}</a></h6></span>
                                            @if($cart->options->attribute_names)
                                                @for($i=0; $i<sizeof($cart->options->attribute_names); $i++)
                                                    <span>{{ $cart->options->attribute_names[$i] }}: {{ $cart->options->attribute_values[$i] }}</span><br/>
                                                @endfor
                                            @endif
                                        </td>
                                        <td>
                                            <h6 class="text-muted pl-20 pr-20">x {{$cart->qty}}</h6>
                                        </td>
                                        <td>
                                            <h4 class="text-brand">৳{{$cart->subtotal}}</h4>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <tfoot>
                                <tr>
                                    {{-- <td>
                                        <h6 class="mb-2">Have Coupon ? </h6>
                                    </td>
                                    <td>
                                        <div class="coupon_apply">
                                            <input type="text" placeholder="Coupon Code" id="coupon">
                                            <button class="btn btn-success btn-lg" type="button" id="apply"
                                                onclick="applyCoupon()">Apply</button>
                                        </div>
                                    </td> --}}
                                    {{-- <input type="hidden" name="coupon_id" id="coupon_id"> --}}
                                    <td><h6 class="d-flex justify-content-between mb-2">Subtotal : <span class="text-brand text-end">৳<span id="cartSubTotal">{{ number_format($cartTotal) }}</span></span></h6></td>
                                    <td><h6 class="d-flex justify-content-between mb-2">Shipping : <span class="text-brand text-end">৳<span id="ship_amount">0.00</span></span><h6></td>
                                        {{-- <div class="coupon_times">
                                            <div onclick="removeCoupon()" disabled id="remove" style="display: none">
                                                <h6> <span>Coupon Discount : <i class="fa fa-times"
                                                            aria-hidden="true"></i></span>
                                                    <span class="text-brand text-end">৳<span
                                                            id="coupon_discount">0.00</span></span>
                                                </h6>
                                            </div>
                                            <input type="hidden" value="" name="coupon_discount"
                                                class="discount" />
                                        </div> --}}
                                    <input type="hidden" value="" name="shipping_charge" class="ship_amount" />
                                    <input type="hidden" value="" name="shipping_type" class="shipping_type" />
                                    <input type="hidden" value="" name="shipping_name" class="shipping_name" />
                                    <input type="hidden" value="{{ $cartTotal }}" name="sub_total" id="cartSubTotalShi" />
                                    <input type="hidden" value="{{ $cartTotal }}" name="grand_total" id="grand_total" />
                                    <td><h4 class="d-flex justify-content-between">Total : <span class="text-brand text-end">৳<span id="grand_total_set">{{($cartTotal) }}</span></span><h4></td>
                                </tr>
                            </tfoot>
                        </div>

                        @if(auth()->check() && auth()->user()->role == 7)
                            <div class="mt-30">
                                <label for="collectable_amount" class="fw-bold text-black col-12"><span class="text-danger">*</span> Collectable Amount (৳)</label>
                                <input type="text" name="collectable_amount" id="collectable_amount" class="form-control" value="@if(session()->has('collectable_amount') && session()->get('collectable_amount')>0){{ number_format(session()->get('collectable_amount')) }}@else{{ number_format($cartTotal) }}@endif" required>
                                <input type="hidden" id="prepaid_amount" name="prepaid_amount" value="@if(auth()->check() && auth()->user()->prepaid_amount > 0){{ auth()->user()->prepaid_amount }}@else 0 @endif">
                                @if(auth()->check() && auth()->user()->prepaid_amount > 0)
                                    <p class="mt-30">Pre Paid Amount: <span class="text-brand fw-bold" style="font-size: 20px;">৳{{ auth()->user()->prepaid_amount }}</span></p>
                                @endif
                            </div>
                        @else
                            <input type="hidden" name="collectable_amount" id="collectable_amount" value="@if(session()->has('collectable_amount') && session()->get('collectable_amount')>0){{ number_format(session()->get('collectable_amount')) }}@else{{ number_format($cartTotal) }}@endif">
                            <input type="hidden" id="prepaid_amount" name="prepaid_amount" value="@if(auth()->check() && auth()->user()->prepaid_amount > 0){{ auth()->user()->prepaid_amount }}@else 0 @endif">
                        @endif

                    </div>
                    <div class="payment ml-30" id="payment_prepayment">
                        <h4 class="mb-10">Pre Payment</h4>
                        <!-- <div class="custome-radio"> -->
                            <p class="mb-30">You've to pay <span class="text-brand fw-bold" style="font-size: 30px;">৳<span id="prepayment_amount_txt">0</span></span> first to complete the order.</p>
                            <input type="hidden" name="prepayment_amount" id="prepayment_amount" value="0">
                            <div class="row gutters-5">

                                <div class="col-4 col-sm-3">
                                    <label class="cit-megabox d-block mb-3">
                                        <input class="form-check-input" required="" type="radio" name="pre_payment_option" id="bkash" value="bkash" checked="">
                                        <span class="d-block cit-megabox-elem p-3">
                                            <img src="{{asset('frontend')}}/assets/imgs/theme/bkash.png" alt="" class="img-fluid mb-2">
                                            <span class="d-block text-center">
                                                <span class="d-block fw-600 fs-15">bKash</span>
                                            </span>
                                        </span>
                                    </label>
                                </div>

                                <div class="col-4 col-sm-3">
                                    <label class="cit-megabox d-block mb-3">
                                        <input class="form-check-input" required="" type="radio" name="pre_payment_option" id="nagad" value="nagad">
                                        <span class="d-block cit-megabox-elem p-3">
                                            <img src="{{asset('frontend')}}/assets/imgs/theme/nagad.png" alt="" class="img-fluid mb-2">
                                            <span class="d-block text-center">
                                                <span class="d-block fw-600 fs-15">Nagad</span>
                                            </span>
                                        </span>
                                    </label>
                                </div>

                                <div class="col-4 col-sm-3">
                                    <label class="cit-megabox d-block mb-3">
                                        <input class="form-check-input" required="" type="radio" name="pre_payment_option" id="aamarpay" value="aamarpay">
                                        <span class="d-block cit-megabox-elem p-3">
                                            <img src="{{asset('frontend')}}/assets/imgs/theme/aamarpay.png" alt="" class="img-fluid mb-2">
                                            <span class="d-block text-center">
                                                <span class="d-block fw-600 fs-15">Aamarpay</span>
                                            </span>
                                        </span>
                                    </label>
                                </div>

                                <div class="col-4 col-sm-3">
                                    <label class="cit-megabox d-block mb-3">
                                        <input class="form-check-input" required="" type="radio" name="pre_payment_option" id="sslcommerz" value="sslcommerz">
                                        <span class="d-block cit-megabox-elem p-3">
                                            <img src="{{asset('frontend')}}/assets/imgs/theme/sslcommerz.png" alt="" class="img-fluid mb-2">
                                            <span class="d-block text-center">
                                                <span class="d-block fw-600 fs-15">sslcommerz</span>
                                            </span>
                                        </span>
                                    </label>
                                </div>

                            </div>
                        <!-- </div> -->


                        <!-- <div class="payment_option">
                            <div class="custome-radio">
                                <input class="form-check-input" required="" type="radio" name="payment_option" id="exampleRadios3" checked="" value="bikash">
                                <label class="form-check-label" for="exampleRadios3" data-bs-toggle="collapse" data-target="#bankTranfer" aria-controls="bankTranfer">bKash</label>
                            </div>
                            <div class="custome-radio">
                                <input class="form-check-input" required="" type="radio" name="payment_option" id="exampleRadios4" checked="" value="nagad">
                                <label class="form-check-label" for="exampleRadios4" data-bs-toggle="collapse" data-target="#checkPayment" aria-controls="checkPayment">Nagad</label>
                            </div>
                            <div class="custome-radio">
                                <input class="form-check-input" required="" type="radio" name="payment_option" id="exampleRadios5" checked="" value="cash">
                                <label class="form-check-label" for="exampleRadios5" data-bs-toggle="collapse" data-target="#paypal" aria-controls="paypal">Cash on delivery</label>
                            </div>
                        </div> -->
                        <button type="submit" class="btn btn-fill-out btn-block mt-30" name="pre_payment">Pay Now<i class="fi-rs-sign-out ml-15"></i></button>
                    </div>
                    <div class="payment ml-30" id="payment_checkout">
                        <h4 class="mb-30">Payment</h4>
                        <!-- <div class="custome-radio"> -->
                            <div class="row gutters-5">
                                <div class="col-4 col-sm-3">
                                    <label class="cit-megabox d-block mb-3">
                                        <input class="form-check-input" required="" type="radio" name="payment_option" id="cash_on_delivery" checked="" value="cod">
                                        <span class="d-block cit-megabox-elem p-3">
                                            <img src="{{asset('frontend')}}/assets/imgs/theme/cod.png" alt="" class="img-fluid mb-2">
                                            <span class="d-block text-center">
                                                <span class="d-block fw-600 fs-15">Cash On Delivery</span>
                                            </span>
                                        </span>
                                    </label>
                                </div>

                                <div class="col-4 col-sm-3">
                                    <label class="cit-megabox d-block mb-3">
                                        <input class="form-check-input" required="" type="radio" name="payment_option" id="bkash" value="bkash">
                                        <span class="d-block cit-megabox-elem p-3">
                                            <img src="{{asset('frontend')}}/assets/imgs/theme/bkash.png" alt="" class="img-fluid mb-2">
                                            <span class="d-block text-center">
                                                <span class="d-block fw-600 fs-15">bKash</span>
                                            </span>
                                        </span>
                                    </label>
                                </div>

                                <div class="col-4 col-sm-3">
                                    <label class="cit-megabox d-block mb-3">
                                        <input class="form-check-input" required="" type="radio" name="payment_option" id="nagad" value="nagad">
                                        <span class="d-block cit-megabox-elem p-3">
                                            <img src="{{asset('frontend')}}/assets/imgs/theme/nagad.png" alt="" class="img-fluid mb-2">
                                            <span class="d-block text-center">
                                                <span class="d-block fw-600 fs-15">Nagad</span>
                                            </span>
                                        </span>
                                    </label>
                                </div>

                                <div class="col-4 col-sm-3">
                                    <label class="cit-megabox d-block mb-3">
                                        <input class="form-check-input" required="" type="radio" name="payment_option" id="aamarpay" value="aamarpay">
                                        <span class="d-block cit-megabox-elem p-3">
                                            <img src="{{asset('frontend')}}/assets/imgs/theme/aamarpay.png" alt="" class="img-fluid mb-2">
                                            <span class="d-block text-center">
                                                <span class="d-block fw-600 fs-15">Aamarpay</span>
                                            </span>
                                        </span>
                                    </label>
                                </div>

                                <div class="col-4 col-sm-3">
                                    <label class="cit-megabox d-block mb-3">
                                        <input class="form-check-input" required="" type="radio" name="payment_option" id="sslcommerz" value="sslcommerz">
                                        <span class="d-block cit-megabox-elem p-3">
                                            <img src="{{asset('frontend')}}/assets/imgs/theme/sslcommerz.png" alt="" class="img-fluid mb-2">
                                            <span class="d-block text-center">
                                                <span class="d-block fw-600 fs-15">sslcommerz</span>
                                            </span>
                                        </span>
                                    </label>
                                </div>

                            </div>
                        <!-- </div> -->


                        <!-- <div class="payment_option">
                            <div class="custome-radio">
                                <input class="form-check-input" required="" type="radio" name="payment_option" id="exampleRadios3" checked="" value="bikash">
                                <label class="form-check-label" for="exampleRadios3" data-bs-toggle="collapse" data-target="#bankTranfer" aria-controls="bankTranfer">bKash</label>
                            </div>
                            <div class="custome-radio">
                                <input class="form-check-input" required="" type="radio" name="payment_option" id="exampleRadios4" checked="" value="nagad">
                                <label class="form-check-label" for="exampleRadios4" data-bs-toggle="collapse" data-target="#checkPayment" aria-controls="checkPayment">Nagad</label>
                            </div>
                            <div class="custome-radio">
                                <input class="form-check-input" required="" type="radio" name="payment_option" id="exampleRadios5" checked="" value="cash">
                                <label class="form-check-label" for="exampleRadios5" data-bs-toggle="collapse" data-target="#paypal" aria-controls="paypal">Cash on delivery</label>
                            </div>
                        </div> -->
                        <button type="submit" class="btn btn-fill-out btn-block mt-30" name="checkout_payment">Place an Order<i class="fi-rs-sign-out ml-15"></i></button>
                    </div>
                </div>
                </form>
            </div>
        </div>
    </main>

    <!-- Modal -->
    <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Create New Address</h5>
                <button type="button" class="btn-close" id="Close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
                <div class="modal-body">
                    <div class="row">
                        <input type="hidden" name="_token" id="csrf" value="{{Session::token()}}">
                        <div class="form-group col-lg-6">
                            <div class="row">
                                <div class="col-12">
                                    <label for="division_id" class="fw-bold text-black col-form-label"><span class="text-danger">*</span> Division</label>
                                </div>
                                <div class="col-12">
                                    <div class="custom_address_modal custom_select">
                                        <select class="form-control select-active" aria-label="Default select example"  name="division_id" id="division_id" required>
                                            <option selected>Select Division</option>
                                                @foreach(get_divisions() as $division)
                                                    <option value="{{ $division->id}}">{{ ucwords($division->division_name_en) }}</option>
                                                @endforeach
                                        </select>
                                        @error('division_id')
                                            <span>{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                           </div>
                        </div>

                        <div class="form-group col-lg-6">
                            <div class="row">
                                <div class="col-12">
                                    <label for="district_id" class="fw-bold text-black col-form-label"><span class="text-danger">*</span> District</label>
                                </div>
                                <div class="col-12">
                                    <div class="custom_address_modal custom_select">
                                        <select class="form-control select-active" aria-label="Default select example"  name="district_id" id="district_id" required>
                                                <option selected=""  value="">Select District</option>
                                        </select>
                                        @error('district_id')
                                            <span>{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                           </div>
                        </div>

                        <div class="form-group col-lg-6">
                            <div class="row">
                                <div class="col-12">
                                    <label for="upazilla_id" class="fw-bold text-black col-form-label"><span class="text-danger">*</span> Upazilla</label>
                                </div>
                                <div class="col-12">
                                    <div class="custom_address_modal custom_select">
                                        <select class="form-control select-active" aria-label="Default select example"  name="upazilla_id" id="upazilla_id" required>
                                            <option selected>Select Upazilla</option>
                                        </select>
                                        @error('upazilla_id')
                                            <span>{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                           </div>
                        </div>

                        <div class="form-group col-lg-6">
                            <label for="address" class="fw-bold text-black col-form-label"><span class="text-danger">*</span>Address:</label>
                            <textarea class="form-control" name="address" id="address" required placeholder="Address"></textarea>
                            @error('address')
                                <span>{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <div class="checkbox">
                                <div class="custome-checkbox">
                                    <input class="form-check-input" type="checkbox" name="is_default" id="is_default" value="0">
                                    <label class="form-check-label label_info" for="is_default"><span>Is Default</span></label>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="checkbox">
                                <div class="custome-checkbox">
                                    <input class="form-check-input" type="checkbox" name="checkbox" id="status" checked value="1">
                                    <label class="form-check-label label_info" for="status"><span>Status</span></label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" id="addressStore" class="btn btn-primary">Submit</button>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('footer-script')
    <script>
        $(document).ready(function() {

            var grand_total = parseFloat($('#grand_total').val());
            var collectable_amount = parseFloat($('#collectable_amount').val());
            var prepaid_amount = parseFloat($('#prepaid_amount').val());

            if((collectable_amount + prepaid_amount) < grand_total){
                $('#payment_prepayment').show();
                $('#payment_checkout').hide();
            }else{
                $('#payment_prepayment').hide();
                $('#payment_checkout').show();
            }

            $('#collectable_amount').on('keyup', function() {
                grand_total = parseFloat($('#grand_total').val());
                collectable_amount = parseFloat($('#collectable_amount').val());
                prepaid_amount = parseFloat($('#prepaid_amount').val());

                if((collectable_amount + prepaid_amount) < grand_total){
                    $('#payment_prepayment').show();
                    $('#payment_checkout').hide();

                    var pay_amount = grand_total - (collectable_amount + prepaid_amount);
                    if(pay_amount < 10){
                        pay_amount = 10;
                    }

                    $('#prepayment_amount').val(pay_amount);
                    $('#prepayment_amount_txt').html(pay_amount);
                }else{
                    $('#payment_prepayment').hide();
                    $('#payment_checkout').show();

                    $('#prepayment_amount').val(0);
                    $('#prepayment_amount_txt').html('');
                }
            });

            // $("form").submit(function(){
            //     if(!$('select[name="payment_option"]').is(':checked')) {
            //         alert("Select payment method");
            //         return false;
            //     }
            // });

            $('select[name="shipping_id"]').on('change', function(){
                var shipping_cost = $(this).val();
                if(shipping_cost) {
                    $.ajax({
                        url: "{{  url('/checkout/shipping/ajax') }}/"+shipping_cost,
                        type:"GET",
                        dataType:"json",
                        success:function(data) {
                            // console.log(data);
                           $('#ship_amount').text(data.shipping_charge);
                            $('.ship_amount').val(data.shipping_charge);
                            $('.shipping_name').val(data.name);
                            $('.shipping_type').val(data.type);

                            let shipping_price = parseInt(data.shipping_charge);
                            let grand_total_price = parseInt($('#cartSubTotalShi').val());
                            // console.log(grand_total_price);
                            grand_total_price += shipping_price;
                            $('#grand_total_set').html(grand_total_price);
                            $('#grand_total').val(grand_total_price);

                            prepaid_amount = parseFloat($('#prepaid_amount').val());
                            $('#collectable_amount').val(grand_total_price - prepaid_amount);

                            grand_total = parseFloat($('#grand_total').val());
                            collectable_amount = parseFloat($('#collectable_amount').val());

                            if((collectable_amount + prepaid_amount) < grand_total){
                                $('#payment_prepayment').show();
                                $('#payment_checkout').hide();

                                var pay_amount = grand_total - (collectable_amount + prepaid_amount);
                                if(pay_amount < 10){
                                    pay_amount = 10;
                                }

                                $('#prepayment_amount').val(pay_amount);
                                $('#prepayment_amount_txt').html(pay_amount);
                            }else{
                                $('#payment_prepayment').hide();
                                $('#payment_checkout').show();

                                $('#prepayment_amount').val(0);
                                $('#prepayment_amount_txt').html('');
                            }

                            //coupon code
                            /*var ship_amount = parseFloat($('#ship_amount').text(data
                                .shipping_charge));
                            var cartSubTotal = parseFloat($('#cartSubTotal').text());
                            $('.ship_amount').val(data.shipping_charge);
                            var coupon_discount = parseFloat($('#coupon_discount').text());
                            $('.shipping_name').val(data.name);
                            $('.shipping_type').val(data.type);
                            let shipping_price = parseInt(data.shipping_charge);
                            var grand_total_price = ((cartSubTotal + shipping_price) -
                                coupon_discount);
                            $('#grand_total_set').html(grand_total_price);
                            $('#grand_total').val(grand_total_price);*/
                        },
                    });
                } else {
                    alert('danger');
                }
            });
        });
    </script>

<!--  Division To District Show Ajax -->
<script type="text/javascript">
  $(document).ready(function() {
    $('select[name="division_id"]').on('change', function(){
        var division_id = $(this).val();
        if(division_id) {
            $.ajax({
                url: "{{  url('/division-district/ajax') }}/"+division_id,
                type:"GET",
                dataType:"json",
                success:function(data) {
                    $('select[name="district_id"]').html('<option value="" selected="" disabled="">Select District</option>');
                        $.each(data, function(key, value){
                        $('select[name="district_id"]').append('<option value="'+ value.id +'">' + capitalizeFirstLetter(value.district_name_en) + '</option>');
                    });
                    $('select[name="upazilla_id"]').html('<option value="" selected="" disabled="">Select District</option>');
                },
            });
        } else {
           alert('danger');
        }
    });

    function capitalizeFirstLetter(string) {
      return string.charAt(0).toUpperCase() + string.slice(1);
    }

    // Address Realtionship Division/District/Upazilla Show Data Ajax //
    $('select[name="address_id"]').on('change', function(){
        var address_id = $(this).val();
        $('.selected_address').removeClass('d-none');
        if(address_id) {
            $.ajax({
                url: "{{  url('/address/ajax') }}/"+address_id,
                type:"GET",
                dataType:"json",
                success:function(data) {

                    $('#dynamic_division').text(capitalizeFirstLetter(data.division_name_en));
                    $('#dynamic_division_input').val(data.division_id);
                    $("#dynamic_district").text(capitalizeFirstLetter(data.district_name_en));
                    $('#dynamic_district_input').val(data.district_id);
                    $("#dynamic_upazilla").text(capitalizeFirstLetter(data.upazilla_name_en));
                    $('#dynamic_upazilla_input').val(data.upazilla_id);
                    $("#dynamic_address").text(data.address);
                    $('#dynamic_address_input').val(data.address);
                },
            });
        } else {
           alert('danger');
        }
    });
});
</script>

<!--  District To Upazilla Show Ajax -->
<script type="text/javascript">
    $(document).ready(function() {
        $('select[name="district_id"]').on('change', function(){
            var district_id = $(this).val();
            if(district_id) {
                $.ajax({
                    url: "{{  url('/district-upazilla/ajax') }}/"+district_id,
                    type:"GET",
                    dataType:"json",
                    success:function(data) {
                       var d =$('select[name="upazilla_id"]').empty();
                        $.each(data, function(key, value){
                            $('select[name="upazilla_id"]').append('<option value="'+ value.id +'">' + value.name_en + '</option>');
                        });
                    },
                });
            } else {
                alert('danger');
            }
        });
    });
</script>

<!-- create address ajax -->
<script type="text/javascript">
    $(document).ready(function() {
        $('#addressStore').on('click', function() {
            var division_id = $('#division_id').val();
            var district_id = $('#district_id').val();
            var upazilla_id = $('#upazilla_id').val();
            var address     = $('#address').val();
            var is_default  = $('#is_default').val();
            var status      = $('#status').val();

            $.ajax({
                url: '{{ route('address.ajax.store') }}',
                type: "POST",
                data: {
                  _token: $("#csrf").val(),
                  division_id: division_id,
                  district_id: district_id,
                  upazilla_id: upazilla_id,
                  address: address,
                  is_default: is_default,
                  status: status,
                },
                dataType:'json',
                success: function(data){
                    // console.log(data);
                    $('#address').val(null);

                    $('select[name="address_id"]').html('<option value="" selected="" disabled="">Select Address</option>');
                    $.each(data, function(key, value){
                        $('select[name="address_id"]').append('<option value="'+ value.id +'">' + value.address + '</option>');
                    });
                    $('select[name="division_id"]').html('<option value="" selected="" disabled="">Select Division</option>');
                    $('select[name="district_id"]').html('<option value="" selected="" disabled="">Select District</option>');
                    $('select[name="upazilla_id"]').html('<option value="" selected="" disabled="">Select Upazilla</option>');

                    // Start Message
                    const Toast = Swal.mixin({
                          toast: true,
                          position: 'top-end',
                          icon: 'success',
                          showConfirmButton: false,
                          timer: 2000
                        })
                    if ($.isEmptyObject(data.error)) {
                        Toast.fire({
                            type: 'success',
                            title: data.success
                        })
                    }else{
                        Swal.fire({
                            type: 'error',
                            title: data.error
                        })
                    }

                    // End Message
                    $('#Close').click();
                }
            });
         });
    });
</script>



{{--this is coupon code --}}
{{-- <script>
    function applyCoupon() {
        var coupon = $('#coupon').val();
        var url = '{{ route('coupon.get') }}';
        $.ajax({
            headers: {
                "X-CSRF-TOKEN": "{{ csrf_token() }}"
            },
            url: url,
            method: "GET",
            data: {
                'coupon': coupon
            },
            success: function(response) {
                if ((response.success)) {
                    $('#remove').prop('disabled', false);
                    $('#remove').show();
                    var coupon = response.coupon;
                    var discount = response.discount;
                    var currentPrice = parseFloat($('#cartSubTotal').text());
                    var grandPrice = parseFloat($('#grand_total_set').text());
                    var amountOfDiscount = 0;
                    if (!discount) {
                        if (coupon.discount_type == 0) {
                            var discount_amount = currentPrice * coupon.discount / 100;
                            amountOfDiscount = grandPrice - discount_amount;
                        } else {
                            var discount_amount = Math.min(coupon.discount, currentPrice);
                            amountOfDiscount = grandPrice - discount_amount;
                        }
                        $('#grand_total_set').text(amountOfDiscount);
                        $('#coupon_discount').text(discount_amount);
                        $('#grand_total').val(amountOfDiscount);
                        $('#coupon_id').val(coupon.id);
                        $('.discount').val(discount_amount);
                        $('#apply').prop('disabled', true);
                        $('#coupon').prop('disabled', true);
                        const Toast = Swal.mixin({
                            toast: true,
                            position: 'top-end',
                            icon: 'success',
                            showConfirmButton: false,
                            timer: 1200
                        })
                        Toast.fire({
                            type: 'success',
                            title: response.success
                        })
                    } else {
                        $('#coupon_id').val(coupon.id);
                        $('.discount').val(discount);
                        $('#coupon_discount').text(discount);
                        amountOfDiscount = grandPrice - discount;
                        $('#grand_total_set').text(amountOfDiscount);
                        $('#grand_total').val(amountOfDiscount);
                        $('#apply').prop('disabled', true);
                        $('#coupon').prop('disabled', true);
                        const Toast = Swal.mixin({
                            toast: true,
                            position: 'top-end',
                            icon: 'success',
                            showConfirmButton: false,
                            timer: 1200
                        })
                        Toast.fire({
                            type: 'success',
                            title: response.success
                        })
                    }

                } else {
                    //console.log("Coupon not found.");
                    const Toast = Swal.mixin({
                        toast: true,
                        position: 'top-end',
                        icon: 'error',
                        showConfirmButton: false,
                        timer: 1200
                    })
                    Toast.fire({
                        type: 'error',
                        title: response.error
                    })
                }
            },
            error: function(xhr, status, error) {
                console.log("AJAX request failed: " + error);
            }
        });
    }
</script>
<script>
    function removeCoupon() {
        var couponamount = parseFloat($('#coupon_discount').text());
        $('#apply').prop('disabled', false);
        $('#coupon').prop('disabled', false);
        var grandvalue = parseFloat($('#grand_total_set').text());
        var grandamount = grandvalue + couponamount
        if (couponamount > 0) {
            $('.discount').val('');
            $('#coupon').val('');
            $('#coupon_discount').text('0');
            $('#grand_total_set').text(grandamount);
            $('#grand_total').val(grandamount);
            $('#coupon_id').val('');
            $('#remove').prop('disabled', true);
            $('#remove').hide();
        }
    }
</script> --}}

@endpush
