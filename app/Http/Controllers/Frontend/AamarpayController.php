<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Session;
use Auth;
use App\TempOrder;

class AamarpayController extends Controller
{
    public function index(){
        // if (Auth::user()->phone == null) {
        //     // flash('Please add phone number to your profile')->warning();
        //     return redirect()->route('users.profile')->with('warning','Please add phone number to your profile.');
        // }
        
        // if (Auth::user()->email == null) {
        //     $email = 'customer@exmaple.com';
        // }else{
        //     $email = Auth::user()->email;
        // }

        $email = 'nawshad@gmail.com';
        $name = 'nawshad';
        $phone = '01755352842';

        // if (get_setting('aamarpay_sandbox') == 1) {
        //     $url = 'https://sandbox.aamarpay.com/request.php'; // live url https://secure.aamarpay.com/request.php
        // }
        // else {
        //     $url = 'https://secure.aamarpay.com/request.php';
        // }
        $url = 'https://sandbox.aamarpay.com/request.php';

        $amount = 0;
        if(Session::has('payment_amount')){
            $amount = round(Session::get('payment_amount'));
        }

        $fields = array(
            'store_id' => env('AAMARPAY_STORE_ID'), //store id will be aamarpay,  contact integration@aamarpay.com for test/live id
            'amount' => $amount, //transaction amount
            'payment_type' => 'VISA', //no need to change
            'currency' => 'BDT',  //currenct will be USD/BDT
            'tran_id' => rand(1111111,9999999), //transaction id must be unique from your end
            'cus_name' => $name,  //customer name
            'cus_email' => $email, //customer email address
            'cus_add1' => '',  //customer address
            'cus_add2' => '', //customer address
            'cus_city' => '',  //customer city
            'cus_state' => '',  //state
            'cus_postcode' => '', //postcode or zipcode
            'cus_country' => 'Bangladesh',  //country
            'cus_phone' => $phone, //customer phone number
            'cus_fax' => 'Not¬Applicable',  //fax
            'ship_name' => '', //ship name
            'ship_add1' => '',  //ship address
            'ship_add2' => '',
            'ship_city' => '',
            'ship_state' => '',
            'ship_postcode' => '',
            'ship_country' => 'Bangladesh',
            'desc' => env('APP_NAME').' payment',
            'success_url' => route('aamarpay.success'), //your success route
            'fail_url' => route('aamarpay.fail'), //your fail route
            'cancel_url' => route('checkout'), //your cancel url
            'opt_a' => 'Aamarpay',  //optional paramter
            'opt_b' => Session::get('invoice_no'),
            'opt_c' => '',
            'opt_d' => '',
            'signature_key' => env('AAMARPAY_SIGNATURE_KEY') //signature key will provided aamarpay, contact integration@aamarpay.com for test/live signature key
        );

        $fields_string = http_build_query($fields);

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_VERBOSE, true);
        curl_setopt($ch, CURLOPT_URL, $url);

        curl_setopt($ch, CURLOPT_POSTFIELDS, $fields_string);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        $url_forward = str_replace('"', '', stripslashes(curl_exec($ch)));
        curl_close($ch);

