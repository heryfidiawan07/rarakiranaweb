<?php

namespace App\Http\Controllers;

use Auth;
use File;
use Image;
use Purifier;
use App\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function __construct(){
        $this->middleware('auth', ['except'=>'show']);
    }

    public function show($slug)
    {   
        $user    = User::whereSlug($slug)->first();
        $threads = $user->forums()->paginate(5);
        $artcomments  = $user->artcomments()->paginate(5);
        $prodcomments = $user->discusions()->paginate(5);
        $forcomments  = $user->forcomments()->paginate(5);
        return view('user.show',compact('user','threads','artcomments','prodcomments','forcomments'));
    }

    public function image(Request $request, $id){
        $this->validate($request, [
                'img' => 'required',
            ]);
        $user = User::whereId($id)->first();
        $img     = $request->file('img');
        $extends = $img->getClientOriginalextension();
        $imgName = $user->slug.'.'.$extends;
        if ($user->id == Auth::user()->id) {
            if ($user->img != null) {
                $oldImg   = public_path("users/".$user->img);
                if (file_exists($oldImg)) {
                    File::delete($oldImg);
                }
            }
            $user->update([
                    'img' => $imgName,
                ]);
            $path     = $img->getRealPath();
            $img      = Image::make($path)->resize(null, 350, function ($constraint) {
                            $constraint->aspectRatio();
                        });
            $img->save(public_path("users/". $imgName));
        }else{
            return view('errors.503');
        }
        return back();
    }
    

    public function name(Request $request,$id)
    {
        $this->validate($request, [
                'name' => 'required|max:50',
            ]);
        $user = User::whereId($id)->first();
        $cekSlug = User::where('slug','=',str_slug($request->name))->first();
        $time = date("YmdHis");
        if ($cekSlug === null) {
            $slug = str_slug($request->name);
        }else{
            $slug = str_slug($request->name).'-'.$time;
        }
        if ($user->id == Auth::user()->id) {
            $user->update([
                    'name' => $request->name,
                    'slug' => $slug,
                ]);
        }
        return redirect("/user/{$user->slug}");
    }

    public function bio(Request $request, $id)
    {
        $this->validate($request, [
                'bio' => 'required|max:1000',
            ]);
        $user = User::whereId($id)->first();
        if ($user->id == Auth::user()->id) {
            $user->update([
                    'bio' => Purifier::clean($request->bio),
                ]);
        }else{
            return 'disini';
        }
        return back();
    }

}
