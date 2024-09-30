<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin;
use App\Models\Product;
use App\Models\ProductStock;
use App\Models\Vendor;
use App\Models\Order;
use App\Models\User;
use Auth;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;
use Session;
use Artisan;
use Cache;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    /*=================== Start Index Login Methoed ===================*/
    public function Index(){

        if(Auth::check()){
            abort(404);
        }

    	return view('admin.admin_login');
    } // end method

    /*=================== End Index Login Methoed ===================*/

    /*=================== Start Dashboard Methoed ===================*/
       public function Dashboard(){

        $vendor = Vendor::where('user_id', Auth::guard('admin')->user()->id)->first();

        $userCount = DB::table('users')
            ->select(DB::raw('count(*) as total_users'))
            ->where('status', 1)
            ->where('role', 3)
            ->first();
        // Sale-Report Start
        $currentMonth = Carbon::now()->month;
        $todays_sale = Order::whereDate('created_at', '=', now()->toDateString())->get();
        $todays_sale_value  = Order::whereDate('created_at', '=', now()->toDateString())->sum('sub_total');
        $monthly_sale  = Order::whereMonth('created_at', $currentMonth)->get();
        $monthly_sale_value  = Order::whereMonth('created_at', $currentMonth)->sum('sub_total');
        $yearly_sale  = Order::whereYear('created_at', date('Y-m-d'))->get();
        $yearly_sale_value  = Order::whereYear('created_at', date('Y-m-d'))->sum('sub_total');
        // Sale-Report End
        
        
        // Purchases-Report Start
        // $todays_purchase  = Product::whereDay('created_at', '=', date('d'))->count();
        $todays_purchase = Product::whereDate('created_at', '=', now()->toDateString())->sum('stock_qty');
        $todays_purchase_value = DB::table('products')->whereDate('created_at', '=', now()->toDateString())->sum(DB::raw('purchase_price * stock_qty'));
    
    
        $monthly_purchase  = Product::whereMonth('created_at', $currentMonth)->sum('stock_qty');
        $monthly_purchase_value = DB::table('products')->whereMonth('created_at', $currentMonth)->sum(DB::raw('purchase_price * stock_qty'));
        $yearly_purchase  = Product::whereYear('created_at', date('Y-m-d'))->sum('stock_qty');
        $yearly_purchase_value = DB::table('products')->whereYear('created_at', date('Y-m-d'))->sum(DB::raw('purchase_price * stock_qty'));
         
        // Purchases-Report End


        if(Auth::guard('admin')->user()->role == '2'){
            $productCount = DB::table('products')
                ->select(DB::raw('count(*) as total_products'))
                ->where('vendor_id', Auth::guard('admin')->user()->id)
                ->where('status', 1)
                ->first();
                
            if($vendor){
                $productCount = DB::table('products')
                    ->select(DB::raw('count(*) as total_products'))
                    ->where('vendor_id', $vendor->id)
                    ->where('status', 1)
                    ->first();
            }
        }else{
            $productCount = DB::table('products')
                ->select(DB::raw('count(*) as total_products'))
                ->where('status', 1)
                ->first();
        }

        $categoryCount = DB::table('categories')
            ->select(DB::raw('count(*) as total_categories'))
            ->where('status', 1)
            ->first();

        $brandCount = DB::table('brands')
            ->select(DB::raw('count(*) as total_brands'))
            ->where('status', 1)
            ->first();

        $vendorCount = DB::table('vendors')
            ->select(DB::raw('count(*) as total_vendors'))
            ->where('status', 1)
            ->first();

        $orderCount = DB::table('orders')
            ->select(DB::raw('count(*) as total_orders, sum(grand_total) as total_sell'))
            ->first();
            
        $lowStockCount = DB::table('product_stocks as s')
            ->leftjoin('products as p', 's.product_id', '=', 'p.id')
            ->select(DB::raw('count(s.id) as total_low_stocks'))
            ->where('p.vendor_id', Auth::guard('admin')->user()->id)
            ->where('s.qty', '<=', 5)
            ->first();
            
        if($vendor){
            $lowStockCount = DB::table('product_stocks as s')
                ->leftjoin('products as p', 's.product_id', '=', 'p.id')
                ->select(DB::raw('count(s.id) as total_low_stocks'))
                ->where('p.vendor_id', $vendor->id)
                ->where('s.qty', '<=', 5)
                ->first();
        }
        $stockCount = DB::table('product_stocks as s')
            ->leftjoin('products as p', 's.product_id', '=', 'p.id')
            ->select(DB::raw('count(s.id) as total_stocks'))
            ->sum('s.qty');
        $product_qty = Product::where('created_at', Carbon::today()->toDateString())->sum('stock_qty');
        $product_stock_qty = ProductStock::where('created_at',Carbon::today()->toDateString())->sum('qty');
    	//dd($product_stock_qty);
        $todaysStockIn = ($product_stock_qty+$product_stock_qty);
        
        $todaysStockOut = DB::table('order_details as s')
            ->leftJoin('products as p', 's.product_id', '=', 'p.id')
            ->where('s.created_at', '=', date('d'))
            ->sum('s.qty');
        // Today profit Start
        $currentMonth = Carbon::now()->month;
        $order_today_total  = Order::whereDay('created_at', date('d'))->sum('grand_total');
        $order_today_pur  = Order::whereDay('created_at', date('d'))->sum('pur_sub_total');
        $today_profit = ($order_today_total - $order_today_pur);
        
        $order_monthly_total = Order::whereMonth('created_at', $currentMonth)->sum('grand_total');
        $order_monthly_pur = Order::whereMonth('created_at', $currentMonth)->sum('pur_sub_total');
        $monthly_profit = ($order_monthly_total - $order_monthly_pur);
        
        $order_yearly_total  = Order::whereYear('created_at', date('Y-m-d'))->sum('grand_total');
        $order_yearly_pur  = Order::whereYear('created_at', date('Y-m-d'))->sum('pur_sub_total');
        $yearly_profit = ($order_yearly_total - $order_yearly_pur);
        // Today profit End
    	
    	return view('admin.index', compact('userCount', 'productCount', 'categoryCount', 'brandCount', 'vendorCount', 'orderCount', 'lowStockCount','todays_sale','todays_sale_value','monthly_sale','monthly_sale_value','yearly_sale','yearly_sale_value','stockCount','todaysStockIn','todaysStockOut','today_profit','monthly_profit','yearly_profit','todays_purchase','monthly_purchase','yearly_purchase','todays_purchase_value','monthly_purchase_value',
    	'yearly_purchase_value'));
    } // end method

    /*=================== End Dashboard Methoed ===================*/

    /*=================== Start Admin Login Methoed ===================*/
    public function Login(Request $request){

    	$this->validate($request,[
    		'email' =>'required',
    		'password' =>'required'
    	]);

    	// dd($request->all());
    	$check = $request->all();
    	if(Auth::guard('admin')->attempt(['email' => $check['email'], 'password'=> $check['password'] ])){

            if(Auth::guard('admin')->user()->role == "1" || Auth::guard('admin')->user()->role == "5" || Auth::guard('admin')->user()->role == "2"){
                return redirect()->route('admin.dashboard')->with('success','Admin Login Successfully.');
            }else{
                $notification = array(
                    'message' => 'Invaild Email Or Password.', 
                    'alert-type' => 'error'
                );
                return back()->with($notification);
            }
    		
    	}else{
            $notification = array(
                'message' => 'Invaild Email Or Password.', 
                'alert-type' => 'error'
            );
    		return back()->with($notification);
    	}
    	
    } // end method

    /*=================== End Admin Login Methoed ===================*/

    /*=================== Start Logout Methoed ===================*/
    public function AminLogout(Request $request){
        
    	Auth::guard('admin')->logout();
        $request->session()->invalidate();

        $request->session()->regenerateToken();
        $notification = array(
            'message' => 'Admin Logout Successfully.', 
            'alert-type' => 'success'
        );
    	return redirect()->route('login_form')->with($notification);
    } // end method
    /*=================== End Logout Methoed ===================*/

    /*=================== Start AdminRegister Methoed ===================*/
    public function AdminRegister(){
    	
    	return view('admin.admin_register');
    } // end method
    /*=================== End AdminRegister Methoed ===================*/

     /*=================== Start AdminForgotPassword Methoed ===================*/
    public function AdminForgotPassword(){
        
        return view('admin.admin_forgot_password');
    } // end method
    /*=================== End AdminForgotPassword Methoed ===================*/

    /*=================== Start AdminRegisterStore Methoed ===================*/
    public function AdminRegisterStore(Request $request){

    	$this->validate($request,[
    		'name' =>'required',
    		'email' =>'required',
    		'password' =>'required',
    		'password_confirmation' =>'required'
    	]);
    	// dd($request->all());
    	User::insert([
    		'name' => $request->name,
    		'email' => $request->email,
    		'password' => Hash::make($request->password),
    		'created_at' => Carbon::now(),
    	]);
    	return redirect()->route('login_form')->with('success','Admin Created Successfully.');
    } // end method
    /*=================== End AdminRegisterStore Methoed ===================*/

    /* =============== Start Profile Method ================*/
    public function Profile(){
        $id = Auth::guard('admin')->user()->id;
        $adminData = User::find($id);

        // dd($adminData);
        return view('admin.admin_profile_view',compact('adminData'));

    }// End Method

    /* =============== Start EditProfile Method ================*/
    public function EditProfile(){

        $id = Auth::guard('admin')->user()->id;
        $editData = User::find($id);
        return view('admin.admin_profile_edit',compact('editData'));
    }//

     /* =============== Start StoreProfile Method ================*/
    public function StoreProfile(Request $request){
        $id = Auth::guard('admin')->user()->id;
        $data = User::find($id);
        $data->name = $request->name;
        $data->email = $request->email;
        $data->phone = $request->phone;
        $data->address = $request->address;

        if ($request->file('profile_image')) {
           $file = $request->file('profile_image');

           $filename = date('YmdHi').$file->getClientOriginalName();
           $file->move(public_path('upload/admin_images'),$filename);
           $data['profile_image'] = $filename;
        }
        $data->save();

        Session::flash('success','Admin Profile Updated Successfully');

        return redirect()->route('admin.profile');

    }// End Method

    /* =============== Start ChangePassword Method ================*/
    public function ChangePassword(){

        return view('admin.admin_change_password');

    }// 

    /* =============== Start UpdatePassword Method ================*/
    public function UpdatePassword(Request $request){

        $validateData = $request->validate([
            'oldpassword' => 'required',
            'newpassword' => 'required',
            'confirm_password' => 'required|same:newpassword',

        ]);

        $hashedPassword = Auth::guard('admin')->user()->password;

        // dd($hashedPassword);
        if (Hash::check($request->oldpassword,$hashedPassword )) {
            $id = Auth::guard('admin')->user()->id;
            $admin = User::find($id);
            $admin->password = bcrypt($request->newpassword);
            $admin->save();

            Session::flash('success','Password Updated Successfully');
            return redirect()->back();
        }else{
            Session::flash('error','Old password is not match');
            return redirect()->back();
        }

    }// End Method

    /* =============== Start clearCache Method ================*/
    function clearCache(Request $request){
        Artisan::call('optimize:clear');
        Session::flash('success','Cache cleared successfully.');
        return redirect()->back();
    } // end method

    /* =============== End clearCache Method ================*/
}