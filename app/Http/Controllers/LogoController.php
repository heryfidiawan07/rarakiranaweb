<?php

namespace App\Http\Controllers;

use File;
use Auth;
use Image;
use App\Logo;
use App\Menu;
use Illuminate\Http\Request;

class LogoController extends Controller
{   
    public function __construct(){
        $this->middleware('admin');
    }
    //Logo setting 1 = Home Logo/Main 2 = Post Logo 3 = Thread Logo 4 = Product Logo
    public function index()
    {   
        $logos = Logo::all();
        return view('admin.logo.index',compact('logos','menus'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
             'title' => 'required|max:100',
             'description' => 'required|max:500',
             'img' => 'required',
             'setting' => 'required',
            ]);
        $img     = $request->file('img');
        $extends = $img->getClientOriginalextension();
        $imgName = str_slug($request->title).'.'.$extends;
        Logo::create([
                'user_id' => Auth::user()->id,
                'title' => $request->title,
                'description' => $request->description,
                'img' => $imgName,
                'setting' => $request->setting,
            ]);
        $path     = $img->getRealPath();
        $img      = Image::make($path)->resize(null, 630, function ($constraint) {
                        $constraint->aspectRatio();
                    });
        $img->save(public_path("logo/img/". $imgName));
        $thumb    = Image::make($path)->resize(200, 250, function ($constraint) {
                        $constraint->aspectRatio();
                    });
        $thumb->save(public_path("logo/thumb/". $imgName));
        return back();
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
             'titleEdit' => 'required|max:100',
             'descriptionEdit' => 'required|max:500',
            ]);
        $img     = $request->file('imgEdit');
        $logo = Logo::whereId($id)->first();
        if (!isset($img)) {
            $imgName  = $logo->img;
        }else{
            $oldImg   = public_path("logo/img/".$logo->img);
            $oldThumb = public_path("logo/thumb/".$logo->img);
            if (file_exists($oldImg)) {
                File::delete($oldImg);
                File::delete($oldThumb);
            }
            $extends = $img->getClientOriginalextension();
            $imgName = str_slug($request->titleEdit).'.'.$extends;
            $path     = $img->getRealPath();
            $img      = Image::make($path)->resize(null, 630, function ($constraint) {
                            $constraint->aspectRatio();
                        });
            $img->save(public_path("logo/img/". $imgName));
            $thumb    = Image::make($path)->resize(200, 250, function ($constraint) {
                            $constraint->aspectRatio();
                        });
            $thumb->save(public_path("logo/thumb/". $imgName));
        }
        $logo->update([
                'title' => $request->titleEdit,
                'description' => $request->descriptionEdit,
                'img' => $imgName,
                'user_id' => Auth::user()->id,
            ]);
        return back();
    }

    public function destroy($id)
    {
        $logo = Logo::find($id);
        if ($logo) {
            $img   = public_path("logo/img/".$logo->img);
            $thumb = public_path("logo/thumb/".$logo->img);
            if (file_exists($img)) {
                File::delete($img);
                File::delete($thumb);
            }
            $logo->delete();
        }else{
            return view('errors.503');
        }
        return back();
    }

}
