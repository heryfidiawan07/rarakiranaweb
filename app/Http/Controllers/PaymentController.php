<?php

namespace App\Http\Controllers;

use File;
use Auth;
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
		                'resi_img' => 'required|mimes:jpeg,jpg,bmp,png',
		            ]);
          $img = $request->file('resi_img');
          if (!empty($img)) {
			        $extends = $img->getClientOriginalextension();
			        $imgName = str_random(50).'.'.$extends;
							//Order Status = [0 = Baru saja chekout | 1 = Telah di bayar/Menunggu konfirmasi admin | 2 = Sedang di proses | 3 = Sedang dalam pengiriman | 4 = Barang telah di terima | 5 = Cancel ]
		        	//Payment status = [0 = Baru saja order | 1 = Order menunggu konfirmasi pembayaran/check payment | 2 = Payment telah di setujui | 3 = Payment Reject ]
					    $order->update([
								'status' => 1,
							]);
					    $oldImg   = public_path("resi/".$order->payment->img);
		          if (file_exists($oldImg)) {
		              File::delete($oldImg);
		          }
							$order->payment->update([
								'pengirim' => strtoupper($request->pengirim),
								'resi_img' => $imgName,
								'status' => 1,
							]);
							$path = $img->getRealPath();
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
