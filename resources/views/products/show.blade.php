@extends('layouts.app')

@section('url') {{Request::url()}} @endsection
@section('image') http://rarakirana.com/products/img/{{$product->galleries[0]->img}} @endsection
@section('title') {{$product->title}} @endsection
@section('description') 
    {{strip_tags(str_limit($product->description, $limit = 145, $end = '...'))}} 
@endsection

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="col-md-5">
                @include('products.img')
            </div>
            <div class="col-md-7">
                <h2><b>{{$product->title}}</b></h2>
                <h4 class="discount"><s>Rp {{number_format($product->price, 2)}}</s></h4>
                <h3 class="price">Rp {{number_format($product->price - $product->discount, 2)}}</h3>
            </div>
        </div>
        <div class="col-md-12">
            <div class="col-md-5 product-content-show">
                <ul class="nav nav-tabs" role="tablist">
                    <li role="presentation" class="active"><a href="#deskripsi" aria-controls="deskripsi" role="tab" data-toggle="tab">DESKRIPSI</a></li>
                    <li role="presentation">
                        <a href="#diskusi" aria-controls="diskusi" role="tab" data-toggle="tab">
                        {{$product->prodcomments->count()}} DISKUSI</a>
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
