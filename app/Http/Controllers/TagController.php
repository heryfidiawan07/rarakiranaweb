<?php

namespace App\Http\Controllers;

use Auth;
use App\Tag;
use Illuminate\Http\Request;

class TagController extends Controller
{   
    public function __construct(){
      $this->middleware('admin');
    }
    
    public function activate(Request $request){
        $uncat = Tag::where('slug','uncategorised')->first();
        if ($uncat === null) {
            Tag::create([
                'user_id' => Auth::user()->id,
                'name' => 'UNCATEGORISED',
                'slug' => 'uncategorised',
                'setting' => 1,
            ]);
        }
        Tag::create([
                'user_id' => Auth::user()->id,
                'name'    => strtoupper($request->forumName),
                'slug'    => str_slug($request->forumName),
                'setting' => 10,
            ]);
        return back();
    }    

    public function forumUpdate(Request $request, $id){
        $tag = Tag::whereId($id)->first();
        $tag->update([
                'name' => strtoupper($request->forumUpdate),
                'slug' => str_slug($request->forumUpdate),
            ]);
        return back();
    }

    public function forumStatus(Request $request, $id){
        $tag = Tag::whereId($id)->first();
        $tag->update([
                'status' => $request->statusForum,
            ]);
        return back();
    }
    
    public function store(Request $request){
        $this->validate($request, [
                'name' => 'required|unique:tags|max:50',
            ]);
        Tag::create([
                'user_id' => Auth::user()->id,
                'name' => strtoupper($request->name),
                'slug' => str_slug($request->name),
                'parent_id' => $request->parent_id,
            ]);
        return back();
    }

    public function updateName(Request $request, $id){
        $this->validate($request, [
                'tagEdit' => 'required|max:50',
            ]);
        $tag = Tag::whereId($id)->first();
        $cekTag = Tag::where('slug',str_slug($request->tagEdit))->first();
        if ($cekTag === null) {
            $tag->update([
                    'user_id' => Auth::user()->id,
                    'name' => strtoupper($request->tagEdit),
                    'slug' => str_slug($request->tagEdit),
                ]);
        }else{
            return back()->with('warningEdit', 'Nama tag sudah ada, silahkan ganti nama yang lain !');
        }
        return back();
    }
    
    public function updateParent(Request $request, $id){
        $tag    = Tag::whereId($id)->first();
        $tag->update([
                'user_id' => Auth::user()->id,
                'parent_id' => $request->parent_edit,
            ]);
        return back();
    }

    public function status(Request $request, $id){
        $tag = Tag::whereId($id)->first();
        $tag->update([
                'status' => $request->status,
            ]);
        return back();
    }

    public function delete($id){
        $uncat = Tag::where('slug','uncategorised')->first();
        $tag   = Tag::find($id);
        $tag->threads()->update([
                'tag_id' => $uncat->id,
            ]);
        $tag->delete();
        return redirect('/dashboard/forum');
    }
    
}
