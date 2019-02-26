@extends('layouts.app')
@section('css')
    <link rel="stylesheet" type="text/css" href="/css/dashboard.css">
@endsection
@section('content')
<div class="container">
    <div class="row">

        <div class="col-md-12">
            @include('admin.dashboard-menu')
            <h4 class="text-center"><b>POST LIST</b></h4>
            <div class="panel panel-default">
                <div class="panel-heading text-center">
                    <a href="/post/create" class="btn btn-primary btn-sm">
                        <span class="glyphicon glyphicon-book" aria-hidden="true"></span> CEATE POST
                    </a>
                </div>
                <div class="panel-body">
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            @foreach($posts as $post)
                            <tr>
                                <td rowspan="3" class="td-admin-img-posts">
                                    <div class="admin-frame-posts">
                                        <span class="admin-frame-posts-helper"></span>
                                        <img src="/posts/thumb/{{$post->img}}" class="admin-posts-thumb-img">
                                    </div>
                                </td>
                                <td colspan="7"><p class="@if($post->sticky == 1) sticky @else posts-title @endif">{{$post->title}} @if($post->sticky == 1) - <small style="color: black;">This Post Sticky</small>@endif</p></td>
                            </tr>
                            <tr>
                                <td><a href="/post/{{$post->id}}/edit" class="btn btn-primary btn-sm"><span class="glyphicon glyphicon-edit" aria-hidden="true"></span></a></td>
                                <td>@include('admin.posts.delete')</td>
                                <td><a href="/read/post/{{$post->slug}}" class="btn btn-success btn-sm"><span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span></a></td>
                                <td>@include('admin.posts.status')</td>
                                <td>@include('admin.posts.acomment')</td>
                                <td>
                                    <form class="form-inline" method="POST" action="/post/sticky/{{$post->id}}">
                                        {{csrf_field()}}
                                        <div class="input-group input-group-sm">
                                            <select class="form-control" name="sticky" required>
                                                @if($post->sticky == 1)
                                                    <option value="{{$post->sticky}}">Sticky Post</option>
                                                @endif
                                                <option value="0">Default</option>
                                                <option value="1">Set to sticky</option>
                                            </select>
                                            <div class="input-group-addon">
                                                <button class="glyphicon glyphicon-send"></button>
                                            </div>
                                        </div>
                                    </form>
                                </td>
                                <td>
                                    <form class="form-inline" method="POST" action="/post/parent/{{$post->id}}">
                                        {{csrf_field()}}
                                        <div class="input-group input-group-sm">
                                            <select class="form-control input-sm" name="menu_post" required>
                                                <option value="{{$post->menu->id}}">{{$post->menu->name}}</option>
                                                @foreach($menus as $menu)
                                                    <option value="{{$menu->id}}">{{$menu->name}}</option>
                                                @endforeach
                                            </select>
                                            <div class="input-group-addon">
                                                <button class="glyphicon glyphicon-send"></button>
                                            </div>
                                        </div>
                                    </form>
                                </td>
                            </tr>
                            <tr>
                                <td><a href="/{{$post->menu->slug}}" class="btn btn-default btn-sm"><span class="glyphicon glyphicon-tag">{{$post->menu->name}}</a></td>
                                <td><span class="glyphicon glyphicon-user"></span><small><i> {{$post->user->name}}</i></small></td>
                                <td><span class="glyphicon glyphicon-comment"> {{$post->comments->count()}}</span></td>
                                <td colspan="2"><small><i>
                                    <span class="glyphicon glyphicon-time"></span>
                                    Create: {{ date('d F, Y', strtotime($post->created_at))}} - {{date('g:ia', strtotime($post->created_at))}}
                                </i></small></td>
                                <td colspan="2"><small><i>
                                    <span class="glyphicon glyphicon-time"></span>
                                    Updated: {{ date('d F, Y', strtotime($post->udated_at))}} - {{date('g:ia', strtotime($post->updated_at))}}
                                </i></small></td>
                            </tr>
                            @endforeach
                        </table>
                    </div>
                </div>
                <div class="panel-footer">
                    <small>{{$posts->links()}}</small>
                </div>
            </div>
        </div>

    </div>
</div>
@endsection
