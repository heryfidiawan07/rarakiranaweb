<?php

namespace App\Http\Controllers;

use Auth;
use App\Storefront;
use Illuminate\Http\Request;

class StorefrontController extends Controller
{   
    public function __construct(){
      $this->middleware('admin');
    }
    
    public function activate(Request $request){
        $uncat = Storefront::where('slug','uncategorised')->first();
        if ($uncat === null) {
            Storefront::create([
                'user_id' => Auth::user()->id,
                'name' => 'UNCATEGORISED',
                'slug' => 'uncategorised',
                'setting' => 1,
            ]);
        }
        Storefront::create([
                'user_id' => Auth::user()->id,
                'name'    => strtoupper($request->forumName),
                'slug'    => str_slug($request->forumName),
                'setting' => 10,
            ]);
        return back();
    }

    public function productUpdate(Request $request, $id){
        $front = Storefront::whereId($id)->first();
        $front->update([
                'name' => strtoupper($request->frontUpdate),
                'slug' => str_slug($request->frontUpdate),
            ]);
        return back();
    }

    public function productStatus(Request $request, $id){
        $front = Storefront::whereId($id)->first();
        $front->update([
                'status' => $request->statusFront,
            ]);
        return back();
    }

    public function store(Request $request){
        Storefront::create([
                'user_id' => Auth::user()->id,
                'name' => strtoupper($request->name),
                'slug' => str_slug($request->name),
                'parent_id' => $request->parent_id,
            ]);
        return back();
    }
    
    public function name(Request $request, $id){
        $this->validate($request, [
                'nameEdit' => 'required',
            ]);
        $front    = Storefront::whereId($id)->first();
        $cekFront = Storefront::where('slug',str_slug($request->nameEdit))->first();
        if ($cekFront === null) {
            $front->update([
                    'user_id' => Auth::user()->id,
                    'name' => strtoupper($request->nameEdit),
                    'slug' => str_slug($request->nameEdit),
                ]);
        }else{
            return back()->with('warningEdit', 'Nama etalase sudah ada, ganti yang lain !');
        }
        return back();
    }

    public function parent(Request $request, $id){
        $front = Storefront::whereId($id)->first();
        $front->update([
                'user_id' => Auth::user()->id,
                'parent_id' => str_slug($request->parent_edit),
            ]);
        return back();
    }

    public function status(Request $request, $id){
        $front = Storefront::whereId($id)->first();
        $front->update([
                'status' => $request->status,
            ]);
        return back();
    }

    public function delete($id){
        $uncat = Storefront::where('slug','uncategorised')->first();
        $front = Storefront::find($id);
        $front->products()->update([
                'storefront_id' => $uncat->id,
            ]);
        $front->delete();
        return redirect('/dashboard/products');
    }

}
