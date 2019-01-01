@extends('layouts.app')

@section('url') {{Request::url()}} @endsection
@if($articleLogo)
    @section('image') http://rarakirana.com/logo/img/{{$articleLogo->img}} @endsection
    @section('title') {{$articleLogo->title}} @endsection
    @section('description') {{$articleLogo->description}} @endsection
@endif

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8">
            <h4 class="article-tags">
                @if($menu->parent->count())
                    @foreach($menu->parent as $sub)
                        | <a href="/{{$sub->slug}}">{{$sub->menu}}</a>
                    @endforeach
                @else
                    | <a href="/{{$menu->slug}}">{{$menu->menu}}</a>
                @endif
            </h4>
            <hr>
            @foreach($articles as $article)
                @include('articles.content-index')
            @endforeach

            <div class="text-center">
                <ul class="pagination pagination-sm">{{$articles->links()}}</ul>
            </div>

        </div>
        <div class="col-md-4">
            @if($artrecents->count())
                <h5 class="text-center"><b>KOMENTAR BARU</b></h5><hr>
                @foreach($artrecents as $article)
                    @include('articles.recent-comment')
                @endforeach
            @endif
        </div>
    </div>
</div>
@endsection
