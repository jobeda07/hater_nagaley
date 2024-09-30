<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class LanguageController extends Controller
{
	/*=================== Start Bangla Methoed ===================*/
   	public function Bangla(){
	   	session()->get('language');
	   	session()->forget('language');
	   	Session::put('language','bangla');
	   	$notification = array(
            'message' => 'Language Updated Successfully.', 
            'alert-type' => 'success'
        );
	   	return redirect()->back()->with($notification);
    }
   /*=================== End Bangla Methoed ===================*/

   /*=================== Start English Methoed ===================*/
    public function English(){
	   	session()->get('language');
	   	session()->forget('language');
	   	Session::put('language','english');
	   	$notification = array(
            'message' => 'Language Updated Successfully.', 
            'alert-type' => 'success'
        );
	   	return redirect()->back()->with($notification);
    }
   /*=================== End English Methoed ===================*/
}
