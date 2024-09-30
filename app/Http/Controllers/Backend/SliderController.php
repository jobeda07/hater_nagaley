<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Slider;
use Illuminate\Support\Carbon;
use Image;
use Session;

class SliderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sliders = Slider::latest()->get();
        return view('backend.slider.index',compact('sliders'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.slider.create');
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
            'title_en' => 'required',
            'description_en' => 'required',
            'slider_img' => 'required',
        ]);

        if($request->hasfile('slider_img')){
            $image = $request->slider_img;
            $name_gen = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
            Image::make($image)->resize(2300,800)->save('upload/slider/'.$name_gen);
            $save_url = 'upload/slider/'.$name_gen;
        }else{
            $save_url = '';
        }

        $slider = new slider();
        $slider->title_en = $request->title_en;

        if($request->title_bn == ''){
            $slider->title_bn = $request->title_en;
        }else{
            $slider->title_bn = $request->title_bn;
        }

        $slider->description_en = $request->description_en;
        if($request->description_bn == ''){
            $slider->description_bn = $request->description_en;
        }else{
            $slider->description_bn = $request->description_bn;
        }

        $slider->slug = preg_replace('/[^A-Za-z0-9\-]/', '', str_replace(' ', '-', strtolower($request->title_en)));
        if($request->status == Null){
            $request->status = 0;
        }
        $slider->status = $request->status;
        $slider->slider_img = $save_url;
        $slider->slider_url = $request->slider_url;
        $slider->created_at = Carbon::now();

        $slider->save();

        Session::flash('success','Slider Inserted Successfully');
        return redirect()->route('slider.index');
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
        $slider = Slider::findOrFail($id);
        return view('backend.slider.edit',compact('slider'));
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
        $this->validate($request,[
            'title_en' => 'required',
            'description_en' => 'required',
        ]);

        $slider = Slider::find($id);

        //Slider Photo Update
        if ($request->file('slider_img')) {
            try {
                if(file_exists($slider->slider_img)){
                    unlink($slider->slider_img);
                }
            } catch (Exception $e) {
                
            }
            $slider_img = $request->slider_img;
            $slider_save = time().$slider_img->getClientOriginalName();
            $slider_img->move('upload/slider/',$slider_save);
            $slider->slider_img = 'upload/slider/'.$slider_save;
        }else{
            $slider_save = '';
        }

        // slider update
        $slider->title_en = $request->title_en;
        if($request->title_bn == ''){
            $slider->title_bn = $request->title_en;
        }else{
            $slider->title_bn = $request->title_bn;
        }

        $slider->description_en = $request->description_en;
        if($request->description_bn == ''){
            $slider->description_bn = $request->description_en;
        }else{
            $slider->description_bn = $request->description_bn;
        }

        $slider->slug = preg_replace('/[^A-Za-z0-9\-]/', '', str_replace(' ', '-', strtolower($request->title_en)));
        if($request->status == Null){
            $request->status = 0;
        }
        $slider->status = $request->status;
        $slider->slider_url = $request->slider_url;
        $slider->created_at = Carbon::now();

        $slider->save();

        Session::flash('success','Slider Updated Successfully');
        return redirect()->route('slider.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $slider = Slider::findOrFail($id);

        try {
            if(file_exists($slider->slider_img)){
                unlink($slider->slider_img);
            }
        } catch (Exception $e) {
            
        }
        
        $slider->delete();

        $notification = array(
            'message' => 'Slider Deleted Successfully.', 
            'alert-type' => 'error'
        );
        return redirect()->back()->with($notification);
    }

    /*=================== Start Active/Inactive Methoed ===================*/
    public function active($id){
        $slider = Slider::find($id);
        $slider->status = 1;
        $slider->save();

        $notification = array(
            'message' => 'Slider Active Successfully.', 
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    }

    public function inactive($id){
        $slider = Slider::find($id);
        $slider->status = 0;
        $slider->save();

        $notification = array(
            'message' => 'Slider Inactive Successfully.', 
            'alert-type' => 'error'
        );
        return redirect()->back()->with($notification);
    }
}
