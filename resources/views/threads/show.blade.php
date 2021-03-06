@extends('layouts.app')

@section('url') {{Request::url()}} @endsection
@if($logo)
    @section('image') http://rarakirana.com/logo/img/{{$logo->img}} @endsection
@endif
@section('title') {{$thread->title}} @endsection
@section('description') 
    {{str_limit(strip_tags($thread->description), $limit = 145, $end = '...')}} 
@endsection

@section('content')
<div class="container">
    <div class="row">
        
        <div class="col-md-7">
            
            <div class="thread-show">
                <h3 class="title-thread-show text-center">{{$thread->title}}</h3><hr>
                <div class="desc-thread-show">
                    {!! $thread->description !!}
                </div>
                <hr>
                <div class="tag-thread-show">
                    <a href="/user/{{$thread->user->slug}}">
                        <img src="<?php if ($thread->user->img != null){ echo "/users/".$thread->user->img;}else if($thread->user->graph != null){echo $thread->user->graph;}else{echo $thread->user->avatar();} ?>" class="img-circle" width="30">
                        {{$thread->user->name}}
                    </a>
                    - <small><i>{{ date('d F, Y', strtotime($thread->created_at))}}</i></small>,
                    <a href="/threads/{{$thread->tag->slug}}" class="btn btn-default btn-sm">
                        <span class="glyphicon glyphicon-tag" aria-hidden="true"></span>
                        {{$thread->tag->name}}
                    </a>
                    @if(Auth::check())
                        @if($thread->user->id == Auth::user()->id)
                            - <a href="/thread/edit/{{$thread->slug}}" class="btn btn-primary btn-sm">
                                Edit
                            </a>
                        @endif
                    @endif
                </div>
                <hr>
            </div>

            @include('threads.comment')

        </div>

        <div class="col-md-5">
            @include('threads.tags-category')
            @if($threadrecents->count())
                <hr>
                <h5 class="text-center"><b>KOMENTAR BARU</b></h5><hr>
                @foreach($threadrecents as $thread)
                    @include('threads.recent-comment')
                @endforeach
            @endif
        </div>
        
    </div>
</div>
@endsection
@section('js')
    <script type="text/javascript" src="/js/helper.js"></script>
@endsection