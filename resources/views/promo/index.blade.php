
<div id="carousel-promo-generic" class="carousel slide" data-ride="carousel">
    <!-- Wrapper for slides -->
    <div class="carousel-inner carousel-promo-inner" role="listbox">
        @foreach($promo->pictures as $pict)
            <div class="item {{ $loop->first ? ' active' : '' }}" >
                <div class="frame-promo-img">
                    <span class="frame-promo-img-helper"></span>
                    <img src="/promo/{{ $pict->img }}" alt="" class="promo-img">
                </div>
            </div>
        @endforeach
    </div>
    <!-- Indicators -->
    <ol class="carousel-indicators carousel-promo-indicators">
        @foreach($promo->pictures as $pict)
            <li data-target="#carousel-promo-generic" data-slide-to="{{ $loop->index }}" class="{{ $loop->first ? 'active' : '' }}">
            </li>
        @endforeach
    </ol>

    @if($promo->pictures->count() > 1)
        <a class="left carousel-control carousel-promo-control" href="#carousel-promo-generic" role="button" data-slide="prev">
          <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
          <span class="sr-only">Previous</span>
        </a>
        <a class="right carousel-control carousel-promo-control" href="#carousel-promo-generic" role="button" data-slide="next">
          <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
          <span class="sr-only">Next</span>
        </a>
    @endif
</div>
