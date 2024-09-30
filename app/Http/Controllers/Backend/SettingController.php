<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Setting;
use Session;
use Illuminate\Support\Carbon;
use Image;

class SettingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $settings = Setting::find(1);
        return view('backend.setting.setting_update', compact('settings'));
    }

    public function activation()
    {
        $settings = Setting::find(1);
        return view('backend.setting.setting_activation', compact('settings'));
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
        //
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
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {   
        if(!demo_mode()){

            // dd($request->types);
            if($request->types !=null && count($request->types) > 0){
                foreach ($request->types as $key => $type) {
                    $setting = Setting::where('name', $type)->first();
                    $setting->value = $request[$type];
                    // if ($request[$type] == ) {
                    //     # code...
                    // }
                    $setting->save();
                }
            }

            //Setting Logo Update
            if ($request->file('site_logo')) {
                $logo = $request->file('site_logo');
                $logo_save = time().$logo->getClientOriginalName();
                $logo->move('upload/setting/logo/',$logo_save);
                $save_url_logo = 'upload/setting/logo/'.$logo_save;

                $setting = Setting::where('name', 'site_logo')->first();
                try {
                    if(file_exists($setting->value)){
                        unlink($setting->value);
                    }
                } catch (Exception $e) {
                    
                }
                $setting->value = $save_url_logo;

                $setting->save();
            }

            //Setting Logo Update
            if ($request->file('site_footer_logo')) {
                $logo = $request->file('site_footer_logo');
                $logo_save = time().$logo->getClientOriginalName();
                $logo->move('upload/setting/logo/',$logo_save);
                $save_url_footer_logo = 'upload/setting/logo/'.$logo_save;

                $setting = Setting::where('name', 'site_footer_logo')->first();
                try {
                    if(file_exists($setting->value)){
                        unlink($setting->value);
                    }
                } catch (Exception $e) {
                    
                }
                $setting->value = $save_url_footer_logo;

                $setting->save();
            }

            //Setting Favicon Update
            if ($request->file('site_favicon')) {
                $favicon = $request->file('site_favicon');
                $favicon_save = time().$favicon->getClientOriginalName();
                $favicon->move('upload/setting/favicon/',$favicon_save);
                $save_url_favicon = 'upload/setting/favicon/'.$favicon_save;
                
                $setting = Setting::where('name', 'site_favicon')->first();
                try {
                    if(file_exists($setting->value)){
                        unlink($setting->value);
                    }
                } catch (Exception $e) {
                    
                }
                $setting->value = $save_url_favicon;

                $setting->save();
            }

            Session::flash('success','Setting Updated Successfully');
            return redirect()->back();

        }else{
            $notification = array(
                'message' => 'Settings can not be change on demo mode.',
                'alert-type' => 'error'
            );
        }

        return redirect()->back()->with($notification);

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
}
