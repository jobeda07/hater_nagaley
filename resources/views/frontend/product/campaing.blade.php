@extends('layouts.frontend')
@section('content-frontend')
@include('frontend.common.add_to_cart_modal')
@section('title')
Category Nest Online Shop
@endsection
<main class="main">
    <div class="page-header mt-30 mb-50">
        <div class="container">
            <div class="archive-header">
                <div class="row align-items-center">
                    <div class="col-xl-3">
                        <h1 class="mb-15">All Campaing</h1>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Campaign Slider Start-->
	@php
        $campaign = \App\Models\Campaing::where('status', 1)->where('is_featured', 1)->first();
    @endphp
	
    @if($campaign)
	@php
        $start_diff=date_diff(date_create($campaign->flash_start), date_create(date('d-m-Y H:i:s')));
        $end_diff=date_diff(date_create(date('d-m-Y H:i:s')), date_create($campaign->flash_end));
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
</main>
@endsection
@push('footer-script')
@endpush