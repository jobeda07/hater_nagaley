<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Models\Page;
use Session;

class PageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pages = Page::latest()->get();
        return view('backend.pages.index',compact('pages'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.pages.create');
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
            'description_en' => 'required',
        ]);

        $page = new Page();
        $page->name_en = $request->name_en;

        if($request->name_bn == ''){
            $page->name_bn = $request->name_en;
        }else{
            $page->name_bn = $request->name_bn;
        }

        $page->title = $request->title;

        $page->description_en = $request->description_en;

        if($request->description_bn == ''){
            $page->description_bn = $request->description_en;
        }else{
            $page->description_bn = $request->description_bn;
        }


        $page->slug = preg_replace('/[^A-Za-z0-9\-]/', '', str_replace(' ', '-', strtolower($request->name_en)));
        $page->position = $request->position;
        if($request->status == Null){
            $request->status = 0;
        }
        $page->status = $request->status;
        $page->created_at = Carbon::now();

        $page->save();

        Session::flash('success','Page Inserted Successfully');
        return redirect()->route('page.index');
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
        $page = Page::findOrFail($id);
        return view('backend.pages.edit',compact('page'));
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
            'description_en' => 'required',
        ]);
        
        $page = Page::find($id);

        // Page table update
        $page->name_en = $request->name_en;

        if($request->name_bn == ''){
            $page->name_bn = $request->name_en;
        }else{
            $page->name_bn = $request->name_bn;
        }
        $page->title = $request->title;
        $page->description_en = $request->description_en;

        if($request->description_bn == ''){
            $page->description_bn = $request->description_en;
        }else{
            $page->description_bn = $request->description_bn;
        }
        $page->slug = preg_replace('/[^A-Za-z0-9\-]/', '', str_replace(' ', '-', strtolower($request->name_en)));
        $page->position = $request->position;
        if($request->status == Null){
            $request->status = 0;
        }
        $page->status = $request->status;
        $page->created_at = Carbon::now();

        $page->save();

        $notification = array(
            'message' => 'Page Updated Successfully.',
            'alert-type' => 'success'
        );
        return redirect()->route('page.index')->with($notification);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $page = Page::findOrFail($id);

        $page->delete();

        $notification = array(
            'message' => 'Page Deleted Successfully.',
            'alert-type' => 'error'
        );
        return redirect()->back()->with($notification);
    }
    /*=================== Start Active/Inactive Methoed ===================*/
    public function active($id){
        $page = Page::find($id);
        $page->status = 1;
        $page->save();

        Session::flash('success','Page Active Successfully.');
        return redirect()->back();
    }

    public function inactive($id){
        $page = Page::find($id);
        $page->status = 0;
        $page->save();

        Session::flash('warning','Page Inactive Successfully.');
        return redirect()->back();
    }
}
