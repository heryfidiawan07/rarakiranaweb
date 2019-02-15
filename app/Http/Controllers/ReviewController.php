<?php

namespace App\Http\Controllers;

use Auth;
use Purifier;
use App\Review;
use App\Product;
use Illuminate\Http\Request;

class ReviewController extends Controller
{   

    public function __construct(){
        $this->middleware('auth');
    }

    public function review(Request $request, $slug){
        $product = Product::whereSlug($slug)->first();
        if($product){
            Review::create([
                'user_id' => Auth::user()->id,
                'product_id' => $product->id,
                'description' => Purifier::clean($request->review),
                'setting' => 0,
            ]);
            return back();
        }else{
            return view('errors.503');
        }
    }
}
