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
                <strong>Total: Rp {{number_format($totalPrice)}}</strong>
                <a href="/product/checkout" class="btn btn-success btn-sm">Checkout</a>
            @else
                <h3 class="text-center"><i class="fas fa-shopping-cart"></i>Keranjang anda kosong</h3>
            @endif
        </div>
        <div class="col-md-4"></div>
        
    </div>
</div>
@endsection
