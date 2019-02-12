@extends('layouts.app')
@section('css')
    <link rel="stylesheet" type="text/css" href="/css/dashboard.css">
@endsection
@section('content')
<div class="container">
    <div class="row">
        
        @include('admin.dashboard-menu')
        <div class="col-md-3">
            <h4 class="text-center">ADD PROMO</h4><hr>
            <form class="form-horizontal" role="form" method="POST" action="/promo/store" enctype="multipart/form-data">
                {{ csrf_field() }}
                <label for="img" class="control-label">Image</label>
                <p><i>Gambar akan di resize dengan ukuran PxL (900x300)</i></p>
                <input id="img" type="file" class="form-control" name="img[]" value="{{ old('img') }}" multiple="multiple" required autofocus>

                @if ($errors->has('img'))
                    <span class="help-block">
                        <strong>{{ $errors->first('img') }}</strong>
                    </span>
                @endif
                
                <label for="setting" class="control-label">Setting</label>
                <select name="setting" class="form-control" required autofocus>
                    <option value="main">Home/Main Title & Logo</option>
                    <option value="post">Post Title & Logo</option>
                    <option value="thread">Forum Title & Logo</option>
                    <option value="product">Produk Title & Logo</option>
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
                <button type="submit" class="btn btn-primary btn-sm">
                    <span class="glyphicon glyphicon-send" aria-hidden="true"></span>
                </button>
            </form>
        </div>
        <div class="col-md-9">
            @foreach($promos as $promo)
            <div id="carousel-promo-generic" class="carousel slide" data-ride="carousel">
                <!-- Wrapper for slides -->
                <div class="carousel-inner carousel-promo-inner" role="listbox">
                    @foreach($promo->galleries as $pict)
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
                    @foreach($promo->galleries as $pict)
                        <li data-target="#carousel-promo-generic" data-slide-to="{{ $loop->index }}" class="{{ $loop->first ? 'active' : '' }}">
                        </li>
                    @endforeach
                </ol>

                @if($promo->galleries->count() > 1)
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
                    @foreach($promo->galleries as $pict)
                        <div style="display: inline-block;">
                            <img src="/promo/{{$pict->img}}" width="100">
                            <p><a href="/promo/picture/delete/{{$pict->id}}" class="danger"><span class="glyphicon glyphicon-trash"></span></a></p>
                        </div>
                    @endforeach
                    <form class="form-inline" method="POST" action="/promo/update/{{$promo->id}}" enctype="multipart/form-data">
                        {{csrf_field()}}
                        <label>+ Image</label>
                        <input type="file" name="imgmore[]" class="form-control input-sm" multiple="multiple" required>
                        <button class="btn btn-success btn-sm">
                            <span class="glyphicon glyphicon-send"></span>
                        </button>
                    </form>
                </div>
                <div class="text-center">
                    @if($promo->setting == 'main')
                        <h5 class="thumbnail">Home/Main</h5>
                    @elseif($promo->setting == 'post')
                        <h5 class="thumbnail">Post</h5>
                    @elseif($promo->setting == 'thread')
                        <h5 class="thumbnail">Forum</h5>
                    @elseif($promo->setting == 'product')
                        <h5 class="thumbnail">Product</h5>
                    @endif
                </div>
            @endforeach
        </div>
        
    </div>
</div>
@endsection