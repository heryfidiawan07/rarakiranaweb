@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8">
        @if($posts->count())
            <h4><b>News</b></h4><hr>
            @foreach($posts as $post)
                @include('posts.content-index')
            @endforeach
        @endif
        @if(!empty($kosong))
            <div class="alert alert-info"> {{ $kosong }}</div>
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
                @include('threads.content-index')
            @endforeach
        @endif
        </div>
        <div class="col-md-4"></div>
    </div>
</div>

@endsection
