@extends('layouts.app')

@section('url') {{Request::url()}} @endsection
@if($logo)
    @section('image') http://rarakirana.com/logo/img/{{$logo->img}} @endsection
    @section('title') {{$logo->title}} @endsection
    @section('description') {{$logo->description}} @endsection
@endif

@section('content')
<div class="container">
    <div class="row">
        
        <div class="col-md-9">
            @if($promo)
                @include('promo.index')
            @endif
            <h4 class="product-tag-childs">
                @if($subs->parent->count())
                    @foreach($subs->parent->where('status',1) as $sub)
                        | <a href="/products/{{$sub->slug}}">{{$sub->name}}</a>
                    @endforeach
                @else
                    | <a href="/products/{{$subs->slug}}">{{$subs->name}}</a><br>
                @endif
            </h4><hr>
            @foreach($products->where('status',1)->where('storefront.status',1) as $product)
                @include('products.content-index')
            @endforeach
            
            <div class="text-center">
                <ul class="pagination pagination-sm">{{$products->links()}}</ul>
            </div>

        </div>
        <div class="col-md-3">@include('products.tags-category')</div>

    </div>
</div>
@endsection
