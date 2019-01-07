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
                    <a href="/article/create" class="btn btn-primary btn-sm pull-left">TULIS POST</a>
                    <p class="text-center"><b>POST LIST</b></p>
                </div>
                <div class="panel-body">
                    <div class="table-responsive">
                    @foreach($articles as $article)
                        <table class="table table-bordered">
                            <tr>
                                <td rowspan="3" class="frame-admin-art"><img src="/articles/thumb/{{$article->img}}"></td>
                                <td colspan="6"><p class="@if($article->sticky == 1) sticky @endif">{{$article->title}} @if($article->sticky == 1)@endif - <small style="color: black;">This Post Sticky</small></p></td>
                            </tr>
                            <tr>
                                <td><a href="/article/{{$article->id}}/edit" class="btn btn-primary btn-xs">Edit</a></td>
                                <td><a href="/article/{{$article->id}}/destroy" class="btn btn-danger btn-xs">Delete</a></td>
                                <td><a href="/read/article/{{$article->slug}}" class="btn btn-success btn-xs">Show</a></td>
                                <td>@include('admin.articles.status')</td>
                                <td>@include('admin.articles.acomment')</td>
                                <td>
                                    <form class="form-inline" method="POST" action="/article/sticky/{{$article->id}}">
                                        {{csrf_field()}}
                                        <select class="form-control input-sm" name="sticky" required>
                                            @if($article->sticky == 1)
                                                <option value="{{$article->sticky}}">Sticky Post</option>
                                            @endif
                                            <option value="0">Default</option>
                                            <option value="1">Set to sticky</option>
                                        </select>
                                        <input type="submit" class="btn btn-warning btn-sm" value="set">
                                    </form>
                                </td>
                            </tr>
                            <tr>
                                <td><a href="/{{$article->menu->slug}}" class="btn btn-default btn-xs"><span class="glyphicon glyphicon-tag">{{$article->menu->menu}}</a></td>
                                <td><span class="glyphicon glyphicon-user"></span><small><i> {{$article->user->name}}</i></small></td>
                                <td><span class="glyphicon glyphicon-comment"> {{$article->artcomments->count()}}</span></td>
                                <td colspan="2"><small><i>
                                    <span class="glyphicon glyphicon-time"></span>
                                    Create: {{ date('d F, Y', strtotime($article->created_at))}} - {{date('g:ia', strtotime($article->created_at))}}
                                </i></small></td>
                                <td colspan="2"><small><i>
                                    <span class="glyphicon glyphicon-time"></span>
                                    Updated: {{ date('d F, Y', strtotime($article->udated_at))}} - {{date('g:ia', strtotime($article->updated_at))}}
                                </i></small></td>
                            </tr>
                        </table>
                    @endforeach
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
@endsection
