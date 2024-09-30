<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Session;
use App\Models\User;
use App\Models\Category;
use App\Models\SmsTemplate;
use App\Utility\SmsUtility;
use App\Utility\SendSMSUtility;


class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $categories = Category::orderBy('name_en','DESC')->where('status','=',1)->limit(5)->get();

        if(get_setting('otp_system')->value){
            return view('auth.otp.otp_login',compact('categories'));
        }
        
        return view('auth.login',compact('categories'));
    }

    /**
     * Handle an incoming authentication request.
     *
     * @param  \App\Http\Requests\Auth\LoginRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(LoginRequest $request)
    {
        $this->validate($request,[
            'email' =>'required',
            'password' =>'required'
        ]);

        // dd($request->all());
        $check = $request->all();
        if(Auth::guard('web')->attempt(['email' => $check['email'], 'password'=> $check['password'] ])){

            if(Auth::guard('web')->user()->role == "3" || Auth::guard('web')->user()->role == "7"){
                $notification = array(
                    'message' => 'User Login Successfully.', 
                    'alert-type' => 'success'
                );
                return redirect()->route('dashboard')->with($notification);
            }else{
                Auth::guard('web')->logout();
                $request->session()->invalidate();
                $request->session()->regenerateToken();

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

        // $request->authenticate();
        // $request->session()->regenerate();
        // return redirect()->route('dashboard');
    }

    public function otp_login(Request $request)
    {
        //dd($request);
        $this->validate($request,[
            'phone' =>'required',
        ]);

        $user = User::where('phone', $request->phone)->first();
        Session::put('otp_phone', $request->phone);

        if($user){
            if(get_setting('otp_system')){
                $sms_template = SmsTemplate::where('name','login_verification')->where('status',1)->first();
                if($sms_template){

                    $otp_code = rand(100000, 999999);
                    Session::put('otp_code', $otp_code);

                    $sms_body       = $sms_template->body;
                    $sms_body       = str_replace('[[code]]', $otp_code, $sms_body);
                    $sms_body       = str_replace('[[site_name]]', env('APP_NAME'), $sms_body);

                    if(substr($request->phone,0,3)=="+88"){
                        $phone = $request->phone;
                    }elseif(substr($request->phone,0,2)=="88"){
                        $phone = '+'.$request->phone;
                    }else{
                        $phone = '+88'.$request->phone;
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
                    $notification = array(
                        'message' => 'Code sent to your number', 
                        'alert-type' => 'success'
                    );
                    return redirect()->route('otp_login.verifyForm')->with($notification);
                }else{
                    $notification = array(
                        'message' => 'Code sending failed!', 
                        'alert-type' => 'error'
                    );
                    return back()->with($notification);
                }
            }
        }else{
            $notification = array(
                'message' => 'No user registered with this number!', 
                'alert-type' => 'error'
            );
            return back()->with($notification);
        }

        $notification = array(
            'message' => 'Code sending failed!', 
            'alert-type' => 'error'
        );
        return back()->with($notification);
    }

    public function otp_verify_form()
    {
        return view('auth.otp.otp_verification');
    }

    public function otp_verify(Request $request)
    {
        $this->validate($request,[
            'code' =>'required',
        ]);

        if($request->code == Session::get('otp_code')){
            $phone = Session::get('otp_phone');
            $user = User::where('phone', $phone)->first();
            if($user){
                auth()->login($user, true);

                if(Auth::guard('web')->user()->role == "3"){
                    $notification = array(
                        'message' => 'User Login Successfully.', 
                        'alert-type' => 'success'
                    );
                    return redirect()->route('dashboard')->with($notification);
                }else{
                    Auth::guard('web')->logout();
                    $request->session()->invalidate();
                    $request->session()->regenerateToken();
    
                    $notification = array(
                        'message' => 'Invaild Email Or Password.', 
                        'alert-type' => 'error'
                    );
                    return back()->with($notification);
                }
            }else{
                $notification = array(
                    'message' => 'Something went wrong.', 
                    'alert-type' => 'error'
                );
                return back()->with($notification);
            }
        }else{
            $notification = array(
                'message' => 'Wrong code!', 
                'alert-type' => 'error'
            );
            return back()->with($notification);
        }
    }

    /**
     * Destroy an authenticated session.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Request $request)
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        $notification = array(
                'message' => 'User Logout Successfully.', 
                'alert-type' => 'success'
        );

        return redirect('/')->with($notification);
    }
}
