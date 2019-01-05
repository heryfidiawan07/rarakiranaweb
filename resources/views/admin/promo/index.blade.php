@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">

        <div class="col-md-3">
            @include('admin.dashboard-menu')
            <h4 class="text-center">ADD PROMO</h4><hr>
            <form class="form-horizontal" role="form" method="POST" action="/promo/store" enctype="multipart/form-data">
                {{ csrf_field() }}

                
                <label for="img" class="control-label">Image</label>
                <input id="img" type="file" class="form-control" name="img[]" value="{{ old('img') }}" multiple="multiple" required autofocus>

                @if ($errors->has('img'))
                    <span class="help-block">
                        <strong>{{ $errors->first('img') }}</strong>
                    </span>
                @endif
                
                <label for="setting" class="control-label">Setting</label>
                <select name="setting" class="form-control" required autofocus>
                    <option value="1">Home/Main</option>
                    <option value="2">Produk Promo</option>
                    <option value="3">Forum Promo</option>
                    <option value="4">Artikel Promo</option>
                </select>

                @if ($errors->has('setting'))
                    <span class="help-block">
                        <strong>{{ $errors->first('setting') }}</strong>
                    </span>
                @endif
                @if(session('warning'))
                    <div class="alert alert-warning">
                        {{session('warning')}}
                    </div>
                @endif
                <br>
                <button type="submit" class="btn btn-primary">Save</button>
            </form>
        </div>
        <div class="col-md-9">
            @foreach($promos as $promo)
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
                <br>
                <div class="text-center">
                    @foreach($promo->pictures as $pict)
                        <div style="display: inline-block;">
                            <img src="/promo/{{$pict->img}}" width="100">
                            <p><a href="/promo/picture/delete/{{$pict->id}}"><span class="glyphicon glyphicon-trash"></span></a></p>
                        </div>
                    @endforeach
                    <form class="form-inline" method="POST" action="/promo/update/{{$promo->id}}" enctype="multipart/form-data">
                        {{csrf_field()}}
                        <label>+ Image</label>
                        <input type="file" name="imgmore[]" class="form-control input-sm" multiple="multiple" required>
                        <input type="submit" class="btn btn-success btn-sm">
                    </form>
                </div>
                <div class="text-center">
                    @if($promo->setting == 1)
                        <h5 class="thumbnail">Home/Main</h5>
                    @elseif($promo->setting == 2)
                        <h5 class="thumbnail">Product</h5>
                    @elseif($promo->setting == 3)
                        <h5 class="thumbnail">Forum</h5>
                    @elseif($promo->setting == 4)
                        <h5 class="thumbnail">Article</h5>
                    @endif
                </div>
            @endforeach
        </div>
        
    </div>
</div>
@endsection