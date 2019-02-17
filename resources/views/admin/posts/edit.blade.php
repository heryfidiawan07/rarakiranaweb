@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">

            <h4 class="text-center"><b>EDIT POST</b></h4>
            <form method="POST" action="/post/{{$post->id}}/update" enctype="multipart/form-data">
                {{csrf_field()}}
                <div class="form-group{{ $errors->has('title') ? ' has-error' : '' }}">
                    <label for="title" class="control-label">Judul</label>
                    <input type="text" name="title" class="form-control" value="{{$post->title}}" required>
                    @if ($errors->has('title'))
                        <span class="help-block">
                            <strong>{{ $errors->first('title') }}</strong>
                        </span>
                    @endif
                </div>
                <div class="form-group{{ $errors->has('menu_id') ? ' has-error' : '' }}">
                    <label for="menu_id" class="control-label">Menu</label>
                    <select name="menu_id" class="form-control" required>
                        <option value="{{$post->menu_id}}">{{$post->menu->name}}</option>
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
                    <label for="img" class="control-label">Gambar</label><br>
                    <img src="/posts/thumb/{{$post->img}}" width="100"><br>
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
                    <textarea name="description" class="form-control" rows="20">{{$post->description}}</textarea>
                    @if ($errors->has('description'))
                        <span class="help-block">
                            <strong>{{ $errors->first('description') }}</strong>
                        </span>
                    @endif
                </div>
                <div class="form-group">
                    <div class="col-md-6">
                        <label for="status" class="control-label">Status</label>
                        <select name="status" class="form-control">
                            @if($post->status == 0)
                                <option value="0">Tidak Aktif</option>
                            @endif
                            <option value="1">Aktif</option>
                            <option value="0">Tidak Aktif</option>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-md-6">
                        <label for="acomment" class="control-label">Izinkan komentar</label>
                        <select name="acomment" class="form-control">
                            @if($post->allowed_comment == 0)
                                <option value="0">Tidak</option>
                            @endif
                            <option value="1">Ya</option>
                            <option value="0">Tidak</option>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-md-12">
                        <hr>
                        <button class="btn btn-primary"><span class="glyphicon glyphicon-send" aria-hidden="true"></span></button>
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