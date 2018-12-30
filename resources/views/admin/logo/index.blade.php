@extends('layouts.app')
@section('css')
    <link rel="stylesheet" type="text/css" href="/css/dashboard.css">
@endsection
@section('content')
<div class="container">
    <div class="row">
        
        <div class="col-md-5">
            @include('admin.dashboard-menu')
            <h4 class="text-center">ADD LOGO</h4><hr>
            <form class="form-horizontal" role="form" method="POST" action="/logo/store" enctype="multipart/form-data">
                {{ csrf_field() }}

                <div class="form-group{{ $errors->has('title') ? ' has-error' : '' }}">
                    <label for="title" class="col-md-4 control-label">Title</label>

                    <div class="col-md-6">
                        <input id="title" type="text" class="form-control" name="title" value="{{ old('title') }}" required autofocus>

                        @if ($errors->has('title'))
                            <span class="help-block">
                                <strong>{{ $errors->first('title') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>

                <div class="form-group{{ $errors->has('description') ? ' has-error' : '' }}">
                    <label for="description" class="col-md-4 control-label">Description</label>

                    <div class="col-md-6">
                        <textarea id="description" cols="5" class="form-control" name="description" required autofocus>{{ old('description') }}</textarea>

                        @if ($errors->has('description'))
                            <span class="help-block">
                                <strong>{{ $errors->first('description') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>

                <div class="form-group{{ $errors->has('menu_id') ? ' has-error' : '' }}">
                    <label for="menu_id" class="col-md-4 control-label">Menu</label>

                    <div class="col-md-6">
                        <select name="menu_id" class="form-control" required autofocus>
                            @if($menus->count())
                                @foreach($menus as $menu)
                                    <option value="{{$menu->id}}">{{$menu->menu}}</option>
                                @endforeach
                            @endif
                        </select>

                        @if ($errors->has('menu_id'))
                            <span class="help-block">
                                <strong>{{ $errors->first('menu_id') }}</strong>
                            </span>
                        @endif
                        @if(session('warning'))
                            <div class="alert alert-warning">
                                {{session('warning')}}
                            </div>
                        @endif
                    </div>
                </div>

                <div class="form-group{{ $errors->has('img') ? ' has-error' : '' }}">
                    <label for="img" class="col-md-4 control-label">Image</label>

                    <div class="col-md-6">
                        <input id="img" type="file" class="form-control" name="img" value="{{ old('img') }}" required autofocus>

                        @if ($errors->has('img'))
                            <span class="help-block">
                                <strong>{{ $errors->first('img') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-md-8 col-md-offset-4">
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                </div>
            </form>
        </div>

        <div class="col-md-7">
            <h4 class="text-center"><b>LOGO LIST</b></h4>
            @if(session('warningEdit'))
                <div class="alert alert-warning">
                    {{session('warningEdit')}}
                </div>
            @endif
            <div class="table-responsive">
                <table class="table table-bordered">
                    @foreach($logos as $logo)
                    <tr>
                        <td class="td-logo" rowspan="3">
                            <img src="/logo/thumb/{{$logo->img}}" class="logo-img">
                        </td>
                        <td colspan="4">{{$logo->title}}</td>
                    </tr>
                    <tr>
                        <td colspan="4">{{$logo->description}}</td>
                    </tr>
                    <tr>
                        <td class="td-logo-tag">
                            <a href="/{{$logo->menu->slug}}">
                                <span class="glyphicon glyphicon-tag" aria-hidden="true"></span>
                                {{$logo->menu->menu}}
                            </a>
                        </td>
                        <td>
                            <span class="glyphicon glyphicon-user" aria-hidden="true"></span>
                            <i>{{$logo->user->name}}</i>
                        </td>
                        <td>@include('admin.logo.edit')</td>
                        <td>@include('admin.logo.delete')</td>
                    </tr>
                    @endforeach
                </table>
            </div>
        </div>

    </div>
</div>
@endsection
