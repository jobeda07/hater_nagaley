@extends('admin.admin_master')
@section('admin')
    @push('css')
        <style>
            .table {
                margin-bottom: 0.5rem;
            }
            .table> :not(caption)>*>* {
                padding: 0.1rem 0.4rem;
            }
            .product-price {
                font-size: 12px;
            }
            .product-thumb {
                cursor: pointer !important;
            }
            .btn-circle {
                width: 30px;
                height: 30px;
                background-color: #d56666;
                vertical-align: center !important;
                border: none;
                float: right;
                color: #fff;
                border-radius: 50%;
            }
            .material-icons {
                vertical-align: middle !important;
                font-size: 15px !important;
            }
            .select2-container--default .select2-selection--single {
                border-radius: 0px !important;
            }
            .select2-container--default {
                width: 100% !important;
            }
            .flex-grow-1 {
                margin-right: 10px;
            }

            .product_wrapper .card-body {
                padding: 0.4rem 0.4rem;
            }
            .modal-open .modal {
                background: #000000a8 !important;
            }
            div#product_wrapper {
                max-height: 760px;
                overflow-y: auto;
            }
            div#checkout_list {
                min-height: 400px;
                overflow-y: auto;
                max-height: 450px;
            }
        </style>
    @endpush
    <section class="content-main">
        <div class="row">
            <div class="col-sm-8">
                <div class="row">
                    <div class="card mb-4">
                        <div class="card-body">
                            <form action="">
                                <div class="row">
                                    <div class="col-sm-6">
                                        <input class="form-control" type="text" name="search_product" id="search_product"
                                            placeholder="Search by Name">
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="custom_select">
                                            <select name="category_id" id="category_id"
                                                class="form-control select-active w-100 form-select select-nice">
                                                <option value="">-- Select Category --</option>
                                                @foreach ($categories as $category)
                                                    <option value="{{ $category->id }}">{{ $category->name_en }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <!-- card-body end// -->
                    </div>
                </div>
                <div class="row product_wrapper product-row" id="product_wrapper">
                    @include('backend.pos.product')
                </div>
                {{-- <button class="btn btn-xs d-flex mx-auto my-4" id="seemore">Load More <i class="fi-rs-arrow-small-right"></i></button> --}}
            </div>
            <div class="col-sm-4">
                <div class="card mb-4">
                    <div class="card-body">
                        {{-- <div class="mb-3">
                            <!-- <input class="form-control" type="text" name="barcode_search_term" id="barcode_search_term" placeholder="Search by Barcode" oninput="barcode()"> -->
                        </div> --}}
                        <form action="{{ route('pos.store') }}" method="POST">
                            @csrf
                            <div class="d-flex border-bottom pb-3">
                                <div class="flex-grow-1">
                                    <select name="user_id" id="customer_id"
                                        class="form-control select-active w-100 form-select select-nice" required>
                                        <option value="1">-- Walking Customer --</option>
                                        @foreach ($customers as $customer)
                                            <option value="{{ $customer->id }}">{{ $customer->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <a style="background-color: #454847; "class="btn btn-sm float-end" data-bs-toggle="modal"
                                    data-bs-target="#customer1"><i class="fa-solid fa-plus text-white"></i></a>
                            </div>
                            <div>
                                <div  id="checkout_list">

                                </div>
                            </div>
                            <div class="row">
                                <table class="table pos_product__count">
                                    <tbody>
                                        <tr>
                                            <td>Sub Total</td>
                                            <td style="float: right;" class="my-1"><input type="number"
                                                    id="subtotal_text" name="subtotal" class="form-control" readonly
                                                    value="0.00"></td>
                                        </tr>
                                        <tr>
                                            <td>Discount</td>
                                            {{-- <td style="float: right;">৳ 0.00</td> --}}
                                            <td style="float: right;" class="my-1"> <input type="text" id="discount"
                                                    oninput="this.value = this.value.replace(/[^0-9]/g, '')" name="discount"
                                                    class="form-control" value="0.00" /></td>
                                        </tr>
                                        <tr>
                                            <td>Paid Amount</td>
                                            <td style="float: right;" class="my12"> <input type="text"
                                                    oninput="this.value = this.value.replace(/[^0-9]/g, '')"
                                                    id="paid_amount" name="paid_amount" class="form-control"
                                                    value="0.00" /></td>
                                        </tr>
                                        <tr>
                                            <td>Due Amount</td>
                                            <td style="float: right;" class="my-1"> <input type="number" id="due_amount"
                                                    name="due_amount" readonly class="form-control" value="0.00" /></td>
                                            <input type="hidden" value="" name="totalbuyingPrice"
                                                id="totalbuyingPrice">
                                        </tr>
                                        <tr>
                                            <td>Sale By</td>
                                            <td style="" class="my-2">
                                                <select name="staff_id"
                                                    class="form-control select-active w-100 form-select select-nice">
                                                    @if (Auth::guard('admin')->user()->role == '1')
                                                        <option value="">-- Select Staff --</option>
                                                    @endif
                                                    @foreach ($staffs as $staff)
                                                        @if (Auth::guard('admin')->user()->role == '5')
                                                            @if (Auth::guard('admin')->user()->id == $staff->user_id)
                                                                <option value="{{ $staff->id }}" selected>
                                                                    {{ $staff->user->name }}</option>
                                                            @endif
                                                        @elseif(Auth::guard('admin')->user()->role == '1')
                                                            <option value="{{ $staff->id }}">{{ $staff->user->name }}</option>
                                                        @endif
                                                    @endforeach
                                                </select>
                                            </td>
                                        </tr>
                                        <div class="clearfix"></div>
                                        <input type="hidden" id="posProducts">
                                    </tbody>
                                </table>
                                <hr>
                                <table class="table">
                                    <tbody>
                                        <tr style="font-size: 20px; font-weight: bold">
                                            <td>Total</td>
                                            <td style="float: right;">৳ <span id="total_text">0.00</span></td>
                                            <input type="hidden" id="total" name="grand_total" value="0">
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="row">
                                <div class="col-sm-6">

                                </div>
                                <div class="col-sm-6">
                                    <input type="submit" class="btn btn-primary" value="Place Order"
                                        style="float: right;">
                                </div>
                            </div>
                        </form>
                    </div>
                    <!-- card-body end// -->
                </div>
            </div>
        </div>
    </section>
    <!--  Customer Modal -->
    <div class="modal fade" id="customer1" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header card-header">
                    <h3>Customer Create</h3>
                    <button type="button" class="btn-close bg-white" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form method="POST" enctype="multipart/form-data" id="customer_store" action="">
                        <input type="hidden" name="_token" id="csrf" value="{{ Session::token() }}">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="mb-1">
                                    <label class="col-form-label" style="font-weight: bold;">Name: <span
                                            class="text-danger">*</span></label>
                                    <input class="form-control" type="text" id="name" name="name" required
                                        placeholder="Write Customer Name">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="mb-1">
                                    <label class="col-form-label" style="font-weight: bold;">Phone: <span
                                            class="text-danger">*</span></label>
                                    <input type="text" placeholder="Write Phone" id="phone" name="phone"
                                        required class="form-control">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="mb-1">
                                    <label class="col-form-label" style="font-weight: bold;">Email:</label>
                                    <input type="email" placeholder="Write Email" id="email" name="email"
                                        class="form-control">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="mb-1">
                                    <label class="col-form-label" style="font-weight: bold;">Address: <span
                                            class="text-danger">*</span></label>
                                    <input type="text" placeholder="Write Address" id="address" name="address"
                                        required class="form-control">
                                </div>
                            </div>
                            <div class="mb-1 mt-2">
                                <img id="showImage" class="rounded avatar-lg"
                                    src="{{ !empty($editData->profile_image) ? url('upload/admin_images/' . $editData->profile_image) : url('upload/no_image.jpg') }}"
                                    alt="Card image cap" width="100px" height="80px;">
                            </div>
                            <div class="mb-1">
                                <label for="image" class="col-form-label" style="font-weight: bold;">Profile
                                    Image:</label>
                                <input name="profile_image" class="form-control" type="file" id="image">
                            </div>
                            <div class="modal-footer">
                                <button type="button" id="Close" class="btn btn-secondary"
                                    data-bs-dismiss="modal">Close</button>
                                <button type="submit" id="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('footer-script')
    <!-- Ajax Update Category Store -->
    <script type="text/javascript">
        $(document).ready(function(e) {
            $('#customer_store').submit(function(e) {
                e.preventDefault();
                var formData = new FormData(this);
                $.ajax({
                    type: 'POST',
                    url: "{{ route('customer.ajax.store.pos') }}",
                    data: formData,
                    cache: false,
                    contentType: false,
                    processData: false,
                    success: (data) => {
                        //console.log(data);
                        $('select[name="customer_id"]').html(
                            '<option value="" selected="" disabled="">-- Select Customer --</option>'
                        );
                        $.each(data.customers, function(key, value) {
                            $('select[name="customer_id"]').append('<option value="' +
                                value.id + '">' + value.name + '</option>');
                        });
                        // console.log(data);
                        $('#showImage').val('');
                        $('#phone').val('');
                        $('#email').val('');
                        $('#address').val('');
                        this.reset();
                        if ($.isEmptyObject(data.error)) {
                            const Toast = Swal.mixin({
                                toast: true,
                                position: 'top-end',
                                icon: 'success',
                                showConfirmButton: false,
                                timer: 1000
                            })
                            Toast.fire({
                                type: 'success',
                                title: data.success
                            })
                            location.reload();
                        } else {
                            const Toast = Swal.mixin({
                                toast: true,
                                position: 'top-end',
                                icon: 'error',
                                showConfirmButton: false,
                                timer: 1000
                            })
                            Swal.fire({
                                icon: 'error',
                                title: data.error,
                            })
                        }
                        // End Message
                        $('#Close').click();
                    },

                    error: function(data) {
                        $.each(data.responseJSON.errors, function(key, value) {
                            // console.log(value);
                            var Toast = Swal.mixin({
                                toast: true,
                                position: 'top-end',
                                icon: 'error',
                                showConfirmButton: false,
                                timer: 1000,
                            })
                            Toast.fire({
                                title: value
                            })

                        });

                    }
                });
            });
        });
    </script>
    <script></script>
    <script>
        $(document).ready(function() {
            $('body').addClass('aside-mini');
        });
        //discount price
        $(document).on("keyup", "#discount", function() {
            var subtotal = parseFloat($('#subtotal_text').val());
            var paid_amount = $('#paid_amount').val();
            var total_text = parseFloat($('#total_text').text());
            var discount_amount = $('#discount').val();
            var due_amount = $('#due_amount').val();
            var total_amount_due = $('#total').val();
            if (paid_amount == 0 || paid_amount == 0.00) {
                discount_amount = Math.min(discount_amount, subtotal);
                $('#discount').val(discount_amount);
                var subtotal_dicount = parseFloat(subtotal - discount_amount).toFixed(2);
                $('#due_amount').val(subtotal_dicount);
                $('#total_text').html(subtotal_dicount);
                $('#total').val(subtotal_dicount);
            } else {
                var subtotalof = subtotal - paid_amount;
                discount_amount = Math.min(discount_amount, subtotalof);
                $('#discount').val(discount_amount);
                var subtotal_dicount = parseFloat(subtotal - discount_amount).toFixed(2);
                var subtotal_dicount_paid = parseFloat(subtotal_dicount - paid_amount).toFixed(2);
                $('#due_amount').val(subtotal_dicount_paid);
                $('#total_text').html(subtotal_dicount);
                $('#total').val(subtotal_dicount);
            }
        });
        //paid price
        $(document).on("keyup", "#paid_amount", function() {
            var subtotal = parseFloat($('#subtotal_text').val());
            var discount_amount = $('#discount').val();
            var paid_amount = $('#paid_amount').val();
            var total_text = parseFloat($('#total_text').text());
            if (discount_amount == 0 || discount_amount == 0.00) {
                paid_amount = Math.min(paid_amount, subtotal);
                $('#paid_amount').val(paid_amount);
                var subtotal_due = parseFloat(subtotal - paid_amount).toFixed(2);
                $('#due_amount').val(subtotal_due);
            } else {
                var subtotalof = subtotal - discount_amount;
                paid_amount = Math.min(paid_amount, subtotalof);
                $('#paid_amount').val(paid_amount);
                var discount_amount = $('#discount').val();
                var subtotal_due = parseFloat(subtotalof - paid_amount).toFixed(2);
                $('#due_amount').val(subtotal_due);

            }
        });
    </script>
    <script>
        /* get cart */
        function getCartData() {
            $.ajax({
                method: "get",
                url: '{{ route('get.pos.CartData') }}',
                success: function(response) {
                    $('#checkout_list').html(response.cart_data);
                    $('#subtotal_text').val(response?.totalPrice);
                    $('#total').val(response?.totalPrice);
                    $('#total_text').text(response?.totalPrice);
                    $('.totalPrice').text(response?.totalPrice);
                    $('#due_amount').val(response?.totalPrice);
                    $('#totalbuyingPrice').val(response.totalbuyingPrice);
                }
            });
        }
        getCartData();
        /* add to cart */
        $(document).on('click', '.addToCartBtn', function() {
            var product_id = $(this).attr('data-product_id');
            var dataid = $(this).attr('data-id');
            var data = {
                product_id: product_id,
                stock_id: dataid
            }
            if (dataid !== undefined && dataid !== null) {
                data.stock_id = dataid;
            }
            $.ajax({
                url: "{{ route('add.pos.product') }}",
                method: "get",
                data: data,
                success: function(response) {
                    if (response.status == 'success') {
                        getCartData();
                        toastr.success(response.message, 'message');
                    } else if (response.status == 'error') {
                        toastr.error(response.error, 'Error');
                    } else {
                        toastr.error(response.error, 'Error');
                    }
                }
            });
        });
        //remove
        $(document).on('click', '.remove-posCart', function(e) {
            var btn = $(this);
            var id = btn.data('id');
            var url = '{{ route('pos.delete.item', '') }}' + '/' + id;
            $.ajax({
                headers: {
                    "X-CSRF-TOKEN": "{{ csrf_token() }}"
                },
                url: url,
                method: "GET",
                success: function(response) {
                    if (response.status == 'success') {
                        toastr.success(response.message, 'message');
                        getCartData();

                    } else {
                        toastr.error(response.error, 'Error');
                    }
                }
            });
        });
        //Update Cart
        $(document).on('click', '.changeQuantity', function() {
            var product_id = $(this).closest('.cart__product').find('.product_id').val();
            var stock_id = $(this).closest('.cart__product').find('.stock_id').val();
            var type = $(this).data('type');
            var data = {
                'product_id': product_id,
                'stock_id': stock_id,
                'type': type,
            }
            if (stock_id !== undefined && stock_id !== null) {
                data.stock_id = stock_id;
            }
            $.ajax({
                method: "get",
                url: '{{ route('pos.cart.update') }}',
                data: data,
                success: function(response) {
                    // systemAlert(response.status, response.message);
                    if (response.status == 'success') {
                        toastr.success(response.message, 'message');
                        var currentPrice = parseFloat($('#totalPrice').text());
                        if (response.type == '+') {
                            currentPrice += parseFloat(response.price);
                        } else {
                            currentPrice -= parseFloat(response.price);
                        }
                        $('.totalPrice').text(currentPrice);
                        getCartData();
                    } else {
                        toastr.error(response.error, 'Error');
                    }
                }
            });
        });
    </script>
    <script>
        //filter category
        $(document).on('change', '#category_id', function() {
            var category_id = $(this).val();
            var search_product = $('#search_product').val();
            console.log(search_product)
            $.ajax({
                method: "GET",
                url: '{{ route('pos.filter') }}',
                data: {
                    category_id: category_id
                },
                success: function(response) {
                    if (response) {
                        $('#product_wrapper').html(response);
                    } else {
                        $('#product_wrapper').html(`
                        <div class="text-center">@lang('Product Not Found')</div>
                    `);
                    }
                }
            })
        })
        //search product
        $(document).on('keyup', '#search_product', function() {
            var search_product = $(this).val();
            console.log(search_product)
            if (search_product.length > 2) {
                $.ajax({
                    method: "GET",
                    url: '{{ route('pos.filter') }}',
                    data: {
                        search_product: search_product
                    },
                    success: function(response) {
                        if (response) {
                            $('#product_wrapper').html(response);
                        } else {
                            $('#product_wrapper').html(`
                        <div class="text-center">@lang('Product Not Found')</div>
                    `);
                        }
                    }
                })
            } else {
                $.ajax({
                    method: "GET",
                    url: '{{ route('pos.filter') }}',
                    success: function(response) {
                        if (response) {
                            $('#product_wrapper').html(response);
                        } else {
                            $('#product_wrapper').html(`
                        <div class="text-center">@lang('Product Not Found')</div>
                    `);
                        }
                    }
                })
            }
        })
    </script>
    {{-- <script>
        $(".product-row .product-row-list").hide();
        $(".product-row .product-row-list").slice(0, 18).show();
        $("#seemore").click(function(){
            $(".product-row .product-row-list:hidden").slice(0, 18).slideDown();
            if ($(".product-row .product-row-list:hidden").length == 0) {
                $("#load").fadeOut('slow');
            }
        });
    </script> --}}
@endpush
