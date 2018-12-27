<div class="col-md-4">
    <div class="products">
        @include('products.thumb')
        <h5 class="product-title text-center">
            <a href="/show/product/{{$product->slug}}">{{$product->title}}</a>
        </h5>
        <div class="product-content">
            <p class="text-center">
                <a href="/products/category/{{$product->menu->slug}}">
                    <span class="glyphicon glyphicon-tag" aria-hidden="true"></span> {{$product->menu->menu}}
                </a>
            </p>
            <p class="discount"><s><small>Rp {{number_format($product->price,2)}}</small></s></p>
            <h4 class="price">Rp {{number_format($product->price - $product->discount, 2)}}</h4>
            <div class="text-center">
                <a href="/checkout/product/{{$product->slug}}" class="btn btn-default btn-sm buy">
                    <span class="glyphicon glyphicon-shopping-cart" aria-hidden="true"></span> Beli
                </a>
            </div>
        </div>
    </div>
</div>