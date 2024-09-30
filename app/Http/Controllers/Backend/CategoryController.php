<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use Illuminate\Support\Carbon;
use Session;
use Image;
use Illuminate\Support\Str;
use App\Utility\CategoryUtility;
use Illuminate\Support\Facades\DB;
use Auth;

class CategoryController extends Controller
{

    /*=================== Start CategoryView Methoed ===================*/
    public function index(){

        //$categories = Category::latest()->get();
        $categories = DB::table('categories as c')
            ->leftJoin('categories as sc', 'c.parent_id', '=', 'sc.id')
            ->select('c.*', 'sc.id as parent_id', 'sc.name_en as parent_name')
            ->latest()
            ->get();

        return view('backend.category.index',compact('categories'));
    } // end method

    /*=================== Start CategoryView Methoed ===================*/
    public function create(){

        $categories = Category::where('parent_id', 0)
            ->with('childrenCategories')
            ->get();

        return view('backend.category.create',compact('categories'));
    } // end method

    /*=================== Start Store Methoed ===================*/
    public function store(Request $request)
    {
        $this->validate($request,[
            'name_en' => 'required',
        ]);

        if($request->hasfile('image')){
            $image = $request->file('image');
            $name_gen = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
            Image::make($image)->resize(300,300)->save('upload/category/'.$name_gen);
            $save_url = 'upload/category/'.$name_gen; 
        }else{
            $save_url = '';
        }

        $category = new Category;

        /* ======== Category Name English ======= */
        $category->name_en = $request->name_en;
        if($request->name_bn == ''){
            $category->name_bn = $request->name_en;
        }else{
            $category->name_bn = $request->name_bn;
        }

        /* ======== Category Description English ======= */
        $category->description_en = $request->description_en;
        if($request->description_bn == ''){
            $category->description_bn = $request->description_en;
        }else{
            $category->description_bn = $request->description_bn;
        }

        /* ======== Category Parent Id  ======= */
        if ($request->parent_id != "0") {
            $category->parent_id = $request->parent_id;

            $parent = Category::find($request->parent_id);

            // dd($parent);
            $category->type = $parent->type + 1 ;
        }

        /* ======== Category Slug   ======= */
        if ($request->slug != null) {
            $category->slug = preg_replace('/[^A-Za-z0-9\-]/', '', str_replace(' ', '-', $request->slug));
        }else {
            $category->slug = preg_replace('/[^A-Za-z0-9\-]/', '', str_replace(' ', '-', $request->name_en)).'-'.Str::random(5);
        }

        /* ======== Status   ======= */
        if($request->status == Null){
            $request->status = 0;
        }
        $category->status = $request->status;

        /* ======== Featured   ======= */
        if($request->is_featured == Null){
            $request->is_featured = 0;
        }
        $category->is_featured = $request->is_featured;
        $category->image = $save_url;
        $category->created_by = Auth::guard('admin')->user()->id;
        $category->created_at = Carbon::now();

        // dd($request()->all());
        $category->save();

        Session::flash('success', 'Category has been inserted successfully.');
        return redirect()->route('category.index');
    } // end method

    public function edit($id)
    {
        $category = Category::findOrFail($id);

        $categories = Category::where('parent_id', 0)
            ->with('childrenCategories')
            ->whereNotIn('id', CategoryUtility::children_ids($category->id, true))->where('id', '!=' , $category->id)
            ->orderBy('name_en','asc')
            ->get();

        return view('backend.category.edit',compact('category', 'categories'));
    } // end method

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

        $category = Category::findOrFail($id);
        //Category Photo Update
        if($request->hasfile('image')){
            try {
                if(file_exists($category->image)){
                    unlink($category->image);
                }
            } catch (Exception $e) {
                
            }
            $image = $request->image;
            $category_save = time().$image->getClientOriginalName();
            $image->move('upload/category/',$category_save);
            $category->image = 'upload/category/'.$category_save;
        }else{
            $category_save = '';
        }

        /* ======== Category Name English ======= */
        $category->name_en = $request->name_en;
        if($request->name_bn == ''){
            $category->name_bn = $request->name_en;
        }else{
            $category->name_bn = $request->name_bn;
        }

