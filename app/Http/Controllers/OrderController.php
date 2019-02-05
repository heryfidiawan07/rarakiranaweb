<?php

namespace App\Http\Controllers;

use Auth;
use App\Order;
use App\Rekening;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function __construct(){
      $this->middleware('admin');
    }

    public function index(){
    	$orders = Order::all();
    	return view('admin.orders.index', compact('orders'));
    }
    
    public function details($order){
    	$user      = Auth::user();
        $rekenings = Rekening::all();
        if (Auth::user()->id == $user->id) {
            $order   = Order::where('no_order',$order)->first();
            $carts   = unserialize($order->cart);
            $payment = $order->payment()->first();
            return view('admin.orders.details',
                ['user' => $user, 'order' => $order, 'payment' => $payment, 'carts' => $carts->items, 'rekenings' => $rekenings]
            );
        }else{
            return view('errors.503');
        }
    }
    
}
