<?php

namespace App\Http\Controllers;

use App\Forum;
use App\Article;
use App\Product;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {	
    		$newarticles = Article::where('status',1)->latest()->paginate(3);
    		$newcommentart = Article::with(['artcomments' => function($com){
    			$com->latest()->limit(3)->get();
    		}])->where('status',1);
    		$newproducts = Product::where('status',1)->latest()->paginate(5);
    		$newthreads = Forum::where('status',1)->latest()->paginate(4);
    		// Post::with( ['comments' => function($c){
      //           $c->latest()->limit(5)->get() ;
      //       } ])->where('status', 'publish');
    		// $hothreads   = Forum::where('status', 1)->withCount('comments')->orderBy('comments_count', 'desc')->paginate(4);
        return view('home',compact('newarticles','newcommentart','newproducts','newthreads'));
    }
    
}