        $this->redirect_to_merchant($url_forward);
    }

    function redirect_to_merchant($url) {
        // if (get_setting('aamarpay_sandbox') == 1) {
        //     $base_url = 'https://sandbox.aamarpay.com/';
        // }
        // else {
        //     $base_url = 'https://secure.aamarpay.com/';
        // }
        $base_url = 'https://sandbox.aamarpay.com/';

        ?>
        <html xmlns="http://www.w3.org/1999/xhtml">
          <head><script type="text/javascript">
            function closethisasap() { document.forms["redirectpost"].submit(); }
          </script></head>
          <body onLoad="closethisasap();">

            <form name="redirectpost" method="post" action="<?php echo $base_url.$url; ?>"></form>

          </body>
        </html>
        <?php
        exit;
    }


    public function success(Request $request){
        // $payment_type = $request->opt_a;

        // if ($payment_type == 'cart_payment') {
        //     $checkoutController = new CheckoutController;
        //     return $checkoutController->checkout_done($request->opt_b, json_encode($request->all()));
        // }

        // if ($payment_type == 'wallet_payment') {
        //     $walletController = new WalletController;
        //     return $walletController->wallet_payment_done(json_decode($request->opt_c), json_encode($request->all()));
        // }

        // if ($payment_type == 'customer_package_payment') {
        //     $customer_package_controller = new CustomerPackageController;
        //     return $customer_package_controller->purchase_payment_done(json_decode($request->opt_c), json_encode($request->all()));
        // }
        // if($payment_type == 'seller_package_payment') {
        //     $seller_package_controller = new SellerPackageController;
        //     return $seller_package_controller->purchase_payment_done(json_decode($request->opt_c), json_encode($request->all()));
        // }
        //dd($request);

        $temp_order = TempOrder::findOrFail(Session::get('order_id'));
        $temp_order->payment_method_name = 'Aamarpay';
        $temp_order->payment_info = json_encode($request->all());
        $temp_order->payment_status = 'paid';
        $temp_order->txd_id = $request->mer_txnid;
        $temp_order->txd_acc = $request->card_number;
        $temp_order->save();

        $checkoutController = new CheckoutController;
        return $checkoutController->success($temp_order);

        $checkout_type = Session::get('checkout_type');

        if($checkout_type == 'cart_checkout'){

            $checkout_request = new Request;
            $checkout_request = new Request(Session::get('buy_checkout_request'));
            $checkout_request->payment_info = json_encode($request->all());
            $checkout_request->transaction_id = $request->mer_txnid;
            $checkout_request->account_number = $request->card_number;
            $orderController = new OrderController;

            notify()->success("Payment Successfull", "Congratulations");
            return $orderController->orderStore($checkout_request);

        }elseif($checkout_type == 'buy_checkout'){

            $checkout_request = new Request;
            $checkout_request = new Request(Session::get('buy_checkout_request'));
            $checkout_request->payment_info = json_encode($request->all());
            $checkout_request->transaction_id = $request->mer_txnid;
            $checkout_request->account_number = $request->card_number;
            $orderController = new OrderController;

            notify()->success("Payment Successfull", "Congratulations");
            return $orderController->orderBuyNowStore($checkout_request);

        }elseif($checkout_type == 'partial'){
            PartialPayment::create([
                'order_id'=>Session::get('order_id'),
                'payment_method'=>Session::get('payment_method_name'),
                'transaction_id'=>$request->mer_txnid,
                'amount'=>Session::get('payment_amount'),
            ]);
            return redirect()->route('order.pay.form', Session::get('order_order_id'))->with('paymentSuccess', 'Aamarpay payment successful');
        }elseif($checkout_type == 'wallet'){
            Auth::user()->wallate = auth()->user()->wallate + Session::get('payment_amount');
            notify()->success("Wallet Recharge Successfull", "Congratulations!");
            return redirect()->route('wallet')->with('paymentSuccess', 'bKash Online payment successful');
        }
    }

    public function fail(Request $request){
        //flash(translate('Payment failed'))->error();
    	//return redirect()->route('checkout.index')->with('error','Payment failed.');
        
        //notify()->warning("Payment Failed", "Failed");
        
        //return redirect()->route('checkout')->with('checkoutError', 'Payment Failed');
        //dd($request);

        $checkout_type = Session::get('checkout_type');
        if($checkout_type == 'cart_checkout'){
            return redirect()->route('checkout')->with('checkoutError', 'Payment Failed');
        }elseif($checkout_type == 'buy_checkout'){
            $checkout_request = new Request;
            $checkout_request = new Request(Session::get('buy_checkout_request'));
            notify()->warning("Payment failed", "Failed!");
            return redirect()->route('buy.product', $checkout_request)->with('checkoutError', 'Payment Failed');
        }elseif($checkout_type == 'partial'){
            return redirect()->route('order.pay.form', Session::get('order_order_id'))->with('checkoutError', 'Payment Failed');
        }elseif($checkout_type == 'wallet'){
            notify()->warning("Sorry, please try again", "Something Wrong");
            return redirect()->route('wallet');
        }
    }
}
