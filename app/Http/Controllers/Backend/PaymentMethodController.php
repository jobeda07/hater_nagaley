<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Session;

class PaymentMethodController extends Controller
{
    public function index()
    {
        //$pages = Page::latest()->get();
        return view('backend.paymentMethods.configuration');
    }

    public function update(Request $request)
    {
        foreach ($request->types as $key => $type) {
                $this->overWriteEnvFile($type, $request[$type]);
        }

        // $business_settings = BusinessSetting::where('type', $request->payment_method.'_sandbox')->first();
        // if($business_settings != null){
        //     if ($request->has($request->payment_method.'_sandbox')) {
        //         $business_settings->value = 1;
        //         $business_settings->save();
        //     }
        //     else{
        //         $business_settings->value = 0;
        //         $business_settings->save();
        //     }
        // }

        //Artisan::call('cache:clear');

        Session::flash('success','Settions Updated Successfully');
        return back();
    }

    public function overWriteEnvFile($type, $val)
    {
        if(env('DEMO_MODE') != 'On'){
            $path = base_path('.env');
            if (file_exists($path)) {
                $val = '"'.trim($val).'"';
                if(is_numeric(strpos(file_get_contents($path), $type)) && strpos(file_get_contents($path), $type) >= 0){
                    file_put_contents($path, str_replace(
                        $type.'="'.env($type).'"', $type.'='.$val, file_get_contents($path)
                    ));
                }
                else{
                    file_put_contents($path, file_get_contents($path)."\r\n".$type.'='.$val);
                }
            }
        }
    }
}
