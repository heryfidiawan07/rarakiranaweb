<?php

namespace App\Http\Controllers;

use Auth;
use File;
use Image;
use Purifier;
use App\Menu;
use App\Logo;
use App\Product;
use App\Gallery;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function __construct(){
        $this->middleware('admin', ['except'=>['show','category']]);
    }

    public function index()
    {
        $products = Product::all();
        $categories = Menu::where('setting',21)->get();
        return view('admin.products.index', compact('products','categories'));
    }

    public function categoryStore(Request $request){
        $this->validate($request, [
                'category' => 'required|max:20',
            ]);
        $category = Menu::where('setting',20)->first();
        if ($request->parent_id == 0) {
            $setting = 21;
            $parent_id = $category->id;
        }else{
            $setting = 22;
            $parent_id = $request->parent_id;
        }
        $cekMenu = Menu::where('slug', '=', str_slug($request->category))->first();
        if ($cekMenu === null) {
            Menu::create([
                    'user_id' => Auth::user()->id,
                    'menu' => $request->category,
                    'slug' => str_slug($request->category),
                    'parent_id' => $parent_id,
                    'setting' => $setting,
                ]);
        }else{
            return back()->with('warningEdit', 'Nama kategori sudah ada, ganti yang lain !');
        }
        return back();
    }
    
    public function categoryUpdate(Request $request, $id){
        $this->validate($request, [
                'categoryEdit' => 'required',
            ]);
        $menuProd = Menu::where('setting',20)->first();
        $category = Menu::whereId($id)->first();
        if ($request->parent_edit == 0) {
            $setting = 21;
            $parent_id = $menuProd->id;
        }else{
            $setting = 22;
            $parent_id = $request->parent_edit;
        }
        $cekMenu = Menu::where('slug', '=', str_slug($request->categoryEdit))->first();
        if ($cekMenu === null) {
            $category->update([
                    'user_id' => Auth::user()->id,
                    'menu' => $request->categoryEdit,
                    'slug' => str_slug($request->categoryEdit),
                    'parent_id' => $parent_id,
                    'setting' => $setting,
                ]);
        }else{
            return back()->with('warningEdit', 'Nama kategori sudah ada, ganti yang lain !');
        }
        return back();
    }

    public function categoryStatus(Request $request, $id){
        $category = Menu::whereId($id)->first();
        $category->update([
                'status' => $request->status,
            ]);
        return back();
    }
    
    public function create()
    {   
        $categories = Menu::where([['setting','>',20],['status',1]])->get();
        return view('admin.products.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
                'title' => 'required|unique:products|max:200',
                'menu_id' => 'required',
                'price' => 'required',
                'img' => 'required',
                'description' => 'required',
                'status' => 'required',
                'acomment' => 'required',
            ]);
        $time = date("YmdHis");
        $slug = str_slug($request->title).'-'.$time;
        $product = Product::create([
                'user_id' => Auth::user()->id,
                'title' => $request->title,
                'slug' => $slug,
                'price' => $request->price,
                'discount' => $request->discount,
                'menu_id' => $request->menu_id,
                'description' => Purifier::clean($request->description, array('CSS.AllowTricky' => true , 
                    'HTML.SafeIframe' => true , "URI.SafeIframeRegexp" => "%^(http://|https://|//)(www.youtube.com/embed/|player.vimeo.com/video/)%")),
                'status' => $request->status,
                'allowed_comment' => $request->acomment,
            ]);
            $files = $request->file('img');
            $key   = 0;
            while ($key < count($files)) {
                $extends = $files[$key]->getClientOriginalExtension();
                $imgName = $product->id.'-'.$key.'-'.$slug.'.'.$extends;
                $path    = $files[$key]->getRealPath();
                $img     = Image::make($path)->resize(null, 630, function ($constraint) {
                                $constraint->aspectRatio();
                            });
                $img->save(public_path("products/img/". $imgName));
                $thumb    = Image::make($path)->resize(200, 200, function ($constraint) {
                                $constraint->aspectRatio();
                            });
                $thumb->save(public_path("products/thumb/". $imgName));
            $key++;
                $gallery = new Gallery;
                $gallery->img        = $imgName;
                $gallery->product_id = $product->id;
                $gallery->save();
            }
        return redirect('/dashboard/products');
    }

    public function status(Request $request, $id){
        $product = Product::whereId($id)->first();
        $product->update(['status' => $request->status,]);
        return back();
    }
    
    public function acomment(Request $request, $id){
        $product = Product::whereId($id)->first();
        $product->update(['allowed_comment' => $request->acomment,]);
        return back();  
    }

    public function edit($id)
    {
        $categories = Menu::where([['setting','>',20],['status',1]])->get();
        $product = Product::whereId($id)->first();
        return view('admin.products.edit',compact('product','categories'));
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
        $product = Product::whereId($id)->first();
        if ($product) {
            $time     = date("YmdHis");
            if ($product->title == $request->title) {
                $title = $product->title;
                $slug  = $product->slug;
            }else{
                $title = $request->title;
                $slug  = str_slug($request->title).'-'.$time;
            }
            $files = $request->file('img');
            if (isset($files)) {
                for ($i=0; $i < count($product->galleries); $i++) { 
                    $oldImg   = public_path("products/img/".$product->galleries[$i]->img);
                    $oldThumb = public_path("products/thumb/".$product->galleries[$i]->img);
                    if (file_exists($oldImg)) {
                        File::delete($oldImg);
                        File::delete($oldImg);
                    }
                }
                $key   = 0;
                while ($key < count($files)) {
                    $extends = $files[$key]->getClientOriginalExtension();
                    $imgName = $product->id.'-'.$key.'-'.$slug.'.'.$extends;
                    $path    = $files[$key]->getRealPath();
                    $img     = Image::make($path)->resize(null, 630, function ($constraint) {
                                    $constraint->aspectRatio();
                                });
                    $img->save(public_path("products/img/". $imgName));
                    $thumb    = Image::make($path)->resize(200, 200, function ($constraint) {
                                    $constraint->aspectRatio();
                                });
                    $thumb->save(public_path("products/thumb/". $imgName));
                $key++;
                    $gallery = new Gallery;
                    $gallery->img        = $imgName;
                    $gallery->product_id = $product->id;
                    $gallery->save();
                }
            }
            $product->update([
                    'user_id' => Auth::user()->id,
                    'title' => $title,
                    'slug' => $slug,
                    'menu_id' => $request->menu_id,
                    'price' => $request->price,
                    'discount' => $request->discount,
                    'description' => Purifier::clean($request->description, array('CSS.AllowTricky' => true , 
                        'HTML.SafeIframe' => true , "URI.SafeIframeRegexp" => "%^(http://|https://|//)(www.youtube.com/embed/|player.vimeo.com/video/)%")),
                    'status' => $request->status,
                    'allowed_comment' => $request->acomment,
                ]);
            return redirect('/dashboard/products');
        }else{
            return view('errors.503');
        }
    }

    public function destroy($id)
    {
        $product = Product::find($id);
        if ($product) {
            for ($i=0; $i < count($product->galleries); $i++) { 
                $img   = public_path("products/img/".$product->galleries[$i]->img);
                $thumb = public_path("products/thumb/".$product->galleries[$i]->img);
                if (file_exists($img)) {
                    File::delete($img);
                    File::delete($thumb);
                }
                $product->delete();
            }
        }else{
            return view('errors.503');
        }
        return back();
    }

// Guest User
    public function show($prodslug)
    {
        $product = Product::where([['slug',$prodslug],['status',1]])->first();
        $discusions = $product->prodcomments()->paginate(10);
        if ($product && $product->menu->status==1) {
            return view('products.show', compact('product','discusions'));
        }else{
            return view('errors.503');
        }
    }

    public function category($categorySlug){
        $productLogo = Logo::where('setting',3)->first();
        $category = Menu::whereSlug($categorySlug)->first();
        if ($category->status == 1) {
            if ($category->parent()->count()) {
                $tagproducts = $category->childProducts()->latest()->get();
            }else{
                $tagproducts = $category->products()->latest()->get();
            }
            $categories = Menu::where([['setting',21],['status',1]])->get();
            return view('products.category', compact('tagproducts','category','categories','productLogo'));
        }else{
            return view('errors.503');
        }
    }
// Guest User

}
