<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Support\Facades\Session;
use Auth;

class OrderController extends Controller
{ 
	/* ============ User Orders ============== */
    public function index()
    {
       $orders = Order::where('user_id',Auth::id())->orderBy('id','DESC')->get();

       // dd($orders);
       return view('dashboard', compact('orders'));
    } // end method
}
