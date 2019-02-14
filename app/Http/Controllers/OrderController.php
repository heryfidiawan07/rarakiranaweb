<?php

namespace App\Http\Controllers;

use PDF;
use File;
use Auth;
use RajaOngkir;
use App\User;
use App\Order;
use App\Address;
use App\Rekening;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function __construct(){
        $this->middleware('admin', ['except'=>['userDone','cancel']]);
    }

    public function index(){
        //Order Status = [0 = Baru saja chekout | 1 = Telah di bayar/Menunggu konfirmasi admin | 2 = Sedang di proses | 3 = Sedang dalam pengiriman | 4 = Barang telah di terima | 5 = Reject ]
        //Payment status = [0 = Baru saja order | 1 = Order menunggu konfirmasi pembayaran/check payment | 2 = Payment telah di setujui | 3 = Payment Reject ]
        $user      = User::where('admin',1)->first();
    	$orders    = Order::where('status','>',0)->latest()->paginate(20);
        $address   = Address::where('user_id',$user->id)->first();
        $kabupaten = RajaOngkir::Kota()->all();
    	return view('admin.orders.index', compact('orders','address','kabupaten'));
    }
    
    public function details($order){
    	$user      = Auth::user();
        $rekenings = Rekening::all();
        if (Auth::user()->id == $user->id) {
            $order   = Order::where('no_order',$order)->first();
            if($order){
                $carts   = unserialize($order->cart);
                $payment = $order->payment()->first();
                return view('admin.orders.details',
                    ['user' => $user, 'order' => $order, 'carts' => $carts->items, 'rekenings' => $rekenings]
                );
            }else{
                return redirect('/dashboard/orders');
            }
        }else{
            return view('errors.503');
        }
    }

    public function orderProcesed($order){
        $order = Order::where('no_order',$order)->first();
        if ($order->count()) {
            $order->update([
                'status' => 2,
            ]);
            $order->payment->update([
                'status' => 2,
                'status' => 'OK',
            ]);
        }else{
            return view('errors.503');
        }
        //Kirim email bahwa pesanan disetujui / sedang di proses oleh admin/penjual
        return back();
    }

    public function orderRejected(Request $request, $order){
        $order = Order::where('no_order',$order)->first();
        if ($order->count()) {
            $order->update([
                'status' => 5,
            ]);
            $order->payment->update([
                'status' => 3,
                'keterangan' => $request->keterangan,
            ]);
        }else{
            return view('errors.503');
        }
        //Kirim email bahwa pesanan ditolak
        return back();
    }

    
    public function invoicePrint($order){
        if (Auth::user()->admin()) {
            $order   = Order::where('no_order',$order)->first();
            $carts   = unserialize($order->cart);
            $inv     = "admin.orders.invoice";
            $pdf     = PDF::Make();
            $css     = file_get_contents('css/pdf.css');
            $pdf->writeHtml($css, 1);
            $pdf->loadView($inv, ['order' => $order, 'carts' => $carts->items, 'subTotalPrice' => $carts->totalPrice]);
            return $pdf->Stream();
        }else{
            return view('errors.503');
        }
    }
    
    public function deliveryPrint($order){
        if (Auth::user()->admin()) {
            $user    = Auth::user();
            $address = Address::where('user_id', $user->id)->first();
            $order   = Order::where('no_order',$order)->first();
            $carts   = unserialize($order->cart);
            $inv     = "admin.orders.delivery";
            $pdf     = PDF::Make();
            $css     = file_get_contents('css/pdf.css');
            $pdf->writeHtml($css, 1);
            $pdf->loadView($inv, ['order' => $order, 'carts' => $carts->items, 'subTotalPrice' => $carts->totalPrice, 'address' => $address]);
            return $pdf->Stream();
        }else{
            return view('errors.503');
        }
    }
    
    public function inputResi(Request $request, $order){
        if (Auth::user()->admin()) {
            $order   = Order::where('no_order',$order)->first();
            $order->update([
                'kurir_resi' => $request->kurir_resi,
                'status' => 3,
            ]);
            //Kirim Email Pesanan dalam perjalan kurir
            return back();
        }
    }
    
    public function done($order){
        $order   = Order::where('no_order',$order)->first();
            if (Auth::user()->admin() || Auth::user()->id == $order->user_id) {
            $order->update([
                'status' => 4,
            ]);
            //Kirim Email Pesanan telah sampai tujuan
            return back();
        }else {
            return view('errors.503');
        }
    }

    public function userDone($slug, $order){
        $user    = User::whereSlug($slug)->first();
        $order   = Order::where('no_order',$order)->first();
        if (Auth::user()->id == $user->id && $user->id == $order->user_id) {
            $order->update([
                'status' => 4,
            ]);
            //Kirim Email Pesanan telah sampai tujuan
            return back();
        }else {
            return view('errors.503');
        }
    }

    public function cancel($slug, $order){
        $user    = User::whereSlug($slug)->first();
        $order   = Order::where('no_order',$order)->first();
        if (Auth::user()->id == $user->id && $user->id == $order->user_id) {
            $order->payment->delete();
            $order->delete();
            return redirect("/user/{$user->slug}");
        }else {
            return view('errors.503');
        }
    }
    

    public function orderDelete($order){
        if (Auth::user()->admin()) {
            $order = Order::where('no_order',$order)->first();
            $img   = public_path("resi/".$order->payment->resi_img);
            if (file_exists($img)) {
                File::delete($img);
            }
            $order->payment->delete();
            $order->delete();
            return redirect('/dashboard/orders');
        }
    }
    
}
