<?php

namespace App\Http\Controllers;

use Auth;
use File;
use Image;
use App\Promo;
use App\Picture;
use Illuminate\Http\Request;

class PromoController extends Controller
{
    public function __construct(){
        $this->middleware('admin');
    }

    public function index()
    {   
        $promos = Promo::all();
        return view('admin.promo.index',compact('promos'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
                'img' => 'required',
                'setting' => 'required',
            ]);
        $time = date("YmdHis");
        $files = $request->file('img');
        $key   = 0;
        $cek = Promo::where('setting',$request->setting)->first();
        if ($cek === null) {
            $promo = Promo::create([
                    'user_id' => Auth::user()->id,
                    'setting' => $request->setting,
                    'status' => 1,
                ]);
            while ($key < count($files)) {
                $extends = $files[$key]->getClientOriginalExtension();
                $imgName = $time.'-'.$promo->id.'-'.$key.'-'.'rarakirana-com.'.$extends;
                $path    = $files[$key]->getRealPath();
                $img     = Image::make($path)->resize(900, 300);
                $img->save(public_path("promo/". $imgName));
            $key++;
                $picture = new Picture;
                $picture->img      = $imgName;
                $picture->promo_id = $promo->id;
                $picture->save();
            }
        }else{
            return back()->with('warning', 'Setting yang anda pilih sudah terisi !');   
        }
        return back();
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
                'imgmore' => 'required',
            ]);
        $promo = Promo::whereId($id)->first();
        $picture = Picture::where('promo_id',$promo->id)->first();
        $time = date("YmdHis");
        $files = $request->file('imgmore');
        $key   = 0;
        while ($key < count($files)) {
            $extends = $files[$key]->getClientOriginalExtension();
            $imgName = $time.'-'.$promo->id.'-'.$key.'-'.'rarakirana-com.'.$extends;
            $path    = $files[$key]->getRealPath();
            $img     = Image::make($path)->resize(900, 300);
            $img->save(public_path("promo/". $imgName));
        $key++;
            $picture = new Picture;
            $picture->img      = $imgName;
            $picture->promo_id = $promo->id;
            $picture->save();
        }
        return back();
    }

    public function deletePicture($id){
        $pict = Picture::find($id);
        $img   = public_path("promo/".$pict->img);
        if (file_exists($img)) {
            File::delete($img);
        }
        $pict->delete();
        return back();
    }
    
    public function destroy($id)
    {
        //
    }

}
