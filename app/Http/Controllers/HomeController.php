<?php

namespace App\Http\Controllers;

use DB;
use App\Logo;
use App\Post;
use App\Promo;
use App\Thread;
use App\Product;
use App\Comment;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {	//Promo setting 1 = Home Logo/Main 2 = Post Logo 3 = Thread Logo 4 = Product Logo
        $logo        = Logo::where('setting','main')->first();
        $promo       = Promo::where('setting','main')->first();
    	$newposts    = Post::where('status',1)->latest('sticky')->paginate(3);
    	$newproducts = Product::where('status',1)->latest('sticky')->paginate(5);
    	$newthreads  = Thread::where('status',1)->latest('sticky')->paginate(4);

        $postrecents   = Post::has('comments')->latest()->paginate(5);
        $threadrecents = Thread::has('comments')->latest()->paginate(5);

        return view('home',compact('newposts','postrecents','newproducts','newthreads','threadrecents','logo','promo'));
    }
    
}
