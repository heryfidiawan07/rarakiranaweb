<a data-toggle="collapse" href="#tagList" role="button" aria-expanded="false" aria-controls="tagList" class="thumbnail thumb-caret">
    CATEGORY <span class="caret"></span>
</a>
<div class="collapse" id="tagList">
    <div class="card card-body">
        <div class="table-responsive">
            <table class="table table-hover">
                @foreach($fronts->where('parent_id',0)->where('status',1) as $front)
                    <tr>
                        <td><a class="product-tags" href="/products/{{$front->slug}}">{{$front->name}}</a></td>
                        <tr>
                    <tr>
                    @foreach($front->parent->where('status',1) as $child)
                    <tr>
                        <td><a class="product-sub-tags" href="/products/{{$child->slug}}">{{$child->name}}</a></td>
                    @endforeach
                @endforeach
            </table>
        </div>
    </div>
</div>