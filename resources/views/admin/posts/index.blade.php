@extends('layouts.app')
@section('css')
    <link rel="stylesheet" type="text/css" href="/css/dashboard.css">
@endsection
@section('content')
<div class="container">
    <div class="row">

        <div class="col-md-12">
            @include('admin.dashboard-menu')
            <div class="panel panel-default">
                <div class="panel-heading">
                    <a href="/post/create" class="btn btn-primary btn-sm pull-left">CEATE POST</a>
                    <p class="text-center"><b>POST LIST</b></p>
                </div>
                <div class="panel-body">
                    <div class="table-responsive">
                    @foreach($posts as $post)
                        <table class="table table-bordered">
                            <tr>
                                <td rowspan="3" class="frame-admin-art"><img src="/posts/thumb/{{$post->img}}"></td>
                                <td colspan="7"><p class="@if($post->sticky == 1) sticky @endif">{{$post->title}} @if($post->sticky == 1) - <small style="color: black;">This Post Sticky</small>@endif</p></td>
                            </tr>
                            <tr>
                                <td><a href="/post/{{$post->id}}/edit" class="btn btn-primary btn-xs">Edit</a></td>
                                <td><a href="/post/{{$post->id}}/destroy" class="btn btn-danger btn-xs">Delete</a></td>
                                <td><a href="/read/post/{{$post->slug}}" class="btn btn-success btn-xs">Show</a></td>
                                <td>@include('admin.posts.status')</td>
                                <td>@include('admin.posts.acomment')</td>
                                <td>
                                    <form class="form-inline" method="POST" action="/post/sticky/{{$post->id}}">
                                        {{csrf_field()}}
                                        <select class="form-control input-sm" name="sticky" required>
                                            @if($post->sticky == 1)
                                                <option value="{{$post->sticky}}">Sticky Post</option>
                                            @endif
                                            <option value="0">Default</option>
                                            <option value="1">Set to sticky</option>
                                        </select>
                                        <input type="submit" class="btn btn-warning btn-sm" value="sticky">
                                    </form>
                                </td>
                                <td>
                                    <form class="form-inline" method="POST" action="/post/parent/{{$post->id}}">
                                        {{csrf_field()}}
                                        <select class="form-control input-sm" name="menu_post" required>
                                            <option value="{{$post->menu->id}}">{{$post->menu->name}}</option>
                                            @foreach($menus as $menu)
                                                <option value="{{$menu->id}}">{{$menu->name}}</option>
                                            @endforeach
                                        </select>
                                        <input type="submit" class="btn btn-success btn-sm" value="save">
                                    </form>
                                </td>
                            </tr>
                            <tr>
                                <td><a href="/{{$post->menu->slug}}" class="btn btn-default btn-xs"><span class="glyphicon glyphicon-tag">{{$post->menu->name}}</a></td>
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
                        </table>
                    @endforeach
                    </div>
                </div>
            </div>
            <div class="text-center">
                <ul class="pagination pagination-sm">{{$posts->links()}}</ul>
            </div>
        </div>

    </div>
</div>
@endsection