<div class="recent-posts">
    <div class="col-xs-4">
        <a href="/read/post/{{$post->slug}}">
            <div class="frame-recent-posts">
                <span class="frame-recent-posts-helper"></span>
                <img src="/posts/thumb/{{$post->img}}" class="recent-thumb">
            </div>
        </a>
    </div>
    <div class="col-xs-8">
        <p class="recent-posts-title">
            <a href="/read/post/{{$post->slug}}">
            	{!! str_limit($post->title, $limit = 100, $end = '...') !!}
            </a>
        </p>
        <p class="recent-posts-author">
	        	<a href="/{{$post->menu->slug}}">
	            <small>
	            	<span class="glyphicon glyphicon-tag" aria-hidden="true"></span>
	                {{$post->menu->name}}
	            </small>
	          </a>
        </p>
    </div>
</div>
