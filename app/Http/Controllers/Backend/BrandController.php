<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Models\Brand;
use Image;
use Session;
use Auth;

class BrandController extends Controller
{
    /*=================== Start BrandView Methoed ===================*/
    public function BrandView(){
    	$brands = Brand::latest()->get();
    	return view('backend.brand.brand_view',compact('brands'));
    }

    /*=================== Start BrandAdd Methoed ===================*/
    public function BrandAdd(){
        return view('backend.brand.brand_add');

    }

    /*=================== Start BrandStore Methoed ===================*/
    public function BrandStore(Request $request){
        $this->validate($request,[
            'name_en' => 'required',
            'brand_image' => 'required',
        ]);

        if($request->hasfile('brand_image')){
            $image = $request->file('brand_image');
            $name_gen = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
            Image::make($image)->resize(160,160)->save('upload/brand/'.$name_gen);
            $save_url = 'upload/brand/'.$name_gen;
        }else{
            $save_url = '';
        }

        $brand = new Brand();
        $brand->name_en = $request->name_en;
        if($request->name_bn == ''){
            $brand->name_bn = $request->name_en;
        }else{
            $brand->name_bn = $request->name_bn;
        }

        $brand->description_en = $request->description_en;
        if($request->description_bn == ''){
            $brand->description_bn = $request->description_en;
        }else{
            $brand->description_bn = $request->description_bn;
        }
        $brand->slug = preg_replace('/[^A-Za-z0-9\-]/', '', str_replace(' ', '-', strtolower($request->name_en)));
        if($request->status == Null){
            $request->status = 0;
        }
        $brand->status = $request->status;
        $brand->brand_image = $save_url;
        $brand->created_by = Auth::guard('admin')->user()->id;
        $brand->created_at = Carbon::now();

        $brand->save();

		Session::flash('success','Brand Inserted Successfully');
		return redirect()->route('brand.all');

    } // end method

    /*=================== Start BrandEdit Methoed ===================*/
    public function BrandEdit($id){
    	$brand = Brand::findOrFail($id);
    	return view('backend.brand.brand_edit',compact('brand'));
    }

    /*=================== Start BrandUpdate Methoed ===================*/
    public function BrandUpdate(Request $request, $id){
        $this->validate($request,[
            'name_en' => 'required',
        ]);

        $brand = Brand::find($id);
        //Brand Photo Update
        if($request->hasfile('brand_image')){
            try {
                if(file_exists($brand->brand_image)){
                    unlink($brand->brand_image);
                }
            } catch (Exception $e) {
                
            }
            $brand_image = $request->brand_image;
            $brand_save = time().$brand_image->getClientOriginalName();
            $brand_image->move('upload/brand/',$brand_save);
            $brand->brand_image = 'upload/brand/'.$brand_save;
        }else{
            $brand_save = '';
        }

        // Brand table update
        $brand->name_en = $request->name_en;
        if($request->name_bn == ''){
            $brand->name_bn = $request->name_en;
        }else{
            $brand->name_bn = $request->name_bn;
        }

        $brand->description_en = $request->description_en;
        if($request->description_bn == ''){
            $brand->description_bn = $request->description_en;
        }else{
            $brand->description_bn = $request->description_bn;
        }
        $brand->slug = preg_replace('/[^A-Za-z0-9\-]/', '', str_replace(' ', '-', strtolower($request->name_en)));
        if($request->status == Null){
            $request->status = 0;
        }
        $brand->status = $request->status;
        $brand->created_by = Auth::guard('admin')->user()->id;
        
        $brand->save();

        $notification = array(
            'message' => 'Brand Updated Successfully.',
            'alert-type' => 'success'
        );
        return redirect()->route('brand.all')->with($notification);
    } // end method

    /*=================== Start BrandDelete Methoed ===================*/
    public function BrandDelete($id){
    	$brand = Brand::findOrFail($id);
    	try {
            if(file_exists($brand->brand_image)){
                unlink($brand->brand_image);
            }
        } catch (Exception $e) {
            
        }

    	$brand->delete();

        $notification = array(
            'message' => 'Brand Deleted Successfully.',
            'alert-type' => 'error'
        );
		return redirect()->back()->with($notification);

    } // end method

    /*=================== Start Active/Inactive Methoed ===================*/
    public function active($id){
        $brand = Brand::find($id);
        $brand->status = 1;
        $brand->save();

        Session::flash('success','Brand Active Successfully.');
        return redirect()->back();
    }

    public function inactive($id){
        $brand = Brand::find($id);
        $brand->status = 0;
        $brand->save();

        Session::flash('warning','Brand Inactive Successfully.');
        return redirect()->back();
    }
}
