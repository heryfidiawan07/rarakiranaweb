@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        
        <div class="col-md-8">
            @if(Session::has('cart'))
                @foreach($products as $product)
                    <div class="posts">
                        <div class="col-sm-4">
                            <a href="/read/post/{{$product['item']['slug']}}">
                                <div class="frame-new-posts">
                                    <span class="frame-new-posts-helper"></span>
                                    <img src="/products/thumb/{{$product['item']->pictures[0]['img']}}" class="posts-thumb">
                                </div>
                            </a>
                        </div>
                        <div class="col-sm-8">
                            <h4 class="@if($product['item']['sticky'] == 1) sticky @else posts-title @endif">
                                <a href="/read/post/{{$product['item']['slug']}}">
                                    {{$product['item']['title']}}
                                </a>
                            </h4>
                            <p class="discount">
                                <s><i>Rp {{number_format($product['price'] + $product['item']['discount'], 2)}}</i></s>
                                <span>
                                    <small>
                                        <i>{{number_format(($product['price'] + $product['item']['discount']) / $product['item']['discount'])}} %</i>
                                    </small>
                                </span>
                                @if($product['item']['discount'])
                                    <img src="/parts/sale.jpg" width="50">
                                @endif
                            </p>
                            <p>
                                Rp {{number_format($product['price'], 2)}} <i>x</i> <span class="badge">{{$product['qty']}}</span> = 
                                <strong>Rp {{number_format($product['price']*$product['qty'])}}</strong>
                            </p>
                            <i class="fas fa-weight"></i>{{$product['item']['weight']}} <small><i>KG</i></small>
                            @if($product['item']['dimensi'] < 1)
                                 - <span class="glyphicon glyphicon-th-large"></span>
                                 {{$product['item']['dimensi']}} <small><i>Meter</i></small>
                            @endif
                        </div>
                    </div>
                @endforeach
                <strong>Sub Total:<span class="price" id="subtotal" data-price="{{$totalPrice}}"> Rp {{number_format($totalPrice, 2)}}</span></strong>
                <hr>
                <form id="formcheckout" method="POST" action="/product/payment">
                    {{csrf_field()}}
                    <div class="form-group">
                        <textarea name="note" class="form-control" rows="3" placeholder="Catatan untuk penjual" id="note" required></textarea>
                    </div>
                    <div class="form-group">
                        <textarea name="address" class="form-control" rows="4" placeholder="Alamat rumah" id="address" required></textarea>
                    </div>
                    <div class="form-group">
                        <input type="text" name="penerima" placeholder="Nama penerima" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <input type="text" id="city" name="kabupaten" class="form-control input-sm" placeholder="Kabupaten" required>
                        <input type="hidden" name="kabHidden" id="kabHidden">
                        <div id="listcity-frame">
                            <table id="listcity" class="table table-hover">
                                @for($i = 0; $i < count($city); $i++)
                                    <tr>
                                        <td class="listcityitem" data-id="{{$city[$i]['city_id']}}" data-name="{{$city[$i]['city_name']}}">{{$city[$i]['type']}} - {{$city[$i]['city_name']}} - {{$city[$i]['province']}}</td>
                                    </tr>
                                @endfor
                            </table>
                        </div>
                    </div>
                    <div class="form-group">
                        <input type="text" id="kecamatan" name="kecamatan" class="form-control input-sm" placeholder="Kecamatan" required>
                    </div>
                    <div class="form-group">
                        <select name="kurir" id="kurir" class="form-control input-sm" required>
                            <option value="0" data-cap="JNE">KURIR</option>
                            <option value="jne" data-cap="JNE">JNE</option>
                            <option value="tiki" data-cap="TIKI">TIKI</option>
                            <option value="pos" data-cap="POS">POS</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <select name="services" id="services" class="form-control input-sm" required>
                            <option>PILIH</option>
                        </select>
                        <input type="hidden" name="keyServ" id="keyServ">
                    </div>
                    <div class="panel panel-default">
                        <div class="panel-heading">Ringkasan Belanja</div>
                        <div class="panel-body">
                            <table>
                                <tr>
                                    <td>
                                        Total Harga 
                                        <span>({{Session::has('cart') ? Session::get('cart')->totalQty : '0'}} barang)</span>
                                    </td>
                                    <td>
                                        <strong>Rp {{number_format($totalPrice, 2)}}</strong>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Total Ongkos Kirim</td>
                                    <td><strong id="ongkir">Rp -</strong></td>
                                </tr>
                                <tr>
                                    <td>Total Tagihan</td>
                                    <td><strong id="tagihan">Rp -</strong></td>
                                </tr>
                            </table>
                        </div>
                    </div>
                    <div class="form-group">
                        <input id="checkout" type="submit" value="Bayar" class="btn btn-success btn-sm">
                    </div>
                </form>
            @else
                <h3 class="text-center">Keranjang anda kosong</h3>
            @endif
        </div>
        <div class="col-md-4"></div>
        
    </div>
</div>
@endsection
@section('js')
    <script type="text/javascript" src="/js/cart.js"></script>
@endsection