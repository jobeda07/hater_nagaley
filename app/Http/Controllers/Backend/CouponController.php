<?php

namespace App\Http\Controllers\Backend;

use Session;
use Carbon\Carbon;
use App\Models\User;
use App\Models\Coupon;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CouponController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $coupons = Coupon::latest()->get();
        return view('backend.coupon.index', compact('coupons'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $users = User::latest()->get();
        $Products = Product::where('status',1)->latest()->get();
        return view('backend.coupon.create', compact('users','Products'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'coupon_code' => 'required|max:50',
            'limit_per_user' => 'required',
            'total_use_limit' => 'required',
            'expire_date' => 'required',
            'type' => 'required',
            'producttype' => 'required',
            'user_id' => 'nullable',
            'product_id' => 'nullable',
            'description' => 'nullable',
        ]);

        $coupon = new Coupon();
        $coupon->coupon_code = $request->coupon_code;
        $coupon->discount_type = $request->discount_type;
        $coupon->discount = $request->discount;
        $coupon->limit_per_user = $request->limit_per_user;
        $coupon->total_use_limit = $request->total_use_limit;
        $coupon->expire_date = $request->expire_date;
        $coupon->type = $request->type;
        $coupon->producttype = $request->producttype;
        $coupon->description = $request->description;

        if (is_array($request->user_id)) {
            $coupon['user_id'] = implode(',', $request->user_id);
        } else {
            $coupon['user_id'] = ''; // Set a default value or handle accordingly
        }
        if (is_array($request->product_id)) {
            $coupon['product_id'] = implode(',', $request->product_id);
        } else {
            $coupon['product_id'] = '';
        }
        $coupon->status = $request->status;
        $coupon->save();

        Session::flash('success','Coupon Inserted Successfully');
        return redirect()->route('coupons.index');
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
        $coupon = Coupon::findOrFail($id);
        $users = User::latest()->get();
        $Products = Product::where('status',1)->latest()->get();
        return view('backend.coupon.edit',compact('coupon','users','Products'));
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

        $coupon = Coupon::findOrFail($id);
        $this->validate($request,[
            'coupon_code' => 'required|max:50',
            'discount_type' => 'required',
            'discount' => 'required',
            'limit_per_user' => 'required',
            'total_use_limit' => 'required',
            'expire_date' => 'required',
            'type' => 'required',
            'producttype' => 'required',
            'user_id' => 'nullable',
            'description' => 'nullable',
        ]);

        $coupon->coupon_code        = $request->coupon_code;
        $coupon->discount_type      = $request->discount_type;
        $coupon->discount           = $request->discount;
        $coupon->limit_per_user     = $request->limit_per_user;
        $coupon->total_use_limit    = $request->total_use_limit;
        $coupon->expire_date        = $request->expire_date;
       // $coupon['user_id']          = is_array($request->user_id) ? implode(',', $request->user_id) : $request->user_id;
       if (is_array($request->user_id)) {
        $coupon['user_id'] = implode(',', $request->user_id);
        } else {
            $coupon['user_id'] = '';
        }
       if (is_array($request->product_id)) {
        $coupon['product_id'] = implode(',', $request->product_id);
        } else {
            $coupon['product_id'] = '';
        }
        if($request->type==1){
            $coupon['user_id'] = '';
        }
        if($request->producttype==1){
            $coupon['product_id'] = '';
        }
        $coupon->type               = $request->type;
        $coupon->producttype               = $request->producttype;
        $coupon->description        = $request->description;
        $coupon->status = $request->status;
        $coupon->save();

        Session::flash('success','Coupon Updated Successfully');
        return redirect()->route('coupons.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $coupon = Coupon::findOrFail($id);

        $coupon->delete();

        $notification = array(
            'message' => 'Coupon Deleted Successfully.',
            'alert-type' => 'error'
        );
        return redirect()->back()->with($notification);
    }
    /*=================== Start Active/Inactive Methoed ===================*/
    public function active($id){
        $coupon = Coupon::find($id);
        $coupon->status = 1;
        $coupon->save();

        Session::flash('success','Coupon Active Successfully.');
        return redirect()->back();
    }

    public function inactive($id){
        $coupon = Coupon::find($id);
        $coupon->status = 0;
        $coupon->save();

        Session::flash('warning','Coupon Inactive Successfully.');
        return redirect()->back();
    }
}
