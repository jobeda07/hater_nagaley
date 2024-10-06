<?php

namespace App\Http\Controllers\Backend;

use PDF;
use Session;

use App\Models\User;
use App\Models\Order;
use App\Models\Staff;
use App\Models\Vendor;
use App\Models\Address;
use App\Models\Product;
use App\Models\District;
use App\Models\Shipping;
use App\Models\Upazilla;
use App\Models\OrderDetail;
use App\Models\ProductStock;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Models\WalletTransaction;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Backend\Api\StendFastCourierController;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $date = $request->date;
        $delivery_status = null;
        $payment_status = null;
        $shipping_type = null;
        $ordersQuery = Order::latest();
        $dateRange = explode(" - ", $date);
        $startDate = date('Y-m-d', strtotime($dateRange[0]));
        if (isset($dateRange[1])) {
            $endDate = date('Y-m-d', strtotime($dateRange[1]));
        } else {
            $endDate = date('Y-m-d');
        }

        if ($request->filled(['delivery_status', 'payment_status', 'date', 'shipping_type'])) {
            if ($startDate === $endDate) {
                $ordersQuery->whereDate('created_at', $startDate)->where('delivery_status', $request->delivery_status)
                    ->where('payment_status', $request->payment_status)
                    ->where('shipping_type', $request->shipping_type);
            } else {
                $ordersQuery->whereBetween('created_at', [$startDate, $endDate])->where('delivery_status', $request->delivery_status)
                    ->where('payment_status', $request->payment_status)
                    ->where('shipping_type', $request->shipping_type);
            }
        } elseif ($request->filled(['delivery_status', 'payment_status', 'date']) && $request->shipping_type == null) {
            if ($startDate === $endDate) {
                $ordersQuery->whereDate('created_at', $startDate)->where('delivery_status', $request->delivery_status)
                    ->where('payment_status', $request->payment_status);
            } else {
                $ordersQuery->whereBetween('created_at', [$startDate, $endDate])->where('delivery_status', $request->delivery_status)
                    ->where('payment_status', $request->payment_status);
            }
        } elseif ($request->filled(['delivery_status', 'date', 'shipping_type']) && $request->payment_status == null) {
            if ($startDate === $endDate) {
                $ordersQuery->whereDate('created_at', $startDate)->where('delivery_status', $request->delivery_status)
                    ->where('shipping_type', $request->shipping_type);
            } else {
                $ordersQuery->whereBetween('created_at', [$startDate, $endDate])->where('delivery_status', $request->delivery_status)
                    ->where('shipping_type', $request->shipping_type);
            }
        } elseif ($request->filled(['payment_status', 'date', 'shipping_type']) && $request->delivery_status == null) {
            if ($startDate === $endDate) {
                $ordersQuery->whereDate('created_at', $startDate)->where('payment_status', $request->payment_status)
                    ->where('shipping_type', $request->shipping_type);
            } else {
                $ordersQuery->whereBetween('created_at', [$startDate, $endDate])->where('payment_status', $request->payment_status)
                    ->where('shipping_type', $request->shipping_type);
            }
        } elseif ($request->filled(['delivery_status', 'date']) && $payment_status == null && $shipping_type == null) {
            if ($startDate === $endDate) {
                $ordersQuery->whereDate('created_at', $startDate)->where('delivery_status', $request->delivery_status);
            } else {
                $ordersQuery->whereBetween('created_at', [$startDate, $endDate])->where('delivery_status', $request->delivery_status);
            }
        } elseif ($request->filled(['payment_status', 'date']) && $delivery_status == null && $shipping_type == null) {
            if ($startDate === $endDate) {
                $ordersQuery->whereDate('created_at', $startDate)->where('payment_status', $request->payment_status);
            } else {
                $ordersQuery->whereBetween('created_at', [$startDate, $endDate])->where('payment_status', $request->payment_status);
            }
        } elseif ($request->filled(['shipping_type', 'date']) && $delivery_status == null && $payment_status == null) {
            if ($startDate === $endDate) {
                $ordersQuery->whereDate('created_at', $startDate)->where('shipping_type', $request->shipping_type);
            } else {
                $ordersQuery->whereBetween('created_at', [$startDate, $endDate])->where('shipping_type', $request->shipping_type);
            }
        } elseif ($request->filled(['date']) && $delivery_status == null && $payment_status == null && $shipping_type == null) {
            if ($startDate === $endDate) {
                $ordersQuery->whereDate('created_at', $startDate);
            } else {
                $ordersQuery->whereBetween('created_at', [$startDate, $endDate]);
            }
        } else {
            $ordersQuery->orderBy('id', 'desc');
        }
        //$orderIds = OrderDetail::where('vendor_id', '=', 0)->pluck('order_id')->toArray();
        $orders = $ordersQuery->where('sale_type', 2)->orderBy('created_at', 'desc')->get();
        return view('backend.sales.all_orders.index', compact('orders', 'delivery_status', 'date', 'payment_status', 'shipping_type'));
    }
    public function index2(Request $request)
    {
        $date = $request->date;
        $delivery_status = null;
        $payment_status = null;
        $shipping_type = null;
        $ordersQuery = Order::latest();
        $dateRange = explode(" - ", $date);
        $startDate = date('Y-m-d', strtotime($dateRange[0]));
        if (isset($dateRange[1])) {
            $endDate = date('Y-m-d', strtotime($dateRange[1]));
        } else {
            $endDate = date('Y-m-d');
        }
        if ($request->filled(['delivery_status', 'payment_status', 'date', 'shipping_type'])) {
            if ($startDate === $endDate) {
                $ordersQuery->whereDate('created_at', $startDate)->where('delivery_status', $request->delivery_status)
                    ->where('payment_status', $request->payment_status)
                    ->where('shipping_type', $request->shipping_type);
            } else {
                $ordersQuery->whereBetween('created_at', [$startDate, $endDate])->where('delivery_status', $request->delivery_status)
                    ->where('payment_status', $request->payment_status)
                    ->where('shipping_type', $request->shipping_type);
            }
        } elseif ($request->filled(['delivery_status', 'payment_status', 'date']) && $request->shipping_type == null) {
            if ($startDate === $endDate) {
                $ordersQuery->whereDate('created_at', $startDate)->where('delivery_status', $request->delivery_status)
                    ->where('payment_status', $request->payment_status);
            } else {
                $ordersQuery->whereBetween('created_at', [$startDate, $endDate])->where('delivery_status', $request->delivery_status)
                    ->where('payment_status', $request->payment_status);
            }
        } elseif ($request->filled(['delivery_status', 'date', 'shipping_type']) && $request->payment_status == null) {
            if ($startDate === $endDate) {
                $ordersQuery->whereDate('created_at', $startDate)->where('delivery_status', $request->delivery_status)
                    ->where('shipping_type', $request->shipping_type);
            } else {
                $ordersQuery->whereBetween('created_at', [$startDate, $endDate])->where('delivery_status', $request->delivery_status)
                    ->where('shipping_type', $request->shipping_type);
            }
        } elseif ($request->filled(['payment_status', 'date', 'shipping_type']) && $request->delivery_status == null) {
            if ($startDate === $endDate) {
                $ordersQuery->whereDate('created_at', $startDate)->where('payment_status', $request->payment_status)
                    ->where('shipping_type', $request->shipping_type);
            } else {
                $ordersQuery->whereBetween('created_at', [$startDate, $endDate])->where('payment_status', $request->payment_status)
                    ->where('shipping_type', $request->shipping_type);
            }
        } elseif ($request->filled(['delivery_status', 'date']) && $payment_status == null && $shipping_type == null) {
            if ($startDate === $endDate) {
                $ordersQuery->whereDate('created_at', $startDate)->where('delivery_status', $request->delivery_status);
            } else {
                $ordersQuery->whereBetween('created_at', [$startDate, $endDate])->where('delivery_status', $request->delivery_status);
            }
        } elseif ($request->filled(['payment_status', 'date']) && $delivery_status == null && $shipping_type == null) {
            if ($startDate === $endDate) {
                $ordersQuery->whereDate('created_at', $startDate)->where('payment_status', $request->payment_status);
            } else {
                $ordersQuery->whereBetween('created_at', [$startDate, $endDate])->where('payment_status', $request->payment_status);
            }
        } elseif ($request->filled(['shipping_type', 'date']) && $delivery_status == null && $payment_status == null) {
            if ($startDate === $endDate) {
                $ordersQuery->whereDate('created_at', $startDate)->where('shipping_type', $request->shipping_type);
            } else {
                $ordersQuery->whereBetween('created_at', [$startDate, $endDate])->where('shipping_type', $request->shipping_type);
            }
        } elseif ($request->filled(['date']) && $delivery_status == null && $payment_status == null && $shipping_type == null) {
            if ($startDate === $endDate) {
                $ordersQuery->whereDate('created_at', $startDate);
            } else {
                $ordersQuery->whereBetween('created_at', [$startDate, $endDate]);
            }
        } else {
            $ordersQuery->orderBy('id', 'desc');
        }

        $orders = $ordersQuery->where('sale_type', 1)->latest()->get();
        return view('backend.sales.all_orders.pos_sale_index', compact('orders', 'delivery_status', 'date', 'payment_status'));

        // }
    }
    public function AllvendorSellView(Request $request)
    {
        $date = $request->date;
        $delivery_status = null;
        $payment_status = null;
        $vendor_id = null;
        $ordersQuery = Order::latest();
        $dateRange = explode(" - ", $date);
        $startDate = date('Y-m-d', strtotime($dateRange[0]));
        if (isset($dateRange[1])) {
            $endDate = date('Y-m-d', strtotime($dateRange[1]));
        } else {
            $endDate = date('Y-m-d');
        }
        if ($request->filled(['delivery_status', 'payment_status', 'date'])) {
            if ($startDate === $endDate) {
                $ordersQuery->whereDate('created_at', $startDate)->where('delivery_status', $request->delivery_status)
                    ->where('payment_status', $request->payment_status);
            } else {
                $ordersQuery->whereBetween('created_at', [$startDate, $endDate])->where('delivery_status', $request->delivery_status)
                    ->where('payment_status', $request->payment_status);
            }
        } elseif ($request->filled(['delivery_status', 'date',]) && $request->payment_status == null) {
            if ($startDate === $endDate) {
                $ordersQuery->whereDate('created_at', $startDate)->where('delivery_status', $request->delivery_status);
            } else {
                $ordersQuery->whereBetween('created_at', [$startDate, $endDate])->where('delivery_status', $request->delivery_status);
            }
        } elseif ($request->filled(['payment_status', 'date']) && $request->delivery_status == null) {
            if ($startDate === $endDate) {
                $ordersQuery->whereDate('created_at', $startDate)->where('payment_status', $request->payment_status);
            } else {
                $ordersQuery->whereBetween('created_at', [$startDate, $endDate])->where('payment_status', $request->payment_status);
            }
        } elseif ($request->filled(['delivery_status', 'date']) && $payment_status == null) {
            if ($startDate === $endDate) {
                $ordersQuery->whereDate('created_at', $startDate)->where('delivery_status', $request->delivery_status);
            } else {
                $ordersQuery->whereBetween('created_at', [$startDate, $endDate])->where('delivery_status', $request->delivery_status);
            }
        } elseif ($request->filled(['payment_status', 'date']) && $delivery_status == null) {
            if ($startDate === $endDate) {
                $ordersQuery->whereDate('created_at', $startDate)->where('payment_status', $request->payment_status);
            } else {
                $ordersQuery->whereBetween('created_at', [$startDate, $endDate])->where('payment_status', $request->payment_status);
            }
        } elseif ($request->filled(['date']) && $delivery_status == null && $payment_status == null) {
            if ($startDate === $endDate) {
                $ordersQuery->whereDate('created_at', $startDate);
            } else {
                $ordersQuery->whereBetween('created_at', [$startDate, $endDate]);
            }
        } elseif ($request->filled(['date']) && $delivery_status == null && $payment_status == null) {
            if ($startDate === $endDate) {
                $ordersQuery->whereDate('created_at', $startDate);
            } else {
                $ordersQuery->whereBetween('created_at', [$startDate, $endDate]);
            }
        } else {
            $ordersQuery->orderBy('id', 'desc');
        }
        $vendors = Vendor::pluck('user_id')->toArray();
        $users = User::where('role', 2)->latest()->get();
        $orderIds = OrderDetail::whereIn('vendor_id', $vendors)->pluck('order_id');
        $orders = $ordersQuery->whereIn('id', $orderIds)->orderBy('created_at', 'desc')->paginate(15);
        return view('backend.sales.all_orders.all_vendor_sale_index', compact('orders', 'orderIds', 'vendors', 'delivery_status', 'date', 'payment_status', 'users'));
    }
    public function vendorSellView(Request $request)
    {
        $date = $request->date;
        $delivery_status = null;
        $payment_status = null;
        $vendor_id = null;
        $ordersQuery = Order::where('vendor_show_status', 1)->latest();
        $dateRange = explode(" - ", $date);
        $startDate = date('Y-m-d', strtotime($dateRange[0]));
        if (isset($dateRange[1])) {
            $endDate = date('Y-m-d', strtotime($dateRange[1]));
        } else {
            $endDate = date('Y-m-d');
        }
        if ($request->filled(['delivery_status', 'payment_status', 'date'])) {
            if ($startDate === $endDate) {
                $ordersQuery->whereDate('created_at', $startDate)->where('delivery_status', $request->delivery_status)
                    ->where('payment_status', $request->payment_status);
            } else {
                $ordersQuery->whereBetween('created_at', [$startDate, $endDate])->where('delivery_status', $request->delivery_status)
                    ->where('payment_status', $request->payment_status);
            }
        } elseif ($request->filled(['delivery_status', 'date',]) && $request->payment_status == null) {
            if ($startDate === $endDate) {
                $ordersQuery->whereDate('created_at', $startDate)->where('delivery_status', $request->delivery_status);
            } else {
                $ordersQuery->whereBetween('created_at', [$startDate, $endDate])->where('delivery_status', $request->delivery_status);
            }
        } elseif ($request->filled(['payment_status', 'date']) && $request->delivery_status == null) {
            if ($startDate === $endDate) {
                $ordersQuery->whereDate('created_at', $startDate)->where('payment_status', $request->payment_status);
            } else {
                $ordersQuery->whereBetween('created_at', [$startDate, $endDate])->where('payment_status', $request->payment_status);
            }
        } elseif ($request->filled(['delivery_status', 'date']) && $payment_status == null) {
            if ($startDate === $endDate) {
                $ordersQuery->whereDate('created_at', $startDate)->where('delivery_status', $request->delivery_status);
            } else {
                $ordersQuery->whereBetween('created_at', [$startDate, $endDate])->where('delivery_status', $request->delivery_status);
            }
        } elseif ($request->filled(['payment_status', 'date']) && $delivery_status == null) {
            if ($startDate === $endDate) {
                $ordersQuery->whereDate('created_at', $startDate)->where('payment_status', $request->payment_status);
            } else {
                $ordersQuery->whereBetween('created_at', [$startDate, $endDate])->where('payment_status', $request->payment_status);
            }
        } elseif ($request->filled(['date']) && $delivery_status == null && $payment_status == null) {
            if ($startDate === $endDate) {
                $ordersQuery->whereDate('created_at', $startDate);
            } else {
                $ordersQuery->whereBetween('created_at', [$startDate, $endDate]);
            }
        } elseif ($request->filled(['date']) && $delivery_status == null && $payment_status == null) {
            if ($startDate === $endDate) {
                $ordersQuery->whereDate('created_at', $startDate);
            } else {
                $ordersQuery->whereBetween('created_at', [$startDate, $endDate]);
            }
        } else {
            $ordersQuery->orderBy('id', 'desc');
        }
        $orderIds = Order::latest()->pluck('id')->toArray();
        if (Auth::guard('admin')->user()->role == '2') {
            $vendor = Vendor::where('user_id', Auth::guard('admin')->user()->id)->first();
            $vendorIds = OrderDetail::where('vendor_id', $vendor->user_id)->pluck('order_id')->toArray();
            //$orders = Order::whereIn('id', $vendorIds)->paginate(15);
            $orders = $ordersQuery->whereIn('id', $vendorIds)->orderBy('created_at', 'desc')->get();
        } else {
            $orders = [];
        }
        return view('backend.sales.all_orders.vendor_sale_index', compact('orders', 'orderIds', 'delivery_status', 'date', 'payment_status'));
    }

    public function AllresellerSellView(Request $request)
    {
        $date = $request->date;
        $delivery_status = null;
        $payment_status = null;
        $vendor_id = null;
        $ordersQuery = Order::latest();
        $dateRange = explode(" - ", $date);
        $startDate = date('Y-m-d', strtotime($dateRange[0]));
        if (isset($dateRange[1])) {
            $endDate = date('Y-m-d', strtotime($dateRange[1]));
        } else {
            $endDate = date('Y-m-d');
        }
        if ($request->filled(['delivery_status', 'payment_status', 'date'])) {
            if ($startDate === $endDate) {
                $ordersQuery->whereDate('created_at', $startDate)->where('delivery_status', $request->delivery_status)
                    ->where('payment_status', $request->payment_status);
            } else {
                $ordersQuery->whereBetween('created_at', [$startDate, $endDate])->where('delivery_status', $request->delivery_status)
                    ->where('payment_status', $request->payment_status);
            }
        } elseif ($request->filled(['delivery_status', 'date',]) && $request->payment_status == null) {
            if ($startDate === $endDate) {
                $ordersQuery->whereDate('created_at', $startDate)->where('delivery_status', $request->delivery_status);
            } else {
                $ordersQuery->whereBetween('created_at', [$startDate, $endDate])->where('delivery_status', $request->delivery_status);
            }
        } elseif ($request->filled(['payment_status', 'date']) && $request->delivery_status == null) {
            if ($startDate === $endDate) {
                $ordersQuery->whereDate('created_at', $startDate)->where('payment_status', $request->payment_status);
            } else {
                $ordersQuery->whereBetween('created_at', [$startDate, $endDate])->where('payment_status', $request->payment_status);
            }
        } elseif ($request->filled(['delivery_status', 'date']) && $payment_status == null) {
            if ($startDate === $endDate) {
                $ordersQuery->whereDate('created_at', $startDate)->where('delivery_status', $request->delivery_status);
            } else {
                $ordersQuery->whereBetween('created_at', [$startDate, $endDate])->where('delivery_status', $request->delivery_status);
            }
        } elseif ($request->filled(['payment_status', 'date']) && $delivery_status == null) {
            if ($startDate === $endDate) {
                $ordersQuery->whereDate('created_at', $startDate)->where('payment_status', $request->payment_status);
            } else {
                $ordersQuery->whereBetween('created_at', [$startDate, $endDate])->where('payment_status', $request->payment_status);
            }
        } elseif ($request->filled(['date']) && $delivery_status == null && $payment_status == null) {
            if ($startDate === $endDate) {
                $ordersQuery->whereDate('created_at', $startDate);
            } else {
                $ordersQuery->whereBetween('created_at', [$startDate, $endDate]);
            }
        } elseif ($request->filled(['date']) && $delivery_status == null && $payment_status == null) {
            if ($startDate === $endDate) {
                $ordersQuery->whereDate('created_at', $startDate);
            } else {
                $ordersQuery->whereBetween('created_at', [$startDate, $endDate]);
            }
        } else {
            $ordersQuery->orderBy('id', 'desc');
        }
        //$vendors = Vendor::pluck('user_id')->toArray();
        $users = User::where('role', 7)->pluck('id')->toArray();
        $orderIds = Order::whereIn('user_id', $users)->pluck('id');
        $orders = $ordersQuery->whereIn('id', $orderIds)->orderBy('created_at', 'desc')->paginate(15);
        return view('backend.sales.all_orders.all_reseller_sale_index', compact('orders', 'orderIds', 'delivery_status', 'date', 'payment_status', 'users'));
    }
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $order = Order::findOrFail($id);
        $shippings = Shipping::where('status', 1)->get();
        return view('backend.sales.all_orders.show', compact('order', 'shippings'));
    }
    public function reseller_show($id)
    {
        $order = Order::findOrFail($id);
        $shippings = Shipping::where('status', 1)->get();
        return view('backend.sales.all_orders.reseller_show', compact('order', 'shippings'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'payment_method' => 'required',
        ]);
        $order = Order::findOrFail($id);
        $order->division_id = $request->division_id;
        $order->district_id = $request->district_id;
        $order->upazilla_id = $request->upazilla_id;
        $order->payment_method = $request->payment_method;
        $order->address = $request->address;
        $discount_total = ($order->sub_total - $request->discount);
        $total_ammount = ($discount_total + $request->shipping_charge);

        Order::where('id', $id)->update([
            'shipping_charge'   => $request->shipping_charge,
            'discount'          => $request->discount,
            'grand_total'       => $total_ammount,
        ]);

        $order->save();
        Session::flash('success', 'Admin Orders Information Updated Successfully');
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $order = Order::findOrFail($id);

        $order->delete();

        $notification = array(
            'message' => 'Order Deleted Successfully.',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    }


    /*================= Start update_payment_status Methoed ================*/
    public function update_payment_status(Request $request)
    {
        $order = Order::findOrFail($request->order_id);

        $order->payment_status = $request->status;
        $order->save();

        // dd($order);

        return response()->json(['success' => 'Payment status has been updated']);
    }

    /*================= Start update_delivery_status Methoed ================*/
    public function update_delivery_status(Request $request)
    {
        $order = Order::findOrFail($request->order_id);

        if ($request->status == 'cancelled') {
            //    return $order->order_details;
            foreach ($order->order_details as $orderDetail) {
                //for product stock update
                if ($orderDetail->is_varient) {
                    $jsonData = $orderDetail->variation;
                    $data = json_decode($jsonData, true);
                    $attributeValues = [];
                    foreach ($data as $item) {
                        $attributeValues[] = $item['attribute_value'];
                    }
                    $concatenatedValue = implode('-', $attributeValues);
                    $productStockId = ProductStock::where('product_id', $orderDetail->product_id)->get();
                    foreach ($productStockId as $productStock) {
                        if ($productStock->varient == $concatenatedValue) {
                            $productStock->qty = $productStock->qty + $orderDetail->qty;
                            $productStock->update();
                        }
                    }
                }
                $product = Product::find($orderDetail->product_id);
                $product->stock_qty = $product->stock_qty + $orderDetail->qty;
                $orderDetail->delivery_status = $request->status;
                $orderDetail->update();
                $product->update();
            }
        }
        $order->delivery_status = $request->status;
        $order->save();

        $order_detail = OrderDetail::where('order_id', $order->id)->get();
        foreach ($order_detail as $item) {
            $item->delivery_status = $request->status;
            $item->save();
        }
        if ($order->delivery_status == 'delivered') {
            if ($order->collectable_amount > $order->grand_total) {
                $user = User::where('id', $order->user_id)->first();
                $extraAmount = $order->collectable_amount - $order->grand_total;
                $user->wallet_balance = $user->wallet_balance + $extraAmount;
                $user->save();
                $wallet = WalletTransaction::where('user_id', $user->id)->where('amount', $extraAmount)->first();
                $wallet->delete();
            }
        }
        return response()->json(['success' => 'Delivery status has been updated']);
    }



    /*================= Start admin_user_update Methoed ================*/
    public function admin_user_update(Request $request, $id)
    {
        $user = Order::where('id', $id)->update([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
        ]);

        // dd($user);

        Session::flash('success', 'Customer Information Updated Successfully');
        return redirect()->back();
    }

    /* ============= Start getdivision Method ============== */
    public function getdivision($division_id)
    {
        $division = District::where('division_id', $division_id)->orderBy('district_name_en', 'ASC')->get();

        return json_encode($division);
    }
    /* ============= End getdivision Method ============== */

    /* ============= Start getupazilla Method ============== */
    public function getupazilla($district_id)
    {
        $upazilla = Upazilla::where('district_id', $district_id)->orderBy('name_en', 'ASC')->get();

        return json_encode($upazilla);
    }
    /* ============= End getupazilla Method ============== */

    /* ============= Start invoice_download Method ============== */
    // public function invoice_download($id){
    //     $order = Order::findOrFail($id);

    //     $pdf = PDF::loadView('backend.invoices.invoice',compact('order'))->setPaper('a4')->setOptions([
    //             'tempDir' => public_path(),
    //             'chroot' => public_path(),
    //     ]);
    //     return $pdf->download('invoice.pdf');
    // } // end method

    /* ============= Start invoice_download Method ============== */
    public function invoice_download($id)
    {
        $order = Order::findOrFail($id);
        //dd(app('url')->asset('upload/abc.png'));
        $pdf = PDF::loadView('backend.invoices.invoice', compact('order'))->setPaper('a4');
        return $pdf->download('invoice.pdf');
    } // end method
    /* ============= End invoice_download Method ============== */
    public function invoice_print_download($id)
    {
        //dd($id);
        $order = Order::findOrFail($id);
        //dd(app('url')->asset('upload/abc.png'));
        // $pdf = PDF::loadView('backend.invoices.invoice',compact('order'))->setPaper('a4');
        // dd($pdf);
        return view('backend.invoices.invoice_print', compact('order'));
        // return $pdf->loadView('invoice.pdf');
    } // end method
    public function reseller_invoice_print_download($id)
    {
        $order = Order::findOrFail($id);
        return view('backend.invoices.reseller_invoice_print', compact('order'));
    } // end method
    public function vendor_show_status($id)
    {
        //dd($id);
        $order = Order::findOrFail($id);
        $order->vendor_show_status = $order->vendor_show_status == 1 ? 0 : 1;
        $order->save();
        $notification = array(
            'message' => 'Show status Change Successfully',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    } // end method


    public function order_product_courierSend(Request $request)
    {
        $ids = $request->ids;
        $orders = Order::whereIn('id', $ids)->get();
        $status = 'shipped';
        Order::whereIn('id', $ids)->update(['delivery_status' => $status]);
        $data = [];
        foreach ($orders as $order) {
            $item['invoice'] = $order->invoice_no;
            $item['recipient_name'] = $order->name;
            $item['recipient_phone'] = $order->phone;
            $item['recipient_address'] = $order->address;
            $item['cod_amount'] = $order->due_amount;
            $item['note'] = '';

            $data[] = $item;
        }
        $steadfast = new StendFastCourierController();
        $result = $steadfast->bulkCreate(json_encode($data));
        return response()->json([
            'status' => 'success',
            'message' => "Products are Shipped",
            'resultData' => $result,
        ]);
    }
}
