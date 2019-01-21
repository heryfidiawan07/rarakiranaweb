<?php

namespace App\Http\Controllers;

use Auth;
use File;
use Image;
use Session;
use Purifier;
use RajaOngkir;

use App\Cart;
use App\Logo;
use App\Promo;
use App\Order;
use App\Product;
use App\Picture;
use App\Address;
use App\Payment;
use App\Storefront;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function __construct(){
        $this->middleware('admin', ['except'=>['show','storefront','products','ongkir','getCity','cart','checkout', 'payment', 'services', 'costService','addToCart','confirm']]);
    }

    public function index()
    {
        $products = Product::latest('sticky')->paginate(10);
        $fronts   = Storefront::orderBy('setting','ASC')->get();
        $frontTag = Storefront::where('setting',10)->first();
        $upfronts = Storefront::has('parent','<',1)->where('setting',0)->get();
        return view('admin.products.index', compact('products','fronts','frontTag','upfronts'));
    }
    
    public function create()
    {   
        $fronts = Storefront::has('parent','<',1)->where('setting',0)->get();
        return view('admin.products.create', compact('fronts'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
                'title' => 'required|unique:products|max:200',
                'storefront_id' => 'required',
                'price' => 'required',
                'img' => 'required',
                'weight' => 'required',
                'description' => 'required',
                'status' => 'required',
                'acomment' => 'required',
            ]);
        $time = date("YmdHis");
        $slug = str_slug($request->title).'-'.$time;
        $product = Product::create([
                'user_id' => Auth::user()->id,
                'title' => $request->title,
                'slug' => $slug,
                'price' => $request->price - $request->discount,
                'discount' => $request->discount,
                'weight' => $request->weight,
                'dimensi' => $request->dimensi,
                'storefront_id' => $request->storefront_id,
                'description' => Purifier::clean($request->description, array('CSS.AllowTricky' => true , 
                    'HTML.SafeIframe' => true , "URI.SafeIframeRegexp" => "%^(http://|https://|//)(www.youtube.com/embed/|player.vimeo.com/video/)%")),
                'status' => $request->status,
                'allowed_comment' => $request->acomment,
            ]);
            $files = $request->file('img');
            $key   = 1;
            while ($key < 6) {
                $extends = $files[$key]->getClientOriginalExtension();
                $imgName = $product->id.'-'.$key.'-'.str_slug($request->title).'-'.$time.'.'.$extends;
                $path    = $files[$key]->getRealPath();
                $img     = Image::make($path)->resize(null, 630, function ($constraint) {
                                $constraint->aspectRatio();
                            });
                $img->save(public_path("products/img/". $imgName));
                $thumb    = Image::make($path)->resize(null, 300, function ($constraint) {
                                $constraint->aspectRatio();
                            });
                $thumb->save(public_path("products/thumb/". $imgName));
            $key++;
                $picture = new Picture;
                $picture->img        = $imgName;
                $picture->product_id = $product->id;
                $picture->save();
            }
        return redirect('/dashboard/products');
    }

    public function status(Request $request, $id){
        $product = Product::whereId($id)->first();
        $product->update(['status' => $request->status,]);
        return back();
    }
    
    public function acomment(Request $request, $id){
        $product = Product::whereId($id)->first();
        $product->update(['allowed_comment' => $request->acomment,]);
        return back();  
    }

    public function sticky(Request $request, $id){
        $product = Product::whereId($id)->first();
        $product->update([
                'sticky' => $request->sticky,
            ]);
        return back();
    }

    public function parent(Request $request, $id){
        $product = Product::whereId($id)->first();
        $product->update([
                'storefront_id' => $request->parent_product,
            ]);
        return back();
    }

    public function edit($id)
    {
        $fronts = Storefront::has('parent','<',1)->where('setting',0)->get();
        $product = Product::whereId($id)->first();
        return view('admin.products.edit',compact('product','fronts'));
    }

    public function updateImg(Request $request, $id){
        $product = Product::whereId($id)->first();
        $time    = date("YmdHis");
        $files   = $request->file('img');
        if (isset($files)) {
            $key   = 0;
            $batas = 5-count($product->pictures);
            while ($key < $batas) {
                $extends = $files[$key]->getClientOriginalExtension();
                $imgName = $product->id.'-'.$key.'-'.str_slug($product->title).'-'.$time.'.'.$extends;
                $path    = $files[$key]->getRealPath();
                $img     = Image::make($path)->resize(null, 630, function ($constraint) {
                                $constraint->aspectRatio();
                            });
                $img->save(public_path("products/img/". $imgName));
                $thumb    = Image::make($path)->resize(null, 300, function ($constraint) {
                                $constraint->aspectRatio();
                            });
                $thumb->save(public_path("products/thumb/". $imgName));
            $key++;
                $picture = new Picture;
                $picture->img        = $imgName;
                $picture->product_id = $product->id;
                $picture->save();
            }
        }
        return redirect("/product/{$product->id}/edit");
    }
    
    public function update(Request $request, $id)
    {
        $this->validate($request, [
                'title' => 'required|max:200',
                'storefront_id' => 'required',
                'price' => 'required',
                'weight' => 'required',
                'description' => 'required',
                'status' => 'required',
                'acomment' => 'required',
            ]);
        $product = Product::whereId($id)->first();
        if ($product) {
            $time     = date("YmdHis");
            if ($product->title == $request->title) {
                $title = $product->title;
                $slug  = $product->slug;
            }else{
                $title = $request->title;
                $slug  = str_slug($request->title).'-'.$time;
            }
            $product->update([
                    'user_id' => Auth::user()->id,
                    'title' => $title,
                    'slug' => $slug,
                    'storefront_id' => $request->storefront_id,
                    'price' => $request->price - $request->discount,
                    'weight' => $request->weight,
                    'dimensi' => $request->dimensi,
                    'discount' => $request->discount,
                    'description' => Purifier::clean($request->description, array('CSS.AllowTricky' => true , 
                        'HTML.SafeIframe' => true , "URI.SafeIframeRegexp" => "%^(http://|https://|//)(www.youtube.com/embed/|player.vimeo.com/video/)%")),
                    'status' => $request->status,
                    'allowed_comment' => $request->acomment,
                ]);
            return redirect('/dashboard/products');
        }else{
            return view('errors.503');
        }
    }

    public function destroy($id)
    {
        $product = Product::find($id);
        if ($product) {
            for ($i=0; $i < count($product->pictures); $i++) { 
                $img   = public_path("products/img/".$product->pictures[$i]->img);
                $thumb = public_path("products/thumb/".$product->pictures[$i]->img);
                File::delete($img);
                File::delete($thumb);
            }
        }else{
            return view('errors.503');
        }
        $product->comments()->delete();
        $product->delete();
        return back();
    }

