<div class="table-responsive">
    @if(Auth::check())
        @if(Auth::user())
            <h4><a class="btn btn-primary btn-sm" href="/thread/create">TULIS THREAD</a></h4>
        @endif
    @endif
    <table class="table table-hover">
        <th class="success">THREADS TAGS</th>
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