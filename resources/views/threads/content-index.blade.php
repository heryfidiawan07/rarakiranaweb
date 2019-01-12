<div class="threads">
    <h4 class="threads-title @if($thread->sticky == 1) sticky @endif">
        <a href="/thread/{{$thread->slug}}">{{$thread->title}}</a>
    </h4>
    <p class="threads-author">
        by <a href="/user/{{$thread->user->slug}}" class="author">{{$thread->user->name}}</a>
        - <a href="/threads/{{$thread->tag->slug}}" class="btn btn-default btn-xs">
            <span class="glyphicon glyphicon-tag" aria-hidden="true"></span>
            {{$thread->tag->name}}
        </a>
        - <small><i>{{ date('d F, Y', strtotime($thread->created_at))}}</i></small>
        , <span class="glyphicon glyphicon-comment" aria-hidden="true"></span>
        <i> {{$thread->comments->count()}}</i>
    </p>
</div>
<hr>