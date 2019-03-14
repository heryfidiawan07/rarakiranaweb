<?php

namespace App\Http\Controllers;

use PDF;
use Auth;
use File;
use Image;
use Purifier;
use App\User;
use App\Post;
use App\Order;
use App\Thread;
use App\Product;
use App\Comment;
use App\Payment;
use App\Rekening;
use Illuminate\Http\Request;

class UserController extends Controller
{
	public function __construct(){
		$this->middleware('auth', ['except'=>'show']);
	}

	public function show($slug)
	{   
		$user    = User::whereSlug($slug)->first();
		$threads = $user->threads()->paginate(5);
		$artcomments = $user->postcomments()->paginate(5);
		$prodcomments = $user->prodcomments()->paginate(5);
		$thcomments = $user->threadcomments()->paginate(5);
		return view('user.show',compact('user','threads','artcomments','prodcomments','thcomments'));
	}

	public function image(Request $request, $id){
		$this->validate($request, [
				'img' => 'required|mimes:jpeg,jpg,bmp,png',
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
	
	public function payment($slug, $order){
		$user      = User::whereSlug($slug)->first();
		$admin     = User::where('admin',1)->first();
		$rekenings = Rekening::where('user_id',$admin->id)->get();
		if (Auth::user()->id == $user->id) {
			$order    = Order::where('no_order',$order)->first();
			$products = Product::all();
			if ($order) {
				$carts   = unserialize($order->cart);
				return view('user.payment', 
					[
						'user' => $user, 'order' => $order, 'carts' => $carts->items, 'rekenings' => $rekenings, 
						'subTotalPrice' => $carts->totalPrice, 'products' => $products
					]
				);
			}else{
				return redirect("/user/{$user->slug}");
			}
		}else{
			return view('errors.503');
		}
	}
	
	public function invoice($slug, $order){
		$user    = User::whereSlug($slug)->first();
		if (Auth::user()->id == $user->id) {
			$order   = Order::where('no_order',$order)->first();
			$carts   = unserialize($order->cart);
			$inv     = "user.invoice";
			$pdf     = PDF::Make();
			$css     = file_get_contents('css/pdf.css');
			$pdf->writeHtml($css, 1);
			$pdf->loadView($inv, ['order' => $order, 'carts' => $carts->items, 'subTotalPrice' => $carts->totalPrice]);
			return $pdf->Stream();
		}else{
			return view('errors.503');
		}
	}
	
}
