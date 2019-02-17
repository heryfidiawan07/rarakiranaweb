@extends('layouts.app')
@section('css')
    <link rel="stylesheet" type="text/css" href="/css/dashboard.css">
@endsection
@section('content')
<div class="container">
    <div class="row">
        
        <div class="col-md-4">
            @include('admin.dashboard-menu')
            <h4 class="text-center">ADD MENU</h4><hr>
            <form class="form-horizontal" role="form" method="POST" action="/menu/store">
                {{ csrf_field() }}

                <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                    <label for="name" class="col-md-4 control-label">Name</label>

                    <div class="col-md-6">
                        <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}" required autofocus>

                        @if ($errors->has('menu'))
                            <span class="help-block">
                                <strong>{{ $errors->first('menu') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>

                <div class="form-group{{ $errors->has('parent_id') ? ' has-error' : '' }}">
                    <label for="parent_id" class="col-md-4 control-label">Parent</label>

                    <div class="col-md-6">
                        <select name="parent_id" class="form-control">
                            <option value="0">SELECT PARENT</option>
                            @if($menus->count())
                                @foreach($menus->where('parent_id',0)->where('setting',0) as $menu)

                                    <option value="{{$menu->id}}">{{$menu->name}}</option>
                                @endforeach
                            @endif
                        </select>

                        @if ($errors->has('parent_id'))
                            <span class="help-block">
                                <strong>{{ $errors->first('parent_id') }}</strong>
                            </span>
                        @endif
                        @if(session('warning'))
                            <div class="alert alert-warning">
                                {{session('warning')}}
                            </div>
                        @endif
                    </div>
                </div>
                
                <div class="form-group{{ $errors->has('contact') ? ' has-error' : '' }}">
                    <label for="contact" class="col-md-4 control-label">Contact</label>
                    <div class="col-md-6">
                        <select name="contact" class="form-control">
                            <option value="0">SELECT</option>
                            <option value="5">SET TO CONTACT</option>
                        </select>
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-md-8 col-md-offset-4">
                        <button type="submit" class="btn btn-primary btn-sm">
                            <span class="glyphicon glyphicon-send" aria-hidden="true"></span>
                        </button>
                    </div>
                </div>
            </form>
        </div>

        <div class="col-md-8">
            <h4 class="text-center"><b>MENU LIST</b></h4>
            @if(session('warningEdit'))
                <div class="alert alert-warning">
                    {{session('warningEdit')}}
                </div>
            @endif
            <div class="table-responsive">
                <table class="table table-hover">
                <tr>
                    <th>MENU</th>
                    <th>EDIT NAME</th>
                    <th>EDIT PARENT</th>
                    <th>DELETE</th>
                    <th>STATUS</th>
                    <th>POSTED BY</th>
                </tr>
                @foreach($menus->where('parent_id',0) as $menu)
                        <tr>
                            <td>
                                {{$menu->name}}
                                @if($menu->setting == 5)
                                    - <span class="glyphicon glyphicon-envelope" aria-hidden="true"></span>
                                @endif
                                - <small><i>{{$menu->posts->count()}} post</i></small>
                            </td>
                            <td>@include('admin.menu.edit-name')</td>
                            <td>@include('admin.menu.edit')</td>
                            <td>@include('admin.menu.delete')</td>
                            <td>@include('admin.menu.status')</td>
                            <td>
                                <span class="glyphicon glyphicon-user" aria-hidden="true"></span>
                                <small><i>{{$menu->user->name}}</i></small>
                            </td>
                            <tr>
                    
                    <tr>
                    @foreach($menu->parent as $child)
                    <tr>
                        <td>
                            <span class="glyphicon glyphicon-arrow-right"></span>
                            {{$child->name}}
                            @if($child->setting == 5)
                                <span class="glyphicon glyphicon-envelope" aria-hidden="true"></span>
                            @endif
                             - <small><i>{{$child->posts->count()}} post</i></small>
                        </td>
                        <td>@include('admin.menu.edit-child-name')</td>
                        <td>@include('admin.menu.editChild')</td>
                        <td>@include('admin.menu.deleteChild')</td>
                        <td>@include('admin.menu.statusChild')</td>
                        <td>
                            <span class="glyphicon glyphicon-user" aria-hidden="true"></span>
                            <small><i>{{$child->user->name}}</i></small>
                        </td>
                    @endforeach
                @endforeach
                </table>
            </div>
        </div>

    </div>
</div>
@endsection
