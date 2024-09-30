<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Supplier;
use Session;
use Illuminate\Support\Facades\Auth;

class SupplierController extends Controller
{

	/*=================== Start BrandView Methoed ===================*/
    public function SupplierView(){

        if(Auth::guard('admin')->user()->role != '1' && Auth::guard('admin')->user()->role != '2'){
            abort(404);
        }

    	$suppliers = Supplier::latest()->get();
    	return view('backend.supplier.supplier_view',compact('suppliers'));

    }

    public function create()
    {   
        if(Auth::guard('admin')->user()->role != '1' && Auth::guard('admin')->user()->role != '2'){
            abort(404);
        }

        return view('backend.supplier.create');
    }

    public function store(Request $request)
    {
        $this->validate($request,[
            'name' => 'required',
            'phone' => 'required',
            'email' => 'required|email',
            'address' => 'required',
        ]);

        $supplier = Supplier::where('phone',$request->phone)->first();

        if($supplier){
            $notification = array(
                'message' => 'Supplier Phone Already Created.', 
                'alert-type' => 'error'
            );
            return redirect()->back()->with($notification);
        }else{
            Supplier::insert([
                'name' => $request->name,
                'phone' => $request->phone,
                'email' => $request->email,
                'address' => $request->address,
                'status' => $request->status,
                'created_by' => Auth::guard('admin')->user()->id,
            ]);

            Session::flash('success','Supplier Inserted Successfully');
            return redirect()->route('supplier.all');
        }
    }

    public function edit($id)
    {
        $supplier = Supplier::findOrFail($id);
        return view('backend.supplier.edit',compact('supplier'));
    }

    public function update(Request $request, $id)
    {
        $supplier = Supplier::find($id);

        $this->validate($request,[
            'name' => 'required',
            'phone' => 'required',
            'email' => 'required|email',
            'address' => 'required',
        ]);

        Supplier::findOrFail($id)->update([
            'name' => $request->name,
            'phone' => $request->phone,
            'email' => $request->email,
            'address' => $request->address,
            'status' => $request->status,
            'created_by' => Auth::guard('admin')->user()->id,
        ]);

        Session::flash('success','Supplier Updated Successfully');
        return redirect()->route('supplier.all');
    }

    public function destroy($id)
    {
        Supplier::findOrFail($id)->delete();

        $notification = array(
            'message' => 'Supplier Deleted Successfully.', 
            'alert-type' => 'error'
        );
        return redirect()->back()->with($notification);
    }


    /*=================== Start Active/Inactive Methoed ===================*/
    public function active($id){
        $supplier = Supplier::find($id);
        $supplier->status = 1;
        $supplier->save();

        $notification = array(
            'message' => 'Supplier Active Successfully.', 
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    }

    public function inactive($id){
        $supplier = Supplier::find($id);
        $supplier->status = 0;
        $supplier->save();

        $notification = array(
            'message' => 'Supplier Inactive Successfully.', 
            'alert-type' => 'error'
        );
        return redirect()->back()->with($notification);
    }
}
