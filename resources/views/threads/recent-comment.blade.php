<div class="recent-threads">
    <a href="/thread/{{$thread->slug}}" class="recent-threads-link">
        <h4 class="recent-threads-title">{{$thread->title}}</h4>
        <div class="recent-threads-author">
            <p>
                <img src="<?php if ($thread->user->img != null){ echo "/users/".$thread->user->img;}else if($thread->user->graph != null){echo $thread->user->graph;}else{echo $thread->user->avatar();} ?>" class="img-circle" width="30">
                {{$thread->user->name}} - <small><i>{{ date('d F, Y', strtotime($thread->created_at))}}</i>,
                <span class="glyphicon glyphicon-comment"></span> {{$thread->comments->count()}}</small>
            </p>
        </div>
    </a>
</div>
<hr>