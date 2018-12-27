<?php

namespace App\Http\Controllers;

use Auth;
use Purifier;
use App\Menu;
use App\Forum;
use Illuminate\Http\Request;

class ForumController extends Controller
{
    public function __construct(){
        $this->middleware('admin', ['except'=>['show','tag','create','store','edit','update']]);
    }

    public function index()
    {
        $threads = Forum::all();
        $tags = Menu::where('setting',20)->get();
        return view('admin.forum.index', compact('threads','tags'));
    }

    public function tagStore(Request $request){
        $this->validate($request, [
                'tag' => 'required',
            ]);
        $tag = Menu::where('setting',11)->first();
        if ($request->parent_tag == 0) {
            $setting = 20;
            $parent_tag = $tag->id;
        }else{
            $setting = 21;
            $parent_tag = $request->parent_tag;
        }
        Menu::create([
                'user_id' => Auth::user()->id,
                'menu' => $request->tag,
                'slug' => str_slug($request->tag),
                'parent_id' => $parent_tag,
                'setting' => $setting,
            ]);
        return back();
    }

    public function tagUpdate(Request $request, $id){
        $this->validate($request, [
                'tagEdit' => 'required',
            ]);
        $menuForum = Menu::where('setting',11)->first();
        $tag = Menu::whereId($id)->first();
        if ($request->parent_edit == 0) {
            $setting = 20;
            $parent_id = $menuForum->id;
        }else{
            $setting = 21;
            $parent_id = $request->parent_edit;
        }
        $tag->update([
                'user_id' => Auth::user()->id,
                'menu' => $request->tagEdit,
                'slug' => str_slug($request->tagEdit),
                'parent_id' => $parent_id,
                'setting' => $setting,
            ]);
        return back();
    }

    public function tagStatus(Request $request, $id){
        $tag = Menu::whereId($id)->first();
        $tag->update([
                'status' => $request->status,
            ]);
        return back();
    }
    
    public function destroy($id){
        if (Auth::user()->admin == 1) {
            $thread = Forum::find($id);
            $thread->delete();
        }else{
            return view('errors.503');
        }
        return back();
    }
// User Auth
    public function create()
    {   
        $tags = Menu::where([['setting','>',19],['status',1]])->get();
        return view('forum.create', compact('tags'));
    }

    public function store(Request $request){
        $this->validate($request, [
                'title' => 'required|unique:products|max:100',
                'menu_id' => 'required',
                'description' => 'required',
            ]);
        if (Auth::user()) {
            $time = date("YmdHis");
            $slug = str_slug($request->title).'-'.$time;
            $thread = Forum::create([
                    'user_id' => Auth::user()->id,
                    'title' => $request->title,
                    'slug' => $slug,
                    'menu_id' => $request->menu_id,
                    'description' => Purifier::clean($request->description, array('CSS.AllowTricky' => true , 
                        'HTML.SafeIframe' => true , "URI.SafeIframeRegexp" => "%^(http://|https://|//)(www.youtube.com/embed/|player.vimeo.com/video/)%")),
                    'status' => 1,
                ]);
            return redirect("/thread/{$thread->slug}");
        }else{
            return view('errors.503');
        }
    }

    public function edit($slug){
        $thread = Forum::whereSlug($slug)->first();
        $tags = Menu::where([['setting','>',19],['status',1]])->get();
        if ($thread->user->id == Auth::user()->id) {
            return view('forum.edit', compact('thread','tags'));
        }else{
            return view('errors.503');
        }
    }
    
    public function update(Request $request, $slug){
        $this->validate($request, [
                'title' => 'required|unique:products|max:100',
                'menu_id' => 'required',
                'description' => 'required',
            ]);
        $thread = Forum::whereSlug($slug)->first();
        if ($thread->user->id == Auth::user()->id) {
            $time = date("YmdHis");
            $slug = str_slug($request->title).'-'.$time;
            $thread = Forum::update([
                    'user_id' => Auth::user()->id,
                    'title' => $request->title,
                    'slug' => $slug,
                    'menu_id' => $request->menu_id,
                    'description' => Purifier::clean($request->description, array('CSS.AllowTricky' => true , 
                        'HTML.SafeIframe' => true , "URI.SafeIframeRegexp" => "%^(http://|https://|//)(www.youtube.com/embed/|player.vimeo.com/video/)%")),
                    'status' => 1,
                ]);
            return redirect("/thread/{$thread->slug}");
        }else{
            return view('errors.503');
        }
    }
// End User Auth

// User Guest
    public function show($slug){
        $thread = Forum::whereSlug($slug)->first();
        if ($thread->status == 1 && $thread->menu->status == 1) {
            $categories = Menu::where('setting',20)->get();
            return view('forum.show',compact('thread','categories'));
        }else{
            return view('errors.503');
        }
    }

    public function tag($tagSlug){
        $tags = Menu::whereSlug($tagSlug)->first();
        if ($tags->status == 1) {
            if ($tags->parent()->count()) {
                $tagthreads = $tags->childForums()->latest()->get();
            }else{
                $tagthreads = $tags->forums()->latest()->get();
            }
            $categories = Menu::where('setting',20)->get();
            return view('forum.tags', compact('tagthreads','tags','categories'));
        }else{
            return view('errors.503');
        }
    }
// End User Guest

}
