@if(Auth::check())
    @if(Auth::user())
        <h4><a class="btn btn-primary btn-sm" href="/thread/create">TULIS THREAD</a></h4>
    @endif
@endif
@if(Auth::guest())
    <hr>
@endif
<div class="thumbnail">
    <ul class="list">
        <li class="li-role">
            <a data-toggle="collapse" href="#tagList" role="button" aria-expanded="false" aria-controls="tagList">
                <p class="p-category">CATEGORY </p>
                <p class="caret-category"><span class="caret"></span></p>
            </a>
        </li>
        <div class="collapse" id="tagList">
            <div class="card card-body">
                @foreach($tags->where('parent_id',0)->where('status',1) as $tag)
                    <li><a class="a-list" href="/threads/{{$tag->slug}}">{{$tag->name}}</a></li>
                    @foreach($tag->parent->where('status',1) as $child)
                        <li><a class="a-sub-list" href="/threads/{{$child->slug}}">{{$child->name}}</a></li>
                    @endforeach
                @endforeach
            </div>
        </div>
    </ul>
</div>