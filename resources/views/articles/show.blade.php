@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8">
            <div class="article-show">
                @if($article)
                    <h3 class="title-art-show text-center">{{$article->title}}</h3><hr>
                    <div class="text-center img-art-show">
                        <img src="/articles/img/{{$article->img}}">
                    </div>
                    <div class="desc-art-show">{{$article->description}}</div>
                    <hr>
                    <div class="tag-art-show">
                        <a href="/{{$article->menu->slug}}" class="btn btn-default btn-sm">
                            <span class="glyphicon glyphicon-tag" aria-hidden="true"></span>
                            {{$article->menu->menu}}
                        </a>
                        by <a href="/user/{{$article->user->slug}}"> {{$article->user->name}} </a>
                        - <small><i>{{ date('d F, Y', strtotime($article->created_at))}}</i></small>
                    </div>
                    <hr>
                @endif
            </div>
        </div>
        <div class="col-md-4">
            <h5 class="text-center"><b>KOMENTAR BARU</b></h5><hr>
        </div>
    </div>
</div>
@endsection
