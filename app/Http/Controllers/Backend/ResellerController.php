<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Session;
use Illuminate\Auth\Events\Registered;
use Illuminate\Validation\Rules;
use Illuminate\Support\Facades\Hash;

class ResellerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (Auth::guard('admin')->user()->role != '1') {
            abort(404);
        }
        $resellers = User::where('role', 7)->where('is_approved', 1)->latest()->get();
        return view('backend.reseller.index', compact('resellers'));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function requests()
    {
        if (Auth::guard('admin')->user()->role != '1') {
            abort(404);
        }
        $resellers = User::where('role', 7)->where('is_approved', 0)->latest()->get();
        return view('backend.reseller.requests', compact('resellers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.reseller.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'username' => ['required', 'string', 'max:255', 'unique:users'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'phone' => ['required', 'string', 'max:255', 'unique:users'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'wallet_default_amount' => ['required'],
            'wallet_balance' => ['nullable'],
        ]);
        //  dd($request->all());
        $userEmail = User::where('email', $request->email)->first();
        $userUser = User::where('username', $request->username)->first();
        $userPhone = User::where('phone', $request->phone)->first();
        if ($userEmail) {
            $notification = array(
                'message' => 'User email already Created',
                'alert-type' => 'error'
            );
            return redirect()->back()->with($notification);
        } elseif ($userUser) {
            $notification = array(
                'message' => 'User name already Created',
                'alert-type' => 'error'
            );
            return redirect()->back()->with($notification);
        } elseif ($userPhone) {
            $notification = array(
                'message' => 'User Phone already Created',
                'alert-type' => 'error'
            );
            return redirect()->back()->with($notification);
        } else {
            if ($request->reseller_discount_percent == null || $request->reseller_discount_percent == '') {
                $request->reseller_discount_percent = get_setting('reseller_discount_percent')->value;
            }
            $user = User::create([
                'name' => $request->name,
                'username' => $request->username,
                'email' => $request->email,
                'phone' => $request->phone,
                'password' => Hash::make($request->password),
                'role' => 7,
                'reseller_discount_percent' => $request->reseller_discount_percent,
                'wallet_default_amount' => $request->wallet_default_amount,
                'wallet_balance' => $request->wallet_balance
            ]);
        }
        event(new Registered($user));

        //Auth::login($user);

        $notification = array(
            'message' => 'Reseller added successfully',
            'alert-type' => 'success'
        );
        return redirect()->route('reseller.index')->with($notification);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (Auth::guard('admin')->user()->role != '1') {
            abort(404);
        }
        $reseller = User::find($id);
        if ($reseller) {
            return view('backend.reseller.show', compact('reseller'));
        } else {
            Session::flash('error', 'Reseller account not found');
            return redirect()->back();
        }
    }

    public function changeStatus($id)
    {
        $reseller = User::find($id);

        if ($reseller) {
            if ($reseller->status == 0) {
                $reseller->status = 1;
            } else {
                $reseller->status = 0;
            }

            $reseller->save();

            Session::flash('success', 'Reseller Status Changed Successfully');
            return redirect()->back();
        } else {
            Session::flash('error', 'Reseller account not found');
            return redirect()->back();
        }
    }

    public function approve($id)
    {
        $reseller = User::find($id);

        if ($reseller) {
            $reseller->is_approved = 1;
            $reseller->status = 1;

            $reseller->reseller_discount_percent = get_setting('reseller_discount_percent')->value;

            $reseller->save();

            Session::flash('success', 'Reseller Approved Successfully');
            return redirect()->back();
        } else {
            Session::flash('error', 'Reseller account not found');
            return redirect()->back();
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $reseller = User::find($id);

        if ($reseller) {
            return view('backend.reseller.edit', compact('reseller'));
        } else {
            Session::flash('error', 'Reseller account not found');
            return redirect()->back();
        }
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
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'username' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255'],
            'phone' => ['required', 'string', 'max:255'],
        ]);

        if ($request->status == Null) {
            $request->status = 0;
        }

        $reseller = User::find($id);

        $reseller->name = $request->name;
        $reseller->username = $request->username;
        $reseller->phone = $request->phone;
        $reseller->email = $request->email;
        $reseller->status = $request->status;
        $reseller->reseller_discount_percent = $request->reseller_discount_percent;
        $reseller->wallet_default_amount = $request->wallet_default_amount;
        if($request->wallet_balance){
            $reseller->wallet_balance = $request->wallet_balance;
        }
        $reseller->save();

        Session::flash('success', 'Reseller Info Updated Successfully');
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
        $reseller = User::find($id);
        if ($reseller) {
            $reseller->delete();

            $notification = array(
                'message' => 'Reseller Deleted Successfully.',
                'alert-type' => 'success'
            );
            return redirect()->back()->with($notification);
        } else {
            Session::flash('error', 'Reseller account not found');
            return redirect()->back();
        }
    }
}
