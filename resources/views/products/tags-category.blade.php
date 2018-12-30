<div class="table-responsive">
    <table class="table table-hover">
        <th class="warning">CATEGORY</th>
        @foreach($categories->where('status',1) as $category)
            <tr>
                <td><a class="product-tags" href="/products/category/{{$category->slug}}">{{$category->menu}}</a></td>
                <tr>
            <tr>
            @foreach($category->parent->where('status',1) as $child)
            <tr>
                <td><a class="product-sub-tags" href="/products/category/{{$child->slug}}">{{$child->menu}}</a></td>
            @endforeach
        @endforeach
    </table>
</div>