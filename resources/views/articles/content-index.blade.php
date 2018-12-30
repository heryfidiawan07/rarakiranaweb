<div class="articles">
    <div class="col-md-4">
        <a href="/read/article/{{$article->slug}}">
            <div class="frame-new-articles">
                <span class="frame-new-articles-helper"></span>
                <img src="/articles/thumb/{{$article->img}}" class="articles-thumb">
            </div>
        </a>
    </div>
    <div class="col-md-8">
        <h4 class="articles-title">
            <a href="/read/article/{{$article->slug}}">{{$article->title}}</a>
        </h4>
        <p class="articles-author">
            by <a href="/user/{{$article->user->slug}}">{{$article->user->name}}</a>
            - <a href="/{{$article->menu->slug}}" class="btn btn-default btn-xs">
                <span class="glyphicon glyphicon-tag" aria-hidden="true"></span>
                {{$article->menu->menu}}
            </a>
            - <small><i>{{ date('d F, Y', strtotime($article->created_at))}}</i></small>
            , <span class="glyphicon glyphicon-comment" aria-hidden="true"></span><i> {{$article->artcomments->count()}}</i>
        </p>
    </div>
</div>