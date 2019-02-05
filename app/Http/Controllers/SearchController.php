<?php

namespace App\Http\Controllers;

use App\Thread;
use App\Post;
use App\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;

class SearchController extends Controller
{
    public function search(Request $request){
    	$val = $request->input('val');
    	$posts = Post::where('title','LIKE',"%{$val}%")->latest()->paginate(10);
    	$products = Product::where('title','LIKE',"%{$val}%")->latest()->paginate(10);
    	$threads = Thread::where('title','LIKE',"%{$val}%")->latest()->paginate(10);
    	if ($posts->count()) {
    		return view('search.index',compact('posts','products','threads'));
    	}elseif ($products->count()) {
    		return view('search.index',compact('posts','products','threads'));
    	}elseif ($threads->count()) {
    		return view('search.index',compact('posts','products','threads'));
    	}else {
    		return view('search.index',compact('posts','products','threads'))->with('kosong', 'Hasil pencarian tidak di temukan !');
    	}
    }
    
}
