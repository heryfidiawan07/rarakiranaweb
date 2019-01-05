<?php

namespace App\Http\Controllers;

use Auth;
use App\Menu;
use Illuminate\Http\Request;

class MenuController extends Controller
{

    public function __construct(){
      $this->middleware('admin');
    }

    public function index()
    {   
        $menus = Menu::all();
        return view('admin.menu.index', compact('menus'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
                'menu' => 'required|unique:menus|max:20',
            ]);
        if($request->parent_id == 10 || $request->parent_id == 20){
            $setting = $request->parent_id;
            $parent_id = 0;
        }else{
            $setting = 0;
            $parent_id = $request->parent_id;
        }
        $menuForum = Menu::where('setting',10)->first();
        $menuProd  = Menu::where('setting',20)->first();
        if ($menuForum && $request->parent_id == 10) {
            return back()->with('warning', 'Parent forum already exists.');
        }elseif ($menuProd && $request->parent_id == 20) {
            return back()->with('warning', 'Parent product already exists.');
        }
        Menu::create([
                'user_id' => Auth::user()->id,
                'menu' => strtoupper($request->menu),
                'slug' => str_slug($request->menu),
                'parent_id' => $parent_id,
                'setting' => $setting,
            ]);
        return back();
    }

    public function update(Request $request, $id)
    {   
        $this->validate($request, [
                'menuEdit' => 'required',
            ]);
        $mForum = Menu::where('setting',10)->first();
        $mProd  = Menu::where('setting',20)->first();
        if ($mProd && $request->parent_edit == 10) {
            return back()->with('warningEdit', 'Parent forum already exists.');
        }elseif ($mProd && $request->parent_edit == 20) {
            return back()->with('warningEdit', 'Parent product already exists.');
        }
        if($request->parent_edit == 10 || $request->parent_edit == 20){
            $setting = $request->parent_edit;
            $parent_edit = 0;
        }elseif($request->contact){
            $setting = 5;
            $parent_edit = $request->parent_edit;
        }else{
            $setting = 0;
            $parent_edit = $request->parent_edit;
        }
        $menu = Menu::whereId($id)->first();
        $menu->update([
            'menu' => strtoupper($request->menuEdit),
            'slug' => str_slug($request->menuEdit),
            'parent_id' => $parent_edit,
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
        $menu = Menu::find($id);
        $menu->delete();
        return back();
    }

}
