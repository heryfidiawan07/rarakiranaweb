@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10">
                
            <h4 class="text-center"><b>CREATE THREADS</b></h4>
            <form method="POST" action="/thread/store">
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
                <div class="form-group{{ $errors->has('tag_id') ? ' has-error' : '' }}">
                    <label for="tag_id" class="control-label">Menu</label>
                    <select name="tag_id" class="form-control" required autofocus>
                        @foreach($tags as $tag)
                            <option value="{{$tag->id}}">{{$tag->name}}</option>
                        @endforeach
                    </select>
                    @if ($errors->has('tag_id'))
                        <span class="help-block">
                            <strong>{{ $errors->first('tag_id') }}</strong>
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
                    <button class="btn btn-primary btn-sm">
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
@endsection