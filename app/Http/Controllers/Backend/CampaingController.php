<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Models\Campaing;
use App\Models\CampaingProduct;
use App\Models\Product;
use Image;
use Session;

class CampaingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $campaings = Campaing::latest()->get();
        return view('backend.campaing.index',compact('campaings'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.campaing.create');
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
            'name_en' => 'required',
            'campaing_image' => 'required',
        ]);

        if($request->hasfile('campaing_image')){
            $image = $request->file('campaing_image');
            $name_gen = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
            Image::make($image)->save('upload/campaing/'.$name_gen);
            $save_url = 'upload/campaing/'.$name_gen; 
        }else{
            $save_url = '';
        }

        $campaing = new Campaing();

        $date_var = explode(" - ", $request->date_range);
        // dd($date_var[0]);
        $campaing->flash_start  = $date_var[0];
        $campaing->flash_end    = $date_var[1];
        
        $campaing->name_en = $request->name_en;
        if($request->name_bn == ''){
            $campaing->name_bn = $request->name_en;
        }else{
            $campaing->name_bn = $request->name_bn;
        }
        $campaing->slug = preg_replace('/[^A-Za-z0-9\-]/', '', str_replace(' ', '-', strtolower($request->name_en)));

        if($request->is_featured == Null){
            $request->is_featured = 0;
        }
        $campaing->is_featured = $request->is_featured;

        if($request->status == Null){
            $request->status = 0;
        }
        $campaing->status = $request->status;
        $campaing->campaing_image = $save_url;
        $campaing->created_at = Carbon::now();

        // dd($campaing);
        if($campaing->save()){
            foreach ($request->products as $key => $product) {
                $campaing_product = new CampaingProduct;
                $campaing_product->campaing_id = $campaing->id;
                $campaing_product->product_id = $product;
                $campaing_product->discount_price = $request['discount_'.$product];
                $campaing_product->discount_type = $request['discount_type_'.$product];
                // dd($campaing_product);
                $campaing_product->save();

                $root_product = Product::findOrFail($product);
                $root_product->discount_price = $request['discount_'.$product];
                $root_product->discount_type = $request['discount_type_'.$product];
                // $root_product->discount_start_date = $date_var[0];
                // $root_product->discount_end_date   = $date_var[1];
                $root_product->save();
            }
            Session::flash('success','Flash Campaing Inserted Successfully');
            return redirect()->route('campaing.index');
        }
        else{
            Session::flash('danger','Something went wrong');
            return back();
        }

        Session::flash('success','Campaing Inserted Successfully');
        return redirect()->route('campaing.index');
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
        $campaing = Campaing::find($id);
        return view('backend.campaing.edit',compact('campaing'));
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
            'name_en' => 'required',
        ]);

        $campaing = Campaing::find($id);
        //Campaing Photo Update
        if($request->hasfile('campaing_image')){
            try {
                if(file_exists($campaing->campaing_image)){
                    unlink($campaing->campaing_image);
                }
            } catch (Exception $e) {
                
            }
            $campaing_image = $request->campaing_image;
            $img = time().$campaing_image->getClientOriginalName();
            $campaing_image->move('upload/campaing/',$img);
            $campaing->campaing_image = 'upload/campaing/'.$img;
        }else{
            $img = '';
        }

        // Campaing table update
        $date_var = explode(" - ", $request->date_range);
        // dd($date_var[0]);
        $campaing->flash_start  = $date_var[0];
        $campaing->flash_end    = $date_var[1];
        
        $campaing->name_en = $request->name_en;
        if($request->name_bn == ''){
            $campaing->name_bn = $request->name_en;
        }else{
            $campaing->name_bn = $request->name_bn;
        }
        $campaing->slug = preg_replace('/[^A-Za-z0-9\-]/', '', str_replace(' ', '-', strtolower($request->name_en)));

        if($request->is_featured == Null){
            $request->is_featured = 0;
        }
        $campaing->is_featured = $request->is_featured;

        if($request->status == Null){
            $request->status = 0;
        }
        $campaing->status = $request->status;
        $campaing->updated_at = Carbon::now();

        // dd($campaing);
        foreach ($campaing->campaing_products as $key => $campaing_product) {
            $campaing_product->delete();
        }
        if($campaing->save()){
            foreach ($request->products as $key => $product) {
                $campaing_product = new CampaingProduct;
                $campaing_product->campaing_id = $campaing->id;
                $campaing_product->product_id = $product;
                $campaing_product->discount_price = $request['discount_'.$product];
                $campaing_product->discount_type = $request['discount_type_'.$product];
                // dd($campaing_product);
                $campaing_product->save();

                $root_product = Product::findOrFail($product);
                $root_product->discount_price = $request['discount_'.$product];
                $root_product->discount_type = $request['discount_type_'.$product];
                // $root_product->discount_start_date = $date_var[0];
                // $root_product->discount_end_date   = $date_var[1];
                $root_product->save();
            }
            Session::flash('success','Flash Campaing Update Successfully');
            return redirect()->route('campaing.index');
        }
        else{
            Session::flash('danger','Something went wrong');
            return back();
        }

        Session::flash('success','Campaing Update Successfully');
        return redirect()->route('campaing.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $campaing = Campaing::findOrFail($id);
        try {
            if(file_exists($campaing->campaing_image)){
                unlink($campaing->campaing_image);
            }
        } catch (Exception $e) {
            
        }
        
        $campaing->delete();

        $notification = array(
            'message' => 'Campaing Deleted Successfully.', 
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    }

    /*=================== Start Active/Inactive Methoed ===================*/
    public function active($id){
        $campaing = Campaing::find($id);
        $campaing->status = 1;
        $campaing->save();

        Session::flash('success','Campaing Active Successfully.');
        return redirect()->back();
    }

    public function inactive($id){
        $campaing = Campaing::find($id);
        $campaing->status = 0;
        $campaing->save();

        Session::flash('warning','Campaing Inactive Successfully.');
        return redirect()->back();
    }

    // campaing product show
    public function product_discount(Request $request){
        $product_ids = $request->product_ids;

        // dd($product_ids);
        return view('backend.campaing.flash_deal_discount', compact('product_ids'));
    }
    // campaing product Edit
    public function product_discount_edit(Request $request){
        $product_ids = $request->product_ids;
        $campaing_id = $request->campaing_id;

        return view('backend.campaing.flash_deal_discount_edit', compact('product_ids', 'campaing_id'));
    }

}
