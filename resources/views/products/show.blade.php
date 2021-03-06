@extends('layouts.app')

@section('url') {{Request::url()}} @endsection
@section('image') http://rarakirana.com/products/img/{{$product->pictures[0]->img}} @endsection
@section('title') {{$product->title}} @endsection
@section('description') {{strip_tags(str_limit($product->description, $limit = 145, $end = '...'))}} @endsection

@section('content')
<div class="container">
    <div class="row">

        <div class="col-md-12">
            <div class="col-md-6">
                @include('products.img')
            </div>
            <div class="col-md-6">
                <h3><b>{{$product->title}}</b></h3>
                <div>
                    @if($product->weight > 0)
                        <i class="fas fa-weight"></i>{{$product->weight}} <i>KG</i>
                    @elseif($product->dimensi > 0)
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
                    @if($product->discount > 0)
                        <s>Rp {{number_format($product->price + $product->discount)}}</s>
                        <span>
                            <small><i>{{number_format(($product->price + $product->discount) / $product->discount)}} %</i></small>
                        </span>
                    @endif
                </h4>
                <h3 class="price">Rp {{number_format($product->price)}}</h3>
                @if($product->setting == 0)
                    <div class="buy-show form-inline">
                        <div class="form-group">
                            <a href="/product/cart/{{$product->slug}}" class="btn btn-default btn-sm">
                                <span class="glyphicon glyphicon-shopping-cart" aria-hidden="true"></span> Beli
                            </a>
                        </div>
                        <div class="form-group">
                            <a href="/add-to-cart/{{$product->id}}" class="btn btn-success btn-sm">
                                <span class="glyphicon glyphicon-shopping-cart" aria-hidden="true"></span> Add to Cart
                            </a>
                        </div>
                    </div>
                    <div class="media">
                        <form class="form-inline" id="form-ongkir" method="POST" action="/cek/ongkir/product/{{$product->slug}}">
                            {{csrf_field()}}
                            <div class="form-group">
                                <input type="text" id="kabupaten" name="kabupaten" class="form-control input-sm" placeholder="Nama Kota" autocomplete="off" required>
                                <div id="list-kabupaten-frame">
                                    <table id="list-kabupaten" class="table table-hover">
                                        @for($i = 0; $i < count($kabupaten); $i++)
                                            <tr>
                                                <td class="list-kabupaten-item" data-id="{{$kabupaten[$i]['city_id']}}" data-name="{{$kabupaten[$i]['city_name']}}">{{$kabupaten[$i]['city_name']}} - {{$kabupaten[$i]['type']}} - {{$kabupaten[$i]['province']}}</td>
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
                @endif
            </div>
        </div>
        
        <div class="col-md-6">
            <div class="product-content-show">
                <ul class="nav nav-tabs" role="tablist">
                    <li role="presentation" class="active">
                        <a href="#decription" aria-controls="description" role="tab" data-toggle="tab">DESKRIPSI</a>
                    </li>
                </ul>
                <div class="tab-content">
                    <div role="tabpanel" class="tab-pane active" id="description">
                        {!! $product->description !!}
                    </div>
                </div>
                @if($product->setting == 1)
                <hr><h4><b>Kirim Penawaran</b></h4><hr>
                    @include('layouts.contact-form')
                @endif
            </div>
        </div>

        <div class="col-md-6">
            <div class="product-content-show">
                <ul class="nav nav-tabs" role="tablist">
                    <li role="presentation" class="active">
                        <a href="#diskusi" aria-controls="diskusi" role="tab" data-toggle="tab">{{$product->comments->count()}} DISKUSI</a>
                    </li>
                    @if($product->setting == 0)
                        <li role="presentation">
                            <a href="#review" aria-controls="review" role="tab" data-toggle="tab">{{$product->reviews->count()}} ULASAN</a>
                        </li>
                    @endif
                    <li role="presentation"><a href="#pesan" aria-controls="pesan" role="tab" data-toggle="tab">KIRIM PESAN</a></li>
                </ul>

                <!-- Tab panes -->
                <div class="tab-content">
                    <div role="tabpanel" class="tab-pane active" id="diskusi">
                        @include('products.discusion')
                    </div>
                    @if($product->setting == 0)
                        <div role="tabpanel" class="tab-pane" id="review">
                            @include('products.reviews')
                        </div>
                    @endif
                    <div role="tabpanel" class="tab-pane" id="pesan">
                        @include('products.messages')
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
@endsection
@section('js')
    <script type="text/javascript" src="/js/ongkir.js"></script>
    <script type="text/javascript" src="/js/helper.js"></script>
@endsection
