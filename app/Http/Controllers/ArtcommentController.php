<?php

namespace App\Http\Controllers;

use Auth;
use App\Article;
use App\Artcomment;
use Illuminate\Http\Request;

class ArtcommentController extends Controller
{   
    public function __construct(){
        $this->middleware('auth');
    }
    
    public function store(Request $request, $slug)
    {   
        $this->validate($request, [
                'description' => 'required|max:1000',
            ]);
        $article = Article::whereSlug($slug)->first();
        Artcomment::create([
                'user_id' => Auth::user()->id,
                'article_id' => $article->id,
                'description' => $request->description,
            ]);
        return back();
    }
    
    public function update(Request $request, $id)
    {   
        $this->validate($request, [
                'descriptionEdit' => 'required|max:1000',
            ]);
        $comment = Artcomment::whereId($id)->first();
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
