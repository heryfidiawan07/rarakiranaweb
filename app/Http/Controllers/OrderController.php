<?php

namespace App\Http\Controllers;

use PDF;
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
      $this->middleware('admin');
    }

    public function index(){
        //Order Status = [0 = Baru saja chekout | 1 = Telah di bayar/Menunggu konfirmasi admin | 2 = Sedang di proses | 3 = Sedang dalam pengiriman | 4 = Barang telah di terima | 5 = Reject ]
        //Payment status = [0 = Baru saja order | 1 = Order menunggu konfirmasi pembayaran/check payment | 2 = Payment telah di setujui | 3 = Payment Reject ]
        $user      = User::where('admin',1)->first();
    	$orders    = Order::where('status','>',0)->get();
        $address   = Address::where('user_id',$user->id)->first();
        $kabupaten = RajaOngkir::Kota()->all();
    	return view('admin.orders.index', compact('orders','address','kabupaten'));
    }
    
    public function details($order){
    	$user      = Auth::user();
        $rekenings = Rekening::all();
        if (Auth::user()->id == $user->id) {
            $order   = Order::where('no_order',$order)->first();
            $carts   = unserialize($order->cart);
            $payment = $order->payment()->first();
            return view('admin.orders.details',
                ['user' => $user, 'order' => $order, 'carts' => $carts->items, 'rekenings' => $rekenings]
            );
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
            ]);
        }else{
            return view('errors.503');
        }
        //Kirim email bahwa pesanan disetujui / sedang di proses oleh admin/penjual
        return back();
    }

    public function orderRejected($order){
        $order = Order::where('no_order',$order)->first();
        if ($order->count()) {
            $order->update([
                'status' => 5,
            ]);
            $order->payment->update([
                'status' => 3,
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
            $order   = Order::where('no_order',$order)->first();
            $carts   = unserialize($order->cart);
            $inv     = "admin.orders.delivery";
            $pdf     = PDF::Make();
            $css     = file_get_contents('css/pdf.css');
            $pdf->writeHtml($css, 1);
            $pdf->loadView($inv, ['order' => $order, 'carts' => $carts->items, 'subTotalPrice' => $carts->totalPrice]);
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
            //Kirim Pesanan dalam perjalan kurir
            return back();
        }
    }
    
    public function done($order){
        if (Auth::user()->admin()) {
            $order   = Order::where('no_order',$order)->first();
            $order->update([
                'status' => 4,
            ]);
            //Kirim Pesanan dalam perjalan kurir
            return back();
        }
    }
    
}
