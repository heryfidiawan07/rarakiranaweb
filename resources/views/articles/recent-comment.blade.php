<div class="recent-articles">
    <div class="col-xs-4">
        <a href="/read/article/{{$article->slug}}">
            <div class="frame-recent-articles">
                <span class="frame-recent-articles-helper"></span>
                <img src="/articles/thumb/{{$article->img}}" class="recent-thumb">
            </div>
        </a>
    </div>
    <div class="col-xs-8">
        <p class="recent-articles-title">
            <a href="/read/article/{{$article->slug}}">
            	{!! str_limit($article->title, $limit = 100, $end = '...') !!}
            </a>
        </p>
        <p class="recent-articles-author">
	        	<a href="/{{$article->menu->slug}}">
	            <small>
	            		<span class="glyphicon glyphicon-tag" aria-hidden="true"></span>
	                {{$article->menu->menu}}
	            </small>
	          </a>
        </p>
    </div>
</div>
