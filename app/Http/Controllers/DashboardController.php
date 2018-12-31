<?php

namespace App\Http\Controllers;

use App\Follower;
use App\Share;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function __construct(){
      $this->middleware('admin');
    }

    public function dashboard(){
    	return view('admin.dashboard');
    }
    
    public function inbox(){
    	
    }

    public function inboxStore(Request $request){
    		return Validator::make($data, [
            'user_id' => 'required|max:50',
            'email' => 'required|max:100',
            'description' => 'required|max:1000',
            //'g-recaptcha-response' => 'required|captcha',
        ]);
    }
    
}
