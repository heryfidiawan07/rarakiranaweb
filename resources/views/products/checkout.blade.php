@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        
        <div class="col-md-8">
            @if(Session::has('cart'))
                @foreach($products as $product)
                    <div class="posts">
                        <div class="col-sm-4">
                            <a href="/show/product/{{$product['item']['slug']}}">
                                <div class="frame-new-posts">
                                    <span class="frame-new-posts-helper"></span>
                                    <img src="/products/thumb/{{$product['item']->pictures[0]['img']}}" class="posts-thumb">
                                </div>
                            </a>
                        </div>
                        <div class="col-sm-8">
                            <h4 class="@if($product['item']['sticky'] == 1) sticky @else posts-title @endif">
                                <a href="/show/product/{{$product['item']['slug']}}">
                                    {{$product['item']['title']}}
                                </a>
                            </h4>
                            <p class="discount">
                                <s><i>Rp {{number_format($product['item']['price'] + $product['item']['discount'], 2)}}</i></s>
                                <span>
                                    <small>
                                        <i>{{number_format(($product['item']['price'] + $product['item']['discount']) / $product['item']['discount'])}} %</i>
                                    </small>
                                </span>
                                @if($product['item']['discount'])
                                    <img src="/parts/sale.jpg" width="50">
                                @endif
                            </p>
                            <p>
                                Rp {{number_format($product['item']['price'], 2)}} <i>x</i> <span class="badge">{{$product['qty']}}</span> = 
                                <strong>Rp {{number_format($product['price'])}}</strong>
                            </p>
                            <i class="fas fa-weight"></i>{{$product['item']['weight']}} <small><i>KG</i></small>
                            @if($product['item']['dimensi'] > 0)
                                 - <span class="glyphicon glyphicon-th-large"></span>
                                 {{$product['item']['dimensi']}} <small><i>Meter</i></small>
                            @endif
                        </div>
                    </div>
                @endforeach
                <strong>Sub Total:<span class="price" id="subtotal" data-price="{{$totalPrice}}"> Rp {{number_format($totalPrice, 2)}}</span></strong>
                <form id="formcheckout" method="POST" action="/product/payment">
                    {{csrf_field()}}
                    <hr>
                    @include('products.address')
                    <hr>
                    <div class="form-group">
                        <textarea name="note" id="note" class="form-control" rows="3" placeholder="Catatan untuk penjual" required></textarea>
                        @if ($errors->has('note'))
                            <span class="help-block">
                                <strong>{{ $errors->first('note') }}</strong>
                            </span>
                        @endif
                    </div>
                    <div class="form-group">
                        <select name="kurir" id="kurir" class="form-control input-sm" disabled required>
                            <option value="0" data-cap="0">KURIR</option>
                            <option value="jne" data-cap="JNE">JNE</option>
                            <option value="tiki" data-cap="TIKI">TIKI</option>
                            <option value="pos" data-cap="POS">POS</option>
                        </select>
                        @if ($errors->has('kurir'))
                            <span class="help-block">
                                <strong>{{ $errors->first('kurir') }}</strong>
                            </span>
                        @endif
                    </div>
                    <div class="form-group">
                        <select name="services" id="services" class="form-control input-sm" disabled required>
                            <option value="10">PILIH</option>
                            <input type="hidden" name="keyService" id="keyService" value="10">
                        </select>
                        @if ($errors->has('services'))
                            <span class="help-block">
                                <strong>{{ $errors->first('services') }}</strong>
                            </span>
                        @endif
                    </div>
                    <div class="panel panel-default">
                        <div class="panel-body">
                            <table class="table table-hover">
                                <strong>Ringkasan Belanja</strong>
                                <tr>
                                    <td>
                                        Total Harga 
                                        <span>
                                            <i>({{$totalQty}} barang)</i>
                                            <input type="hidden" name="totalQty" value="{{$totalQty}}">
                                        </span>
                                    </td>
                                    <td>
                                        <strong> Rp {{number_format($totalPrice, 2)}}</strong>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Total Ongkos Kirim</td>
                                    <td><strong id="ongkir">Rp -</strong></td>
                                    <input type="hidden" name="ongkir" id="inputOngkir">
                                </tr>
                                <tr>
                                    <td>Total Tagihan</td>
                                    <td><strong id="tagihan">Rp -</strong></td>
                                </tr>
                            </table>
                        </div>
                    </div>
                    <div class="form-group">
                        <input id="checkout" type="submit" value="Bayar" class="btn btn-success btn-sm" disabled>
                    </div>
                </form>
            @endif
        </div>
        <div class="col-md-4"></div>
        
    </div>
</div>
@endsection
@section('js')
    <script type="text/javascript" src="/js/cart.js"></script>
@endsection