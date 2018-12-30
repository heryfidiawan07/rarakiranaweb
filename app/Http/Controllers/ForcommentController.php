<?php

namespace App\Http\Controllers;

use Auth;
use App\Forum;
use App\Forcomment;
use Illuminate\Http\Request;

class ForcommentController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }
    
    public function store(Request $request, $slug)
    {   
        $this->validate($request, [
                'description' => 'required|max:1000',
            ]);
        $thread = Forum::whereSlug($slug)->first();
        Forcomment::create([
                'user_id' => Auth::user()->id,
                'forum_id' => $thread->id,
                'description' => $request->description,
            ]);
        return back();
    }
    
    public function update(Request $request, $id)
    {   
        $this->validate($request, [
                'descriptionEdit' => 'required|max:1000',
            ]);
        $comment = Forcomment::whereId($id)->first();
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
