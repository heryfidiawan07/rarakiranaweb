@extends('layouts.app')

@section('url') {{Request::url()}} @endsection
@if($forumLogo)
    @section('image') http://rarakirana.com/logo/img/{{$forumLogo->img}} @endsection
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
                    by <a href="/user/{{$thread->user->slug}}">{{$thread->user->name}}</a>
                    - <small><i>{{ date('d F, Y', strtotime($thread->created_at))}}</i></small>,
                    <a href="/threads/tag/{{$thread->menu->slug}}" class="btn btn-default btn-sm">
                        <span class="glyphicon glyphicon-tag" aria-hidden="true"></span>
                        {{$thread->menu->menu}}
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

            @include('forum.comment')

        </div>

        <div class="col-md-5">
            @include('forum.tags-category')
            @if($threadrecents->count())
                <hr>
                <h5 class="text-center"><b>KOMENTAR BARU</b></h5><hr>
                @foreach($threadrecents as $thread)
                    @include('forum.recent-comment')
                @endforeach
            @endif
        </div>
        
    </div>
</div>
@endsection
