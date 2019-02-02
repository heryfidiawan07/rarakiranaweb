<div class="table-responsive">
    @if(Auth::check())
        @if(Auth::user())
            <h4><a class="btn btn-primary btn-sm" href="/thread/create">TULIS THREAD</a></h4>
        @endif
    @endif
    <a data-toggle="collapse" href="#tagList" role="button" aria-expanded="false" aria-controls="tagList" class="thumbnail thumb-caret">
        THREADS TAGS <span class="caret"></span>
    </a>
    <div class="collapse" id="tagList">
        <div class="card card-body">
            <table class="table table-hover">
                @foreach($tags->where('parent_id',0)->where('status',1) as $tag)
                    <tr><td><a class="thread-tags" href="/threads/{{$tag->slug}}">{{$tag->name}}</a></td><tr>
                    <tr>
                    @foreach($tag->parent->where('status',1) as $child)
                    <tr>
                        <td><a class="thread-sub-tags" href="/threads/{{$child->slug}}">{{$child->name}}</a></td>
                    @endforeach
                @endforeach
            </table>
        </div>
    </div>
</div>