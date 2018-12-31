@extends('layouts.app')

@section('url') {{Request::url()}} @endsection
@if($forumLogo)
    @section('image') http://rarakirana.com/logo/img/{{$forumLogo->img}} @endsection
    @section('title') {{$forumLogo->title}} @endsection
    @section('description') {{$forumLogo->description}} @endsection
@endif

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-3">@include('forum.tags-category')</div>
        <div class="col-md-9">
        	<h4 class="thread-tag-childs">
		        @if($tags->parent->count())
                    @foreach($tags->parent->where('status',1) as $subtag)
                      | <a href="/threads/tag/{{$subtag->slug}}">{{$subtag->menu}}</a>
                    @endforeach
		        @else
                    | <a href="/threads/tag/{{$tags->slug}}">{{$tags->menu}}</a><br>
		        @endif
          	</h4><hr>	
            @foreach($tagthreads->where('menu.status',1)->where('status',1) as $thread)
                @include('forum.content-index')
            @endforeach
        </div>
    </div>
</div>
@endsection
