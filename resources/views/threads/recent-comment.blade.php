<div class="recent-threads">
    <a href="/thread/{{$thread->slug}}" class="recent-threads-link">
        <h4 class="recent-threads-title">{{$thread->title}}</h4>
        <div class="recent-threads-author">
            <p>by {{$thread->name}}- <small><i>{{ date('d F, Y', strtotime($thread->created_at))}}</i></small></p>
        </div>
    </a>
</div>
<hr>