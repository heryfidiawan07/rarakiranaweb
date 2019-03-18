@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        
        <div class="col-md-8">
            @if(Session::has('cart'))
                @foreach($products as $key => $product)
                    <div class="posts media">
                        <div class="col-sm-4">
                            <a href="/show/product/{{$product['item']['slug']}}">
                                <div class="frame-new-posts">
                                    <span class="frame-new-posts-helper"></span>
                                    <img src="/products/thumb/{{$product['item']->pictures[0]['img']}}" class="posts-thumb-img">
                                </div>
                            </a>
                        </div>
                        <div class="col-sm-8">
                            <div class="@if($product['item']['sticky'] == 1) sticky @else posts-title @endif">
                                <h4>
                                    <a href="/show/product/{{$product['item']['slug']}}">
                                        {{str_limit($product['item']['title'],50)}}
                                    </a>
                                </h4>
                            </div>
                            <p class="discount">
                                @if($product['item']['discount'])
                                    <s><i>Rp {{number_format($product['item']['price'] + $product['item']['discount'], 2)}}</i></s>
                                    <span>
                                        <small>
                                            <i>{{number_format(($product['item']['price'] + $product['item']['discount']) / $product['item']['discount'])}} %</i>
                                        </small>
                                    </span>
                                    <img src="/parts/sale.jpg" width="50">
                                @endif
                                <i class="fas fa-weight"></i>{{$product['item']['weight']}} <small><i>KG</i></small>
                                @if($product['item']['dimensi'] > 1)
                                     - <span class="glyphicon glyphicon-th-large"></span>
                                     {{$product['item']['dimensi']}} <small><i>Meter</i></small>
                                @endif
                            </p>
                            <p>
                                Rp {{number_format($product['item']['price'])}} <i>x</i>
                                <button data-url="/add-min-qty-cart/{{$product['item']['slug']}}" type="button" id="min" class="min" data-key="{{$key}}">-</button>
                                <input type="number" id="itemQty" value="{{$product['qty']}}" min="1" name="itemQty" readonly>
                                <button data-url="/add-new-qty-cart/{{$product['item']['slug']}}" type="button" id="plus" class="plus" data-key="{{$key}}">+</button>
                                = 
                                <strong id="price_{{$key}}">Rp {{number_format($product['price'])}}</strong>
                                <a href="/remove-cart/{{$product['item']['slug']}}" class="btn btn-default btn-sm danger" style="height: 100%;">
                                    <span class="glyphicon glyphicon-trash"></span>
                                </a>
                            </p>
                        </div>
                    </div>
                @endforeach
                <strong id="totalPrice">Subtotal: Rp {{number_format($totalPrice)}}</strong>
                <a href="/product/checkout" class="btn btn-success btn-sm">
                    <span class="glyphicon glyphicon-shopping-cart"></span> Checkout
                </a>
            @else
                <h3 class="text-center"><i class="fas fa-shopping-cart"></i>Keranjang anda kosong</h3>
            @endif
        </div>
        <div class="col-md-4"></div>
        
    </div>
</div>
@endsection
@section('js')
    <script type="text/javascript" src="/js/cart.js"></script>
@endsection