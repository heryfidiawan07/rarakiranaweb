<div id="carousel-{{$product->id}}-generic carousel-thumb-generic" class="carousel slide carousel-thumb-generic" data-ride="carousel">
  <!-- Wrapper for slides -->
  <div class="carousel-inner inner-thumb">
    @foreach($product->pictures as $pict)
      <div class="item {{ $loop->first ? ' active' : '' }}" >
        <a href="/show/product/{{$product->slug}}">
        	<div class="frame-product-thumb">
  	        <span class="frame-product-thumb-helper"></span>
  	        <img src="/products/thumb/{{$pict->img}}" alt="{{$pict->img}}" class="product-thumb">
          </div>
        </a>
      </div>
    @endforeach
  </div>
  
</div>