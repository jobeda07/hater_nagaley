<?php

namespace App\Http\Controllers\Frontend;

use Auth;
use App\Models\Order;
use App\Models\Coupon;
use App\Models\Address;
use App\Models\Product;
use App\Models\Category;
use App\Models\District;
use App\Models\Shipping;
use App\Models\Upazilla;
use App\Models\TempOrder;
use App\Models\AccountHead;
use App\Models\OrderDetail;
use App\Models\SmsTemplate;
use App\Utility\SmsUtility;
use App\Models\ProductStock;
use Illuminate\Http\Request;
use App\Models\AccountLedger;
use Illuminate\Support\Carbon;
use App\Utility\SendSMSUtility;
use App\Models\WalletTransaction;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;
use Gloudemans\Shoppingcart\Facades\Cart;
use App\Http\Controllers\Frontend\PublicSslCommerzPaymentController;

class CheckoutController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(!guest_checkout() && !auth()->check()){
            return redirect()->route('login');
        }
        $addresses = Address::where('status', 1)->get();
        $shippings = Shipping::where('status', 1)->get();

        $carts = Cart::content();
        $cartTotal = Cart::total();

        // dd($cartTotal);

        return view('frontend.checkout.index',compact('addresses','shippings', 'carts', 'cartTotal'));
    } // end method

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function complete()
    {
        if(!guest_checkout() && !auth()->check()){
            return redirect()->route('login');
        }

        if(auth()->check() && auth()->user()->prepaid_amount > 0){
        }else{
            return redirect()->route('home');
        }

        $addresses = Address::where('status', 1)->get();
        $shippings = Shipping::where('status', 1)->get();

        $carts = Cart::content();
        $cartTotal = Cart::total();
        return view('frontend.checkout.complete',compact('addresses','shippings', 'carts', 'cartTotal'));
    }

    public function shippingAjax($shipping_id){
        $shipping = Shipping::find($shipping_id);
        return json_encode($shipping);
    }

    /* ============== Start GetCheckoutProduct Method ============= */
    public function getCheckoutProduct(){
        $carts = Cart::content();
        $cartQty = Cart::count();
        $cartTotal = Cart::total();

        return response()->json(array(
            'carts' => $carts,
            'cartQty' => $cartQty,
            'cartTotal' => $cartTotal,
        ));

    } //end method
    /* ============= End GetCheckoutProduct Method ============== */

    /* ============= Start getdivision Method ============== */
    public function getdivision($division_id){
    $division = District::where('division_id', $division_id)->orderBy('district_name_en','ASC')->get();

        return json_encode($division);
    }
    /* ============= End getdivision Method ============== */

    /* ============= Start getupazilla Method ============== */
    public function getupazilla($district_id){
        $upazilla = Upazilla::where('district_id', $district_id)->orderBy('name_en','ASC')->get();

        return json_encode($upazilla);
    }
    /* ============= End getupazilla Method ============== */



    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
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
        //dd($request);
        $data = $request->validate([
            'name' => 'required|max:191',
            'email' => 'nullable|email|max:191',
            'phone' => ['required','regex:/(\+){0,1}(88){0,1}01(3|4|5|6|7|8|9)(\d){8}/','min:11','max:15'],
            'address' => 'required|max:10000',
            'payment_option'=>'required',
            'comment' => 'nullable|max:2000',
        ]);
        // dd(Cart::total()+$request->total_amount);
        // dd($request->total_amount);
        // if($request->payment_option == 'nagad'){
        //     return redirect()->route('checkout.payment');
        // }
        $carts = Cart::content();
        //dd($carts);

        if($carts->isEmpty()){
            $notification = array(
                'message' => 'Your cart is empty.',
                'alert-type' => 'error'
            );
            return redirect()->route('home')->with($notification);
        }

        // dd($request->all());

        if(Auth::check()){
            $user_id = Auth::id();
            if(Auth::user()->role == 7){
                $type = 3;
            }else{
                $type = 1;
            }
        }else{
            $user_id = 1;
            $type = 2;
        }

        if($request->payment_option == 'cod'){
            $payment_status = 'unpaid';
        }else{
            $payment_status = 'paid';
        }

        $invoice_data = Order::orderBy('id','desc')->first();

        if($invoice_data){
            $lastId = $invoice_data->id;
            // $idd = str_replace("E-", "", $lastId);
            $id = str_pad($lastId + 1, 7, 0, STR_PAD_LEFT);
            $invoice_no = $id;
        }else{
            $invoice_no = "0000001";
        }

        // order add //
        $order = Order::create([
            'user_id' => $user_id,
            'name' => $request->name,
            'sub_total' => $request->sub_total,
            'grand_total' => $request->grand_total,
            'prepaid_amount' => $request->prepaid_amount,
            'collectable_amount' => $request->collectable_amount,
            'shipping_charge' => $request->shipping_charge,
            'shipping_name' => $request->shipping_name,
            'shipping_type' => $request->shipping_type,
            'payment_method' => $request->payment_option,
            'payment_status' => $payment_status,
            // 'invoice_no' => date('Ymd-His') . rand(10, 99),
            'invoice_no' => $invoice_no,
            'delivery_status' => 'pending',
            'phone' => $request->phone,
            'email' => $request->email,
            'division_id' => $request->division_id,
            'district_id' => $request->district_id,
            'upazilla_id' => $request->upazilla_id,
            'address' => $request->address,
            'comment' => $request->comment,
            'type' => $type,
            'sale_type' => 2,
           // 'coupon_id' => $request->coupon_id,
           // 'coupon_discount' => $request->coupon_discount,
            //'created_by' => Auth::guard('admin')->user()->id,
        ]);

        $total_paid = $request->prepaid_amount + $request->collectable_amount;

        if($total_paid > $request->grand_total){
            $wallet_transaction = WalletTransaction::create([
                'user_id' => $user_id,
                'order_id' => $order->id,
                'amount' => $total_paid-$order->grand_total,
            ]);
        }

        // Auth::user()->prepaid_amount = 0;
        // Auth::user()->save();

        if(get_setting('otp_system')){
            $sms_template = SmsTemplate::where('name','order_message')->where('status',1)->first();
            if($sms_template){
                $sms_body       = $sms_template->body;
                $sms_body       = str_replace('[[order_code]]', $order->invoice_no, $sms_body);
                $sms_body       = str_replace('[[order_amount]]', $order->grand_total, $sms_body);
                $sms_body       = str_replace('[[site_name]]', env('APP_NAME'), $sms_body);

                if($order->pay_status == 1){
                    $payment_info = json_decode($order->payment_info);
                    $sms_body     = str_replace('[[payment_details]]', 'পেমেন্ট স্ট্যাটাসঃ paid'.', ট্রান্সেকশন আইডিঃ '.$order->transaction_id.', মাধ্যমঃ '.$order->payment_method.' ', $sms_body);
                }else{
                    $sms_body       = str_replace('[[payment_details]]', '', $sms_body);
                }

                if(substr($order->phone,0,3)=="+88"){
                    $phone = $order->phone;
                }elseif(substr($order->phone,0,2)=="88"){
                    $phone = '+'.$order->phone;
                }else{
                    $phone = '+88'.$order->phone;
                }
                //dd($phone);
                SendSMSUtility::sendSMS($phone, $sms_body);

                // $sms_body = str_replace('আপনার', 'নতুন', $sms_body);
                // $setting = Setting::where('name', 'phone')->first();
                // if($setting->value != null){
                //     $admin_phone=$setting->value;

                //     if(substr($admin_phone,0,3)=="+88"){
                //         $phone = $admin_phone;
                //     }elseif(substr($admin_phone,0,2)=="88"){
                //         $phone = '+'.$admin_phone;
                //     }else{
                //         $phone = '+88'.$admin_phone;
                //     }
                //     SendSMSUtility::sendSMS($admin_phone, $sms_body);
                // }
            }
        }


        // order details add //
        foreach ($carts as $cart) {
            // dd($cart);
            $product = Product::find($cart->id);
            if($cart->options->is_varient == 1){
                $variations = array();
                for($i=0; $i<count($cart->options->attribute_names); $i++){
                    $item['attribute_name'] = $cart->options->attribute_names[$i];
                    $item['attribute_value'] = $cart->options->attribute_values[$i];
                    array_push($variations, $item);
                }
                OrderDetail::insert([
                    'order_id' => $order->id,
                    'product_id' => $cart->id,
                    'product_name' => $cart->name,
                    'is_varient' => 1,
                    'variation' => json_encode($variations, JSON_UNESCAPED_UNICODE),
                    'qty' => $cart->qty,
                    'price' => $cart->price,
                    'tax' => $cart->tax,
                    'created_at' => Carbon::now(),
                ]);

                // stock calculation //
                $stock = ProductStock::where('varient', $cart->options->varient)->first();
                // dd($cart);
                if($stock){
                    // dd($stock);
                    $stock->qty = $stock->qty - $cart->qty;
                    $stock->save();
                }

            }else{
                OrderDetail::insert([
                    'order_id' => $order->id,
                    'product_id' => $cart->id,
                    'product_name' => $cart->name,
                    'is_varient' => 0,
                    'qty' => $cart->qty,
                    'price' => $cart->price,
                    'tax' => $cart->tax,
                    'created_at' => Carbon::now(),
                ]);
            }

            $product->stock_qty = $product->stock_qty - $cart->qty;
            $product->save();
        }

        Cart::destroy();

        //Ledger Entry
        $ledger = AccountLedger::create([
            'account_head_id' => 2,
            'particulars' => $cart->name,
            'credit' => $order->grand_total,
            'order_id' => $order->id,
            'type' => 2,
        ]);
        $ledger->balance = get_account_balance() + $order->grand_total;
        $ledger->save();

        $amount = 0;
        foreach($order->order_details as $order_detail){
            $product_purchase_price = $order_detail->product->purchase_price;
            $amount+=$order_detail->product->purchase_price;
        }
        //dd($amount);
        $order->pur_sub_total = $amount;
        //dd($order);
        $order->save();

        $notification = array(
            'message' => 'Your order has been placed successfully.',
            'alert-type' => 'success'
        );
        return redirect()->route('checkout.success', $order->invoice_no)->with($notification);
    }


    public function completeStore()
    {
        //dd('got it');
        $carts = Cart::content();
        //dd($carts);

        if($carts->isEmpty()){
            $notification = array(
                'message' => 'Your cart is empty.',
                'alert-type' => 'error'
            );
            return redirect()->route('home')->with($notification);
        }

        // dd($request->all());

        if(Auth::check()){
            $user_id = Auth::id();
            if(Auth::user()->role == 7){
                $type = 3;
            }else{
                $type = 1;
            }
        }else{
            $user_id = 1;
            $type = 2;
        }

        $payment_method = Session::get('payment_method');
        $collectable_amount = Session::get('collectable_amount');

        if($payment_method == 'cod'){
            $payment_status = 'unpaid';
        }else{
            $payment_status = 'paid';
        }

        $temp_order = TempOrder::where('user_id', $user_id)->first();

        $invoice_data = Order::orderBy('id','desc')->first();

        if($invoice_data){
            $lastId = $invoice_data->id;
            // $idd = str_replace("E-", "", $lastId);
            $id = str_pad($lastId + 1, 7, 0, STR_PAD_LEFT);
            $invoice_no = $id;
        }else{
            $invoice_no = "0000001";
        }

        // order add //
        $order = Order::create([
            'user_id' => $user_id,
            'name' => $temp_order->name,
            'sub_total' => $temp_order->sub_total,
            'grand_total' => $temp_order->grand_total,
            'prepaid_amount' => Auth::user()->prepaid_amount,
            'collectable_amount' => $collectable_amount,
            'shipping_charge' => $temp_order->shipping_charge,
            'shipping_name' => $temp_order->shipping_name,
            'shipping_type' => $temp_order->shipping_type,
            'payment_method' => $payment_method,
            'payment_status' => $temp_order->payment_status,
            // 'invoice_no' => date('Ymd-His') . rand(10, 99),
            'invoice_no' => $temp_order->invoice_no,
            'delivery_status' => $temp_order->delivery_status,
            'phone' => $temp_order->phone,
            'email' => $temp_order->email,
            'division_id' => $temp_order->division_id,
            'district_id' => $temp_order->district_id,
            'upazilla_id' => $temp_order->upazilla_id,
            'address' => $temp_order->address,
            'comment' => $temp_order->comment,
            'type' => $temp_order->type,

            //'created_by' => Auth::guard('admin')->user()->id,
        ]);

        $total_paid = Auth::user()->prepaid_amount + $collectable_amount;

        if($total_paid > $temp_order->grand_total){
            $wallet_transaction = WalletTransaction::create([
                'user_id' => $user_id,
                'order_id' => $order->id,
                'amount' => $total_paid-$order->grand_total,
            ]);
        }

        Auth::user()->prepaid_amount = 0;
        Auth::user()->save();

        if(get_setting('otp_system')){
            $sms_template = SmsTemplate::where('name','order_message')->where('status',1)->first();
            if($sms_template){
                $sms_body       = $sms_template->body;
                $sms_body       = str_replace('[[order_code]]', $order->invoice_no, $sms_body);
                $sms_body       = str_replace('[[order_amount]]', $order->grand_total, $sms_body);
                $sms_body       = str_replace('[[site_name]]', env('APP_NAME'), $sms_body);

                if($order->pay_status == 1){
                    $payment_info = json_decode($order->payment_info);
                    $sms_body     = str_replace('[[payment_details]]', 'পেমেন্ট স্ট্যাটাসঃ paid'.', ট্রান্সেকশন আইডিঃ '.$order->transaction_id.', মাধ্যমঃ '.$order->payment_method.' ', $sms_body);
                }else{
                    $sms_body       = str_replace('[[payment_details]]', '', $sms_body);
                }

                if(substr($order->phone,0,3)=="+88"){
                    $phone = $order->phone;
                }elseif(substr($order->phone,0,2)=="88"){
                    $phone = '+'.$order->phone;
                }else{
                    $phone = '+88'.$order->phone;
                }
                //dd($phone);
                SendSMSUtility::sendSMS($phone, $sms_body);

                // $sms_body = str_replace('আপনার', 'নতুন', $sms_body);
                // $setting = Setting::where('name', 'phone')->first();
                // if($setting->value != null){
                //     $admin_phone=$setting->value;

                //     if(substr($admin_phone,0,3)=="+88"){
                //         $phone = $admin_phone;
                //     }elseif(substr($admin_phone,0,2)=="88"){
                //         $phone = '+'.$admin_phone;
                //     }else{
                //         $phone = '+88'.$admin_phone;
                //     }
                //     SendSMSUtility::sendSMS($admin_phone, $sms_body);
                // }
            }
        }



        // order details add //
        foreach ($carts as $cart) {
            // dd($cart);
            $product = Product::find($cart->id);
            if($cart->options->is_varient == 1){
                $variations = array();
                for($i=0; $i<count($cart->options->attribute_names); $i++){
                    $item['attribute_name'] = $cart->options->attribute_names[$i];
                    $item['attribute_value'] = $cart->options->attribute_values[$i];
                    array_push($variations, $item);
                }
                OrderDetail::insert([
                    'order_id' => $order->id,
                    'product_id' => $cart->id,
                    'product_name' => $cart->name,
                    'is_varient' => 1,
                    'variation' => json_encode($variations, JSON_UNESCAPED_UNICODE),
                    'qty' => $cart->qty,
                    'price' => $cart->price,
                    'tax' => $cart->tax,
                    'created_at' => Carbon::now(),
                ]);

                // stock calculation //
                $stock = ProductStock::where('varient', $cart->options->varient)->first();
                // dd($cart);
                if($stock){
                    // dd($stock);
                    $stock->qty = $stock->qty - $cart->qty;
                    $stock->save();
                }

            }else{
                OrderDetail::insert([
                    'order_id' => $order->id,
                    'product_id' => $cart->id,
                    'product_name' => $cart->name,
                    'is_varient' => 0,
                    'qty' => $cart->qty,
                    'price' => $cart->price,
                    'tax' => $cart->tax,
                    'created_at' => Carbon::now(),
                ]);
            }

            $product->stock_qty = $product->stock_qty - $cart->qty;
            $product->save();
        }

        Cart::destroy();

        //Ledger Entry
        $ledger = AccountLedger::create([
            'account_head_id' => 2,
            'particulars' => 'Order ID: '.$order->id,
            'credit' => $order->grand_total,
            'order_id' => $order->id,
            'type' => 2,
        ]);
        $ledger->balance = get_account_balance() + $order->grand_total;
        $ledger->save();

        $notification = array(
            'message' => 'Your order has been placed successfully.',
            'alert-type' => 'success'
        );
        return redirect()->route('checkout.success', $order->invoice_no)->with($notification);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $order = Order::where('invoice_no', $id)->first();

        $notification = array(
            'message' => 'Your Order Successfully.',
            'alert-type' => 'success'
        );

        return view('frontend.order.order_confirmed', compact('order'))->with($notification);
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    // public function Myorders(){

    //     $orders = Order::where('user_id',Auth::id())->orderBy('id','DESC')->get();
    //     return view('frontend.user.order.order_view',compact('orders'));

    // }

    public function payment(Request $request){
        if($request->has('pre_payment')){
            //dd('okay');
            $request->grand_total = $request->prepayment_amount;
            $request->payment_option = $request->pre_payment_option;
            Session::put('payment_type', 'pre_payment');
        }else{
            Session::put('payment_type', 'cart_payment');
        }

        //dd($request);
        //dd($request->payment_option);
        if($request->payment_option == 'cod'){
            $checkout = new CheckoutController;
            return $checkout->store($request);
        }

        $payment_method = $request->payment_option;
        //$total_amount = Cart::total();
        $total_amount = $request->grand_total;
        $last_order = Order::orderBy('id','DESC')->first();
        $order_id = $last_order->id+1;
        $invoice_no = date('YmdHi').$order_id;
        Session::put('invoice_no', $invoice_no);

        Session::put('checkout_request', $request->all());

        if($request->has('pre_payment')){
            auth()->user()->prepaid_amount = $total_amount;
            auth()->user()->save();

            Session::put('collectable_amount', $request->collectable_amount);

            $temp_order = TempOrder::create([
                'user_id' => auth()->user()->id,
                'name' => $request->name,
                'sub_total' => $request->sub_total,
                'grand_total' => $request->grand_total,
                'shipping_charge' => $request->shipping_charge,
                'shipping_name' => $request->shipping_name,
                'shipping_type' => $request->shipping_type,
                'payment_method' => $request->payment_option,
                'payment_status' => 0,
                // 'invoice_no' => date('Ymd-His') . rand(10, 99),
                'invoice_no' => $invoice_no,
                'delivery_status' => 'pending',
                'phone' => $request->phone,
                'email' => $request->email,
                'division_id' => $request->division_id,
                'district_id' => $request->district_id,
                'upazilla_id' => $request->upazilla_id,
                'address' => $request->address,
                'comment' => $request->comment,
                'type' => 1,
                //'created_by' => Auth::guard('admin')->user()->id,
            ]);

            $notification = array(
                'message' => 'Pre Payment Successfull.',
                'alert-type' => 'success'
            );
            return redirect()->route('checkout.complete')->with($notification);
        }

        if($request->payment_option == 'cod'){
            return redirect()->route('checkout.completeStore');
        }else{
            Session::put('payment_method', $request->payment_option);
            //Session::put('payment_type', 'cart_payment');
            Session::put('payment_amount', $request->grand_total);
            if($request->payment_option == 'nagad'){
                $nagad = new NagadController;
                return $nagad->getSession();
            }else if($request->payment_option == 'bkash'){

                $bkash = new BkashController;
                return $bkash->pay();
            }elseif ($request->payment_option == 'sslcommerz') {
                $sslcommerz = new PublicSslCommerzPaymentController;
                return $sslcommerz->index($request);
            }elseif($payment_method == 'aamarpay'){
                $aamarpay = new AamarpayController;
                return $aamarpay->index();
            }
        }

        return view('frontend.checkout.payment', compact('payment_method', 'total_amount', 'invoice_no'));
    }

    public function completePayment(Request $request){


        Session::put('payment_method', $request->payment_option);
        Session::put('collectable_amount', $request->collectable_amount);

        if($request->payment_option == 'cod'){
            return redirect()->route('checkout.store');
        }else{
            //Session::put('payment_type', 'cart_payment');
            Session::put('payment_amount', $request->collectable_amount);
            if($request->payment_option == 'nagad'){
                $nagad = new NagadController;
                return $nagad->getSession();
            }else if($request->payment_option == 'bkash'){
                $bkash = new BkashController;
                return $bkash->pay();
            }elseif ($request->payment_option == 'sslcommerz') {
                $sslcommerz = new PublicSslCommerzPaymentController;
                return $sslcommerz->index($request);
            }elseif($request->payment_option == 'aamarpay'){
                $aamarpay = new AamarpayController;
                return $aamarpay->index();
            }
        }
    }

    public function success($orderId, $json){

        dd(json_decode($json));
    }


    public function coupon_get(Request $request){
        $carts = Cart::content();
        $coupon=Coupon::where('coupon_code',$request->coupon)->first();
        $now=Carbon::now();
        if($coupon){
            //status check
            if($coupon->status == 0){
                return response()->json(['error'=> 'Coupon Is Now InActive.']);
            }
            //expire date
            if($coupon->expire_date != ""){
                  $enddate= $coupon->expire_date;
                  if($now->gt($enddate)){
                    return response()->json(['error'=> 'Coupon Expired date.']);
                  }
            }
            //selected user
            if($coupon->user_id != null){
                $couponUserIds = explode(',', $coupon->user_id);
                foreach($couponUserIds as $userId){
                    $selectedId=$userId==Auth::user()->id;
                    if(!$selectedId){
                        return response()->json(['error'=> 'This coupon is intended for specific users']);
                    }
                }
            }
            //max uses
            $couponUsed=Order::where('coupon_id',$coupon->id)->count();
            if($couponUsed >=$coupon->total_use_limit){
                return response()->json(['error'=> 'Coupon Uses Out of Limit.']);
            }
            //max user uses
            if (Auth::check()) {
                $couponUserUsed = Order::where(['coupon_id' => $coupon->id, 'user_id' => Auth::user()->id])->count();
                if ($couponUserUsed >= $coupon->limit_per_user) {
                    return response()->json(['error' => 'You reached the maximum limit for using the coupon.']);
                }
            } else {
                return response()->json(['error' => 'User is not authenticated.']);
            }
            //if product Id
            if ($coupon->product_id != null) {
                $couponProductIds = explode(',', $coupon->product_id);
                $totalDiscount = 0;
                foreach ($carts as $cart) {
                    if (in_array($cart->id, $couponProductIds)) {
                        if ($coupon->discount_type == 1) {
                            $totalDiscount += $coupon->discount;
                        } else {
                            $discount = $cart->price * $coupon->discount / 100;
                            $totalDiscount += $discount;
                        }
                    }
                }
                if ($totalDiscount > 0) {
                    return response()->json([
                        'success' => 'Added your coupon',
                        'discount' => $totalDiscount,
                        'coupon' => $coupon
                    ]);
                } else {
                    return response()->json(['error' => 'No matching products for the coupon']);
                }
            }
            return response()->json(['success' => 'Added your coupon','coupon' => $coupon]);
        }else{
            return response()->json(['error'=> 'Coupon not found.']);
        }
    }
}
