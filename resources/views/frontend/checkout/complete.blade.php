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
            <h4 class="text-center mb-80">Select Payment Method & Complete the Order</h4>
            <div class="row">
                <div class="col-lg-12">
                <form action="{{ route('checkout.completePayment') }}" method="post">
                    @csrf
                <div class="col-lg-5" style="float: left;">
                    <div class="border p-40 cart-totals ml-30 mb-50">
                        <div class="mt-30">
                            <input type="hidden" name="collectable_amount" id="collectable_amount" value="@if(session()->has('collectable_amount') && session()->get('collectable_amount')>0){{ number_format(session()->get('collectable_amount')) }}@else{{ number_format($cartTotal) }}@endif" required>
                            <input type="hidden" id="prepaid_amount" name="prepaid_amount" value="{{ auth()->user()->prepaid_amount }}">
                            <p class="mt-30">Pre Paid Amount: <span class="text-brand fw-bold" style="font-size: 15px;">৳{{ auth()->user()->prepaid_amount }}</span></p>
                            <p class="mt-30" style="color: black;">Amount To Be Paid: <span class="text-brand fw-bold" style="font-size: 30px;"> <span class="text-brand fw-bold" style="font-size: 20px;">৳@if(session()->has('collectable_amount') && session()->get('collectable_amount')>0){{ number_format(session()->get('collectable_amount')) }}@else{{ number_format($cartTotal) }}@endif</span></p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-5" style="float: left;">
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
                        <button type="submit" class="btn btn-fill-out btn-block mt-30" name="checkout_payment">Complete Order<i class="fi-rs-sign-out ml-15"></i></button>
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

@endpush