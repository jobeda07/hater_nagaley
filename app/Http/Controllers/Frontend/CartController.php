<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use Gloudemans\Shoppingcart\Facades\Cart;
use Auth;
use Carbon\Carbon;
use Illuminate\Support\Facades\Session;
use App\Models\Category;
use App\Models\ProductStock;

class CartController extends Controller
{
    public function index(){
        // Header Category Start
        $categories = Category::orderBy('name_en','DESC')->where('status','=',1)->limit(5)->get();
        $carts = Cart::content();
        //dd($carts);
        return view('frontend.cart.index',compact('categories'));
    }
    /* ============ Start AddToCart Methoed ============ */
    public function AddToCart(Request $request, $id){
        //dd($request->all());
        $options = json_decode(stripslashes($request->get('options')));

        //dd($request);
        $attribute_ids = array();
        $attribute_names = array();
        $attribute_values = array();
        $product = Product::findOrFail($id);
        //dd($product);
        $carts = Cart::content();

        if(!$product->is_varient){
            $prev_cart_qty = 0;
            foreach($carts as $cart){
                if($cart->id == $id) {
                    $prev_cart_qty += $cart->qty;
                }
            }

            $qty = $prev_cart_qty + $request->quantity;

            if($qty > $product->stock_qty){
                return response()->json(['error'=> 'Not enough stock']);
            }
        }else{
            $prev_cart_qty = 0;
            foreach($carts as $cart){
                if($cart->id == $id) {
                    if($cart->options->varient == $request->product_varient){
                        $prev_cart_qty += $cart->qty;
                    }
                }
            }

            $qty = $prev_cart_qty + $request->quantity;
            $stock = ProductStock::where('product_id', $id)->where('varient', $request->product_varient)->first();

            if($qty > $stock->qty){
                return response()->json(['error'=> 'Not enough stock']);
            }
        }

        if($product->is_varient){
            foreach($options as $option){
                if($option->name == 'attribute_ids[]'){
                    $item = $option->value;
                    array_push($attribute_ids, $item);
                }else if($option->name == 'attribute_names[]'){
                    $item = $option->value;
                    array_push($attribute_names, $item);
                }else if($option->name == 'attribute_options[]'){
                    $item = $option->value;
                    array_push($attribute_values, $item);
                }
            }
        }

        if($request->product_price){
            $price = $request->product_price;
            $regular_price = $request->product_regular_price;
        }else{
            if(auth()->check() && auth()->user()->role==7){
                $price = $product->reseller_price;
                $regular_price = $product->regular_price;
            }else{
                if($product->discount_price > 0){
                    if($product->discount_type == 1){
                        $price = $product->regular_price - $product->discount_price;
                    }else{
                        $price = $product->regular_price - ($product->discount_price * $product->regular_price / 100);
                    }
                }else{
                    $price = $product->regular_price;
                }
            }
        }

    	if($product->is_varient){
            if(auth()->check() && auth()->user()->role==7){
                Cart::add([
                    'id' => $id,
                    'name' => $request->product_name,
                    'qty' => $request->quantity,
                    'price' => $price,
                    'weight' => 1,
                    'options' => [
                        'image' => $product->product_thumbnail,
                        'vendor' => $product->vendor_id,
                        'slug' => $product->slug,
                        'is_varient' => 1,
                        'regular_price' => $regular_price,
                        'varient' => $request->product_varient,
                        'attribute_ids' => $attribute_ids,
                        'attribute_names' => $attribute_names,
                        'attribute_values' => $attribute_values,
                    ],
                ]);
            }else{
                Cart::add([
                    'id' => $id,
                    'name' => $request->product_name,
                    'qty' => $request->quantity,
                    'price' => $price,
                    'weight' => 1,
                    'options' => [
                        'image' => $product->product_thumbnail,
                        'slug' => $product->slug,
                        'vendor' => $product->vendor_id,
                        'is_varient' => 1,
                        'varient' => $request->product_varient,
                        'attribute_ids' => $attribute_ids,
                        'attribute_names' => $attribute_names,
                        'attribute_values' => $attribute_values,
                    ],
                ]);
            }

            return response()->json(['success'=> 'Successfully Added on Your Cart']);
        }else{
            if(auth()->check() && auth()->user()->role==7){
                Cart::add([
                    'id' => $id,
                    'name' => $request->product_name,
                    'qty' => $request->quantity,
                    'price' => $price,
                    'weight' => 1,
                    'options' => [
                        'image' => $product->product_thumbnail,
                        'slug' => $product->slug,
                        'regular_price' => $regular_price,
                        'is_varient' => 0,
                    ],
                ]);
            }else{
                Cart::add([
                    'id' => $id,
                    'name' => $request->product_name,
                    'qty' => $request->quantity,
                    'price' => $price,
                    'weight' => 1,
                    'options' => [
                        'image' => $product->product_thumbnail,
                        'slug' => $product->slug,
                        'is_varient' => 0,
                    ],
                ]);
            }

		    return response()->json(['success'=> 'Successfully Added on Your Cart']);
        }
    }
    /* ============ End AddToCart Methoed =========== */

