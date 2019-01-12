<div class="table-responsive">
    <table class="table table-hover">
        <th class="warning">CATEGORY</th>
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