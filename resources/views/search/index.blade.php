@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8">
        @if($articles->count())
            <h4><b>News</b></h4><hr>
            @foreach($articles as $article)
                @include('articles.content-index')
            @endforeach
        @endif
        </div>
        <div class="col-md-4"></div>
    </div>
</div>

@if($products->count())
    <div class="products-scroll-frame">
        @foreach($products as $product)
            @include('products.products-scroll')
        @endforeach
    </div>
@endif

<div class="container">
    <div class="row">
        <div class="col-md-8">
        @if($threads->count())
            <h4><b>Threads</b></h4><hr>
            @foreach($threads as $thread)
                @include('forum.content-index')
            @endforeach
        @endif
        </div>
        <div class="col-md-4"></div>
    </div>
</div>
@endsection
