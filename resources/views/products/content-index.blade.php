<div class="col-sm-4">
    <div class="products">
        @include('products.thumb')
        <div class="text-center">
            <h5 class="product-title @if($product->sticky == 1) sticky @endif">
                <a href="/show/product/{{$product->slug}}">{{$product->title}}</a>
            </h5>
        </div>
        <div class="product-content">
            <a href="/products/{{$product->storefront->slug}}">
                <p class="text-center product-category">
                    <span class="glyphicon glyphicon-tag" aria-hidden="true"></span> {{$product->storefront->name}}
                </p>
            </a>
            
            <p class="discount">
                <s><small>Rp {{number_format($product->price + $product->discount,2)}}</small></s>
                @if($product->discount)
                    <img src="/parts/sale.jpg" width="50">
                @endif
                <span>
                    <small><i>{{number_format(($product->price + $product->discount) / $product->discount)}} %</i></small>
                </span>
            </p>
            <h4 class="price">Rp {{number_format($product->price, 2)}}</h4>
            <div class="text-center">
                <a href="/product/cart/{{$product->slug}}" class="btn btn-default btn-sm buy">
                    <span class="glyphicon glyphicon-shopping-cart" aria-hidden="true"></span> Beli
                </a>
                <a href="/add-to-cart/{{$product->slug}}" class="btn btn-success btn-sm">
                    <span class="glyphicon glyphicon-shopping-cart" aria-hidden="true"></span> Add to Cart
                </a>
            </div>
        </div>
    </div>
</div>