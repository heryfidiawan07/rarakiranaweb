<?php

namespace App\Http\Controllers;

use Auth;
use Purifier;
use App\Tag;
use App\Logo;
use App\Promo;
use App\Thread;
use Illuminate\Http\Request;

class ThreadController extends Controller
{
    public function __construct(){
        $this->middleware('admin', ['except'=>['show','tag','create','store','edit','update','threads']]);
    }

    public function index()
    {
        $threads  = Thread::latest('sticky')->paginate(10);
        $tags     = Tag::orderBy('setting','ASC')->get();
        $forumTag = Tag::where('setting',10)->first();
        return view('admin.threads.index', compact('threads','tags','forumTag'));
    }

    public function sticky(Request $request, $id){
        $thread = Thread::whereId($id)->first();
        $thread->update([
                'sticky' => $request->sticky,
            ]);
        return back();
    }
    
    public function destroy($id){
        if (Auth::user()->admin == 1) {
            $thread = Thread::find($id);
            $thread->comments()->delete();
            $thread->delete();
        }else{
            return view('errors.503');
        }
        return back();
    }
// User Auth
    public function create()
    {   
        $cek = Tag::whereSetting(10)->first();
        if ($cek === null || $cek->status == 0) {
            return view('errors.503');
        }else{
            $tags = Tag::has('parent',0)->where('setting',0)->get();
            return view('threads.create', compact('tags'));
        }
    }

    public function store(Request $request){
        $this->validate($request, [
                'title' => 'required|max:100',
                'tag_id' => 'required',
                'description' => 'required|max:10000',
            ]);
        if (Auth::user()) {
            $time = date("YmdHis");
            $slug = str_slug($request->title).'-'.$time;
            $thread = Thread::create([
                    'user_id' => Auth::user()->id,
                    'title' => $request->title,
                    'slug' => $slug,
                    'tag_id' => $request->tag_id,
                    'description' => Purifier::clean($request->description, array('CSS.AllowTricky' => true , 
                        'HTML.SafeIframe' => true , "URI.SafeIframeRegexp" => "%^(http://|https://|//)(www.youtube.com/embed/|player.vimeo.com/video/)%")),
                ]);
            return redirect("/thread/{$thread->slug}");
        }else{
            return view('errors.503');
        }
    }

    public function edit($slug){
        $thread = Thread::whereSlug($slug)->first();
        $tags   = Tag::has('parent',0)->where('setting',0)->get();
        if ($thread->user->id == Auth::user()->id) {
            return view('threads.edit', compact('thread','tags'));
        }else{
            return view('errors.503');
        }
    }
    
    public function update(Request $request, $slug){
        $cek = Tag::whereSetting(10)->first();
        if ($cek === null || $cek->status == 0) {
            return view('errors.503');
        }else{
            $this->validate($request, [
                    'title' => 'required|max:100',
                    'tag_id' => 'required',
                    'description' => 'required|max:10000',
                ]);
            $thread = Thread::whereSlug($slug)->first();
            if ($thread->user->id == Auth::user()->id) {
                $time = date("YmdHis");
                $slug = str_slug($request->title).'-'.$time;
                $thread->update([
                        'title' => $request->title,
                        'slug' => $slug,
                        'tag_id' => $request->tag_id,
                        'description' => Purifier::clean($request->description, array('CSS.AllowTricky' => true , 
                            'HTML.SafeIframe' => true , "URI.SafeIframeRegexp" => "%^(http://|https://|//)(www.youtube.com/embed/|player.vimeo.com/video/)%")),
                    ]);
                return redirect("/thread/{$thread->slug}");
            }else{
                return view('errors.503');
            }
        }
    }
// End User Auth

// User Guest
    public function show($slug){
        $logo          = Logo::where('setting','thread')->first();
        $thread        = Thread::whereSlug($slug)->first();
        $comments      = $thread->comments()->paginate(10);
        $threadrecents = Thread::has('comments','>',0)->latest()->paginate(5);
        if ($thread->status == 1 && $thread->tag->status == 1) {
            $tags = Tag::where('setting',0)->get();
            return view('threads.show',compact('thread','tags','comments','threadrecents','logo'));
        }else{
            return view('errors.503');
        }
    }

    public function threads($slug){
        $cek   = Tag::whereSlug($slug)->first();
        if ($cek === null || $cek->status == 0) {
            return view('errors.503');
        }else{
            $logo       = Logo::where('setting','thread')->first();
            $promo      = Promo::where('setting','thread')->first();
            $tags       = Tag::where('setting',0)->get();
            $newthreads = Thread::where('status',1)->latest('sticky')->paginate(10);
            return view('threads.index', compact('newthreads','tags','logo','promo'));
        }
    }

    public function tag($tagSlug){
        $logo  = Logo::where('setting','thread')->first();
        $promo = Promo::where('setting','thread')->first();
        $subs  = Tag::where([['slug',$tagSlug],['status',1]])->first();
        $tags  = Tag::where('setting',0)->get();
        if ($subs->parent->count()){
            $threads = $subs->childThreads()->latest('sticky')->paginate(10);
        }else{
            $threads = $subs->threads()->latest('sticky')->paginate(10);
        }
        return view('threads.tags', compact('threads','tags','logo','promo','subs'));
    }
// End User Guest

}
