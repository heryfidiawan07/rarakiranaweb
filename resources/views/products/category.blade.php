@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        
        <div class="col-md-3">@include('products.tags-category')</div>
        <div class="col-md-9">
            <h4 class="product-tag-childs">
                @if($category->parent->count())
                    @foreach($category->parent->where('status',1) as $subcategory)
                        | <a href="/products/category/{{$subcategory->slug}}">{{$subcategory->menu}}</a>
                    @endforeach
                @else
                    | <a href="/products/category/{{$category->slug}}">{{$category->menu}}</a><br>
                @endif
            </h4><hr>
            @foreach($tagproducts->where('status',1)->where('menu.status',1) as $product)
                @include('products.content-index')
            @endforeach
        </div>

    </div>
</div>
@endsection
