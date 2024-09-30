<?php

namespace App\Http\Controllers\Frontend;

use DB;
use Auth;
use Session;
use App\Models\User;
use App\Models\Order;
use App\Models\Address;
use App\Models\Withdraw;
use App\Models\Orderdetail;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Models\WalletTransaction;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    /* ============= Dashboard & user orders ============= */
    public function index(){
        $orders = Order::where('user_id',Auth::id())->orderBy('id','DESC')->get();

        $all = Order::where('user_id', Auth::user()->id)
                        ->where('delivery_status', 'pending')
                        ->get();

        $pending = Order::where('user_id', Auth::user()->id)
                        ->where('delivery_status', 'pending')
                        ->get();

        $processing = Order::where('user_id', Auth::user()->id)
                        ->where('delivery_status', 'processing')
                        ->get();

        $shipping = Order::where('user_id', Auth::user()->id)
                        ->where('delivery_status', 'shipped')
                        ->get();

        $picked = Order::where('user_id', Auth::user()->id)
                        ->where('delivery_status', 'picked_up')
                        ->get();

        $completed = Order::where('user_id', Auth::user()->id)
                        ->where('delivery_status', 'delivered')
                        ->get();

        $cancelled = Order::where('user_id', Auth::user()->id)
                        ->where('delivery_status', 'cancel')
                        ->get();

        $cancelled = Order::where('user_id', Auth::user()->id)
                        ->where('delivery_status', 'cancel')
                        ->get();

        $due_balance = WalletTransaction::where('user_id', Auth::user()->id)->where('status', 0)->where('type', 1)->sum('amount');
        $withdraw=Withdraw::where('user_id',Auth::user()->id)->where('status',1)->sum('amount');

        return view('dashboard',compact('orders', 'all', 'pending', 'processing', 'shipping', 'picked', 'completed', 'cancelled', 'due_balance','withdraw'));
    }

    /* ============= Order View ============= */
    public function orderView($invoice_no){
        // $order = Order::where('user_id',Auth::id())->orderBy('id','DESC')->first();
        $order = Order::where('invoice_no', $invoice_no)->first();
        // $orders = Order::with('address_id')->where('id',$id)->where('user_id',Auth::id())->first();
        return view('frontend.order.order_view', compact('order'));
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
        $this->validate($request,[
            'division_id' => 'required',
            'district_id' => 'required',
            'upazilla_id' => 'required',
            'address' => 'required'
        ]);
        $address = new Address();
        $address->division_id = $request->division_id;
        $address->district_id = $request->district_id;
        $address->upazilla_id = $request->upazilla_id;
        $address->user_id = Auth::user()->id;
        $address->address = $request->address;
        if($request->is_default == Null){
            $request->is_default = 0;
        }
        $address->is_default = $request->is_default;

        if($request->status == Null){
            $request->status = 0;
        }
        $address->status = $request->status;
        $address->created_at = Carbon::now();

        $address->save();

        Session::flash('success','Page Inserted Successfully');

        Session::flash('success','User Address Inserted Successfully');
        return redirect()->back();
    }

    /* ============== Address Store Ajax ============== */
    public function getAddressStore(Request $request)
    {

        $address = new Address();

        $address->division_id = $request->division_id;
        $address->district_id = $request->district_id;
        $address->upazilla_id = $request->upazilla_id;
        $address->user_id = Auth::user()->id;
        $address->address = $request->address;
        $address->is_default = $request->is_default;
        $address->status = $request->status;

        // dd($request->all());

        $address->save();

        $addresses = Address::where('user_id', Auth::user()->id)->orderBy('id','DESC')->get();

        return json_encode($addresses);
    }

    /* =================== Start getAddress Methoed =================== */
    public function getAddress($address_id){
        $address = Address::find($address_id);
        $address_details = [
            'division_name_en' => $address->division->division_name_en ?? 'NULL',
            'division_id' => $address->division->id ?? 1,
            'district_name_en' => $address->district->district_name_en ?? 'NULL',
            'district_id' => $address->district->id ?? 1,
            'upazilla_name_en' => $address->upazilla->name_en ?? 'NULL',
            'upazilla_id' => $address->upazilla->id ?? 1,
            'address' => $address->address,
        ];

        return json_encode($address_details);
    }
    /* =================== End getAddress Methoed =================== */

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

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

    // User Dashboard

    // User Profile Update
    public function userProfileUpdate(Request $request)
    {
        $id = Auth::guard('web')->user()->id;
        $user = User::find($id);

        $profile_image = $user->profile_image;
        // user Photo Update
        if($request->hasfile('profile_image')){
            // if($profile_image !== ''){
            //     unlink($profile_image);
            // }
            $profile_img = $request->profile_image;
            $profile_save = time().$profile_img->getClientOriginalName();
            $profile_img->move('upload/user/',$profile_save);
            $user->profile_image = 'upload/user/'.$profile_save;
        }else{
           $profile_save = '';
        }

        // user table update
        $user->name = $request->name;
        $user->username = $request->username;
        $user->phone = $request->phone;
        $user->email = $request->email;

        $user->save();

        $notification = array(
            'message' => 'User Updated Successfully.',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    }

    // User Password Change
    public function UserPasswordUpdate(Request $request)
    {
        $validateData = $request->validate([
            'oldpassword' => 'required',
            'newpassword' => 'required',
            'confirm_password' => 'required|same:newpassword',
        ]);
        $hashedPassword = Auth::guard('web')->user()->password;
        // dd($hashedPassword);
        if (Hash::check($request->oldpassword,$hashedPassword )) {
            $id = Auth::guard('web')->user()->id;
            $user = User::find($id);
            $user->password = bcrypt($request->newpassword);
            $user->save();

            $notification = array(
                'message' => 'Password Updated Successfully.',
                'alert-type' => 'success'
            );
            return redirect()->back()->with($notification);
        }else{
            $notification = array(
                'message' => 'Old password is not match.',
                'alert-type' => 'error'
            );
            return redirect()->back()->with($notification);
        }
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

    public function set_default($id){

        $user_id = Auth::user()->id;
        $addresses = Address::where('user_id', $user_id)->get();

        foreach ($addresses as $key => $address) {
            $address->is_default = 0;
            $address->save();
        }
        $address = Address::find($id);
        $address->is_default = 1;
        $address->save();

        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function address_destroy($id)
    {
        $addresse = Address::findOrFail($id);
        $addresse->delete();

        $notification = array(
            'message' => 'User Address Deleted Successfully.',
            'alert-type' => 'error'
        );
        return redirect()->back()->with($notification);
    }

    public function withdraw_request(Request $request){
        $adminData = User::select("users.*")->where('users.id',$request->user_id)->first();

        $amount = $adminData->wallet_balance - $request->amount;
        if($request->amount > $adminData->wallet_balance && $amount < $adminData->wallet_default_amount) {
            $notification = array(
                'message' => 'Your requested amount is insufficient.',
                'alert-type' => 'error'
            );
            return redirect()->back()->with($notification);
        }

        
        else{
            $this->validate($request, [
                'transition_number' => 'nullable|digits:11',
                'amount'            => 'required',
            ]);

            $withdraw = new Withdraw();
            $withdraw->user_id = $request->user_id;
            $withdraw->method = $request->method;
            $withdraw->account_type = $request->account_type;
            $withdraw->user_type = $request->user_type;
            $withdraw->phone = $request->transition_number ?? 0;
            $withdraw->account_holder_name = $request->account_holder_name;
            $withdraw->account_no = $request->account_no;
            $withdraw->bank_name = $request->bank_name;
            $withdraw->bank_brunch = $request->bank_brunch;
            $withdraw->purpose = $request->purpose ?? 0;
            $withdraw->amount = $request->amount;
            $withdraw->status = 0;
            $withdraw->save();
            $notification = array(
                'message' => 'Request Submit Successfully',
                'alert-type' => 'success'
            );
            return redirect()->back()->with($notification);
        }
    }

}
