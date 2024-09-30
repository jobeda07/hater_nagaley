<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Shipping;

class ShippingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $shippings = Shipping::latest()->get();
        return view('backend.shipping.index',compact('shippings'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.shipping.create');
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
            'name'  => 'required|max:150',
            'type' => 'required',
            'shipping_charge' => 'required',
            'time' => 'required',   
        ]);

        /* ============== type ============ */
        if($request->type == null){
            $request->type = 1;
        }

        /* ============== status ============ */
        if($request->status == null){
            $request->status = 1;
        }

        Shipping::create([
            'name'              => $request->name,
            'type'              => $request->type,
            'shipping_charge'   => $request->shipping_charge,
            'time'              => $request->time,
            'status'            => $request->status,
            
        ]);


        $notification = array(
            'message' => 'Shipping Inserted Successfully',
            'alert-type' => 'success'
        );
        return redirect()->route('shipping.index')->with($notification);

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
        $shippings = Shipping::findOrFail($id);
        return view('backend.shipping.edit', compact('shippings'));
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
        $shippings = Shipping::findOrFail($id);

        $this->validate($request,[
            'name'  => 'required|max:150',
            'type' => 'required',
            'shipping_charge' => 'required',
            'time' => 'required',   
        ]);

        /* ============== type ============ */
        if($request->type == null){
            $request->type = 1;
        }

        /* ============== status ============ */
        if($request->status == null){
            $request->status = 1;
        }

        $shippings->name             = $request->name;
        $shippings->type             = $request->type;
        $shippings->shipping_charge  = $request->shipping_charge;
        $shippings->time             = $request->time;
        $shippings->status           = $request->status;

        $shippings->save();

        $notification = array(
            'message' => 'Shipping Updated Successfully',
            'alert-type' => 'success'
        );
        return redirect()->route('shipping.index')->with($notification);



    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $shipping = Shipping::findOrFail($id);

        $shipping->delete();

        $notification = array(
            'message' => 'Shipping Deleted Successfully.',
            'alert-type' => 'error'
        );
        return redirect()->back()->with($notification);
    }

    /*=================== Start Active/Inactive Methoed ===================*/
    public function active($id){
        $shipping = Shipping::find($id);
        $shipping->status = 1;
        $shipping->save();

        $notification = array(
            'message' => 'Shipping Active Successfully.', 
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);
    }

    public function inactive($id){
        $shipping = Shipping::find($id);
        $shipping->status = 0;
        $shipping->save();

        $notification = array(
            'message' => 'Shipping Disable Successfully.', 
            'alert-type' => 'error'
        );
        return redirect()->back()->with($notification);
    }
}
