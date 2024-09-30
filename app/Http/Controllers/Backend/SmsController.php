<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SmsTemplate;
use App\Models\SmsProvider;
use Session;
use Illuminate\Support\Facades\DB;

class SmsController extends Controller
{
    /*============== sms template index =============*/
    public function template_index()
    {
    	$sms_templates = SmsTemplate::all();

    	//dd($sms_templates);

    	return view('backend.sms.templates', compact('sms_templates'));
    }

    /*============== sms template store =============*/
    public function store(Request $request)
    {

        // dd($request->all());
        $this->validate($request,[
            'body' => 'required',
        ]);

        $sms = new SmsTemplate();

        $sms->name = $request->name;
        $sms->body = $request->body;
        if($request->status == Null){
            $request->status = 0;
        }
        $sms->status = $request->status;
        $sms->save();


        Session::flash('success','SMS Template Inserted Successfully');
        return redirect()->route('sms.templates');
    }
    /*============== sms template update =============*/
    public function template_update(Request $request, $id)
    {
    	//dd($request);
    	$this->validate($request,[
            'body'  => 'required',
        ]);

    	$template = SmsTemplate::findOrFail($id);

    	if($template){
    		$template->body = $request->body;
    		if($request->status){
    			$template->status = 1;
    		}else{
    			$template->status = 0;
    		}
    		$template->save();
    	}

    	Session::flash('success','SMS Template Updated Successfully');
    	return back();
    }

    /*============== provider index  =============*/
    public function provider_index()
    {
    	$sms_providers = SmsProvider::all();

    	//dd($sms_templates);

    	return view('backend.sms.providers', compact('sms_providers'));
    }

    /*============== provider store  =============*/
    public function providersStore(Request $request)
    {

        // dd($request->all());
        $this->validate($request,[
            'name' => 'required',
            'url' => 'required',
            'api_key' => 'required',
            'sender_id' => 'required',
        ]);

        $provider = new SmsProvider();

        $provider->name = $request->name;
        $provider->url = $request->url;
        $provider->api_key = $request->api_key;
        $provider->sender_id = $request->sender_id;
        $provider->url = $request->url;
        if($request->status == Null){
            $request->status = 0;
        }
        $provider->status = $request->status;
        $provider->save();


        Session::flash('success','SMS Provider Inserted Successfully');
        return redirect()->route('sms.providers');
    }

    /*============== provider update  =============*/
    public function provider_update(Request $request, $id)
    {
    	//dd($request);
    	$this->validate($request,[
            'name'  	 => 'required|string',
            'url'  		 => 'required|string',
            'api_key'  	 => 'required|string',
            'sender_id'  => 'required|string',
        ]);

    	$provider = SmsProvider::findOrFail($id);

    	if($provider){

    		$provider->name 	 = $request->name;
    		$provider->url 		 = $request->url;
    		$provider->api_key   = $request->api_key;
    		$provider->sender_id = $request->sender_id;

    		if($request->status){
    			DB::table('sms_providers')
              ->where('id','!=' , $id)
              ->update(['status' => 0]);

    			$provider->status = 1;

    		}else{
    			$provider->status = 0;
    		}
    		$provider->save();
    	}

    	Session::flash('success','SMS Provider Updated Successfully');
    	return back();
    }


}
