<?php

namespace App\Http\Controllers\Frontend;
use Carbon\Carbon;
use App\Models\Review;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class ReviewController extends Controller
{
    public function index(){
        $review = Review::latest()->get();
        return view('backend.review.index',compact('review'));
    }

    public function store(Request $request){

        $request->validate([
           // 'name'=>'required',
            'rating'=>'required',
            'review'=>'required',
            'product_id'=>'required',
        ]);

        $review = Review::where(['user_id' => $request->user_id, 'product_id' => $request->product_id])->first();

        if(!$review){
            if(Auth::check()){
                $review =new Review();
                $review->user_id = Auth::user()->id;
                $review->product_id = $request->product_id;
               // $review->name = $request->name;
                $review->rating = $request->rating;
                $review->review = $request->review;
                $review->status = 1;
                $review->save();
                Session::flash('success','Review Submited Successfully.');
                return back();

            }else{
                $notification = array(
                    'message' => 'You have to login for review.',
                    'alert-type' => 'error'
                );
                return redirect()->route('login')->with($notification);

            }
        }
        else{
            $notification = array(
                'message' => 'You are  already give review.',
                'alert-type' => 'error'
            );
            return redirect()->back()->with($notification);
        }
    }

    public function destroy($id){
        $review = Review::findOrfail($id);
        $review->delete();
        Session::flash('success','Review Delete Successfully!');
        return redirect()->route('review.index');
    }

    /*=================== Start Active/Inactive Methoed ===================*/
    public function active($id){
        $review = Review::find($id);
        $review->status = 1;
        $review->save();

        $notification = array(
            'message' => 'Review Active Successfully.',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    }

    public function inactive($id){
        $review = Review::find($id);
        $review->status = 0;
        $review->save();

        $notification = array(
            'message' => 'Review Inactive Successfully.',
            'alert-type' => 'error'
        );
        return redirect()->back()->with($notification);
    }


}