// Guest User
    public function show($prodslug)
    {
        $product    = Product::where([['slug',$prodslug],['status',1]])->first();
        $discusions = $product->comments()->paginate(10);
        $city       = RajaOngkir::Kota()->all();
        if ($product && $product->Storefront->status==1) {
            return view('products.show', compact('product','discusions','city'));
        }else{
            return view('errors.503');
        }
    }

    public function products($slug){
        $cek   = Storefront::whereSlug($slug)->first();
        if ($cek === null) {
            return view('errors.503');
        }else{
            $logo        = Logo::where('setting','product')->first();
            $promo       = Promo::where('setting','product')->first();
            $fronts      = Storefront::where('setting',0)->get();
            $newproducts = Product::where('status',1)->latest('sticky')->paginate(10);
            return view('products.index', compact('newproducts','fronts','logo','promo'));
        }
    }

    public function storefront($slug){
        $logo   = Logo::where('setting','product')->first();
        $promo  = Promo::where('setting','product')->first();
        $subs   = Storefront::where([['slug',$slug],['status',1]])->first();
        $fronts = Storefront::where('setting',0)->get();
        if ($subs->parent->count()){
            $products = $subs->childProducts()->latest('sticky')->paginate(10);
        }else{
            $products = $subs->products()->latest('sticky')->paginate(10);
        }
        return view('products.category', compact('products','fronts','logo','promo','subs'));
    }

    public function ongkir(Request $request, $slug, $tujuan, $kurir){
        $product = Product::whereSlug($slug)->first();
        $asal    = 55;//55 Adalah bekasi kabupaten
        $berat   = $product->weight;//$product->weight; // dalam gram
        $cost    = RajaOngkir::Cost([
                        'origin'        => $asal, // id kota asal = Bekasi
                        'destination'   => $tujuan, // id kota tujuan
                        'weight'        => $product->weight, // berat satuan gram
                        'courier'       => $kurir, // kode kurir pengantar ( jne / tiki / pos )
                    ])->get();
        return response($cost);
    }

    public function addToCart(Request $request, $id){
        $product = Product::find($id);
        $oldCart = Session::has('cart') ? Session::get('cart') : null;
        $cart    = new Cart($oldCart);
        $cart->add($product, $product->id);

        $request->session()->put('cart', $cart);
        //dd($request->session()->get('cart'));
        return redirect('/');//Under Dev -> Editing wait
    }
    
    
    public function cart(){
        if (!Session::has('cart')) {
            return view('products.cart');
        }
        $oldCart = Session::get('cart');
        $cart    = new Cart($oldCart);
        return view('products.cart', ['products' => $cart->items, 'totalPrice' => $cart->totalPrice]);
    }

    public function checkout(){
        if (!Session::has('cart')) {
            return view('products.cart');
        }
        $oldCart = Session::get('cart');
        $cart    = new Cart($oldCart);
        $city    = RajaOngkir::Kota()->all();
        $address = Address::where('user_id',Auth::user()->id)->first();
        return view('products.checkout', ['products' => $cart->items, 'totalPrice' => $cart->totalPrice , 'city' => $city, 'totalWeight' => $cart->totalWeight, 'address' => $address]);
    }

    public function services(Request $request, $city, $kurir){
        $asal    = 55;//55 Adalah bekasi kabupaten
        $cost    = RajaOngkir::Cost([
                        'origin'        => $asal, // id kota asal = Bekasi
                        'destination'   => $city, // id kota tujuan
                        'weight'        => 1000, // berat satuan gram
                        'courier'       => $kurir, // kode kurir pengantar ( jne / tiki / pos )
                    ])->get();
        return response($cost);
    }
    
    public function costService(Request $request, $city, $kurir, $key){
        $oldCart = Session::get('cart');
        $cart    = new Cart($oldCart);
        $total   = $cart->totalPrice;
        $weight  = $cart->totalWeight*1000;
        $asal    = 55;//55 Adalah bekasi kabupaten
        $cost    = RajaOngkir::Cost([
                        'origin'        => $asal, // id kota asal = Bekasi
                        'destination'   => $city, // id kota tujuan
                        'weight'        => $weight, // berat satuan gram
                        'courier'       => $kurir, // kode kurir pengantar ( jne / tiki / pos )
                    ])->get();
        $ongkir  = number_format($cost[0]['costs'][$key]['cost'][0]['value'], 2);
        $tagihan = $cost[0]['costs'][$key]['cost'][0]['value'] + $total;
        $tagihan = number_format($tagihan, 2);
        return response(array('ongkir' => $ongkir, 'tagihan' => $tagihan ));
    }
    
    public function payment(Request $request){
        $this->validate($request, [
                'penerima' => 'required',
                'address' => 'required',
                'kabupaten' => 'required',
                'kecamatan' => 'required',
                'note'  => 'required',
                'kurir' => 'required',
                'services' => 'required',
            ]);
        $oldCart = Session::get('cart');
        $cart    = new Cart($oldCart);
        $items   = $cart->items;
        $total   = $cart->totalPrice;
        $weight  = $cart->totalWeight*1000;
        //Request
        $asal      = 55;
        $key       = $request->keyServ;
        $cost      = RajaOngkir::Cost([
                        'origin'        => $asal, // id kota asal = Bekasi
                        'destination'   => $request->kabHidden, // id kota tujuan
                        'weight'        => $weight, // berat satuan gram
                        'courier'       => strtolower($request->kurir), // kode kurir pengantar ( jne / tiki / pos )
                    ])->get();
        $tagihan      = $cost[0]['costs'][$key]['cost'][0]['value'];
        $totalTagihan = $total+$tagihan;
        // $input     = array(
        //                 'note' => $note, 'address' => $address, 'kabupaten' => $kabupaten,'kecamatan' => $kecamatan, 
        //                 'services' => $services, 'kabHidden' => $kabHidden, 'weight' => $weight, 'key' => $key, 
        //                 'totalTagihan' => $totalTagihan
        //             );
        // print_r($input);
        
        //Address [id, name, penerima, user_id, address, kab_id, kabupaten, kec_id, kecamatan]
        //Payments [id, address_id, pengirim, resi, status]
        //ORDERS ['payment_id', 'no_order', 'cart', 'total_price', 'note', 'kurir', 'services', 'total_weight',]
        $useradd = Address::where([['user_id',Auth::user()->id],['kab_id','!=',$request->kabHidden]])->first();
        if ($useradd === null) {
            $address = Address::create([
                'name'      => Auth::user()->name,
                'penerima'  => $request->penerima,
                'address'   => Purifier::clean($request->address),
                'kab_id'    => $request->kabHidden,
                'kabupaten' => $request->kabupaten,
                'kec_id'    => 0,
                'kecamatan' => $request->kecamatan,
                'user_id'   => Auth::user()->id,
            ]);
        }else{
            $address = Address::update([
                'name'      => Auth::user()->name,
                'penerima'  => $request->penerima,
                'address'   => Purifier::clean($request->address),
                'kab_id'    => $request->kabHidden,
                'kabupaten' => $request->kabupaten,
                'kec_id'    => 0,
                'kecamatan' => $request->kecamatan,
                'user_id'   => Auth::user()->id,
            ]);
        }
        $payment = Payment::create([
                'address_id' => $address->id,
                'pengirim'   => 'yet',
                'resi'       => 'yet',
            ]);
        Order::create([
                'payment_id'   => $payment->id,
                'no_order'     => $payment->id.date("YmdHis"),
                'cart'         => serialize($cart),
                'total_price'  => $totalTagihan,
                'note'         => $request->note,
                'kurir'        => $request->kurir,
                'services'     => $request->services,
                'total_weight' => $weight,
                'user_id'   => Auth::user()->id,
            ]);
        $forget = Session::forget('cart');
        //$array = array('address' => $address, 'payment' => $payment, 'order' => $order, 'forget' => $forget, 'dev' => 'UNDER DEVELOPMENT');
        //Mail::to($user->email)->send(new RarakiranaRegister($user));
        return redirect('/user/payment');
        //return view('products.payment',compact('payment'));
        //dd($items[1]);
        // return view('products.cart', ['products' => $cart->items, 'totalPrice' => $cart->totalPrice , 'city' => $city]);
        // $product = Product::whereSlug($slug)->first();
    }

    public function confirm($orderId){
        
    }
    
// Guest User

}
