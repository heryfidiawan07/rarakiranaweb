@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        
        <div class="col-md-3">@include('forum.tags-category')</div>
        <div class="col-md-9">
            <div class="thread-show">
                @if($thread)
                    <h3 class="title-thread-show text-center">{{$thread->title}}</h3><hr>
                    <div class="desc-thread-show">{{$thread->description}}</div>
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
                @endif
            </div>
        </div>
        
    </div>
</div>
@endsection
