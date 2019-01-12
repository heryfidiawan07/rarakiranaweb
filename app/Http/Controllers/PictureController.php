<?php

namespace App\Http\Controllers;

use File;
use App\Picture;
use Illuminate\Http\Request;

class PictureController extends Controller
{
    public function __construct(){
      $this->middleware('admin');
    }

    public function destroy($id){
	    	$pict = Picture::find($id);
	    	$img   = public_path("products/img/".$pict->img);
	      $thumb = public_path("products/thumb/".$pict->img);
	      if (file_exists($img)) {
	          File::delete($img);
	          File::delete($thumb);
	      }
	      $pict->delete();
      	return back();
    }
    
    
}
