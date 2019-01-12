@extends('layouts.app')

@section('url') {{Request::url()}} @endsection
@if($logo)
    @section('image') http://rarakirana.com/logo/img/{{$logo->img}} @endsection
    @section('title') {{$logo->title}} @endsection
    @section('description') {{$logo->description}} @endsection
@endif

@section('content')

@if($newposts->count())
    <div class="container">
        <div class="row">
            <div class="col-md-7">
                @if($promo)
                    @include('promo.index')
                    <hr>
                @endif
                <h4><b>News</b></h4><hr>
                @foreach($newposts->where('menu.status',1) as $post)
                    @include('posts.content-index')
                @endforeach
            </div>
            <div class="col-md-5">
                @if($postrecents)
                    <h5 class="text-center"><b>KOMENTAR BARU</b></h5><hr>
                    @foreach($postrecents as $post)
                        @include('posts.recent-comment')
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
                    @include('threads.content-index')
                @endforeach
            </div>
            <div class="col-md-5">
                @if($threadrecents->count())
                    <h5 class="text-center"><b>KOMENTAR BARU</b></h5><hr>
                    @foreach($threadrecents as $thread)
                        @include('threads.recent-comment')
                    @endforeach
                @endif
            </div>
        </div>
    </div>
@endif

@endsection
