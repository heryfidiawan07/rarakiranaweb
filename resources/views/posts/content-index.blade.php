<div class="posts media">
    <div class="col-md-4">
        <a href="/read/post/{{$post->slug}}">
            <div class="frame-new-posts">
                <span class="frame-new-posts-helper"></span>
                <img src="/posts/thumb/{{$post->img}}" alt="{{$post->slug}}" class="posts-thumb-img">
            </div>
        </a>
    </div>
    <div class="col-md-8">
        <div class="frame-new-posts-content">
            <div class="@if($post->sticky == 1) sticky @else posts-title @endif">
                <h4><a href="/read/post/{{$post->slug}}">{{$post->title}}</a></h4>
            </div>
            <div class="posts-author">
                <a href="/user/{{$post->user->slug}}">
                    <img src="<?php if ($post->user->img != null){ echo "/users/".$post->user->img;}else if($post->user->graph != null){echo $post->user->graph;}else{echo $post->user->avatar();} ?>" class="img-circle" width="30">
                    {{$post->user->name}}
                </a>
                - <a href="/{{$post->menu->slug}}" class="btn btn-default btn-xs">
                    <span class="glyphicon glyphicon-tag" aria-hidden="true"></span>
                    {{$post->menu->name}}
                </a>
                - <small><i>{{ date('d F, Y', strtotime($post->created_at))}}</i></small>
                , <span class="glyphicon glyphicon-comment" aria-hidden="true"></span><i> {{$post->comments->count()}}</i>
            </div>
        </div>
    </div>
</div>