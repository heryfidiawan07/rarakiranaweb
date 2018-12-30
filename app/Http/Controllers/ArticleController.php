<?php

namespace App\Http\Controllers;

use Auth;
use File;
use Image;
use Purifier;
use App\Menu;
use App\Article;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    public function __construct(){
        $this->middleware('admin', ['except'=>['show','menu']]);
    }

    public function index()
    {   
        $articles = Article::all();
        return view('admin.articles.index', compact('articles'));
    }

    public function create()
    {   
        $menus = Menu::where('setting','<',10)->get();
        return view('admin.articles.create', compact('menus'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
                'title' => 'required|unique:articles|max:200',
                'menu_id' => 'required',
                'img' => 'required',
                'description' => 'required',
                'status' => 'required',
                'acomment' => 'required',
            ]);
        $time = date("YmdHis");
        $slug = str_slug($request->title).'-'.$time;
        $img     = $request->file('img');
        $extends = $img->getClientOriginalextension();
        $imgName = $slug.'.'.$extends;
        Article::create([
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
                $img->save(public_path("articles/img/". $imgName));
                $thumb    = Image::make($path)->resize(200, 250, function ($constraint) {
                                $constraint->aspectRatio();
                            });
                $thumb->save(public_path("articles/thumb/". $imgName));
        return redirect('/dashboard/articles');
    }

    public function status(Request $request, $id){
        $article = Article::whereId($id)->first();
        $article->update(['status' => $request->status,]);
        return back();
    }
    
    public function acomment(Request $request, $id){
        $article = Article::whereId($id)->first();
        $article->update(['allowed_comment' => $request->acomment,]);
        return back();  
    }
    
    public function edit($id)
    {   
        $menus = Menu::where('setting','<',10)->get();
        $article = Article::whereId($id)->first();
        return view('admin.articles.edit',compact('article','menus'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
                'title' => 'required|max:200',
                'menu_id' => 'required',
                'description' => 'required',
                'status' => 'required',
                'acomment' => 'required',
            ]);
        $article = Article::whereId($id)->first();
        if ($article) {
            $time     = date("YmdHis");
            if ($article->title == $request->title) {
                $title = $article->title;
                $slug  = $article->slug;
            }else{
                $title = $request->title;
                $slug  = str_slug($request->title).'-'.$time;
            }
            $img      = $request->file('img');
            if (!isset($img)) {
                $imgName  = $article->img;
            }else{
                $oldImg   = public_path("articles/img/".$article->img);
                $oldThumb = public_path("articles/thumb/".$article->img);
                if (file_exists($oldImg)) {
                    File::delete($oldImg);
                    File::delete($oldThumb);
                }
                $extends  = $img->getClientOriginalextension();
                $imgName  = $slug.'.'.$extends;
                $path     = $img->getRealPath();
                $img      = Image::make($path)->resize(null, 630, function ($constraint) {
                                $constraint->aspectRatio();
                            });
                $img->save(public_path("articles/img/". $imgName));
                $thumb    = Image::make($path)->resize(200, 250, function ($constraint) {
                                $constraint->aspectRatio();
                            });
                $thumb->save(public_path("articles/thumb/". $imgName));
            }
            $article->update([
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
            return redirect('/dashboard/articles');
        }else{
            return view('errors.503');
        }
    }

    public function destroy($id)
    {
        $article = Article::find($id);
        if ($article) {
            $img   = public_path("articles/img/".$article->img);
            $thumb = public_path("articles/thumb/".$article->img);
            if (file_exists($img)) {
                File::delete($img);
                File::delete($thumb);
            }
            $article->delete();
        }else{
            return view('errors.503');
        }
        return back();
    }

//Article User Show
    public function show($slug)
    {   
        $article = Article::whereSlug($slug)->first();
        $comments = $article->artcomments()->paginate(10);
        $artrecents = Article::join('artcomments', 'articles.id', '=', 'artcomments.article_id')
                  ->orderBy('artcomments.updated_at','DESC')->groupBy('artcomments.article_id')
                  ->take(5)->get();
        return view('articles.show', compact('article','comments','artrecents'));
    }

    public function menu($slugMenu){
        $menu = Menu::whereSlug($slugMenu)->first();
        $articles = $menu->articles()->get(10);
        return view('articles.menu', compact('articles'));
    }
    
}
