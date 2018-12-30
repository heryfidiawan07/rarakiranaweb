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
		$newproducts = Product::where('status',1)->latest()->paginate(5);
		$newthreads = Forum::where('status',1)->latest()->paginate(4);
    $artrecents = Article::join('artcomments', 'articles.id', '=', 'artcomments.article_id')
                  ->orderBy('artcomments.updated_at','DESC')->groupBy('artcomments.article_id')
                  ->take(5)->get();
    //$artrecents = Article::where('status',1)->withCount('artcomments')->orderBy('artcomments_count', 'desc')->take(5)->get();
    $threadrecents = Forum::join('forcomments', 'forums.id', '=', 'forcomments.forum_id')
                  ->orderBy('forcomments.updated_at','DESC')->groupBy('forcomments.forum_id')
                  ->take(5)->get();

        return view('home',compact('newarticles','artrecents','newproducts','newthreads','threadrecents'));
    }
    
}
