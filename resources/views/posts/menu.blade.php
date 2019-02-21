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
                @if($fmenu->parent()->count() == 0)
                    | <a href="/{{$fmenu->slug}}">{{$fmenu->name}}</a>
                @else
                    @foreach($menus->where('status',1) as $sub)
                        | <a href="/{{$sub->slug}}">{{$sub->name}}</a>
                    @endforeach
                @endif
            </h4>
            <hr>
            @foreach($posts->where('status',1)->where('menu.status',1) as $post)
                @include('posts.content-index')
            @endforeach

            <div class="text-center">
                <ul class="pagination pagination-sm">{{$posts->links()}}</ul>
            </div>

            @if($fmenu->setting ==5)
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
