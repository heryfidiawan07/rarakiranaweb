<?php

namespace App\Http\Controllers;

use Auth;
use App\Menu;
use App\Post;
use Illuminate\Http\Request;

class MenuController extends Controller
{

    public function __construct(){
      $this->middleware('admin');
    }

    public function index()
    {   
        $menus = Menu::orderBy('setting','ASC')->get();
        return view('admin.menu.index', compact('menus'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
                'name' => 'required|unique:menus|max:20',
            ]);
        if ($request->contact == 5) {
            $setting = 5;
        }else{
            $setting = 0;
        }
        $uncat = Menu::where('slug','uncategorised')->first();
        if ($uncat === null) {
            Menu::create([
                'user_id' => Auth::user()->id,
                'name' => 'UNCATEGORISED',
                'slug' => 'uncategorised',
                'setting' => 1,
            ]);
        }
        Menu::create([
                'user_id' => Auth::user()->id,
                'name' => strtoupper($request->name),
                'slug' => str_slug($request->name),
                'parent_id' => $request->parent_id,
                'setting' => $setting,
            ]);
        return back();
    }

    public function updateName(Request $request, $id){
        $this->validate($request, [
                'menuEdit' => 'required',
            ]);
        $menu = Menu::whereId($id)->first();
        $cekMenu = Menu::where('slug',str_slug($request->menuEdit))->first();
        if ($cekMenu === null) {
            $menu->update([
                'user_id' => Auth::user()->id,
                'name' => strtoupper($request->menuEdit),
                'slug' => str_slug($request->menuEdit),
            ]);
        }else{
            return back()->with('warningEdit', 'Nama menu sudah ada, silahkan ganti nama yang lain !');
        }
        return back();
    }
    
    public function updateSetting(Request $request, $id)
    {   
        if($request->contact == 5){
            $setting = 5;
        }else{
            $setting = 0;
        }
        $menu = Menu::whereId($id)->first();
        $menu->update([
            'user_id' => Auth::user()->id,
            'parent_id' => $request->parent_edit,
            'setting' => $setting,
        ]);
        return back();
    }

    public function status(Request $request, $id){
        $menu = Menu::whereId($id)->first();
        $menu->update([
                'status' => $request->status,
            ]);
        return back();
    }

    public function destroy($id)
    {
        $uncat = Menu::where('slug','uncategorised')->first();
        $menu  = Menu::find($id);
        $menu->posts()->update([
                'menu_id' => $uncat->id,
            ]);
        $menu->delete();
        return redirect('/dashboard/menus');
    }

}
