<?php

namespace App\Http\Controllers;

use Auth;
use File;
use Image;
use Purifier;
use App\Logo;
use App\Post;
use App\Menu;
use App\Promo;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function __construct(){
        $this->middleware('admin', ['except'=>['show','menu']]);
    }

    public function index()
    {   
        $posts = Post::latest('sticky')->paginate(10);
        $menus = Menu::has('parent','<',1)->where([['status',1],['setting','!=',1]])->get();
        return view('admin.posts.index', compact('posts','menus'));
    }

    public function create()
    {   
        $menus = Menu::has('parent','<',1)->where([['status',1],['setting','!=',1]])->get();
        return view('admin.posts.create', compact('menus'));
    }

    public function parent(Request $request, $id){
        $post = Post::whereId($id)->first();
        $post->update([
                'menu_id' => $request->menu_post,
            ]);
        return back();
    }
    
    public function store(Request $request)
    {
        $this->validate($request, [
                'title' => 'required|unique:posts|max:100',
                'menu_id' => 'required',
                'img' => 'required',
                'description' => 'required',
                'status' => 'required',
                'acomment' => 'required',
            ]);
        $time    = date("YmdHis");
        $slug    = str_slug($request->title).'-'.$time;
        $img     = $request->file('img');
        $extends = $img->getClientOriginalextension();
        $imgName = $slug.'-'.$time.'.'.$extends;
        Post::create([
                'user_id' => Auth::user()->id,
                'title' => $request->title,
                'slug' => $slug,
                'menu_id' => $request->menu_id,
                'img' => $imgName,
                'description' => Purifier::clean($request->description, array('CSS.AllowTricky' => true , 
                    'HTML.SafeIframe' => true , "URI.SafeIframeRegexp" => "%^(http://|https://|//)(www.youtube.com/embed/|player.vimeo.com/video/)%")),
                'status' => $request->status,
                'allowed_comment' => $request->acomment,
            ]);
                $path     = $img->getRealPath();
                $img      = Image::make($path)->resize(null, 630, function ($constraint) {
                                $constraint->aspectRatio();
                            });
                $img->save(public_path("posts/img/". $imgName));
                $thumb    = Image::make($path)->resize(null, 250, function ($constraint) {
                                $constraint->aspectRatio();
                            });
                $thumb->save(public_path("posts/thumb/". $imgName));
        return redirect('/dashboard/posts');
    }

    public function status(Request $request, $id){
        $post = Post::whereId($id)->first();
        $post->update(['status' => $request->status,]);
        return back();
    }
    
    public function acomment(Request $request, $id){
        $post = Post::whereId($id)->first();
        $post->update(['allowed_comment' => $request->acomment,]);
        return back();  
    }
    
    public function sticky(Request $request, $id){
        $post = Post::whereId($id)->first();
        $post->update([
                'sticky' => $request->sticky,
            ]);
        return back();
    }
    
    public function edit($id)
    {   
        $menus = Menu::has('parent','<',1)->where([['status',1],['setting','!=',1]])->get();
        $post  = Post::whereId($id)->first();
        return view('admin.posts.edit',compact('post','menus'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
                'title' => 'required|max:100',
                'menu_id' => 'required',
                'description' => 'required',
                'status' => 'required',
                'acomment' => 'required',
            ]);
        $post = Post::whereId($id)->first();
        if ($post) {
            $time      = date("YmdHis");
            if ($post->title == $request->title) {
                $title = $post->title;
                $slug  = $post->slug;
            }else{
                $title = $request->title;
                $slug  = str_slug($request->title).'-'.$time;
            }
            $img       = $request->file('img');
            if (!isset($img)) {
                $imgName  = $post->img;
            }else{
                $oldImg   = public_path("posts/img/".$post->img);
                $oldThumb = public_path("posts/thumb/".$post->img);
                if (file_exists($oldImg)) {
                    File::delete($oldImg);
                    File::delete($oldThumb);
                }
                $extends  = $img->getClientOriginalextension();
                $imgName  = $slug.'-'.$time.'.'.$extends;
                $path     = $img->getRealPath();
                $img      = Image::make($path)->resize(null, 630, function ($constraint) {
                                $constraint->aspectRatio();
                            });
                $img->save(public_path("posts/img/". $imgName));
                $thumb    = Image::make($path)->resize(null, 250, function ($constraint) {
                                $constraint->aspectRatio();
                            });
                $thumb->save(public_path("posts/thumb/". $imgName));
            }
            $post->update([
                    'user_id' => Auth::user()->id,
                    'title' => $title,
                    'slug' => $slug,
                    'menu_id' => $request->menu_id,
                    'img' => $imgName,
                    'description' => Purifier::clean($request->description, array('CSS.AllowTricky' => true , 
                        'HTML.SafeIframe' => true , "URI.SafeIframeRegexp" => "%^(http://|https://|//)(www.youtube.com/embed/|player.vimeo.com/video/)%")),
                    'status' => $request->status,
                    'allowed_comment' => $request->acomment,
                ]);
            return redirect('/dashboard/posts');
        }else{
            return view('errors.503');
        }
    }

    public function destroy($id)
    {
        $post = Post::find($id);
        if ($post) {
            $img   = public_path("posts/img/".$post->img);
            $thumb = public_path("posts/thumb/".$post->img);
            if (file_exists($img)) {
                File::delete($img);
                File::delete($thumb);
            }
            $post->comments()->delete();
            $post->delete();
        }else{
            return view('errors.503');
        }
        return back();
    }

//Post User Show
    public function show($slug)
    {   
        $post        = Post::where([['slug',$slug],['status',1]])->first();
        $comments    = $post->comments()->paginate(10);
        $postrecents = Post::has('comments')->latest()->paginate(5);
        return view('posts.show', compact('post','comments','postrecents'));
    }

    public function menu($slugMenu){
        //Promo/Logo setting 1 = Home Logo/Main, 2 = Post Logo, 3 = Thread Logo, 4 = Product Logo
        $fmenu = Menu::where('slug',$slugMenu)->first();
        $promo = Promo::where('setting','post')->first();
        $logo  = Logo::where('setting','post')->first();
        if($fmenu){
            if($fmenu->parent_id == 0){
                if ($fmenu->parent()->count() == 0) {
                    $posts = $fmenu->childPosts()->latest('sticky')->paginate(10);
                    $menus = $fmenu;
                }else {
                    $posts = $fmenu->childPosts()->latest('sticky')->paginate(10);
                    $menus = $fmenu->parent()->get();
                }
            }else{
                $posts = $fmenu->posts()->latest('sticky')->paginate(10);
                $menus = Menu::where('parent_id',$fmenu->parent_id)->get();
            }
            $postrecents = Post::has('comments')->latest()->paginate(5);
            return view('posts.menu', compact('fmenu','menus','posts','postrecents','promo','logo'));
        }else{
            return view('errors.503');
        }
        
    }
    
}
