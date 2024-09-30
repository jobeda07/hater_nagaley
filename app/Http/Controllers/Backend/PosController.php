<?php

namespace App\Http\Controllers\Backend;

use Auth;
use App\Models\User;
use App\Models\Brand;
use App\Models\Order;
use App\Models\Staff;
use App\Models\Vendor;
use App\Models\Address;
use App\Models\PosCart;
use App\Models\Product;
use App\Models\Setting;
use App\Models\Category;
use App\Models\Attribute;
use App\Models\AccountHead;
use App\Models\OrderDetail;
use App\Models\ProductStock;
use Illuminate\Http\Request;
use App\Models\AccountLedger;
use App\Models\AttributeValue;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Session;

class PosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::where('status', 1)->latest()->get();
        // dd($products);
        $staffs = Staff::latest()->get();
        $categories = Category::where('status', 1)->latest()->get();
        $brands = Brand::where('status', 1)->latest()->get();
        $customers = User::where('role', 3)->where('status', 1)->latest()->get();
        //return $products;
        return view('backend.pos.index', compact('products', 'categories', 'brands', 'customers','staffs'));
    }

    public function getProduct($id)
    {
        $stockProduct=ProductStock::findOrFail($id);
        if($stockProduct){
            $product = Product::where('id',$stockProduct->product_id)->first();
        }else{
            $product = Product::findOrFail($id);
        }
        return json_encode($product);
    }
    public function add_pos_product(Request $request)
    {
        if ($request->product_id) {
            $prod_check = Product::where('id', $request->product_id)->first();
            if ($prod_check->stock_qty == 0) {
                return response()->json(['error' => "Product stock out"]);
            }
            $stock_id = $request->stock_id;
            $prod_attr = ProductStock::where('id', $stock_id)->first();
            if ($stock_id = null) {
                if ($prod_check->stock_qty == 0) {
                    return response()->json(['error' => "Product stock out"]);
                }
            }
            if (isset($stock_id)) {
                if ($prod_check->id = $prod_attr->product_id) {
                    if ($prod_attr->qty == 0) {
                        return response()->json(['error' => "Product stock out"]);
                    }
                }
            }
            $admin_id = auth()->user()->id ?? null;

            $s_id = session()->get('session_id');
            if ($s_id == null) {
                session()->put('session_id', uniqid());
                $s_id = session()->get('session_id');
            }

            if ($admin_id != null) {
                $posCart = PosCart::where('admin_id', $admin_id)
                    ->where('product_id', $request->product_id)->where('stock_id', $request->stock_id)
                    ->first();
            } else {

                $posCart = PosCart::where('session_id', $s_id)
                    ->where('product_id', $request->product_id)->where('stock_id', $request->stock_id)
                    ->first();
            }
            if ($posCart) {
                return response()->json(['error' => $prod_check->name . " Allready Added to cart"]);
            } else {

                $posCart =  PosCart::create([
                    'admin_id'          => auth()->user()->id ?? null,
                    'session_id'          => $s_id,
                    'product_id'          => $request->product_id,
                    'stock_id'          => empty($request->stock_id) ? null : $request->stock_id,
                    'quantity'          => 1,
                ]);
            }
            $posCart = session()->get('posCart');

            $posCart[$request->product_id] = [
                "id" => $request->product_id,
            ];
            session()->put('posCart', $posCart);
            return response()->json([ 'status' => 'success','message' => "Added to Cart"]);
        }
    }
    public function getPosCartData()
    {
        $date_now = \Carbon\Carbon::now()->format('Y-m-d H:i:s');
        $setting = Setting::latest()->first();
        $taxTotalPrice = 0;
        $grandTotalPrice = 0;
        $shipping_price = 0;
        $taxTotal = 0;
        $totalPrice = 0;
        $totalbuyingPrice = 0;
        $admin_id    = auth()->user()->id ?? null;
        $count = 0;
        $shipping_price = 0;
            $discount_price = 0;
        if ($admin_id != null) {
            $pos_cart_data = PosCart::where('admin_id', $admin_id)
                ->orderBy('id', 'desc')
                ->get();
        } else {
            $s_id = session()->get('session_id');
            $pos_cart_data = PosCart::where('session_id', $s_id)
                ->orderBy('id', 'desc')
                ->get();
            foreach ($pos_cart_data as $key => $value) {
                if($value->stock_id){
                    $stock=ProductStock::find($value->stock_id);
                    if ($value->product->discount_type == 1) {
                        $price_after_discount = $stock->price - $value->product->discount_price;
                    } elseif ($value->product->discount_type == 2) {
                        $price_after_discount = $stock->price - ($stock->price * $value->product->discount_price) / 100;
                    }
                    $totalPrice += ($value->product->discount_price ? $price_after_discount : $stock->price) * $value->quantity;

                }else{
                    if ($value->product->discount_type == 1) {
                        $price_after_discount = $value->product->regular_price - $value->product->discount_price;
                    } elseif ($value->product->discount_type == 2) {
                        $price_after_discount = $value->product->regular_price - ($value->product->regular_price * $value->product->discount_price) / 100;
                    }
                    $totalPrice += ($value->product->discount_price ? $price_after_discount : $value->product->regular_price) * $value->quantity;
                }
                $totalbuyingPrice += $value->product->purchase_price * $value->quantity;
                $count += $value->quantity;
            }
            // Now calculate tax based on the retrieved $setting
            if ($setting) {
                $taxTotal = ($totalPrice * $setting->product_vat) / 100;
                $taxTotalPrice = $totalPrice + $taxTotal;
            }
        }
        return response()->json([
            'cart_data' => view('backend.include.cart_item', compact('pos_cart_data', 'setting'))->render(),
            'totalPrice' => $taxTotalPrice, 'count' => $count, 'taxAmount' => $taxTotal, 'shipping_price' => $shipping_price,
            'discount_price' => $discount_price, 'totalbuyingPrice' => $totalbuyingPrice,
        ]);
    }
    public function posdelete($id)
    {
        if ($id == 0) {
            $admin_id    = auth()->user()->id ?? null;
            if ($admin_id != null) {
                $posCart = PosCart::where('admin_id', $admin_id);
            } else {
                $s_id       = session()->get('session_id');
                if (!$s_id) {
                    abort(404);
                }
                $posCart = PosCart::where('session_id', $s_id);
            }
        } else {
            $posCart   = PosCart::findorFail($id);
            $product_id = $posCart->product_id;
            $wl         = session()->get('posCart');
            unset($wl[$product_id]);
            session()->put('posCart', $wl);
        }
        Artisan::call('cache:clear');
        if ($posCart) {
            $posCart->delete();
            return response()->json([ 'status' => 'success','message' => "Deleted From Item"]);
        }
        return response()->json(['error'=> 'This product isn\'t available in your POS']);
    }
    public function updatePosCart(Request $request)
    {
        $product_id = $request->input('product_id');
        $stock_id = $request->input('stock_id');
        $type = $request->input('type');
        $s_id       = session()->get('session_id');
        $prod_check = Product::where('id', $product_id)->first();
        $prod_attr = ProductStock::where('id', $stock_id)->where('product_id', $product_id)->first();
        $cart = PosCart::where('product_id', $product_id)->where('stock_id', $stock_id)->where('session_id', $s_id)->first();
        if ($cart){
            if ($cart->product->discount_type == 1) {
                $price_after_discount = $cart->product->regular_price - $cart->product->discount_price;
            } elseif ($cart->product->discount_type == 2) {
                $price_after_discount = $cart->product->regular_price - ($cart->product->regular_price * $cart->product->discount_price) / 100;
            }
            if($type == '+'){
                if (isset($stock_id)){
                    if ($prod_attr->qty == $cart->quantity) {
                        return response()->json(['error'=> 'Product stock limited']);
                    }
                    if ($prod_attr->qty < $cart->quantity) {
                       return response()->json(['error'=> 'Product stock limited']);
                    }
                }
                if (!isset($stock_id)){
                    if ($prod_check->stock_qty == $cart->quantity) {
                       return response()->json(['error'=> 'Product stock limited']);
                    }
                    if ($cart->quantity > $prod_check->stock_qty) {
                        return response()->json(['error'=> 'Product stock limited']);
                    }
                }
                $cart->quantity += 1;
            } else {
                if ($cart->quantity == 1){
                    return response()->json(['error'=> 'Product stock limited']);
                }
                $cart->quantity -= 1;
            }
            $cart->save();
            return response()->json([
                'status' => 'success',
                'message' => "Quantity update successfully",
                'type' => $type,
                'price' => $cart->product->discount_price ? $price_after_discount : $cart->product->regular_price,
            ]);
        }
    }
    public function filter(Request $request)
    {
         $categoryId=$request->category_id;
         $search_product=$request->search_product;
         $products = Product::where('status', 1)->get();
         if($categoryId){
            $products = Product::where('category_id', $categoryId)->where('status', 1)->get();
         }
         if($search_product){
            $products = Product::where('name_en', 'like', '%'.$search_product.'%')->where('status', 1)->get();
         }
        return view('backend.pos.product',compact('products'));
    }

    public function barcode_search_ajax($id)
    {
        $product_barcode = Product::where('product_code',$id)->first();
        if($product_barcode != null){
            $product_stock = ProductStock::with('product')->where('product_id',$product_barcode->id)->get();
            return json_encode($product_stock);
        }else{
            $product_barcode = ProductStock::where('stock_code',$id)->first();
            $product_stock_barcode = DB::table('products')
            ->join('product_stocks', 'products.id', '=', 'product_stocks.product_id')
            ->where('status', 1)
            ->where('products.id',$product_barcode->product_id)
            ->get();
            return json_encode($product_stock_barcode);
        }
    }

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
        $s_id      = session()->get('session_id');
        $carts     = PosCart::where('session_id', $s_id)
            ->with('productStock')
            ->orderBy('id', 'desc')
            ->get();
        if ($carts->count() == 0) {
            //$alert = ['danger', 'Please add the product to your cart first, then proceed to the sale.'];
            $notification = array(
                'message' => 'Please add the product to your cart first, then proceed to the sale ',
                'alert-type' => 'error'
            );
            return redirect()->back()->with($notification);
        }
        $request->validate([
            'grand_total'           => 'required',
            'paid_amount'           => 'nullable',
        ]);
        if($request->payment_method == NULL) {
            $request->payment_method = "cash";
        }
        if ($request->due_amount == 0.00) {
            $payment ='paid';
        } else {
            $payment ='unpaid';
        }
        $invoice_data = Order::orderBy('id', 'desc')->first();
        if($invoice_data){
            $lastId = $invoice_data->id;
            $id = str_pad($lastId + 1, 7, 0, STR_PAD_LEFT);
            $invoice_no = $id;
        }else{
            $invoice_no = "0000001";
        }
        if ($request->staff_id) {
            $staff = Staff::where('id', $request->staff_id)->first();
            $staff_commission = (($request->grand_total / 100) * $staff->user->commission);
        } else {
            $staff_commission = 0;
        }
        $gust_user = User::where('role', 4)->first();
        if ($request->user_id == 1) {
            $customer = $gust_user->id;
            $user_name = $gust_user->name;
            $user_email = $gust_user->email;
            $user_phone = $gust_user->phone;
            $user_address = $gust_user->address;
            $address_division = 0;
            $address_district = 0;
            $address_upazilla = 0;
        } else {
            $customer = $request->user_id;
            $find_user = User::findOrFail($request->user_id);
            $user_name = $find_user->name;
            $user_email = $find_user->email;
            $user_phone = $find_user->phone;
            $user_address = $find_user->address;
            $find_address = Address::where('user_id', $request->user_id)->first();
            $address_division = $find_address->division_id ?? null;
            $address_district = $find_address->district_id ?? null;
            $address_upazilla = $find_address->upazilla_id ?? null;
        }
        if ($request->paid_amount == '') {
            $notification = array(
                'message' => 'The Paid amount can not be null ',
                'alert-type' => 'error'
            );
            return redirect()->back()->with($notification);
        }
        if ($request->user_id == 1) {
            if ($request->due_amount > 0) {
                $notification = array(
                    'message' => 'Walking Customer Not allow Due amount',
                    'alert-type' => 'error'
                );
                return redirect()->back()->with($notification);
            }
        }
        $order = Order::create([
            'user_id'           => $customer,
            'staff_id'          => $request->staff_id,
            'grand_total'       => $request->grand_total,
            'sub_total'         => $request->subtotal,
            'discount'          => $request->discount,
            'paid_amount'       => $request->paid_amount,
            'due_amount'        => $request->due_amount,
            'payment_method'    => $request->payment_method,
            'payment_status'    => $payment,
            'invoice_no'        => $invoice_no,
            'delivery_status'   => 'pending',
            'name'              => $user_name,
            'phone'             => $user_phone,
            'email'             => $user_email,
            'division_id'       => $address_division,
            'district_id'       => $address_district,
            'upazilla_id'       => $address_upazilla,
            'address'           => $user_address,
            'type'              => 1,
            'sale_type'         => 1,
        ]);
        // order details add //
        foreach ($carts as $cart) {
            if($cart->product->is_varient == 1){
                $stockproduct = ProductStock::where('id', $cart->stock_id)->first();
                $getPrice=$stockproduct->price;
            }else{
                $getPrice=$cart->product->regular_price;
            }
            if ($cart->product->discount_type == 1) {
                if($cart->product->is_varient == 1){
                    $stockproduct = ProductStock::where('id', $cart->stock_id)->first();
                    $price_after_discount = $stockproduct->price - $cart->product->discount_price;
                }else{
                    $price_after_discount = $cart->product->regular_price - $cart->product->discount_price;
                }
            } elseif ($cart->product->discount_type == 2) {
                if($cart->product->is_varient == 1){
                    $stockproduct = ProductStock::where('id', $cart->stock_id)->first();
                    $price_after_discount = $stockproduct->price - ($stockproduct->price * $cart->product->discount_price) / 100;
                }else{
                    $price_after_discount = $cart->product->regular_price - ($cart->product->regular_price * $cart->product->discount_price) / 100;
                }
            }
            $Price = ($cart->product->discount_price ? $price_after_discount : $getPrice);
            $product = Product::where('id', $cart->product_id)->first();
            if ($cart->product->vendor_id == 0) {
                $vendor_comission = 0.00;
                $vendor = 0;
            } else {
                $vendor = Vendor::where('user_id', $cart->product->vendor_id)->select('vendors.commission', 'user_id')->first();
                $vendor_comission = ($cart->price * $vendor->commission) / 100;
            }
            if ($cart->product->is_varient == 1) {
                $stockproductId = ProductStock::where('id', $cart->stock_id)->first();
                $stockproductvarient = $stockproductId->varient;
                $varientdivided = explode('-', $stockproductvarient);
                $variations = array();
                foreach ($varientdivided as $onevarient) {
                    $attribute_value = AttributeValue::where('value', $onevarient)->first();
                    if ($attribute_value) {
                        $attribute_id = $attribute_value->attribute_id;
                        $attribute = Attribute::find($attribute_id);
                        if ($attribute) {
                            $item = [
                                'attribute_name' => $attribute->name,
                                'attribute_value' => $attribute_value->value,
                            ];
                            $variations[] = $item;
                        }
                    }
                }
                OrderDetail::insert([
                    'order_id' => $order->id,
                    'product_id' => $cart->product_id,
                    'product_name' => $cart->product->name_en,
                    'is_varient' => 1,
                    'vendor_id' => $vendor->user_id ?? 0,
                    'v_comission' => $vendor_comission,
                    'variation' => json_encode($variations, JSON_UNESCAPED_UNICODE),
                    'qty' => $cart->quantity,
                    'price' => $Price,
                ]);
                $stock = ProductStock::where('varient', $cart->productStock->varient)->first();
                // dd($cart);
                if ($stock) {
                    $stock->qty = $stock->qty - $cart->quantity;
                    $stock->save();
                    //return $stock;
                }
            } else {
                OrderDetail::insert([
                    'order_id' => $order->id,
                    'product_id' => $cart->product->id,
                    'product_name' => $cart->product->name_en,
                    'is_varient' => 0,
                    'vendor_id' => $vendor->user_id ?? 0,
                    'v_comission' => $vendor_comission,
                    'qty' => $cart->quantity,
                    'price' => $Price,
                ]);
            }
            $product->stock_qty = $product->stock_qty - $cart->quantity;
            $product->save();
            if (Product::where('id', $cart->product_id)->exists()) {
                $removeSession = PosCart::where('product_id', $cart->product_id)->where('session_id', $s_id)->first();
                if ($removeSession !== null) {
                    $removeSession->delete();
                } else {
                }
            }
        }
        //Ledger Entry
        if($order->due_amount == 0){
            $ledger = AccountLedger::create([
                'account_head_id' => 2,
                'particulars' => 'Invoice No: '.$invoice_no,
                'credit' => $order->grand_total,
                'order_id' => $order->id,
                'type' => 2,
            ]);
            $ledger->balance = get_account_balance() + $order->grand_total;
            $ledger->save();
        }
        $amount = 0;
        foreach($order->order_details as $order_detail){
            $product_purchase_price = $order_detail->product->purchase_price;
            $amount+=$product_purchase_price;
        }
        $order->pur_sub_total = $amount;
        $order->save();
        Session::flash('success','Order Complete Successfully');
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
    /* ============== Customer Store Ajax ============ */
    public function customerInsert(Request $request)
    {
        $this->validate($request,[
            'name'              => 'required',
            'username'          => ['nullable', 'unique:users'],
            'phone'             => ['required','regex:/(\+){0,1}(88){0,1}01(3|4|5|6|7|8|9)(\d){8}/','min:11','max:15', 'unique:users'],
            'email'             => ['nullable', 'string', 'email', 'max:255', 'unique:users'],
            'address'           => 'required',
            'profile_image'     => 'nullable',
        ]);

        $customer = new User();
        if($request->hasfile('profile_image')){
            $image = $request->file('profile_image');
            $name_gen = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
            Image::make($image)->resize(300,300)->save('upload/user/'.$name_gen);
            $save_url = 'upload/user/'.$name_gen;
        }else{
            $save_url = '';
        }
        $customer->profile_image = $save_url;

        $customer->name     = $request->name;
        $customer->username = $request->username;
        $customer->phone    = $request->phone;
        $customer->email    = $request->email;
        $customer->address  = $request->address;
        $customer->role     = 3;
        $customer->status   = 1;
        $customer->password = Hash::make("12345678");
        $customer->save();

        $customers = User::where('role', 3)->orderBy('id','desc')->get();

        return response()->json([
            'success'=> 'Customer Inserted Successfully',
            'customers' => $customers,
        ]);
    }
    public function barcode_ajax($id)
    {
        $product_barcode = Product::where('product_code',$id)->first();
        // dd($product_barcode);
        if($product_barcode != null){
             //dd($product_barcode);
            return json_encode($product_barcode);
        }else{
            $product_stock_barcode = ProductStock::where('stock_code',$id)->first();
            //dd($product_stock_barcode);
            return json_encode($product_stock_barcode);
        }
    }
}
