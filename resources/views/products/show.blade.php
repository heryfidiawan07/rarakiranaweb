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
        <div class="col-md-12">
            <div class="col-md-6">
                @include('products.img')
            </div>
            <div class="col-md-6">
                <h2><b>{{$product->title}}</b></h2>
                <div>
                    <i class="fas fa-weight"></i>{{$product->weight}} <i>KG</i>
                    @if($product->dimensi > 0)
                     - Dimensi: {{$product->dimensi}} <i>Meter</i>
                    @endif
                    <a href="/products/{{$product->storefront->slug}}" class="btn btn-default">
                        <span class="glyphicon glyphicon-tag" aria-hidden="true"></span> {{$product->storefront->name}}
                    </a>
                     @if($product->discount)
                        <img src="/parts/sale.jpg">
                     @endif
                </div>
                <h4 class="discount">
                    <s>Rp {{number_format($product->price + $product->discount, 2)}}</s>
                    <span>
                        <small><i>{{($product->price + $product->discount) / $product->discount}} %</i></small>
                    </span>
                </h4>
                <h3 class="price">Rp {{number_format($product->price, 2)}}</h3>
                <div class="buy-show">
                    <a href="/product/cart/{{$product->slug}}" class="btn btn-default btn-sm">
                        <span class="glyphicon glyphicon-shopping-cart" aria-hidden="true"></span> Beli
                    </a>
                    <a href="/add-to-cart/{{$product->id}}" class="btn btn-success btn-sm">
                        <span class="glyphicon glyphicon-shopping-cart" aria-hidden="true"></span> Add to Cart
                    </a>
                </div>
                <div class="media">
                    <form class="form-inline" id="form-ongkir" method="POST" action="/cek/ongkir/product/{{$product->slug}}">
                        {{csrf_field()}}
                        <div class="form-group">
                            <input type="text" id="tujuan" name="tujuan" class="form-control input-sm" placeholder="Nama Kota">
                            <div id="listcity-frame">
                                <table id="listcity" class="table table-hover">
                                    @for($i = 0; $i < count($city); $i++)
                                        <tr>
                                            <td class="listcityitem" data-id="{{$city[$i]['city_id']}}" data-name="{{$city[$i]['city_name']}}">{{$city[$i]['city_name']}} - {{$city[$i]['type']}} - {{$city[$i]['province']}}</td>
                                        </tr>
                                    @endfor
                                </table>
                            </div>
                        </div>
                        <div class="form-group">
                            <select name="kurir" id="kurir" class="form-control input-sm">
                                <option value="jne" data-cap="JNE">JNE</option>
                                <option value="tiki" data-cap="TIKI">TIKI</option>
                                <option value="pos" data-cap="POS">POS</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <input type="submit" value="Cek Ongkir" class="btn btn-success btn-sm" id="cek">
                        </div>
                    </form>                    
                    <div class="media" id="cost"></div>
                </div>
            </div>
        </div>
        <div class="col-md-12">
            <div class="col-md-5 product-content-show">
                <ul class="nav nav-tabs" role="tablist">
                    <li role="presentation" class="active"><a href="#deskripsi" aria-controls="deskripsi" role="tab" data-toggle="tab">DESKRIPSI</a></li>
                    <li role="presentation">
                        <a href="#diskusi" aria-controls="diskusi" role="tab" data-toggle="tab">
                        {{$product->comments->count()}} DISKUSI</a>
                    </li>
                    <li role="presentation"><a href="#ulasan" aria-controls="ulasan" role="tab" data-toggle="tab">ULASAN</a></li>
                    <li role="presentation"><a href="#pesan" aria-controls="pesan" role="tab" data-toggle="tab">PESAN</a></li>
                  </ul>

                  <!-- Tab panes -->
                  <div class="tab-content">
                    <div role="tabpanel" class="tab-pane active" id="deskripsi">
                        {!! $product->description !!}
                    </div>
                    <div role="tabpanel" class="tab-pane" id="diskusi">
                        @include('products.discusion')
                    </div>
                    <div role="tabpanel" class="tab-pane" id="ulasan">...</div>
                    <div role="tabpanel" class="tab-pane" id="pesan">
                        @if(Auth::check())
                            @if(Auth::user())

                            @endif
                        @else
                            <div class="text-center">
                                <br>
                                <a href="/login" class="btn btn-primary btn-sm">Login</a>
                            </div>
                        @endif
                    </div>
                  </div>
            </div>
            <div class="col-md-7">
                
            </div>
        </div>
    </div>
</div>
@endsection
@section('js')
    <script type="text/javascript" src="/js/ongkir.js"></script>
@endsection