@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-3">@include('forum.tags-category')</div>
        <div class="col-md-9">
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
