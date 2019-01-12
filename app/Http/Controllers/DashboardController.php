<?php

namespace App\Http\Controllers;

//Analytics
use Analytics;
use Spatie\Analytics\Period;

use App\User;
use App\Post;
use App\Thread;
use App\Product;
use App\Question;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function __construct(){
      $this->middleware('admin');
    }

    public function dashboard(){
        $online   = Analytics::getAnalyticsService()->data_realtime->get('ga:'.env('ANALYTICS_VIEW_ID'), 'rt:activeVisitors')
                    ->totalsForAllResults['rt:activeVisitors'];
        $users    = User::all();
        $posts    = Post::all();
        $threads  = Thread::all();
        $products = Product::all();
    	return view('admin.dashboard',compact('online','users','posts','products','threads'));
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
        $questions = Question::latest()->paginate(10);
        return view('admin.question.index',compact('questions'));
    }
    
}
