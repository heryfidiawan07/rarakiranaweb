<ul class="list">
    <li class="li-role">
        <a data-toggle="collapse" href="#tagList" role="button" aria-expanded="false" aria-controls="tagList">
            <p class="p-category">CATEGORY </p>
            <p class="caret-category"><span class="caret"></span></p>
        </a>
    </li>
    <div class="collapse" id="tagList">
        <div class="card card-body">
            @foreach($fronts->where('parent_id',0)->where('status',1) as $front)
                <li><a class="a-list" href="/products/{{$front->slug}}">{{$front->name}}</a></li>
                @foreach($front->parent->where('status',1) as $child)
                    <li><a class="a-sub-list" href="/products/{{$child->slug}}">{{$child->name}}</a></li>
                @endforeach
            @endforeach
        </div>
    </div>
</ul>