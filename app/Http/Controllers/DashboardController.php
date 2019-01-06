<?php

namespace App\Http\Controllers;

use App\User;
use App\Share;
use App\Inbox;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function __construct(){
      $this->middleware('admin');
    }

    public function dashboard(){
    	return view('admin.dashboard');
    }

    public function users(){
        $users = User::all();
        return view('admin.users.index',compact('users'));
    }
    
    public function statusUsers(Request $request, $id){
        $user = User::whereId($id)->first();
        $user->update([
                'status' => $request->status,
            ]);
        return back();
    }

    public function inbox(){
        $inboxs = Inbox::all();
        return view('admin.inboxs.index',compact('inboxs'));
    }
    
    
}
