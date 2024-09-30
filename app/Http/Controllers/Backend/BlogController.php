<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Models\Blog;
use Image;
use Session;

class BlogController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $blogs = Blog::latest()->get();
        return view('backend.blog.index', compact('blogs'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.blog.create');
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
            'blog_img' => 'required',
        ]);

        if($request->hasfile('blog_img')){
            $image = $request->file('blog_img');
            $name_gen = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
            Image::make($image)->resize(300,300)->save('upload/blog/'.$name_gen);
            $save_url = 'upload/blog/'.$name_gen;
        }else{
            $save_url = '';
        }

        $blog = new Blog();
        $blog->title_en = $request->title_en;
        if($request->title_bn == ''){
            $blog->title_bn = $request->title_en;
        }else{
            $blog->title_bn = $request->title_bn;
        }
        $blog->slug = preg_replace('/[^A-Za-z0-9\-]/', '', str_replace(' ', '-', strtolower($request->title_en)));
        if($request->status == Null){
            $request->status = 0;
        }
        $blog->status = $request->status;
        $blog->blog_img = $save_url;
        $blog->created_at = Carbon::now();

        $blog->save();

        Session::flash('success','Blog Inserted Successfully');
        return redirect()->route('blog.index');

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

    {   $blog = Blog::findOrFail($id);
        return view('backend.blog.edit',compact('blog'));
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
        ]);
        
        $blog = Blog::find($id);

        // Blog Photo Update
        if($request->hasfile('blog_img')){
            try {
                if(file_exists($blog->blog_img)){
                    unlink($blog->blog_img);
                }
            } catch (Exception $e) {
                
            }
            $blog_img = $request->blog_img;
            $blog_save = time().$blog_img->getClientOriginalName();
            $blog_img->move('upload/blog/',$blog_save);
            $blog->blog_img = 'upload/blog/'.$blog_save;
        }else{
            $blog_save = '';
        }

        // blog table update
        $blog->title_en = $request->title_en;
        if($request->title_bn == ''){
            $blog->title_bn = $request->title_en;
        }else{
            $blog->title_bn = $request->title_bn;
        }
        $blog->slug = preg_replace('/[^A-Za-z0-9\-]/', '', str_replace(' ', '-', strtolower($request->title_en)));
        if($request->status == Null){
            $request->status = 0;
        }
        $blog->status = $request->status;
        $blog->created_at = Carbon::now();

        $blog->save();

        $notification = array(
            'message' => 'Blog Updated Successfully.',
            'alert-type' => 'success'
        );
        return redirect()->route('blog.index')->with($notification);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $blog = Blog::findOrFail($id);
        try {
            if(file_exists($blog->blog_img)){
                unlink($blog->blog_img);
            }
        } catch (Exception $e) {
            
        }

        $blog->delete();

        $notification = array(
            'message' => 'Blog Deleted Successfully.',
            'alert-type' => 'error'
        );
        return redirect()->back()->with($notification);
    }
    /*=================== Start Active/Inactive Methoed ===================*/
    public function active($id){
        $blog = Blog::find($id);
        $blog->status = 1;
        $blog->save();

        Session::flash('success','Blog Active Successfully.');
        return redirect()->back();
    }

    public function inactive($id){
        $blog = Blog::find($id);
        $blog->status = 0;
        $blog->save();

        Session::flash('warning','Blog Inactive Successfully.');
        return redirect()->back();
    }
}
