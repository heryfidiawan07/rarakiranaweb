<?php

namespace App\Http\Controllers;

use Auth;
use Purifier;
use App\Menu;
use App\Logo;
use App\Forum;
use App\Promo;
use Illuminate\Http\Request;

class ForumController extends Controller
{
    public function __construct(){
        $this->middleware('admin', ['except'=>['show','tag','create','store','edit','update']]);
    }

    public function index()
    {
        $threads = Forum::all();
        $tags = Menu::where('setting',11)->get();
        return view('admin.forum.index', compact('threads','tags'));
    }

    public function tagStore(Request $request){
        $this->validate($request, [
                'tag' => 'required|max:20',
            ]);
        $tag = Menu::where('setting',10)->first();
        if ($request->parent_tag == 0) {
            $setting = 11;
            $parent_tag = $tag->id;
        }else{
            $setting = 12;
            $parent_tag = $request->parent_tag;
        }
        $cekMenu = Menu::where('slug', '=', str_slug($request->tag))->first();
        if ($cekMenu === null) {
            Menu::create([
                    'user_id' => Auth::user()->id,
                    'menu' => $request->tag,
                    'slug' => str_slug($request->tag),
                    'parent_id' => $parent_tag,
                    'setting' => $setting,
                ]);
        }else{
            return back()->with('warningEdit', 'Nama kategori sudah ada, ganti yang lain !');
        }
        return back();
    }

    public function tagUpdate(Request $request, $id){
        $this->validate($request, [
                'tagEdit' => 'required',
            ]);
        $tag = Menu::whereId($id)->first();
        if ($request->parent_edit == 0) {
            $setting = 11;
            $parent_id = $tag->id;
        }else{
            $setting = 12;
            $parent_id = $request->parent_edit;
        }
        $cekMenu = Menu::where('slug', '=', str_slug($request->tagEdit))->first();
        if ($cekMenu === null) {
            $tag->update([
                    'user_id' => Auth::user()->id,
                    'menu' => $request->tagEdit,
                    'slug' => str_slug($request->tagEdit),
                    'parent_id' => $parent_id,
                    'setting' => $setting,
                ]);
        }else{
            return back()->with('warningEdit', 'Nama kategori sudah ada, ganti yang lain !');
        }
        return back();
    }

    public function tagStatus(Request $request, $id){
        $tag = Menu::whereId($id)->first();
        $tag->update([
                'status' => $request->status,
            ]);
        return back();
    }

    public function sticky(Request $request, $id){
        $thread = Forum::whereId($id)->first();
        $thread->update([
                'sticky' => $request->sticky,
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
        $tags = Menu::where([['setting','>',10],['status',1]])->where('setting','<',20)->get();
        return view('forum.create', compact('tags'));
    }

    public function store(Request $request){
        $this->validate($request, [
                'title' => 'required|max:200',
                'menu_id' => 'required',
                'description' => 'required|max:10000',
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
        $tags = Menu::where([['setting','>',10],['status',1]])->where('setting','<',20)->get();
        if ($thread->user->id == Auth::user()->id) {
            return view('forum.edit', compact('thread','tags'));
        }else{
            return view('errors.503');
        }
    }
    
    public function update(Request $request, $slug){
        $this->validate($request, [
                'title' => 'required|max:200',
                'menu_id' => 'required',
                'description' => 'required|max:10000',
            ]);
        $thread = Forum::whereSlug($slug)->first();
        if ($thread->user->id == Auth::user()->id) {
            $time = date("YmdHis");
            $slug = str_slug($request->title).'-'.$time;
            $thread->update([
                    'title' => $request->title,
                    'slug' => $slug,
                    'menu_id' => $request->menu_id,
                    'description' => Purifier::clean($request->description, array('CSS.AllowTricky' => true , 
                        'HTML.SafeIframe' => true , "URI.SafeIframeRegexp" => "%^(http://|https://|//)(www.youtube.com/embed/|player.vimeo.com/video/)%")),
                ]);
            return redirect("/thread/{$thread->slug}");
        }else{
            return view('errors.503');
        }
    }
// End User Auth

// User Guest
    public function show($slug){
        $forumLogo = Logo::where('setting',3)->first();
        $thread = Forum::whereSlug($slug)->first();
        $comments = $thread->forcomments()->paginate(10);
        $threadrecents = Forum::join('forcomments', 'forums.id', '=', 'forcomments.forum_id')
                  ->orderBy('forcomments.updated_at','DESC')->groupBy('forcomments.forum_id')
                  ->take(5)->get();
        if ($thread->status == 1 && $thread->menu->status == 1) {
            $categories = Menu::where('setting',11)->get();
            return view('forum.show',compact('thread','categories','comments','threadrecents','forumLogo'));
        }else{
            return view('errors.503');
        }
    }

    public function tag($tagSlug){
        $forumLogo  = Logo::where('setting',3)->first();
        $tags       = Menu::whereSlug($tagSlug)->first();
        $promo      = Promo::where('setting',3)->first();
        if ($tags->status == 1) {
            if ($tags->parent()->count()) {
                $tagthreads = $tags->childForums()->latest('sticky')->paginate(10);
            }else{
                $tagthreads = $tags->forums()->latest('sticky')->paginate(10);
            }
            $categories = Menu::where('setting',11)->get();
            return view('forum.tags', compact('tagthreads','tags','categories','forumLogo','promo'));
        }else{
            return view('errors.503');
        }
    }
// End User Guest

}
