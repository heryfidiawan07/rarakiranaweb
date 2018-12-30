@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">

            <h4 class="text-center"><b>EDIT PRODUK</b></h4>
            <form method="POST" action="/product/{{$product->id}}/update" enctype="multipart/form-data">
                {{csrf_field()}}
                <div class="form-group{{ $errors->has('title') ? ' has-error' : '' }}">
                    <label for="title" class="control-label">Judul</label>
                    <input type="text" name="title" class="form-control" value="{{$product->title}}" required>
                    @if ($errors->has('title'))
                        <span class="help-block">
                            <strong>{{ $errors->first('title') }}</strong>
                        </span>
                    @endif
                </div>
                <div class="form-group{{ $errors->has('menu_id') ? ' has-error' : '' }}">
                    <label for="menu_id" class="control-label">Menu</label>
                    <select name="menu_id" class="form-control" required>
                        @foreach($categories as $category)
                            @if($category->setting == 33)
                                @continue
                            @elseif($category->parent()->count())
                                @continue
                            @endif
                            <option value="{{$category->id}}">{{$category->menu}}</option>
                        @endforeach
                    </select>
                    @if ($errors->has('menu_id'))
                        <span class="help-block">
                            <strong>{{ $errors->first('menu_id') }}</strong>
                        </span>
                    @endif
                </div>
                <div class="form-group{{ $errors->has('price') ? ' has-error' : '' }}">
                    <label for="price" class="control-label">Harga</label>
                    <input type="text" name="price" class="form-control" value="{{$product->price}}" required autofocus>
                    @if ($errors->has('price'))
                        <span class="help-block">
                            <strong>{{ $errors->first('price') }}</strong>
                        </span>
                    @endif
                </div>
                <div class="form-group{{ $errors->has('discount') ? ' has-error' : '' }}">
                    <label for="discount" class="control-label">Diskon</label>
                    <input type="text" name="discount" class="form-control" value="{{$product->discount}}" autofocus>
                    @if ($errors->has('discount'))
                        <span class="help-block">
                            <strong>{{ $errors->first('discount') }}</strong>
                        </span>
                    @endif
                </div>
                <div class="form-group{{ $errors->has('img') ? ' has-error' : '' }}">
                    <label for="img" class="control-label">Gambar</label><br>
                    @foreach($product->galleries as $gallery)
                    <div class="pull-left">
                        <img src="/products/thumb/{{$gallery->img}}" width="100">
                        <br>
                        <a href="/product/gallery/{{$gallery->id}}/destroy" class="text-center"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span></a>
                    </div>
                    @endforeach
                    <br>
                    <hr>
                    <a data-toggle="collapse" href="#changeArtImg" role="button" aria-expanded="false" aria-controls="changeArtImg">Ganti</a>
                    <div class="collapse" id="changeArtImg">
                      <div class="card card-body">
                        <input type="file" name="img" class="form-control">
                      </div>
                    </div>
                    @if ($errors->has('img'))
                        <span class="help-block">
                            <strong>{{ $errors->first('img') }}</strong>
                        </span>
                    @endif
                </div>
                <div class="form-group{{ $errors->has('description') ? ' has-error' : '' }}">
                    <label for="description" class="control-label">Deskripsi</label>
                    <textarea name="description" class="form-control" rows="20">{{$product->description}}</textarea>
                    @if ($errors->has('description'))
                        <span class="help-block">
                            <strong>{{ $errors->first('description') }}</strong>
                        </span>
                    @endif
                </div>
                <div class="form-group{{ $errors->has('status') ? ' has-error' : '' }}">
                    <div class="col-md-6">
                        <label for="status" class="control-label">Status</label>
                        <select class="form-control" name="status">
                            <option value="1">Aktif</option>
                            <option value="0">Tidak Aktif</option>
                        </select>
                        @if ($errors->has('status'))
                            <span class="help-block">
                                <strong>{{ $errors->first('status') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>
                <div class="form-group{{ $errors->has('acomment') ? ' has-error' : '' }}">
                    <div class="col-md-6">
                        <label for="acomment" class="control-label">Izinkan komentar</label>
                        <select class="form-control" name="acomment">
                            <option value="1">di Izinkan</option>
                            <option value="0">Tidak di Izinkan</option>
                        </select>
                        @if ($errors->has('acomment'))
                            <span class="help-block">
                                <strong>{{ $errors->first('acomment') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-md-12">
                        <hr>
                        <input type="submit" class="btn btn-primary" value="Update">
                    </div>
                </div>
            </form>
                
        </div>
    </div>
</div>
@endsection
@section('js')
  <script src="//cdn.tinymce.com/4/tinymce.min.js"></script>
  <script src="/js/litle-mce.js"></script>
@endsection