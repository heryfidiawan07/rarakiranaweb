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
        <div class="col-md-8">
            @if($promo)
                @include('promo.index')
            @endif
            <h4 class="post-tags">
                @if($menu->parent->count())
                    @foreach($menu->parent->where('status',1) as $sub)
                        | <a href="/{{$sub->slug}}">{{$sub->name}}</a>
                    @endforeach
                @else
                    | <a href="/{{$menu->slug}}">{{$menu->name}}</a>
                @endif
            </h4>
            <hr>
            @foreach($posts->where('status',1)->where('menu.status',1) as $post)
                @include('posts.content-index')
            @endforeach

            <div class="text-center">
                <ul class="pagination pagination-sm">{{$posts->links()}}</ul>
            </div>

            @if($menu->setting ==5)
                @include('layouts.contact-form')
            @endif

        </div>
        <div class="col-md-4">
            @if($postrecents->count())
                <h5 class="text-center"><b>KOMENTAR BARU</b></h5><hr>
                @foreach($postrecents as $post)
                    @include('posts.recent-comment')
                @endforeach
            @endif
        </div>
    </div>
</div>
@endsection