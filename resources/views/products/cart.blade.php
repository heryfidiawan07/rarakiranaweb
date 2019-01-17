@extends('layouts.app')

@section('url') {{Request::url()}} @endsection
@section('image') http://rarakirana.com/products/img/{{$product->pictures[0]->img}} @endsection
@section('title') {{$product->title}} @endsection
@section('description') 
    {{strip_tags(str_limit($product->description, $limit = 145, $end = '...'))}} 
@endsection

@section('content')
<div class="container">
    <div class="row">
        
        <div class="col-md-6">
            <div class="text-center">
                @include('products.thumb')
                <h3><b>{{$product->title}}</b></h3>
            </div>
            <div>
                <i class="fas fa-weight"></i>{{$product->weight}} <i>KG</i>
                @if($product->dimensi > 0)
                 - Dimensi: {{$product->dimensi}} <i>Meter</i>
                @endif
                 @if($product->discount)
                    <img src="/parts/sale.jpg" width="70">
                 @endif
            </div>
            <h4 class="discount">
                <s>Rp {{number_format($product->price, 2)}}</s>
                <span>
                    <small><i>{{$product->price/$product->discount}} %</i></small>
                </span>
            </h4>
            <h3 class="price">Rp {{number_format($product->price - $product->discount, 2)}}</h3>
            <div class="media">
                <form method="POST" action="">
                    {{csrf_field()}}
                    <div class="form-group">
                        <div class="input-group">
                            <div class="input-group-addon">Qty</div>
                            <input type="number" name="qty" class="form-control input-sm" value="1">
                        </div>
                    </div>
                    <div class="form-group">
                        <textarea class="form-control" rows="4" placeholder="Alamat rumah" id="inputaddress"></textarea>
                    </div>
                    <div class="form-group">
                        <input type="text" id="city" name="tujuan" class="form-control input-sm" placeholder="Kabupaten">
                        <div id="listcity">
                            @for($i = 0; $i < count($city); $i++)
                                <p class="listcityitem" data-id="{{$city[$i]['city_id']}}" data-name="{{$city[$i]['city_name']}}">{{$city[$i]['type']}} - {{$city[$i]['city_name']}} - {{$city[$i]['province']}}</p>
                            @endfor
                        </div>
                    </div>
                    <div class="form-group">
                        <input type="text" id="kecamatan" name="tujuan" class="form-control input-sm" placeholder="Kecamatan">
                    </div>
                    <div class="form-group">
                        <select name="kurir" id="kurir" class="form-control input-sm">
                            <option value="0">Kurir</option>
                            <option value="jne" data-cap="JNE">JNE</option>
                            <option value="tiki" data-cap="TIKI">TIKI</option>
                            <option value="pos" data-cap="POS">POS</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <select name="kurir" id="kurir" class="form-control input-sm" disabled>
                            <option value="jne" data-cap="JNE">OKE</option>
                            <option value="tiki" data-cap="TIKI">REG</option>
                            <option value="pos" data-cap="POS">YES</option>
                        </select>
                    </div>
                    <div class="media" id="cost"></div>
                    <div class="form-group">
                        <input type="submit" value="Checkout" class="btn btn-success btn-sm" disabled>
                    </div>
                </form>
                <div id="datacity">
                    <span></span>
                </div>
            </div>
        </div>
        
    </div>
</div>
@endsection
@section('js')
    <script type="text/javascript" src="/js/cart.js"></script>
@endsection