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
        <div class="col-md-3">@include('threads.tags-category')</div>
        <div class="col-md-9">
            @if($promo)
                @include('promo.index')
            @endif
        	<h4 class="thread-tag-childs">
		        @if($subs->parent->count())
                    @foreach($subs->parent->where('status',1) as $subtag)
                      | <a href="/threads/{{$subtag->slug}}">{{$subtag->name}}</a>
                    @endforeach
		        @else
                    | <a href="/threads/{{$subs->slug}}">{{$subs->name}}</a><br>
		        @endif
          	</h4><hr>	
            @foreach($threads->where('tag.status',1)->where('status',1) as $thread)
                @include('threads.content-index')
            @endforeach
            
            <div class="text-center">
                <ul class="pagination pagination-sm">{{$threads->links()}}</ul>
            </div>
            
        </div>
    </div>
</div>
@endsection
