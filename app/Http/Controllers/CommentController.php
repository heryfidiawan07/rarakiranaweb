<?php

namespace App\Http\Controllers;

use Auth;
use App\Post;
use App\Thread;
use App\Product;
use App\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{   
    public function __construct(){
        $this->middleware('auth');
    }
    
    public function postStore(Request $request, $slug)
    {   
        $this->validate($request, [
                'description' => 'required|max:1000',
            ]);
        $post = Post::whereSlug($slug)->first();
        Comment::create([
                'user_id' => Auth::user()->id,
                'commentable_id' => $post->id,
                'commentable_type' => 'App\Post',
                'description' => $request->description,
            ]);
        return back();
    }
    
    public function postUpdate(Request $request, $id)
    {   
        $this->validate($request, [
                'descriptionEdit' => 'required|max:1000',
            ]);
        $comment = Comment::whereId($id)->first();
        if ($comment->user->id == Auth::user()->id) {
            $comment->update([
                'description' => $request->descriptionEdit,
            ]);
        }else{
            return view('errors.503');
        }
        return back();
    }

    public function threadStore(Request $request, $slug)
    {   
        $this->validate($request, [
                'description' => 'required|max:1000',
            ]);
        $thread = Thread::whereSlug($slug)->first();
        Comment::create([
                'user_id' => Auth::user()->id,
                'commentable_id' => $thread->id,
                'commentable_type' => 'App\Thread',
                'description' => $request->description,
            ]);
        return back();
    }

    public function threadUpdate(Request $request, $id)
    {   
        $this->validate($request, [
                'descriptionEdit' => 'required|max:1000',
            ]);
        $comment = Comment::whereId($id)->first();
        if ($comment->user->id == Auth::user()->id) {
            $comment->update([
                'description' => $request->descriptionEdit,
            ]);
        }else{
            return view('errors.503');
        }
        return back();
    }

    public function productStore(Request $request, $slug)
    {   
        $this->validate($request, [
                'description' => 'required|max:1000',
            ]);
        $product = Product::whereSlug($slug)->first();
        Comment::create([
                'user_id' => Auth::user()->id,
                'commentable_id' => $product->id,
                'commentable_type' => 'App\Product',
                'description' => $request->description,
            ]);
        return back();
    }

    public function productUpdate(Request $request, $id)
    {   
        $this->validate($request, [
                'descriptionEdit' => 'required|max:1000',
            ]);
        $comment = Comment::whereId($id)->first();
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