    /*=================== Start Mini Cart  Methoed ===================*/
    public function AddMiniCart(){

        $carts = Cart::content();
        $cartQty = Cart::count();
        $cartTotal = Cart::total();

        return response()->json(array(
            'carts' => $carts,
            'cartQty' => $cartQty,
            'cartTotal' => round($cartTotal),
        ));

    } // end method

    /*=================== End Mini Cart  Methoed ===================*/

    /*=========== Start Remove Mini Cart  Methoed ============*/
    public function RemoveMiniCart($rowId){

        Cart::remove($rowId);
        return response()->json(['success'=> 'Product Removed from Cart']);
    }

    /*============== End Remove Mini Cart  Methoed =============*/

    /* ================= Start GetCartProduct Method =================== */
    public function getCartProduct(){
        $carts = Cart::content();
        $cartQty = Cart::count();
        $cartTotal = Cart::total();

        return response()->json(array(
            'carts' => $carts,
            'cartQty' => $cartQty,
            'cartTotal' => $cartTotal,
        ));

    } //end method
    /* ================= End GetCartProduct Method =================== */

    /* ================= Start CartIncrement Method =================== */
    public function cartIncrement($rowId){
        $row = Cart::get($rowId);
        //dd($row);
        $id = $row->id;

        $product = Product::findOrFail($id);

        if(!$product->is_varient){
            $prev_cart_qty = 1;
            $carts = Cart::content();
            foreach($carts as $cart){
                if($cart->id == $id) {
                    $prev_cart_qty += $cart->qty;
                }
            }
            $qty = $prev_cart_qty;

            if($qty > $product->stock_qty){
                return response()->json(['error'=> 'Not enough stock']);
            }
        }else{
            $prev_cart_qty = 1;
            $carts = Cart::content();
            foreach($carts as $cart){
                if($cart->id == $id) {
                    if($cart->options->varient == $row->product_varient){
                        $prev_cart_qty += $cart->qty;
                    }
                }
            }
            $qty = $prev_cart_qty + $row->qty;
            $stock = ProductStock::where('product_id', $id)->where('varient', $row->options->varient)->first();

            if($qty > $stock->qty){
                return response()->json(['error'=> 'Not enough stock']);
            }
        }
        Cart::update($rowId, $row->qty + 1);
        return response()->json(['success'=> 'Successfully Added on Your Cart']);

    } // end mehtod

    /* ================= End CartIncrement Method =================== */

    /* ================= Start CartDecrement Method =================== */
    public function cartDecrement($rowId){

        $row = Cart::get($rowId);
        Cart::update($rowId, $row->qty - 1);
        return response()->json($row->qty);
    } // end method

    /* ================= End CartDecrement Method =================== */

    /* ================= Start RemoveCartProduct Method ============== */
    public function removeCartProduct($rowId){

        Cart::remove($rowId);
        return response()->json(['success' => 'Successfully Remove From Cart']);
    } // end method

    /* =============== Start RemoveCartProduct Method ============= */

    /* ================= Start Destroy Method ============== */
    public function destroy()
    {
        Cart::destroy();
        Session::flash('success','Cart Permanently Deleted Successfully.');
        return back();
    } // end method

    /* ================= Start Destroy Method ============== */
}
