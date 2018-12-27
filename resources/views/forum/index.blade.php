@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-3">@include('forum.tags-category')</div>
        <div class="col-md-9">
        		<h4>
        			<a class="btn btn-primary btn-sm" href="/thread/create">TULIS THREAD</a>
        		</h4><hr>
            @foreach($newthreads->where('menu.status',1) as $thread)
                @include('forum.content-index')
            @endforeach
        </div>
    </div>
</div>
@endsection
