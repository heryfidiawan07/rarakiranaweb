<div class="posts">
    <div class="col-md-4">
        <a href="/read/post/{{$post->slug}}">
            <div class="frame-new-posts">
                <span class="frame-new-posts-helper"></span>
                <img src="/posts/thumb/{{$post->img}}" class="posts-thumb">
            </div>
        </a>
    </div>
    <div class="col-md-8">
        <h4 class="@if($post->sticky == 1) sticky @else posts-title @endif">
            <a href="/read/post/{{$post->slug}}">{{$post->title}}</a>
        </h4>
        <p class="posts-author">
            by <a href="/user/{{$post->user->slug}}">{{$post->user->name}}</a>
            - <a href="/{{$post->menu->slug}}" class="btn btn-default btn-xs">
                <span class="glyphicon glyphicon-tag" aria-hidden="true"></span>
                {{$post->menu->name}}
            </a>
            - <small><i>{{ date('d F, Y', strtotime($post->created_at))}}</i></small>
            , <span class="glyphicon glyphicon-comment" aria-hidden="true"></span><i> {{$post->comments->count()}}</i>
        </p>
    </div>
</div>