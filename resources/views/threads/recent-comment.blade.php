<div class="recent-threads">
    <h5 class="recent-threads-title">
        <a href="/thread/{{$thread->slug}}">{{$thread->title}}</a>
    </h5>
    <p class="recent-threads-author">
        by <a href="{{$thread->user->slug}}" class="author">{{$thread->user->name}}</a>
        - <a href="/threads/{{$thread->tag->slug}}" class="btn btn-default btn-xs">
            <span class="glyphicon glyphicon-tag" aria-hidden="true"></span>
            {{$thread->tag->name}}
        </a>
        - <small><i>{{ date('d F, Y', strtotime($thread->created_at))}}</i></small>
    </p>
</div>
<hr>