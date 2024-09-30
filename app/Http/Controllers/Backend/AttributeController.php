<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Models\Attribute;
use App\Models\AttributeValue;
use Image;
use Session;
use App\Helpers\Classes\Combinations;
use App\Models\Unit;
use Auth;

class AttributeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $attributes = Attribute::latest()->get();
        return view('backend.attribute.index', compact('attributes'));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function combination(){
        $options = array (
            array("S","M", "L"),
            array("Black","White"),
            array("A","B"),
          );

        $combinations = Combinations::makeCombinations($options);

        $data = [];
        foreach ($combinations as $combination) {
            $data[implode(', ', $combination)] = rand(10, 100);
        }

        return response()->json(['success' => true, 'data' => $data]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.attribute.create');
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
            'name' => 'required',
        ]);
        
        $request->name = str_replace(' ', '-', $request->name);

        $attribute = new Attribute();
        $attribute->name = $request->name;
        $attribute->created_by = Auth::guard('admin')->user()->id;
        $attribute->created_at = Carbon::now();
        $attribute->save();

        Session::flash('success','Attribute Inserted Successfully');
        return redirect()->route('attribute.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $attribute = Attribute::findOrFail($id);
        $values = AttributeValue::where('attribute_id', $id)->get();
        return view('backend.attribute.show',compact('attribute', 'values'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $attribute = Attribute::findOrFail($id);
        return view('backend.attribute.edit',compact('attribute'));
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
        $attribute = Attribute::find($id);
        
        $request->name = str_replace(' ', '-', $request->name);

        // Attribute table update
        $attribute->name = $request->name;
        $attribute->created_by = Auth::guard('admin')->user()->id;
        $attribute->save();

        $notification = array(
            'message' => 'Attribute Updated Successfully.',
            'alert-type' => 'success'
        );
        return redirect()->route('attribute.index')->with($notification);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $attribute = Attribute::findOrFail($id);
        $attribute->delete();

        $notification = array(
            'message' => 'Attribute Deleted Successfully.',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    }

    public function attribute_detail($id)
    {
        
    }


    // Value Store
    public function value_store(Request $request)
    {
        $this->validate($request,[
            'value' => 'required',
        ]);

        $value = new AttributeValue();
        $value->attribute_id = $request->attribute_id;
        $value->value = $request->value;
        $value->created_by = Auth::guard('admin')->user()->id;
        $value->created_at = Carbon::now();
        $value->save();

        Session::flash('success','Value Inserted Successfully');
        return redirect()->back();
    }

    public function value_edit($id)
    {
        $attr_val = AttributeValue::findOrFail($id);
        return view('backend.attribute.value_edit',compact('attr_val'));
    }
    
    public function value_update(Request $request, $id)
    {
        //dd($request);
        $attribute_val = AttributeValue::find($id);

        // Attribute table update
        $attribute_val->value = $request->value;
        $attribute_val->created_by = Auth::guard('admin')->user()->id;
        $attribute_val->update();

        $notification = array(
            'message' => 'Attribute Value Updated Successfully.',
            'alert-type' => 'success'
        );
        return redirect()->route('attribute.index')->with($notification);
    }

    // Attribute Value Delete
    public function value_destroy($id)
    {
        $attribute_value = AttributeValue::findOrFail($id);
        $attribute_value->delete();

        $notification = array(
            'message' => 'Attribute Value Deleted Successfully.',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    }

    /*=================== Start Active/Inactive Methoed ===================*/
    public function value_active($id){
        $attribute_value = AttributeValue::find($id);
        $attribute_value->status = 1;
        $attribute_value->save();

        Session::flash('success','Attribute Value Active Successfully.');
        return redirect()->back();
    }

    public function value_inactive($id){
        $attribute_value = AttributeValue::find($id);
        $attribute_value->status = 0;
        $attribute_value->save();

        Session::flash('warning','Attribute Value Inactive Successfully.');
        return redirect()->back();
    }

    // Unit
    public function index_unit()
    {
        $units = Unit::latest()->get();
        return view('backend.unit.index', compact('units'));
    }
    public function create_unit()
    {
        return view('backend.unit.create');
    }
    public function store_unit(Request $request)
    {
        $this->validate($request,[
            'name' => 'required',
        ]);

        $unit = new Unit();
        $unit->name = $request->name;
        if($request->status == Null){
            $request->status = 0;
        }
        $unit->status = $request->status;
        $unit->created_by = Auth::guard('admin')->user()->id;
        $unit->created_at = Carbon::now();
        $unit->save();

        Session::flash('success','Unit Inserted Successfully');
        return redirect()->route('unit.index');
    }
    public function edit_unit($id)
    {
        $unit = Unit::findOrFail($id);
        return view('backend.unit.edit',compact('unit'));
    }
    public function update_unit(Request $request, $id)
    {
        $unit = Unit::find($id);

        // unit table update
        $unit->name = $request->name;
        if($request->status == Null){
            $request->status = 0;
        }
        $unit->status = $request->status;
        $unit->created_by = Auth::guard('admin')->user()->id;
        $unit->save();

        $notification = array(
            'message' => 'Unit Updated Successfully.',
            'alert-type' => 'success'
        );
        return redirect()->route('unit.index')->with($notification);
    }
    public function destroy_unit($id)
    {
        $unit = Unit::findOrFail($id);
        $unit->delete();

        $notification = array(
            'message' => 'Unit Deleted Successfully.',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    }
    public function changeStatus($id){
        $unit = Unit::find($id);
        if($unit->status == 0){
            $unit->status = 1;
        }else{
            $unit->status = 0;
        }
        $unit->save();

        Session::flash('success','Status Changed Successfully.');
        return redirect()->back();
    }
}