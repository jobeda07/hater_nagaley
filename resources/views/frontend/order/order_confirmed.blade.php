<!DOCTYPE html>
<html class="no-js" lang="en">

<head>
    <meta charset="utf-8" />
    <title>{{ config('app.name', 'Laravel') }}</title>
    <meta http-equiv="x-ua-compatible" content="ie=edge" />
    <meta name="description" content="" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta property="og:title" content="" />
    <meta property="og:type" content="" />
    <meta property="og:url" content="" />
    <meta property="og:image" content="" />
    @php
        $logo = get_setting('site_favicon');
    @endphp
    @if ($logo != null)
        <link rel="shortcut icon" type="image/x-icon" href="{{ asset(get_setting('site_favicon')->value ?? ' ') }}" />
    @else
        <link rel="shortcut icon" type="image/x-icon" href="{{ asset('upload/no_image.jpg') }}"
            alt="{{ env('APP_NAME') }}" />
    @endif
    <link rel="stylesheet" href="{{ asset('frontend/assets/css/main.css?v=5.3 ') }}" />
    <style>
        .invoice-3 .invoice-header {
            /* background: url(../imgs/invoice/header-bg-2.jpg) top left no-repeat; */
            /* background-size: cover; */
            /* color: #fff; */
            padding: 30px;
        }

        .invoice .invoice-top {
            padding: 15px 150px 5px 150px;
            margin-bottom: 20px;
        }
        
        .invoice .invoice-top {
            padding-bottom: 0;
        }
        .invoice{
            padding:20px 0!important;
        }

        @media screen and (max-width: 991px){
            .logo a {
                display: block;
                width: 120px;
            }
            .logo img{
                width: 100%;
                height: 100%;
            }
            .invoice-content .invoice-header-1 {
                text-transform: uppercase;
                font-weight: 700;
                font-size: 18px;
            }
        }
        
        @media screen and (max-width: 575px){
            
           .invoice .back-top-home {
                margin-top: 10px !important;
                margin-bottom: 10px !important;
            }
            .invoice {
                padding: 3px 0;
                background: #f2f3f4;
            }
            
            .invoice-3 .invoice-header {
               padding: 13px!important;
            }
            .logo{
                display: flex;
                align-items: center;
                gap: 24px;
                justify-content: space-between;
                width: 100%;
            }
            .logo.w-50{
                width: 100%!important;
            }
            .logo a {
                display: block;
                width: 100px;
            }
            .logo img{
                width: 100%;
            }
            .invoice-content .invoice-header-1 {
                text-transform: uppercase;
                font-weight: 700;
                font-size: 16px;
            }
            
            .invoice .invoice-top {
                padding: 15px;
                margin-bottom: 15px;
            }
            .invoice-content .invoice-addr-1 {
                margin-bottom: 0px;
            }
            .invoice .invoice-center {
                padding: 0px 10px !important;
            }
            .col-offsite {
                margin-top: 10px;
            }
            .invoice .table> :not(caption)>> {
                padding: 9px 20px;

            }
            .invoice .bg-active {
            background: #f3f3f3;
            color: #535353 !important;
            /* display: block; */
            width: 100%;
        }
        
        }

        

        @media only screen and (max-width: 480px){
            .table thead {
                display: table-header-group;
            }
            .table td {
    width: 100%;
    text-align: center;
    display:revert-layer
}
        }
            
         
    </style>
</head>

