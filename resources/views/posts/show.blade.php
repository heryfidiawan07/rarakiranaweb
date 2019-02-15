@extends('layouts.app')

@section('url') {{Request::url()}} @endsection
@section('image') http://rarakirana.com/posts/img/{{$post->img}} @endsection
@section('title') {{$post->title}} @endsection
@section('description') 
    {{strip_tags(str_limit($post->description, $limit = 145, $end = '...'))}} 
@endsection

@section('content')
<div class="container">
    <div class="row">

        <div class="col-md-7">
            
            <div class="post-show">
                <h3 class="title-art-show text-center">{{$post->title}}</h3><hr>
                <div class="text-center img-art-show">
                    <img src="/posts/img/{{$post->img}}">
                </div>
                <div class="desc-art-show">
                    {!! $post->description !!}
                </div>
                <hr>
                <div class="tag-art-show">
                    <a href="/user/{{$post->user->slug}}">
                        <img src="<?php if ($post->user->img != null){ echo "/users/".$post->user->img;}else if($post->user->graph != null){echo $post->user->graph;}else{echo $post->user->avatar();} ?>" class="img-circle" width="30">
                        {{$post->user->name}}
                    </a>
                    - <small><i>{{ date('d F, Y', strtotime($post->created_at))}}</i></small>
                    <a href="/{{$post->menu->slug}}" class="btn btn-default btn-sm">
                        <span class="glyphicon glyphicon-tag" aria-hidden="true"></span>
                        {{$post->menu->name}}
                    </a>
                </div>
                <hr>
                @if($post->menu->setting ==5)
                    @include('layouts.contact-form')
                    <hr>
                @endif
            </div>
            
            @include('posts.comment')

        </div>

        <div class="col-md-5">
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
@section('js')
    <script type="text/javascript" src="/js/helper.js"></script>
@endsection