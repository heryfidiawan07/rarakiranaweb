@extends('layouts.app')
@section('css')
    <link rel="stylesheet" type="text/css" href="/css/dashboard.css">
@endsection
@section('content')
<div class="container">
    <div class="row">
        
        <div class="col-md-3">@include('admin.dashboard-menu')</div>
        <div class="col-md-9">
            <h4 class="text-center">ADD MENU</h4><hr>
            <form class="form-horizontal" role="form" method="POST" action="/menu/store">
                {{ csrf_field() }}

                <div class="form-group{{ $errors->has('menu') ? ' has-error' : '' }}">
                    <label for="menu" class="col-md-4 control-label">Name</label>

                    <div class="col-md-6">
                        <input id="menu" type="text" class="form-control" name="menu" value="{{ old('menu') }}" required autofocus>

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
                            <option value="0">Select parent</option>
                            <option value="11">Parent for forum</option>
                            <option value="22">Parent for product</option>
                            <option value="33">Parent for Contact</option>
                            @if($menus->count())
                                @foreach($menus->where('parent_id',0) as $menu)
                                    @if($menu->setting == 11 || $menu->setting == 22)
                                        @continue
                                    @endif
                                    <option value="{{$menu->id}}">{{$menu->menu}}</option>
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

                <div class="form-group">
                    <div class="col-md-8 col-md-offset-4">
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                </div>
            </form>
        </div>

        <div class="col-md-12">
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
                    <th>EDIT</th>
                    <th>DELETE</th>
                    <th>STATUS</th>
                    <th>POSTED BY</th>
                </tr>
                @foreach($menus as $menu)
                    @if($menu->parent_id < 1)
                        <tr>
                            <td>
                                {{$menu->menu}}
                                @if($menu->setting == 11)
                                    <span class="glyphicon glyphicon-comment" aria-hidden="true"></span>
                                @elseif($menu->setting == 33)
                                    <span class="glyphicon glyphicon-envelope" aria-hidden="true"></span>
                                @elseif($menu->setting == 22)
                                    <span class="glyphicon glyphicon-book" aria-hidden="true"></span>
                                @endif
                            </td>
                            <td>@include('admin.menu.edit')</td>
                            <td>@include('admin.menu.delete')</td>
                            <td>@include('admin.menu.status')</td>
                            <td>
                                <span class="glyphicon glyphicon-user" aria-hidden="true"></span>
                                <small><i>{{$menu->user->name}}</i></small>
                            </td>
                            <tr>
                    @else
                        @continue
                    @endif
                    <tr>
                    @foreach($menu->parent->where('parent_id','!=',$menuProd->id)->where('parent_id','!=',$menuForum->id) as $child)
                    <tr>
                        <td> -> {{$child->menu}}</td>
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