<body>
    <div class="invoice invoice-content invoice-3">
        <div class="back-top-home hover-up mt-30 ml-30 mx-auto">
            <a class="hover-up" href="{{ route('home') }}"><i class="fi-rs-home mr-5"></i> Homepage</a>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="invoice-inner">
                        <div class="invoice-info" id="invoice_wrapper">
                            <div class="invoice-header">
                                <div class="row">
                                    <div class="col-sm-8">
                                        <div class="invoice-name">
                                            <div class="logo w-50">
                                                <a href="{{ route('home') }}">
                                                    @php
                                                        $logo = get_setting('site_footer_logo');
                                                    @endphp
                                                    @if ($logo != null)
                                                        <img src="{{ asset(get_setting('site_footer_logo')->value ?? 'null') }}"
                                                            style="max-width: 200px !important;"
                                                            alt="{{ env('APP_NAME') }}">
                                                    @else
                                                        <img src="{{ asset('upload/no_image.jpg') }}"
                                                            alt="{{ env('APP_NAME') }}"
                                                            style="max-width: 200px !important;">
                                                    @endif
                                                </a>
                                                <div>
                                                    <strong>{{ get_setting('business_name')->value ?? '' }}</strong>
                                                    <br />
                                                    {{-- {{ get_setting('business_address')->value ?? ''}}<br> --}}
                                                    <abbr title="Phone">Phone:</abbr>
                                                    {{ get_setting('phone')->value ?? '' }}<br>
                                                    <abbr title="Email">Email:
                                                    </abbr>{{ get_setting('email')->value ?? '' }}<br>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-sm-4">
                                        <div class="invoice-numb">
                                            <h4 class="invoice-header-1 mb-10 mt-20">Invoice No:<span
                                                    class="text-heading">{{ $order->invoice_no }}</span></h4>
                                            <strong class="text-mute">Invoice Data:</strong>
                                            {{ \Carbon\Carbon::parse($order->date)->isoFormat('MMM Do YYYY') }}<br />
                                            <strong class="text-mute">Payment Method:</strong>
                                            @if ($order->payment_method == 'cod')
                                                Cash On Delivery
                                            @else
                                                {{ $order->payment_method }}
                                            @endif
                                            <br />
                                            <strong class="text-mute">Status:</strong> <span
                                                class="">{{ $order->delivery_status }}</span>
                                        </div>
                                    </div>

                                </div>
                            </div>
                            <div class="invoice-top">
                                <div class="row">
                                    <div class="col-md-8">
                                        <div class="invoice-number">
                                            <h4 class="invoice-title-1 mb-10">Bill To</h4>
                                            <p class="invoice-addr-1 text-capitalize">
                                                {{-- @if ($order->user->name)
                                                    <strong>{{ $order->user->name ?? '' }}</strong> <br />
                                                @else
                                                    <strong>{{ $order->name ?? '' }}</strong> <br />
                                                @endif --}}
                                                <strong>Name : {{ $order->name ?? '' }}</strong> <br />
                                                Address : {{ $order->address ?? '' }}<br>
                                                {{-- @if ($order->user->phone)
                                                    Phone: {{ $order->user->phone ?? ''}}<br>
                                                @else
                                                    Phone: {{ $order->phone ?? ''}}<br>
                                                @endif --}}
                                                Phone: {{ $order->phone ?? '' }}<br>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="invoice-center">
                                <div class="table-responsive">
                                    <table class="table table-striped invoice-table">
                                        <thead class="bg-active">
                                            <tr>
                                                <th>Item</th>
                                                <th class="text-center">Price</th>
                                                <th class="text-center">Quantity</th>
                                                <th class="text-right">Amount</th>
                                            </tr>
                                        </thead>
                                        {{-- @if ($order->collectable_amount > $order->grand_total) --}}
                                            @php
                                                $quantity = 0;
                                                $extraPay = 0;
                                                $extraPay = $order->collectable_amount - $order->grand_total;
                                                foreach ($order->order_details as $order_detail) {
                                                    $quantity += $order_detail->qty; // Add a semicolon here
                                                }
                                                $extra = $extraPay / $quantity;
                                                $extra = number_format($extra, 2);
                                            @endphp

                                            <tbody>
                                                @foreach ($order->order_details as $order_detail)
                                                    <tr>
                                                        <td>
                                                            <div class="item-desc-1">
                                                                <span>{{ $order_detail->product->name_en ?? ' ' }}</span>
                                                                <span>
                                                                    @if ($order_detail->is_varient && count(json_decode($order_detail->variation)) > 0)
                                                                        @foreach (json_decode($order_detail->variation) as $varient)
                                                                            <span>{{ $varient->attribute_name }} :
                                                                                <span
                                                                                    class="d-inline-block fw-normal ms-1">{{ $varient->attribute_value }}</span></span>
                                                                        @endforeach
                                                                    @endif
                                                                </span>
                                                            </div>
                                                        </td>
                                                        <td class="text-center">
                                                            {{ $order_detail->price+$extra }}
                                                        </td>
                                                        <td class="text-center">
                                                            {{ $order_detail->qty ?? '' }}
                                                        </td>
                                                        <td class="text-right">
                                                            {{( $order_detail->price * $order_detail->qty)+$extra }}
                                                        </td>
                                                    </tr>
                                                @endforeach
                                                <tr>
                                                    <td colspan="3" class="text-end f-w-600">SubTotal</td>
                                                    <td class="text-right">{{( $order->sub_total ?? ' ')+$extraPay }}</td>
                                                </tr>
                                                <tr>
                                                    <td colspan="3" class="text-end f-w-600">Shipping cost:</td>
                                                    <td class="text-right">{{ $order->shipping_charge ?? '' }}</td>
                                                </tr>
                                                @if ($order->coupon_discount > 0)
                                                    <tr>
                                                        <td colspan="3" class="text-end f-w-600">Coupon Discount:
                                                        </td>
                                                        <td class="text-right">{{ $order->coupon_discount ?? '0.00' }}
                                                        </td>
                                                    </tr>
                                                @endif
                                                <tr>
                                                    <td colspan="3" class="text-end f-w-600">Grand Total</td>
                                                    <td class="text-right f-w-600">
                                                        {{ ($order->grand_total - $order->discount ?? ' ')+$extraPay }}</td>
                                                </tr>
                                            </tbody>
                                        {{-- @else
                                            <tbody>
                                                @foreach ($order->order_details as $order_detail)
                                                    <tr>
                                                        <td>
                                                            <div class="item-desc-1">
                                                                <span>{{ $order_detail->product->name_en ?? ' ' }}</span>
                                                                <span>
                                                                    @if ($order_detail->is_varient && count(json_decode($order_detail->variation)) > 0)
                                                                        @foreach (json_decode($order_detail->variation) as $varient)
                                                                            <span>{{ $varient->attribute_name }} :
                                                                                <span
                                                                                    class="d-inline-block fw-normal ms-1">{{ $varient->attribute_value }}</span></span>
                                                                        @endforeach
                                                                    @endif
                                                                </span>
                                                            </div>
                                                        </td>
                                                        <td class="text-center">
                                                            {{ $order_detail->price ?? '' }}
                                                        </td>
                                                        <td class="text-center">
                                                            {{ $order_detail->qty ?? '' }}
                                                        </td>
                                                        <td class="text-right">
                                                            {{ $order_detail->price * $order_detail->qty ?? ' ' }}
                                                        </td>
                                                    </tr>
                                                @endforeach
                                                <tr>
                                                    <td colspan="3" class="text-end f-w-600">SubTotal</td>
                                                    <td class="text-right">{{ $order->sub_total ?? ' ' }}</td>
                                                </tr>
                                                <tr>
                                                    <td colspan="3" class="text-end f-w-600">Shipping cost:</td>
                                                    <td class="text-right">{{ $order->shipping_charge ?? '' }}</td>
                                                </tr>
                                                @if ($order->coupon_discount > 0)
                                                    <tr>
                                                        <td colspan="3" class="text-end f-w-600">Coupon Discount:
                                                        </td>
                                                        <td class="text-right">{{ $order->coupon_discount ?? '0.00' }}
                                                        </td>
                                                    </tr>
                                                @endif
                                                <tr>
                                                    <td colspan="3" class="text-end f-w-600">Grand Total</td>
                                                    <td class="text-right f-w-600">
                                                        {{ $order->grand_total - $order->discount ?? ' ' }}</td>
                                                </tr>
                                            </tbody>
                                        @endif --}}

                                    </table>
                                </div>
                            </div>
                            <div class="invoice-bottom mb-5">
                                <div class="row">
                                    <div class="col-sm-6">
                                        {{-- <div>
                                            <h3 class="invoice-title-1">Important Note</h3>
                                            <ul class="important-notes-list-1">
                                                <li>All amounts shown on this invoice are in BDT</li>
                                                <li>finance charge of 1.5% will be made on unpaid balances after 30 days.</li>
                                                <li>Once order done, money can't refund</li>
                                                <li>Delivery might delay due to some external dependency</li>
                                            </ul>
                                        </div> --}}
                                    </div>
                                    <div class="col-sm-6 col-offsite">
                                        <div class="text-end">
                                            <p class="mb-0 text-13">Thank you for your Order</p>
                                            <p><strong>{{ get_setting('business_name')->value ?? ' ' }}</strong></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="invoice-btn-section clearfix d-print-none">
                            {{-- <a href="javascript:window.print()" class="btn btn-lg btn-custom btn-print hover-up"> <img src="{{ asset('frontend/assets/imgs/theme/icons/icon-print.svg') }}" alt="" /> Print </a> --}}
                            <a id="invoice_download_btn" class="btn btn-lg btn-custom btn-download hover-up"> <img
                                    src="{{ asset('frontend/assets/imgs/theme/icons/icon-download.svg') }}"
                                    alt="" /> Download </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Vendor JS-->
    <script src="{{ asset('frontend/assets/js/vendor/modernizr-3.6.0.min.js ') }}"></script>
    <script src="{{ asset('frontend/assets/js/vendor/jquery-3.6.0.min.js ') }}"></script>
    <!-- Invoice JS -->
    <script src="{{ asset('frontend/assets/js/invoice/jspdf.min.js ') }}"></script>
    <script src="{{ asset('frontend/assets/js/invoice/invoice.js ') }}"></script>
</body>

</html>