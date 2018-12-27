@extends('layouts.app')

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
        </div>
        <div class="col-md-4">
            <h5 class="text-center"><b>KOMENTAR BARU</b></h5><hr>
        </div>
    </div>
</div>
@endsection
