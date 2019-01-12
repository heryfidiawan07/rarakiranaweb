@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">

            <h4 class="text-center"><b>TULIS PRODUK</b></h4>
            <form method="POST" action="/product/store" enctype="multipart/form-data">
                {{csrf_field()}}
                <div class="form-group{{ $errors->has('title') ? ' has-error' : '' }}">
                    <label for="title" class="control-label">Judul</label>
                    <input type="text" name="title" class="form-control" value="{{ old('title') }}" required autofocus>
                    @if ($errors->has('title'))
                        <span class="help-block">
                            <strong>{{ $errors->first('title') }}</strong>
                        </span>
                    @endif
                </div>
                
                <table><tr><td>
                    <div class="form-group{{ $errors->has('storefront_id') ? ' has-error' : '' }}">
                        <label for="storefront_id" class="control-label">Etalase</label>
                        <select name="storefront_id" class="form-control" required autofocus>
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
                </td><td>
                    <div class="form-group{{ $errors->has('img') ? ' has-error' : '' }}">
                        <label for="img" class="control-label">Gambar</label>
                        <input type="file" name="img[]" class="form-control" multiple="multiple" required autofocus>
                        @if ($errors->has('img'))
                            <span class="help-block">
                                <strong>{{ $errors->first('img') }}</strong>
                            </span>
                        @endif
                    </div>
                </td></tr>
                <tr><td>
                    <div class="form-group{{ $errors->has('price') ? ' has-error' : '' }}">
                        <label for="price" class="control-label">Harga</label>
                        <div class="input-group">
                            <div class="input-group-addon">Rp</div>
                            <input type="integer" name="price" class="form-control" value="{{ old('price') }}" required autofocus>
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
                            <input type="integer" name="discount" class="form-control" value="0" autofocus>
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
                            <input type="integer" name="weight" class="form-control" value="1" required autofocus>
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
                            <input type="integer" name="dimensi" class="form-control" value="0" required autofocus>
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
                    <textarea name="description" class="form-control" rows="20">{{ old('description') }}</textarea>
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
                        <label for="acomment" class="control-label">Izinkan Komentar</label>
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
                        <input type="submit" class="btn btn-primary" value="Save">
                    </div>
                </div>
            </form>
                
        </div>
    </div>
</div>
@endsection
@section('js')
  <script src="//cdn.tinymce.com/4/tinymce.min.js"></script>
  <script src="/js/mce-post.js"></script>
@endsection