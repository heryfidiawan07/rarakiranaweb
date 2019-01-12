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
                <hr>
            @endif
            @foreach($newproducts->where('storefront.status',1) as $product)
                @include('products.content-index')
            @endforeach
            <div class="col-md-12 text-center">
	            <ul class="pagination pagination-sm">{{$newproducts->links()}}</ul>
	        </div>
        </div>
        <div class="col-md-3">@include('products.tags-category')</div>

    </div>
</div>
@endsection
