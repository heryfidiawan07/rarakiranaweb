<div id="carousel-img-generic" class="carousel slide" data-ride="carousel">
    <!-- Wrapper for slides -->
    <div class="carousel-inner carousel-img-inner" role="listbox">
        @foreach($product->galleries as $pict)
            <div class="item {{ $loop->first ? ' active' : '' }}" >
                <div class="frame-product-img">
                    <span class="frame-product-img-helper"></span>
                    <img src="/products/img/{{ $pict->img }}" alt="{{ $product->menu->menu }}" class="product-img">
                </div>
            </div>
        @endforeach
    </div>

    <!-- Indicators -->
    <ol class="carousel-indicators carousel-img-indicators">
        @foreach($product->galleries as $pict)
            <li data-target="#carousel-img-generic" data-slide-to="{{ $loop->index }}" class="{{ $loop->first ? 'active' : '' }}">
              <img src="/products/thumb/{{$pict->img}}">
            </li>
        @endforeach
    </ol>
    
</div>