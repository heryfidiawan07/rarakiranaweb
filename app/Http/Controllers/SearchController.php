<?php

namespace App\Http\Controllers;

use App\Forum;
use App\Article;
use App\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;

class SearchController extends Controller
{
    public function search(Request $request){
    	$val = $request->input('val');
    	$articles = Article::where('title','LIKE',"%{$val}%")->latest()->paginate(10);
    	$products = Product::where('title','LIKE',"%{$val}%")->latest()->paginate(10);
    	$threads = Forum::where('title','LIKE',"%{$val}%")->latest()->paginate(10);
    	
    	return view('search.index',compact('articles','products','threads'));
    }
    
}
