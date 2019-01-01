<?php

namespace App\Http\Controllers;

use App\Menu;
use App\Logo;
use App\Forum;
use App\Article;
use App\Product;
use Illuminate\Http\Request;

class GlobalController extends Controller
{
	public function menu($slugMenu){
		$menu = Menu::where('slug',$slugMenu)->first();
		$articleLogo = Logo::where('setting',4)->first();
		$artrecents = Article::join('artcomments', 'articles.id', '=', 'artcomments.article_id')
                  ->orderBy('artcomments.updated_at','DESC')->groupBy('artcomments.article_id')
                  ->take(5)->get();
		if ($menu) {
				if ($menu->setting == 10) {
						$newthreads = Forum::where('status',1)->latest()->paginate(10);
						$categories = Menu::where([['setting',11],['status',1]])->get();
						$forumLogo 	= Logo::where('setting',3)->first();
						return view('forum.index',compact('newthreads','categories','forumLogo'));
				}elseif ($menu->setting == 20) {
						$newproducts = Product::where('status',1)->latest()->paginate(9);
						$categories  = Menu::where([['setting',21],['status',1]])->get();
						$productLogo = Logo::where('setting',2)->first();
						return view('products.index',compact('newproducts','categories','productLogo'));
				}else{
						if ($menu->parent()->count()) {
								$articles = $menu->childArticles()->paginate(10);
								return view('articles.menu', compact('menu','articles','articleLogo','artrecents'));
						}else{
								$articles = $menu->articles()->latest()->paginate(10);
								if ($articles->count() == 1) {
									$article = Article::where('menu_id',$menu->id)->first();
									return redirect("/read/article/{$article->slug}");
								}else{
									return view('articles.menu', compact('menu','articles','articleLogo','artrecents'));
								}
						}
				}
		}else{
			return view('errors.503');
		}
	}
	
}
