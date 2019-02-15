<div class="recent-posts media">
    <div class="col-xs-4">
        <a href="/read/post/{{$post->slug}}">
            <div class="frame-recent-posts">
                <span class="frame-recent-posts-helper"></span>
                <img src="/posts/thumb/{{$post->img}}" class="recent-thumb-img">
            </div>
        </a>
    </div>
    <div class="col-xs-8">
        <div class="frame-recent-posts-content">
            <div class="recent-posts-title">
                <a href="/read/post/{{$post->slug}}">
                    {!! str_limit($post->title, $limit = 50, $end = '...') !!}
                    <small>, <span class="glyphicon glyphicon-comment"></span> {{$post->comments->count()}}</small>
                </a>
            </div>
        </div>
    </div>
</div>
