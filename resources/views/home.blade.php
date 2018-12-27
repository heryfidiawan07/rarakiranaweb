@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8">
            <h4><b>News</b></h4><hr>
            @foreach($newarticles as $article)
                @include('articles.content-index')
            @endforeach
        </div>
        <div class="col-md-4">
            <h5 class="text-center"><b>KOMENTAR BARU</b></h5><hr>
        </div>
    </div>
</div>

<div class="products-scroll-frame">
    @foreach($newproducts as $product)
        @include('products.products-scroll')
    @endforeach
</div>

<div class="container">
    <div class="row">
        <div class="col-md-8">
            <h4><b>New Threads</b></h4><hr>
            @foreach($newthreads as $thread)
                @include('forum.content-index')
            @endforeach
        </div>
        <div class="col-md-4">
            <h5 class="text-center"><b>KOMENTAR BARU</b></h5><hr>
        </div>
    </div>
</div>
@endsection
