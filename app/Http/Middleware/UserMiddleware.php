<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Auth;

class UserMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        //dd(Auth::guard('web')->check());
        if(Auth::guard('web')->check()){
            if(Auth::guard('web')->user() && (Auth::guard('web')->user()->role =="3" || Auth::guard('web')->user()->role =="7")){
                //dd(Auth::guard('web')->user());
                if (Auth::guard('web')->user()->role == "7" && Auth::guard('web')->user()->status == "0") {
                    Auth::guard('web')->logout(); // Log out the user if already logged in
                    return redirect()->route('login')->with('error', 'Your account is inactive. Please contact support.');
                }
                if(!Auth::guard('web')->user()->role == "3"){
                    return redirect()->route('login')->with('error','Plz login First');
                }
            }else{
                abort(404);
            }
        }else{
            return redirect()->route('home');
        }

        return $next($request);
    }
}
