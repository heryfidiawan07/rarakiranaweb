<?php

namespace App\Http\Controllers;

//Analytics
use Analytics;
use Spatie\Analytics\Period;

use DB;
use App\User;
use App\Post;
use App\Order;
use App\Thread;
use App\Payment;
use App\Product;
use App\Message;
use App\Question;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function __construct(){
      $this->middleware('admin');
    }

    public function dashboard(){
        $online    = Analytics::getAnalyticsService()->data_realtime
                    ->get('ga:'.env('ANALYTICS_VIEW_ID'), 'rt:activeVisitors')
                    ->totalsForAllResults['rt:activeVisitors'];
        $today     = Analytics::fetchVisitorsAndPageViews(Period::days(0));
        //dd($today[0]);
        $users     = User::all();
        $posts     = Post::all();
        $threads   = Thread::all();
        $products  = Product::all();
        //Status = [1 = Telah di bayar/Menunggu di proses penjual | 2 = Sedang di proses penjual | 3 = Sedang dalam pengiriman | 4 = Barang telah di terima 5 = Cancel ]
        $orders    = Order::where('status',1)->get();
        $sold      = Payment::where('status','>',0)->sum('total_qty');//if == 5 -> Cancel
        $questions = Question::all();
        $messages  = DB::table('users')->join('messages', 'users.id', '=', 'messages.messageable_id')
                     ->where('messages.messageable_type', 'App\User')->get();
        $countPostComment    = DB::table('posts')->join('comments', 'posts.id', '=', 'comments.commentable_id')
                               ->where('comments.commentable_type', 'App\Post')->get();
        $countThreadComment  = DB::table('threads')->join('comments', 'threads.id', '=', 'comments.commentable_id')
                               ->where('comments.commentable_type', 'App\Thread')->get();
        $countProductComment = DB::table('products')->join('comments', 'products.id', '=', 'comments.commentable_id')
                               ->where('comments.commentable_type', 'App\Product')->get();
    	return view('admin.dashboard',compact('online','today','users','posts','products','threads','orders','sold','questions','messages','countPostComment','countThreadComment','countProductComment'));
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
