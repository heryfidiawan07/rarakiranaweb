@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10">

            <h4 class="text-center"><b>TULIS POST</b></h4>
            <form method="POST" action="/post/store" enctype="multipart/form-data">
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
                <div class="form-group{{ $errors->has('menu_id') ? ' has-error' : '' }}">
                    <label for="menu_id" class="control-label">Menu</label>
                    <select name="menu_id" class="form-control" required autofocus>
                        @foreach($menus as $menu)
                            <option value="{{$menu->id}}">{{$menu->name}}</option>
                        @endforeach
                    </select>
                    @if ($errors->has('menu_id'))
                        <span class="help-block">
                            <strong>{{ $errors->first('menu_id') }}</strong>
                        </span>
                    @endif
                </div>
                <div class="form-group{{ $errors->has('img') ? ' has-error' : '' }}">
                    <label for="img" class="control-label">Gambar</label>
                    <input type="file" name="img" class="form-control" required autofocus>
                    @if ($errors->has('img'))
                        <span class="help-block">
                            <strong>{{ $errors->first('img') }}</strong>
                        </span>
                    @endif
                </div>
                <div class="form-group{{ $errors->has('description') ? ' has-error' : '' }}">
                    <label for="description" class="control-label">Deskripsi</label>
                    <textarea name="description" class="form-control" rows="20">{{ old('description') }}</textarea>
                    @if ($errors->has('description'))
                        <span class="help-block">
                            <strong>{{ $errors->first('description') }}</strong>
                        </span>
                    @endif
                </div>
                <div class="form-group">
                    <label for="status" class="control-label">Status</label>
                    <select name="status" class="form-control">
                        <option value="1">Aktif</option>
                        <option value="0">Tidak Aktif</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="acomment" class="control-label">Izinkan komentar</label>
                    <select name="acomment" class="form-control">
                        <option value="1">Ya</option>
                        <option value="0">Tidak</option>
                    </select>
                </div>
                <div class="form-group">
                    <button class="btn btn-primary btn-sm"><span class="glyphicon glyphicon-send" aria-hidden="true"></span></button>
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