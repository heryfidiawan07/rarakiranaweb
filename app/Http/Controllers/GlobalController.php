<?php

namespace App\Http\Controllers;

use App\Menu;
use App\Forum;
use App\Article;
use App\Product;
use Illuminate\Http\Request;

class GlobalController extends Controller
{
	public function menu($slugMenu){
		$menu = Menu::where('slug',$slugMenu)->first();
		if ($menu) {
				if ($menu->setting == 11) {
						$newthreads = Forum::where('status',1)->latest()->paginate(10);
						$categories = Menu::where([['setting',20],['status',1]])->get();
						return view('forum.index',compact('newthreads','categories'));
				}elseif ($menu->setting == 22) {
						$newproducts = Product::where('status',1)->latest()->paginate(9);
						$categories = Menu::where([['setting',15],['status',1]])->get();
						return view('products.index',compact('newproducts','categories'));
				}else{
						if ($menu->parent()->count()) {
								$articles = $menu->childArticles()->paginate(20);
								return view('articles.menu', compact('menu','articles'));
						}else{
								$articles = $menu->articles()->latest()->paginate(10);
								if ($articles->count() > 1) {
									return view('articles.menu', compact('menu','articles'));
								}else{
									$article = Article::where('menu_id',$menu->id)->first();
									return redirect("/read/article/{$article->slug}");
								}
						}
				}
		}else{
			return view('errors.503');
		}
	}
	
}
