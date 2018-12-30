<?php

namespace App\Http\Controllers;

use Auth;
use App\Product;
use App\Prodcomment;
use Illuminate\Http\Request;

class ProdcommentController extends Controller
{   
    public function __construct(){
        $this->middleware('auth');
    }
    
    public function store(Request $request, $slug)
    {   
        $this->validate($request, [
                'description' => 'required|max:1000',
            ]);
        $product = Product::whereSlug($slug)->first();
        Prodcomment::create([
                'user_id' => Auth::user()->id,
                'product_id' => $product->id,
                'description' => $request->description,
            ]);
        return back();
    }
    
    public function update(Request $request, $id)
    {   
        $this->validate($request, [
                'descriptionEdit' => 'required|max:1000',
            ]);
        $comment = Prodcomment::whereId($id)->first();
        if ($comment->user->id == Auth::user()->id) {
            $comment->update([
                'description' => $request->descriptionEdit,
            ]);
        }else{
            return view('errors.503');
        }
        return back();
    }

}
