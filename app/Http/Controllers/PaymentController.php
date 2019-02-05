<?php

namespace App\Http\Controllers;

use Auth;
use Image;
use App\User;
use App\Order;
use App\Payment;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function __construct(){
      $this->middleware('admin', ['except'=>'userPayment']);
    }

	public function userPayment(Request $request, $slug, $order){
		$user = User::whereSlug($slug)->first();
		if (Auth::user()->id == $user->id) {
			$order   = Order::where('no_order',$order)->first();
			$payment = $order->payment()->first();
			if ($order->id == $payment->order_id && Auth::user()->id == $order->user_id) {
				$this->validate($request, [
	                'pengirim' => 'required|max:30',
	                'resi'     => 'required|mimes:jpeg,jpg,bmp,png',
	            ]);
	            $img = $request->file('resi');
	            if (!empty($img)) {
			        $extends = $img->getClientOriginalextension();
			        $imgName = str_random(50).'.'.$extends;
					$payment->update([
						'pengirim' => strtoupper($request->pengirim),
						'resi' => $imgName,
						'status' => 1,
					]);
					$path = $img->getRealPath();
		            $img  = Image::make($path)->resize(null, 350, function ($constraint) {
		                            $constraint->aspectRatio();
		                        });
		            $img->save(public_path("resi/". $imgName));
		         }
				return back();
			}else{
				return view('errors.503');
			}
		}else{
			return view('errors.503');
		}

	}
	
}
