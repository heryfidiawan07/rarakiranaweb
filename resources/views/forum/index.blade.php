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
            @if($promo)
                @include('promo.index')
            @endif
            @foreach($newthreads->where('menu.status',1) as $thread)
                @include('forum.content-index')
            @endforeach

            <div class="text-center">
                <ul class="pagination pagination-sm">{{$newthreads->links()}}</ul>
            </div>

        </div>
    </div>
</div>
@endsection
