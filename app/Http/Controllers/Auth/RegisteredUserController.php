<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Session;
use App\Models\Category;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'username' => ['required', 'string', 'max:255', 'unique:users'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'phone' => ['required', 'string', 'max:255', 'unique:users'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $userEmail = User::where('email', $request->email)->first();
        $userUser = User::where('username', $request->username)->first();
        $userPhone = User::where('phone', $request->phone)->first();
        if ($userEmail) {
            $notification = array(
                'message' => 'User email already Created', 
                'alert-type' => 'error'
            );
            return redirect()->back()->with($notification);
        }elseif($userUser){
            $notification = array(
                'message' => 'User name already Created', 
                'alert-type' => 'error'
            );
            return redirect()->back()->with($notification);
        }elseif($userPhone){
            $notification = array(
                'message' => 'User Phone already Created', 
                'alert-type' => 'error'
            );
            return redirect()->back()->with($notification);
        }else{
            $user = User::create([
                'name' => $request->name,
                'username' => $request->username,
                'email' => $request->email,
                'phone' => $request->phone,
                'password' => Hash::make($request->password),
            ]);
        }
        event(new Registered($user));

        Auth::login($user);

        $notification = array(
            'message' => 'User Created Successfully.', 
            'alert-type' => 'success'
        );
        return redirect()->route('dashboard')->with($notification);
    }
}
