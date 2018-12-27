<?php

namespace App\Http\Controllers;

use File;
use App\Gallery;
use Illuminate\Http\Request;

class GalleryController extends Controller
{
    public function __construct(){
        $this->middleware('admin', ['except'=>['show','menu']]);
    }

    public function destroy($id)
    {
        $gallery = Gallery::find($id);
        if ($gallery) {
            $img   = public_path("products/img/".$gallery->img);
            $thumb = public_path("products/thumb/".$gallery->img);
            if (file_exists($img)) {
                File::delete($img);
                File::delete($thumb);
            }
            $gallery->delete();
        }else{
            return view('errors.503');
        }
        return back();
    }
}
