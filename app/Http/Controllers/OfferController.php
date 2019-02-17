<?php

namespace App\Http\Controllers;

use PDF;
use Auth;
use App\Product;
use App\Question;
use Illuminate\Http\Request;

class OfferController extends Controller
{	
		public function __construct(){
      $this->middleware('admin');
    }

    public function show($slug){
    		if (Auth::user()->admin()) {
    				$user    = Auth::user();
    				$product = Product::whereSlug($slug)->first();
    				$offer   = Question::where('setting',$product->id)->first();
                    $offer->update([
                        'status' => 1,
                    ]);
    				return view('admin.offer.show', compact('offer','product','user'));
    		}else{
    			return view('errors.503');
    		}
    }

		public function print($slug){
		 		if (Auth::user()->admin()) {
            $user    = Auth::user();
            $product = Product::whereSlug($slug)->first();
            $offer   = Question::where('setting',$product->id)->first();
            $file    = "admin.offer.product-offer";
            $pdf     = PDF::Make();
            $css     = file_get_contents('css/pdf.css');
            $img     = public_path("products/thumb/");
            $pdf->writeHtml($css, 1);
            $pdf->loadView($file, ['product' => $product, 'offer' => $offer, 'img' => $img]);
            return $pdf->Stream();
        }else{
            return view('errors.503');
        }
		}
   
}
