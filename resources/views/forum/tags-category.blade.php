<div class="table-responsive">
    <h4><a class="btn btn-primary btn-sm" href="/thread/create">TULIS THREAD</a></h4>
    <table class="table table-hover">
        <th class="success">THREADS CATEGORY</th>
        @foreach($categories->where('status',1) as $tag)
            <tr><td><a class="thread-tags" href="/threads/tag/{{$tag->slug}}">{{$tag->menu}}</a></td><tr>
            <tr>
            @foreach($tag->parent->where('status',1) as $child)
            <tr>
                <td><a class="thread-sub-tags" href="/threads/tag/{{$child->slug}}">{{$child->menu}}</a></td>
            @endforeach
        @endforeach
    </table>
</div>