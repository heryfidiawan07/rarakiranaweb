@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
            
            <div class="col-md-6">
                <h2>
                    OFFERING LETTER
                    <small>
                        <a href="/dashboard/product/offer/{{$product->slug}}/print" target="_blank">
                            <span class="glyphicon glyphicon-print"></span> Print
                        </a>
                    </small>
                </h2>
                <hr>
                <h3 class="text-center">{{ config('app.name') }}</h3>
                @if($user->address)
                    <p>{{$user->address->address}}</p>
                @endif
                <hr>
                <h3>{{$offer->title}}</h3>
                <h4>{{$offer->email}}</h4>
                <h4>{{$offer->phone}}</h4>
                <p>{!! nl2br($offer->description) !!}</p>
                <hr>
                <h3 class="text-center">PRODUCT DETAILS</h3>
                <table class="table">
                    <tr>
                        <td><a href="/show/product/{{$offer->slug}}">Open</a> - {{$product->title}}</td>
                        <td><img src="/products/thumb/{{$product->pictures[0]->img}}" width="150"></td>
                    </tr>
                    <tr>
                        <td>Price</td>
                        <td>Rp {{number_format($product->price)}}</td>
                    </tr>
                    <tr>
                        <td>Discount</td>
                        <td>Rp {{number_format($product->discount)}}</td>
                    </tr>
                    <tr>
                        <td>Discription</td>
                        <td>{!! nl2br(strip_tags($product->description)) !!}</td>
                    </tr>
                </table>
            </div>

    </div>
</div>
@endsection