        /* ======== Category Description English ======= */
        $category->description_en = $request->description_en;
        if($request->description_bn == ''){
            $category->description_bn = $request->description_en;
        }else{
            $category->description_bn = $request->description_bn;
        }

       /* ======== Category Parent Id  ======= */
        if ($request->parent_id != "0") {
            $category->parent_id = $request->parent_id;

            $parent = Category::find($request->parent_id);
            $category->type = $parent->type + 1 ;
        }else{
            $category->parent_id = 0;
            $category->type = 1;
        }

        /* ======== Category Slug   ======= */
        if ($request->slug != null) {
            $category->slug = preg_replace('/[^A-Za-z0-9\-]/', '', str_replace(' ', '-', $request->slug));
        }else {
            $category->slug = preg_replace('/[^A-Za-z0-9\-]/', '', str_replace(' ', '-', $request->name_en)).'-'.Str::random(5);
        }

        /* ======== Status   ======= */
        if($request->status == Null){
            $request->status = 0;
        }
        $category->status = $request->status;

        /* ======== Featured   ======= */
        if($request->is_featured == Null){
            $request->is_featured = 0;
        }

        $category->is_featured = $request->is_featured;
        $category->created_by = Auth::guard('admin')->user()->id;

        $category->updated_at = Carbon::now();

        // dd($request()->all());
        $category->save();

        Session::flash('success', 'Category has been updated successfully.');
        return redirect()->route('category.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if(!demo_mode()){
            $category = Category::findOrFail($id);
    
            CategoryUtility::delete_category($id);
            
            Session::flash('success','Category has been deleted successfully');
            return redirect()->route('category.index');
        }else{
            $notification = array(
                'message' => 'Category can not be deleted on demo mode.',
                'alert-type' => 'error'
            );
            return redirect()->back()->with($notification);
        }
    }





    /*=================== Start CategoryUpdate Methoed ===================*/
    public function CategoryUpdate(Request $request, $id){
    	$this->validate($request,[
            'name_en' => 'required',
        ]);

        $category = Category::find($id);
    	$old_img = $request->old_image;
    	$category_img = $category->category_image;

        //Category Photo Update
        if($request->hasfile('category_image')){
            if($category_img !== ''){
                unlink($old_img);
            }
            $category_image = $request->category_image;
            $category_save = time().$category_image->getClientOriginalName();
            $category_image->move('upload/category/',$category_save);
            $category->category_image = 'upload/category/'.$category_save;
        }else{
            $category_save = '';
        }

        // Category table update
        $category->name_en = $request->name_en;
        if($request->name_bn == ''){
            $category->name_bn = $request->name_en;
        }else{
            $category->name_bn = $request->name_bn;
        }
        $category->description_en = $request->description_en;
        if($request->description_bn == ''){
            $category->description_bn = $request->description_en;
        }else{
            $category->description_bn = $request->description_bn;
        }
        $category->slug = preg_replace('/[^A-Za-z0-9\-]/', '', str_replace(' ', '-', strtolower($request->name_en)));
        $category->is_feature = $request->is_feature;
        $category->status = $request->status;

        $category->save();

		Session::flash('success','Category Updated Successfully');
		return redirect()->route('category.all');
    }

    /*=================== Start CategoryDelete Methoed ===================*/
    public function CategoryDelete($id){

    	$category = Category::findOrFail($id);
    	// $img = $category->category_image;

        // if($img !== ''){
        //     unlink($img);
        // }

    	$category->delete();

    	$notification = array(
            'message' => 'Category Deleted Successfully.', 
            'alert-type' => 'error'
        );
		return redirect()->back()->with($notification);

    } // end method 

    /*=================== Start Active/Inactive Methoed ===================*/
    public function active($id){
        $category = Category::find($id);
        $category->status = 1;
        $category->save();

        Session::flash('success','Category Activated Successfully.');
        return redirect()->back();
    }

    public function inactive($id){
        $category = Category::find($id);
        $category->status = 0;
        $category->save();

        Session::flash('success','Category Disabled Successfully.');
        return redirect()->back();
    }

    public function changeFeatureStatus($id){
        $category = Category::find($id);
        if($category->is_featured == 0){
            $category->is_featured = 1;
        }else{
            $category->is_featured = 0;
        }
        $category->save();

        Session::flash('success','Feature Status Changed Successfully.');
        return redirect()->back();
    }

}
