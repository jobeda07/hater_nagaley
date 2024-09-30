@extends('admin.admin_master')
@push('css')
<style>
    .text-white{
        color: #fff !important;
    }
</style>
<script type="text/javascript">
window.onload = function() {

var options = {
    exportEnabled: true,
    animationEnabled: true,
    title:{
        text: "{{ get_setting('site_name')->value ?? ''}}"
    },
    legend:{
        horizontalAlign: "right",
        verticalAlign: "center"
    },
    data: [{
        type: "pie",
        showInLegend: true,
        toolTipContent: "<b>{name}</b>: {y} (#percent)",
        indexLabel: "{name}",
        legendText: "{name} (#percent)",
        indexLabelPlacement: "inside",
        dataPoints: [
            { y: 6, name: "Pending" },
            { y: 9, name: "Prossecing" },
            { y: 10, name: "Delivery" },
            { y: 12, name: "Sales" },
            { y: 5, name: "Others"},
            { y: 6, name: "Utilities" }
        ]
    }]
};
$("#chartContainer").CanvasJSChart(options);
    
}
</script>
@endpush
@section('admin')
 <section class="content-main">
    <div class="content-header">
        <div>
            <h2 class="content-title card-title" style="color: #000 !important;">Dashboard</h2>
            <p>Whole data about your business here</p>
        </div>
        <div>
            <a href="{{ route('pos.index') }}" class="btn btn-primary"><i class="text-muted material-icons md-post_add"></i>Pos</a>
        </div>
    </div>
        <div class="row bg-1">
        @if (Auth::guard('admin')->user()->role != '2')
            <div class="col-xl-4 col-lg-4 col-md-6 col-sm-6">
                <div class="card card-body mb-4">
                    <article class="icontext">
                        <span class="icon icon-sm rounded-circle bg-primary-light"><i
                                class="text-primary material-icons md-monetization_on"></i></span>
                        <div class="text">
                            <h4 class="mb-1 card-title text-white">Today Sale</h4>
                            <span class="text-white">৳ {{ $todays_sale_value }}</span>
                            <h4 class="mb-1 card-title text-white">Today Sale Count : {{ $todays_sale->count() }}</h4>
                        </div>
                    </article>
                </div>
            </div>
        @endif
        @if (Auth::guard('admin')->user()->role != '2')
            <div class="col-xl-4 col-lg-4 col-md-6 col-sm-6">
                <div class="card card-body mb-4">
                    <article class="icontext">
                        <span class="icon icon-sm rounded-circle bg-success-light"><i
                                class="text-success material-icons md-local_shipping"></i></span>
                        <div class="text">
                            <h4 class="mb-1 card-title text-white">This Month Sale</h4>
                            <span class=" text-white">৳ {{ $monthly_sale_value }}</span>
                            <h4 class="mb-1 card-title text-white">Monthly Sale Count : {{ $monthly_sale->count() }}</h4>
                        </div>
                    </article>
                </div>
            </div>
        @endif
        @if (Auth::guard('admin')->user()->role != '2')
            <div class="col-xl-4 col-lg-4 col-md-6 col-sm-6">
                <div class="card card-body mb-4">
                    <article class="icontext">
                        <span class="icon icon-sm rounded-circle bg-info-light"><i
                                class="text-info material-icons md-people"></i></span>
                        <div class="text">
                            <h4 class="mb-1 card-title text-white">This Year Sale</h4>
                            <span class=" text-white">৳ {{ $yearly_sale_value }}</span>
                            <h4 class="mb-1 card-title text-white">Yearly Sale Count : {{ $yearly_sale->count() }}</h4>
                        </div>
                    </article>
                </div>
            </div>
        @endif
    </div>
    <div class="row bg-2">
        @if (Auth::guard('admin')->user()->role != '2')
            <div class="col-xl-4 col-lg-4 col-md-6 col-sm-6">
                <div class="card card-body mb-4">
                    <article class="icontext">
                        <span class="icon icon-sm rounded-circle bg-primary-light"><i
                                class="text-primary material-icons md-monetization_on"></i></span>
                        <div class="text">
                            <h4 class="mb-1 card-title text-white">Today Profit</h4>
                            <span class="text-white">৳ {{ $today_profit }}</span>
                        </div>
                    </article>
                </div>
            </div>
        @endif
        @if (Auth::guard('admin')->user()->role != '2')
            <div class="col-xl-4 col-lg-4 col-md-6 col-sm-6">
                <div class="card card-body mb-4">
                    <article class="icontext">
                        <span class="icon icon-sm rounded-circle bg-success-light"><i
                                class="text-success material-icons md-local_shipping"></i></span>
                        <div class="text">
                            <h4 class="mb-1 card-title text-white">This Month Profit</h4>
                            <span class=" text-white">৳ {{ $monthly_profit }}</span>
                        </div>
                    </article>
                </div>
            </div>
        @endif
        @if (Auth::guard('admin')->user()->role != '2')
            <div class="col-xl-4 col-lg-4 col-md-6 col-sm-6">
                <div class="card card-body mb-4">
                    <article class="icontext">
                        <span class="icon icon-sm rounded-circle bg-info-light"><i
                                class="text-info material-icons md-people"></i></span>
                        <div class="text">
                            <h4 class="mb-1 card-title text-white">This Year Profit</h4>
                            <span class=" text-white">৳ {{ $yearly_profit }}</span>
                        </div>
                    </article>
                </div>
            </div>
        @endif
    </div>
    
    <div class="row bg-3">
        @if (Auth::guard('admin')->user()->role != '2')
            <div class="col-xl-4 col-lg-4 col-md-6 col-sm-6">
                <div class="card card-body mb-4">
                    <article class="icontext">
                        <span class="icon icon-sm rounded-circle bg-primary-light"><i
                                class="text-primary material-icons md-monetization_on"></i></span>
                        <div class="text">
                            <h4 class="mb-1 card-title text-white">Today Purchase</h4>
                            <span class="text-white">৳ {{ $todays_purchase_value }}</span>
                            <h4 class="mb-1 card-title text-white">Today Purchase Count : {{ $todays_purchase }}</h4>
                        </div>
                    </article>
                </div>
            </div>
        @endif
        @if (Auth::guard('admin')->user()->role != '2')
            <div class="col-xl-4 col-lg-4 col-md-6 col-sm-6">
                <div class="card card-body mb-4">
                    <article class="icontext">
                        <span class="icon icon-sm rounded-circle bg-success-light"><i
                                class="text-success material-icons md-local_shipping"></i></span>
                        <div class="text">
                            <h4 class="mb-1 card-title text-white">This Month Purchase</h4>
                            <span class=" text-white">৳ {{ $monthly_purchase_value }}</span>
                            <h4 class="mb-1 card-title text-white">Monthly Purchase Count : {{ $monthly_purchase }}</h4>
                        </div>
                    </article>
                </div>
            </div>
        @endif
        @if (Auth::guard('admin')->user()->role != '2')
            <div class="col-xl-4 col-lg-4 col-md-6 col-sm-6">
                <div class="card card-body mb-4">
                    <article class="icontext">
                        <span class="icon icon-sm rounded-circle bg-info-light"><i
                                class="text-info material-icons md-people"></i></span>
                        <div class="text">
                            <h4 class="mb-1 card-title text-white">This Year Purchase</h4>
                            <span class=" text-white">৳ {{ $yearly_purchase_value }}</span>
                            <h4 class="mb-1 card-title text-white">Yearly Purchase Count : {{ $yearly_purchase }}</h4>
                        </div>
                    </article>
                </div>
            </div>
        @endif
    </div>
    
    <div class="row bg-4">
        @if (Auth::guard('admin')->user()->role != '2')
            <div class="col-xl-3 col-lg-4 col-md-6 col-sm-6">
                <div class="card card-body mb-4">
                    <article class="icontext">
                        <span class="icon icon-sm rounded-circle bg-primary-light"><i
                                class="text-primary material-icons md-monetization_on"></i></span>
                        <div class="text">
                            <h4 class="mb-1 card-title text-white">Revenue</h4>
                            <span class="text-white">৳ {{ number_format($orderCount->total_sell, 2) }}</span>
                            <span class="text-sm text-white"> Shipping fees are not included </span>
                        </div>
                    </article>
                </div>
            </div>
        @endif
        @if (Auth::guard('admin')->user()->role != '2')
            <div class="col-xl-3 col-lg-4 col-md-6 col-sm-6">
                <div class="card card-body mb-4">
                    <article class="icontext">
                        <span class="icon icon-sm rounded-circle bg-success-light"><i
                                class="text-success material-icons md-local_shipping"></i></span>
                        <div class="text">
                            <h4 class="mb-1 card-title text-white">Orders</h4>
                            <span class=" text-white">{{ number_format($orderCount->total_orders) }}</span>
                            <span class="text-sm text-white"> Excluding orders in transit </span>
                        </div>
                    </article>
                </div>
            </div>
        @endif
        @if (Auth::guard('admin')->user()->role != '2')
        <div class="col-xl-3 col-lg-4 col-md-6 col-sm-6">
            <div class="card card-body mb-4">
                <article class="icontext">
                    <span class="icon icon-sm rounded-circle bg-warning-light"><i
                            class="text-warning material-icons md-qr_code"></i></span>
                    <div class="text">
                        <h4 class="mb-1 card-title text-white">Products</h4>
                        <span class=" text-white">{{ number_format($productCount->total_products) }}</span>
                        <span class="text-sm text-white"> In {{ number_format($categoryCount->total_categories) }}
                            Categories </span>
                    </div>
                </article>
            </div>
        </div>
        @endif
        @if (Auth::guard('admin')->user()->role != '2')
            <div class="col-xl-3 col-lg-4 col-md-6 col-sm-6">
                <div class="card card-body mb-4">
                    <article class="icontext">
                        <span class="icon icon-sm rounded-circle bg-info-light"><i
                                class="text-info material-icons md-people"></i></span>
                        <div class="text">
                            <h4 class="mb-1 card-title text-white">Customers</h4>
                            <span class=" text-white">{{ number_format($userCount->total_users) }}</span>
                            <span class="text-sm text-white"> Who are active. </span>
                        </div>
                    </article>
                </div>
            </div>
        @endif
    </div>

    <div class="card mb-4">
        <header class="card-header">
            <h2 class="text-white">All History</h2>
        </header>
        <div class="card-body">
            <div id="chartContainer" style="height: 300px; width: 100%;"></div>
        </div>
    </div>

</section>
@endsection

@push('footer-script')
<script type="text/javascript" src="https://canvasjs.com/assets/script/jquery-1.11.1.min.js"></script>  
<script type="text/javascript" src="https://canvasjs.com/assets/script/jquery.canvasjs.min.js"></script>
@endpush