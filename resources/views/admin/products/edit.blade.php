@extends('layouts.app')
@section('css')
    <link rel="stylesheet" type="text/css" href="/css/dashboard.css">
@endsection
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10">

            <h4 class="text-center"><b>EDIT PRODUK</b></h4>
            <form method="POST" action="/product/{{$product->id}}/update" enctype="multipart/form-data">
                {{csrf_field()}}
                <div class="form-group{{ $errors->has('title') ? ' has-error' : '' }}">
                    <label for="title" class="control-label">Judul</label>
                    <input type="text" name="title" id="product-title" class="form-control" value="{{$product->title}}" required>
                    @if ($errors->has('title'))
                        <span class="help-block">
                            <strong>{{ $errors->first('title') }}</strong>
                        </span>
                    @endif
                </div>
                <div class="form-group{{ $errors->has('storefront_id') ? ' has-error' : '' }}">
                    <label for="storefront_id" class="control-label">Etalase</label>
                    <select name="storefront_id" class="form-control" required>
                        <option value="{{$product->storefront->id}}">{{$product->storefront->name}}</option>
                        @foreach($fronts as $front)
                            <option value="{{$front->id}}">{{$front->name}}</option>
                        @endforeach
                    </select>
                    @if ($errors->has('storefront_id'))
                        <span class="help-block">
                            <strong>{{ $errors->first('storefront_id') }}</strong>
                        </span>
                    @endif
                </div>
                <div class="form-group">
                    <div id="frame-product-img-edit" data-count="{{$product->pictures->count()}}">
                        @foreach($product->pictures as $pict)
                            <div class="frame-product-img-in">
                                <img src="/products/thumb/{{$pict->img}}" height="100">
                                <figcaption class="text-center">
                                    <a href="/product/pictures/{{$pict->id}}/destroy" class="danger"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span></a>
                                </figcaption>
                            </div>
                        @endforeach
                    </div>
                    @if(session('warning'))
                        <div class="alert alert-warning">
                            {{session('warning')}}
                        </div>
                    @endif
                </div>
                <div class="form-group{{ $errors->has('img') ? ' has-error' : '' }}">
                    <label for="img" class="control-label">
                        Gambar <i><u>max 5 image</u></i>
                        <span id="imgEditValidate" class="danger"></span>
                    </label>
                    <input type="file" name="img[]" id="input-img-edit" class="form-control" multiple="multiple" <?php if($product->pictures->count() < 1 ) echo 'required'; ?> >
                    @if ($errors->has('img'))
                        <span class="help-block">
                            <strong>{{ $errors->first('img') }}</strong>
                        </span>
                    @endif
                </div>
                <table class="table"><tr><td>
                    <div class="form-group{{ $errors->has('price') ? ' has-error' : '' }}">
                        <label for="price" class="control-label">Harga</label>
                        <div class="input-group">
                            <div class="input-group-addon">Rp</div>
                            <input type="integer" name="price" class="form-control" value="{{$product->price + $product->discount}}" required autofocus>
                        </div>
                        @if ($errors->has('price'))
                            <span class="help-block">
                                <strong>{{ $errors->first('price') }}</strong>
                            </span>
                        @endif
                    </div>
                </td><td>
                    <div class="form-group{{ $errors->has('discount') ? ' has-error' : '' }}">
                        <label for="discount" class="control-label">Diskon</label>
                        <div class="input-group">
                            <div class="input-group-addon">Rp</div>
                            <input type="integer" name="discount" class="form-control" value="{{$product->discount}}" autofocus required>
                        </div>
                        @if ($errors->has('discount'))
                            <span class="help-block">
                                <strong>{{ $errors->first('discount') }}</strong>
                            </span>
                        @endif
                    </div>
                </td></tr>
                <tr><td>
                    <div class="form-group{{ $errors->has('weight') ? ' has-error' : '' }}">
                        <label for="weight" class="control-label">Berat</label>
                        <div class="input-group">
                            <input type="integer" name="weight" class="form-control" value="{{$product->weight}}" required autofocus>
                            <div class="input-group-addon">Kg</div>
                        </div>
                        @if ($errors->has('weight'))
                            <span class="help-block">
                                <strong>{{ $errors->first('weight') }}</strong>
                            </span>
                        @endif
                    </div>
                </td>
                <td>
                    <div class="form-group{{ $errors->has('dimensi') ? ' has-error' : '' }}">
                        <label for="dimensi" class="control-label">Dimensi</label>
                        <div class="input-group">
                            <input type="integer" name="dimensi" class="form-control" value="{{$product->dimensi}}" required autofocus>
                            <div class="input-group-addon">Meter</div>
                        </div>
                        @if ($errors->has('dimensi'))
                            <span class="help-block">
                                <strong>{{ $errors->first('dimensi') }}</strong>
                            </span>
                        @endif
                    </div>
                </td></tr></table>
                <div class="form-group{{ $errors->has('description') ? ' has-error' : '' }}">
                    <label for="description" class="control-label">Deskripsi</label>
                    <textarea name="description" class="form-control" rows="10">{{$product->description}}</textarea>
                    @if ($errors->has('description'))
                        <span class="help-block">
                            <strong>{{ $errors->first('description') }}</strong>
                        </span>
                    @endif
                </div>
                <div class="form-group">
                    <label for="status" class="control-label">Status</label>
                    <select class="form-control" name="status">
                        @if($product->status == 0)
                            <option value="0">Tidak Aktif</option>
                        @endif
                        <option value="1">Aktif</option>
                        <option value="0">Tidak Aktif</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="acomment" class="control-label">Izinkan komentar</label>
                    <select class="form-control" name="acomment">
                        @if($product->allowed_comment == 0)
                            <option value="0">Tidak</option>
                        @endif
                        <option value="1">Ya</option>
                        <option value="0">Tidak</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="setting" class="control-label">Produk Offline</label>
                    <select class="form-control" name="setting">
                        @if($product->setting == 1)
                            <option value="1">Ya</option>
                        @endif
                        <option value="0">Tidak</option>
                        <option value="1">Ya</option>
                    </select>
                </div>
                <div class="form-group">
                    <button id="create" class="btn btn-primary btn-sm">
                        <span class="glyphicon glyphicon-send" aria-hidden="true"></span>
                    </button>
                </div>
            </form>
                
        </div>
    </div>
</div>
@endsection
@section('js')
  <script src="//cdn.tinymce.com/4/tinymce.min.js"></script>
  <script src="/js/litle-mce.js"></script>
  <script src="/js/helper.js"></script>
@endsection