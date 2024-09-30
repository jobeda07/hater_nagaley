@extends('admin.admin_master')
@section('admin')
    <style type="text/css">
        table,
        tbody,
        tfoot,
        thead,
        tr,
        th,
        td {
            border: 1px solid #dee2e6 !important;
        }

        th {
            font-weight: bolder !important;
        }
    </style>

    <?php
    use App\Models\User;
    $id = Auth::guard('admin')->user()->id;
    $adminData = User::find($id);
    ?>

    <section class="content-main">
        <div class="content-header">
            <div>
                <h2 class="content-title card-title">Order List</h2>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="card mb-4">
                    <!-- card-header end// -->
                    <div class="card-body">
                        <form class="" action="" method="GET">
                            <div class="form-group row mb-3">
                                <div class="col-md-2">
                                    <label class="col-form-label"><span>All Orders :</span></label>
                                </div>
                                <div class="col-md-2 mt-2"></div>
                                <div class="col-md-2 mt-2">
                                    <div class="custom_select">
                                        <select
                                            class="form-select d-inline-block select-active select-nice mb-lg-0 mr-5 mw-200"
                                            name="delivery_status" id="delivery_status">
                                            <option value="" selected="">Delivery Status</option>
                                            <option value="pending" @if ($delivery_status == 'pending') selected @endif>
                                                Pending</option>
                                            <option value="holding" @if ($delivery_status == 'holding') selected @endif>
                                                Holding</option>
                                            <option value="processing" @if ($delivery_status == 'processing') selected @endif>
                                                Processing</option>
                                            <option value="shipped" @if ($delivery_status == 'shipped') selected @endif>
                                                Shipped</option>
                                            <option value="delivered" @if ($delivery_status == 'delivered') selected @endif>
                                                Delivered</option>
                                            <option value="cancelled" @if ($delivery_status == 'cancelled') selected @endif>
                                                Cancelled</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-2 mt-2">
                                    <div class="custom_select">
                                        <select
                                            class=" select-active select-nice form-select d-inline-block mb-lg-0 mr-5 mw-200"
                                            name="payment_status" id="payment_status">
                                            <option value="" selected="">Payment Status</option>
                                            <option value="unpaid" @if ($payment_status == 'unpaid') selected @endif>Unpaid
                                            </option>
                                            <option value="paid" @if ($payment_status == 'paid') selected @endif>Paid
                                            </option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-2 mt-2">
                                    <div class="custom_select">
                                        <input type="text" id="reportrange" class="form-control" name="date"
                                            placeholder="Filter by date" data-format="DD-MM-Y" value="Filter by date"
                                            data-separator=" - " autocomplete="off">
                                    </div>
                                </div>
                                <div class="col-md-2 mt-2">
                                    <button class="btn btn-primary" type="submit">Filter</button>
                                </div>
                            </div>
                            <div class="table-responsive-sm">
                                <table class="table table-bordered table-hover example" width="100%" id="example">
                                    <thead>
                                        <tr>
                                            <th>Order Code</th>
                                            <th>Customer name</th>
                                            <th class="text-center">Total Amount</th>
                                            <th class="text-center">Comission</th>
                                            <th class="text-center">Receiveable Amount</th>
                                            <th class="text-center">Delivery Status</th>
                                            <th class="text-center">Payment Status</th>
                                            <th class="text-end">Options</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($orders as $key => $order)
                                            <tr>
                                                <td>{{ $order->invoice_no }}</td>
                                                <td><b>{{ $order->name }}</b></td>
                                                <td class="text-center">
                                                    @php
                                                        $sum = 0;
                                                        $sum1 = 0;
                                                        $sum2 = 0;
                                                        $price = 0;
                                                        $orderDetails = $order->order_details()->where('vendor_id',Auth::guard('admin')->user()->id)->get();
                                                        foreach ($orderDetails as $key => $orderDetail) {
                                                            $sum1 += $orderDetail->v_comission;
                                                            $sum2 += $orderDetail->qty;
                                                            $price += $orderDetail->price * $orderDetail->qty;
                                                        }
                                                    @endphp
                                                   {{$price}}
                                                </td>
                                                <td class="text-center">
                                                    {{-- @if ($order->payment_status == 'paid') --}}
                                                        @php
                                                            $sum = 0;
                                                            $sum1 = 0;
                                                            $sum2 = 0;
                                                            $orderDetails = $order->order_details()->where('vendor_id', Auth::guard('admin')->user()->id)->get();
                                                            foreach ($orderDetails as $key => $orderDetail) {
                                                                $sum1 += $orderDetail->v_comission;
                                                                $sum2 += $orderDetail->qty;
                                                                $sum += $orderDetail->v_comission * $orderDetail->qty;
                                                            }
                                                        @endphp
                                                        {{ $sum ?? '' }}
                                                    {{-- @else
                                                        <span>0.00 </span>
                                                    @endif --}}

                                                </td>
                                                <td class="text-center">
                                                    {{-- @if ($order->payment_status == 'paid') --}}
                                                        @php
                                                            $sum = 0;
                                                            $sum1 = 0;
                                                            $sum2 = 0;
                                                            $price = 0;
                                                            $orderDetails = $order->order_details()->where('vendor_id',Auth::guard('admin')->user()->id)->get();
                                                            foreach ($orderDetails as $key => $orderDetail) {
                                                                $sum1 += $orderDetail->v_comission;
                                                                $sum2 += $orderDetail->qty;
                                                                $sum += $orderDetail->v_comission * $orderDetail->qty;
                                                                $price += $orderDetail->price * $orderDetail->qty;
                                                            }
                                                        @endphp
                                                        {{($price - $sum)}}
                                                    {{-- @else
                                                        <span>0.00 </span>
                                                    @endif --}}
                                                </td>
                                                <td class="text-center">
                                                    @php
                                                        $status = $order->delivery_status;
                                                        if ($order->delivery_status == 'cancelled') {
                                                            $status = '<span class="badge rounded-pill alert-danger">Cancelled</span>';
                                                        }

                                                    @endphp
                                                    {!! $status !!}
                                                </td>
                                                <td class="text-center">
                                                    @if ($order->payment_status == 'paid')
                                                        <span class="badge rounded-pill alert-success">Paid</span>
                                                    @else
                                                        <span class="badge rounded-pill alert-danger">Un-Paid</span>
                                                    @endif
                                                </td>
                                                <td class="text-end">
                                                    <a target="_blank"
                                                        class="btn btn-primary btn-icon btn-circle btn-sm btn-xs"
                                                        href="{{ route('all_orders.show', $order->id) }}">
                                                        <i class="fa-solid fa-eye"></i>
                                                    </a>
                                                    {{-- <a class="btn btn-primary btn-icon btn-circle btn-sm btn-xs"
                                                        href="{{ route('print.invoice.download', $order->id) }}">
                                                        <i class="fa-solid fa-download"></i>
                                                    </a> --}}
                                                    <!--<a href="{{ route('delete.orders', $order->id) }}" id="delete"-->
                                                    <!--    class="btn btn-primary btn-icon btn-circle btn-sm btn-xs"-->
                                                    <!--    data-href="#">-->
                                                    <!--    <i class="fa-solid fa-trash"></i>-->
                                                    <!--</a>-->
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                {{-- <div class="pagination-area mt-25 mb-50">
                                    <nav aria-label="Page navigation example">
                                        <ul class="pagination justify-content-end">
                                            {{ $orders->links() }}
                                        </ul>
                                    </nav>
                                </div> --}}
                            </div>
                        </form>
                        <!-- table-responsive //end -->
                    </div>
                    <!-- card-body end// -->
                </div>
                <!-- card end// -->
            </div>
        </div>
    </section>

    {{-- model for BKash --}}
    <div class="modal fade" id="Bkash" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Cash Withdraw from Bkash</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="page-content pt-10 pb-10">
                        <div class="container">
                            <div class="row">
                                <div class="col-xl-12 col-lg-12 col-md-12 m-auto">
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <div class="login_wrap widget-taber-content background-white">
                                                <div class="padding_eight_all bg-white">
                                                    <form method="POST" action="">
                                                        @csrf
                                                        <div class="row">
                                                            <div class="input-group-sm col-md-6 mb-3">
                                                                <label for="name" class="fw-900">Name: <span
                                                                        class="text-danger">*</span></label>
                                                                <input type="text" name="name" class="form-control"
                                                                    id="name" value="{{ $adminData->name }}"
                                                                    required readonly />
                                                            </div>

                                                            <div class="form-group col-md-6 mb-3">
                                                                <label for="phone" class="fw-900">Phone:<span
                                                                        class="text-danger">*</span></label>
                                                                <input type="text" name="phone" class="form-control"
                                                                    id="phone" value="{{ $adminData->phone }}"
                                                                    required readonly />
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="form-group col-md-6 mb-3">
                                                                <label for="address" class="fw-900">Address : <span
                                                                        class="text-danger">*</span></label>
                                                                <input type="text" name="address" class="form-control"
                                                                    id="address" value="{{ $adminData->address }}"
                                                                    required readonly />
                                                            </div>

                                                            <div class="form-group col-md-6 mb-3">
                                                                <label for="transition_number" class="fw-900">BKash
                                                                    Number: <span class="text-danger">*</span></label>
                                                                <input type="text" name="transition_number"
                                                                    class="form-control" id="transition_number"
                                                                    placeholder="017XX-XXXXXX" required />
                                                            </div>
                                                        </div>

                                                        <div class="row">
                                                            <div class="form-group col-md-6">
                                                                <label for="account_type" class="fw-900">Account
                                                                    Type:<span class="text-danger">*</span></label>
                                                                <div class="custom_select">
                                                                    <select class="form-control" name="account_type"
                                                                        id="account_type" required>
                                                                        <option value="">Select Type</option>
                                                                        <option value="personal">personal</option>
                                                                        <option value="Agent">Agent</option>
                                                                        <option value="Marchent">Marchent</option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <div class="form-group col-md-6">
                                                                <label for="amount" class="fw-900">Amount<span
                                                                        class="text-danger">*</span></label>
                                                                <input type="number" name="amount" class="form-control"
                                                                    id="amount" value="" required />
                                                            </div>
                                                        </div>

                                                        <div class="row">
                                                            <div class="form-group col-md-3">
                                                                <input type="text" name="method" id="method"
                                                                    value="Bkash" required hidden />
                                                            </div>
                                                            <div class="form-group col-md-3">
                                                                <input type="number" name="user_id" id="user_id"
                                                                    value="{{ $adminData->id }}" required hidden />
                                                            </div>
                                                            <div class="form-group col-md-3">
                                                                <input type="number" name="user_type" id="user_type"
                                                                    value="0" required hidden />
                                                            </div>
                                                        </div>
                                                        <div class="form-group mb-30 mt-20">
                                                            <button type="submit" class="btn btn-primary">Submit</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @push('footer-script')
        <script type="text/javascript">
            $(function() {
                var start = moment();
                var end = moment();

                $('input[name="date"]').daterangepicker({
                    autoUpdateInput: false,
                    locale: {
                        cancelLabel: 'Clear'
                    }
                });

                function cb(start, end) {
                    $('#reportrange').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
                }

                $('#reportrange').daterangepicker({
                    startDate: start,
                    endDate: end,
                    ranges: {
                        'Today': [moment(), moment()],
                        'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
                        'Last 7 Days': [moment().subtract(6, 'days'), moment()],
                        'Last 30 Days': [moment().subtract(29, 'days'), moment()],
                        'This Month': [moment().startOf('month'), moment().endOf('month')],
                        'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1,
                            'month').endOf('month')]
                    }
                }, cb);

                cb(start, end);
            });
        </script>
    @endpush
@endsection
