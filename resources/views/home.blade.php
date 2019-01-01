@extends('layouts.app')

@section('url') {{Request::url()}} @endsection
@if($homeLogo)
    @section('image') http://rarakirana.com/logo/img/{{$homeLogo->img}} @endsection
    @section('title') {{$homeLogo->title}} @endsection
    @section('description') {{$homeLogo->description}} @endsection
@endif

@section('content')

@if($newarticles->count())
    <div class="container">
        <div class="row">
            <div class="col-md-7">
                <h4><b>News</b></h4><hr>
                @foreach($newarticles as $article)
                    @include('articles.content-index')
                @endforeach
            </div>
            <div class="col-md-5">
                @if($artrecents->count())
                    <h5 class="text-center"><b>KOMENTAR BARU</b></h5><hr>
                    @foreach($artrecents as $article)
                        @include('articles.recent-comment')
                    @endforeach
                @endif
            </div>
        </div>
    </div>
@endif

@if($newproducts->count())
    <div class="products-scroll-frame">
        @foreach($newproducts as $product)
            @include('products.products-scroll')
        @endforeach
    </div>
@endif

@if($newthreads->count())
    <div class="container">
        <div class="row">
            <div class="col-md-7">
                <h4><b>New Threads</b></h4><hr>
                @foreach($newthreads as $thread)
                    @include('forum.content-index')
                @endforeach
            </div>
            <div class="col-md-5">
                @if($threadrecents->count())
                    <h5 class="text-center"><b>KOMENTAR BARU</b></h5><hr>
                    @foreach($threadrecents as $thread)
                        @include('forum.recent-comment')
                    @endforeach
                @endif
            </div>
        </div>
    </div>
@endif

@endsection
