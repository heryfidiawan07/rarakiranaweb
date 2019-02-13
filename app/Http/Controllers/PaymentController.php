<?php

namespace App\Http\Controllers;

use File;
use Auth;
use Image;
use App\User;
use App\Order;
use App\Payment;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function __construct(){
		$this->middleware('admin', ['except'=>['userPayment','updatePayment']]);
    }

	public function userPayment(Request $request, $slug, $order){
		$user = User::whereSlug($slug)->first();
		if (Auth::user()->id == $user->id) {
			$order   = Order::where('no_order',$order)->first();
			$payment = $order->payment()->first();
			if ($order->id == $payment->order_id && Auth::user()->id == $order->user_id) {
				$img = $request->file('resi_img');
				if (!empty($img)) {
					//Order Status = [0 = Baru saja chekout | 1 = Telah di bayar/Menunggu konfirmasi admin | 2 = Sedang di proses | 3 = Sedang dalam pengiriman | 4 = Barang telah di terima | 5 = Cancel ]
					//Payment status = [0 = Baru saja order | 1 = Order menunggu konfirmasi pembayaran/check payment | 2 = Payment telah di setujui | 3 = Payment Reject ]
					$this->validate($request, [
						'pengirim' => 'required|max:30',
						'resi_img' => 'required|mimes:jpeg,jpg,bmp,png',
					]);
					$extends = $img->getClientOriginalextension();
					$imgName = str_random(50).'.'.$extends;
					$path 	 = $img->getRealPath();
					$img     = Image::make($path)->resize(null, 630, function ($constraint) {
									$constraint->aspectRatio();
								});
					$img->save(public_path("resi/".$imgName));
					//dd($extends);
					$cekResi = public_path("resi/".$imgName);
					if (file_exists($cekResi)) {
						$order->update([
							'status' => 1,
						]);
						$order->payment->update([
							'pengirim' => strtoupper($request->pengirim),
							'resi_img' => $imgName,
							'status' => 1,
						]);
					}else {
						return back();
					}
				}
				//Kirim Email Ke Admin	
				return back();
			}else{
				return view('errors.503');
			}
		}else{
			return view('errors.503');
		}
	}

	public function updatePayment(Request $request, $slug, $order){
		$user = User::whereSlug($slug)->first();
		if (Auth::user()->id == $user->id) {
			$order   = Order::where('no_order',$order)->first();
			$payment = $order->payment()->first();
			if ($order->id == $payment->order_id && Auth::user()->id == $order->user_id) {
				$img = $request->file('updateImgResi');
				if (!empty($img)) {
					//Order Status = [0 = Baru saja chekout | 1 = Telah di bayar/Menunggu konfirmasi admin | 2 = Sedang di proses | 3 = Sedang dalam pengiriman | 4 = Barang telah di terima | 5 = Cancel ]
					//Payment status = [0 = Baru saja order | 1 = Order menunggu konfirmasi pembayaran/check payment | 2 = Payment telah di setujui | 3 = Payment Reject ]
					$this->validate($request, [
						'updatePengirim' => 'required|max:30',
						'updateImgResi'  => 'required|mimes:jpeg,jpg,bmp,png',
					]);
					$oldImg   = public_path("resi/".$order->payment->resi_img);
					if (file_exists($oldImg)) {
						File::delete($oldImg);
					}

					$extends = $img->getClientOriginalextension();
					$imgName = str_random(50).'.'.$extends;
					$path 	 = $img->getRealPath();
					$img     = Image::make($path)->resize(null, 630, function ($constraint) {
									$constraint->aspectRatio();
								});
					$img->save(public_path("resi/".$imgName));	
				}else{
					$imgName = $order->payment->resi_img;
				}
				$cekResi = public_path("resi/".$imgName);
				if (file_exists($cekResi)) {
					$order->update([
						'status' => 1,
					]);
					$order->payment->update([
						'pengirim' => strtoupper($request->updatePengirim),
						'resi_img' => $imgName,
						'status'   => 1,
					]);
				}
				//Kirim Email Ke Admin	
				return back();
			}else{
				return view('errors.503');
			}
		}else{
			return view('errors.503');
		}
	}
	
}
