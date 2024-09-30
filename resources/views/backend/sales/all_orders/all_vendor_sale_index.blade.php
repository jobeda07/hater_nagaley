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

    <section class="content-main">
        <div class="content-header">
            <div>
                <h2 class="content-title card-title">All Vendor Order List</h2>
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
                                <div class="col-md-2 mt-2">
                                    <div class="custom_select">
                                        <select
                                            class="form-select d-inline-block select-active select-nice mb-lg-0 mr-5 mw-200"
                                            name="delivery_status" id="delivery_status">
                                            <option value="" selected="">Delivery Status</option>
                                            <option value="Pending" @if ($delivery_status == 'Pending') selected @endif>
                                                Pending</option>
                                            <option value="Holding" @if ($delivery_status == 'Holding') selected @endif>
                                                Holding</option>
                                            <option value="Processing" @if ($delivery_status == 'Processing') selected @endif>
                                                Processing</option>
                                            <option value="Shipped" @if ($delivery_status == 'Shipped') selected @endif>
                                                Shipped</option>
                                            <option value="Delivered" @if ($delivery_status == 'Delivered') selected @endif>
                                                Delivered</option>
                                            <option value="Cancelled" @if ($delivery_status == 'Cancelled') selected @endif>
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
                            <div class="table-responsive">
                                <table class="table table-bordered table-hover" id="example" width="100%">
                                    <thead>
                                        <tr>
                                            {{-- <th style="width: 5%">No.</th> --}}
                                            <th style="width: 5%">Order Code</th>
                                            <th style="width: 10%">Customer name</th>
                                            <th style="width: 10%">Vendor name</th>
                                            <th style="width: 5%" class="text-center">Amount</th>
                                            <th style="width: 5%" class="text-center">Paid</th>
                                            <th style="width: 5%" class="text-center">Due</th>
                                            <th style="width: 5%" class="text-center">Payment Status</th>
                                            <th style="width: 5%" class="text-center">Vendor Comission</th>
                                            <th style="width: 5%" class="text-center">Delivery Status</th>
                                            <th style="width: 5%" class="text-center">Vendor Show Status</th>
                                            <th style="width: 10%" class="text-end">Options</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($orders as $key => $order)
                                            <tr>
                                                {{-- <td>{{ $key+1 }}</td> --}}
                                                <td>{{ $order->invoice_no }}</td>
                                                <td><b>{{ $order->name }}</b></td>
                                                <td>
                                                    @php
                                                        $orderDetails = App\Models\OrderDetail::where(
                                                            'order_id',
                                                            $order->id,
                                                        )->get();
                                                        $vendorIds = $orderDetails->pluck('vendor_id')->toArray();
                                                        $vendorNames = App\Models\User::whereIn(
                                                            'id',
                                                            $vendorIds,
                                                        )->pluck('name');
                                                    @endphp

                                                    @foreach ($vendorNames as $vendorName)
                                                        {{ $vendorName }}
                                                    @endforeach
                                                </td>
                                                <td class="text-center">{{ $order->grand_total }}</td>
                                                <td class="text-center">
                                                    @if ($order->payment_status == 'partial paid')
                                                        {{ $order->shipping_charge ?? '' }}
                                                    @elseif($order->payment_status == 'paid')
                                                        {{ $order->grand_total ?? '' }}
                                                    @else
                                                        0.00
                                                    @endif
                                                </td>

                                                <td class="text-center">
                                                    @if ($order->payment_status == 'partial paid')
                                                        {{ $order->grand_total - $order->shipping_charge }}
                                                    @elseif($order->payment_status == 'unpaid')
                                                        {{ $order->grand_total ?? '' }}
                                                    @else
                                                        0.00
                                                    @endif
                                                </td>
                                                <td class="text-center">
                                                    @php
                                                        $status = $order->payment_status;
                                                        if ($order->payment_status == 'unpaid') {
                                                            $status =
                                                                '<span class="badge rounded-pill alert-danger">Unpaid</span>';
                                                        } elseif ($order->payment_status == 'paid') {
                                                            $status =
                                                                '<span class="badge rounded-pill alert-success">Paid</span>';
                                                        } else {
                                                            $status =
                                                                '<span class="badge rounded-pill alert-warning">Partial Paid</span>';
                                                        }

                                                    @endphp
                                                    {!! $status !!}
                                                </td>
                                                <td class="text-center">
                                                    @if ($order->payment_status == 'unpaid')
                                                        @php
                                                            $sum = 0;
                                                            $sum1 = 0;
                                                            $sum2 = 0;
                                                            $orderDetails = $order->order_details;
                                                            foreach ($orderDetails as $key => $orderDetail) {
                                                                $sum1 += $orderDetail->v_comission;
                                                                $sum2 += $orderDetail->qty;
                                                                $sum += $orderDetail->v_comission * $orderDetail->qty;
                                                            }
                                                        @endphp
                                                        {{ $sum ?? '' }}
                                                    @else
                                                        <span>0.00</span>
                                                    @endif

                                                </td>
                                                <td class="text-center">
                                                    @php
                                                        $status = $order->delivery_status;
                                                        if ($order->delivery_status == 'Delivered') {
                                                            $status =
                                                                '<span class="badge rounded-pill alert-success">Delivered</span>';
                                                        }
                                                        if ($order->delivery_status == 'Cancelled') {
                                                            $status =
                                                                '<span class="badge rounded-pill alert-danger">Cancelled</span>';
                                                        }

                                                    @endphp
                                                    {!! $status !!}
                                                </td>

                                                <td class="text-center">
                                                    @if ($order->vendor_show_status == 0)
                                                        <a href="{{ route('vendor.showStatus',$order->id) }}" class="badge rounded-pill alert-danger">hide</a>
                                                    @else
                                                        <a href="{{ route('vendor.showStatus',$order->id) }}" class="badge rounded-pill alert-success">Show</a>
                                                    @endif
                                                </td>

                                                <td class="text-end">
                                                    @if (Auth::guard('admin')->user()->role == '1' ||
                                                            in_array('18', json_decode(Auth::guard('admin')->user()->staff->role->permissions)))
                                                        <a class="btn btn-primary btn-icon btn-circle btn-sm btn-xs"
                                                            href="{{ route('all_orders.show', $order->id) }}">
                                                            <i class="fa-solid fa-eye"></i>
                                                        </a>
                                                    @endif
                                                    <a class="btn btn-primary btn-icon btn-circle btn-sm btn-xs"
                                                        href="{{ route('print.invoice.download', $order->id) }}">
                                                        <i class="fa-solid fa-print"></i>
                                                    </a>
                                                    <!--<a href="{{ route('delete.orders', $order->id) }}" id="delete" class="btn btn-primary btn-icon btn-circle btn-sm btn-xs" data-href="#" >-->
                                                    <!--    <i class="fa-solid fa-trash"></i>-->
                                                    <!--</a>-->
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
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
