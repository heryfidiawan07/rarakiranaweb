<div class="col-sm-4">
    <div class="products">
        @include('products.thumb')
        <div class="text-center @if($product->sticky == 1) product-sticky @else product-title @endif">
            <h4>
                <a href="/show/product/{{$product->slug}}">{{$product->title}}</a>
            </h4>
        </div>
        <div class="product-content">
            <a href="/products/{{$product->storefront->slug}}">
                <p class="text-center product-category">
                    <span class="glyphicon glyphicon-tag" aria-hidden="true"></span> {{$product->storefront->name}}
                </p>
            </a>
            
            <p class="discount">
                @if($product->discount > 0)
                    <s><small>Rp {{number_format($product->price + $product->discount,2)}}</small></s>
                    <img src="/parts/sale.jpg" width="50">
                    <span>
                        <small><i>{{number_format(($product->price + $product->discount) / $product->discount)}} %</i></small>
                    </span>
                @endif
            </p>
            <h4 class="price">Rp {{number_format($product->price, 2)}}</h4>
            <div class="text-center">
                @if($product->setting == 0)
                    <a href="/product/cart/{{$product->slug}}" class="btn btn-default btn-sm buy">
                        <span class="glyphicon glyphicon-shopping-cart" aria-hidden="true"></span> Beli
                    </a>
                    <a href="/add-to-cart/{{$product->slug}}" class="btn btn-success btn-sm buy">
                        <span class="glyphicon glyphicon-shopping-cart" aria-hidden="true"></span> Add to Cart
                    </a>
                @elseif($product->setting == 1)
                    <a href="/show/product/{{$product->slug}}" class="btn btn-default btn-sm">
                        <span class="glyphicon glyphicon-envelope" aria-hidden="true"></span> Kirim Penawaran
                    </a>
                @endif
            </div>
        </div>
    </div>
</div>