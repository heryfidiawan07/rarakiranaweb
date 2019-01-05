@extends('layouts.app')
@section('css')
    <link rel="stylesheet" type="text/css" href="/css/dashboard.css">
@endsection
@section('content')
<div class="container">
    <div class="row">

        <div class="col-md-4">
            @include('admin.dashboard-menu')
            <h4 class="text-center"><b>ADD TAG</b></h4><hr>
            <form class="form-horizontal" role="form" method="POST" action="/forum/tag/store">
                {{ csrf_field() }}

                <div class="form-group{{ $errors->has('tag') ? ' has-error' : '' }}">
                    <label for="tag" class="col-md-4 control-label">Tag Name</label>

                    <div class="col-md-6">
                        <input id="tag" type="text" class="form-control" name="tag" value="{{ old('tag') }}" required autofocus>

                        @if ($errors->has('tag'))
                            <span class="help-block">
                                <strong>{{ $errors->first('tag') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>

                <div class="form-group{{ $errors->has('parent_tag') ? ' has-error' : '' }}">
                    <label for="parent_tag" class="col-md-4 control-label">Parent</label>

                    <div class="col-md-6">
                        <select name="parent_tag" class="form-control">
                            <option value="0">Select parent</option>
                            @if($tags->count())
                                @foreach($tags as $parent)
                                    <option value="{{$parent->id}}">{{$parent->menu}}</option>
                                @endforeach
                            @endif
                        </select>

                        @if ($errors->has('parent_tag'))
                            <span class="help-block">
                                <strong>{{ $errors->first('parent_tag') }}</strong>
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

        <div class="col-md-8">
            <h4 class="text-center"><b>FORUM TAG LIST</b></h4>
            @if(session('warningEdit'))
                <div class="alert alert-warning">
                    {{session('warningEdit')}}
                </div>
            @endif
            <div class="table-responsive">
                <table class="table table-hovered">
                <tr>
                    <th>TAG</th>
                    <th>EDIT</th>
                    <th>DELETE</th>
                    <th>STATUS</th>
                    <th>POSTED BY</th>
                </tr>
                @foreach($tags as $tag)
                    <tr>
                        <td>{{$tag->menu}} - <small>{{$tag->forums->count()}} threads</small></td>
                        <td>@include('admin.forum.tag.edit')</td>
                        <td>@include('admin.forum.tag.delete')</td>
                        <td>@include('admin.forum.tag.status')</td>
                        <td>
                            <span class="glyphicon glyphicon-user" aria-hidden="true"></span>
                            <small><i>{{$tag->user->name}}</i></small>
                        </td>
                        <tr>
                    <tr>
                    @foreach($tag->parent as $child)
                    <tr>
                        <td> -> {{$child->menu}} - <small>{{$child->forums->count()}} threads</small></td>
                        <td>@include('admin.forum.tag.editChild')</td>
                        <td>@include('admin.forum.tag.deleteChild')</td>
                        <td>@include('admin.forum.tag.statusChild')</td>
                        <td>
                            <span class="glyphicon glyphicon-user" aria-hidden="true"></span>
                            <small><i>{{$child->user->name}}</i></small>
                        </td>
                    @endforeach
                @endforeach
                </table>
            </div>
        </div>

        <div class="col-md-12"><hr>
            <div class="panel panel-default">
                <div class="panel-heading">
                    <a href="/thread/create" class="btn btn-primary btn-sm pull-left">Create Threads</a>
                    <h4 class="text-center"><b>THREADS LIST</b></h4>
                </div>
                <div class="panel-body">
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            @foreach($threads as $thread)
                                <tr>
                                    <td colspan="6"><p class="@if($thread->sticky == 1) sticky @endif">{{$thread->title}} @if($thread->sticky == 1) - <small style="color: black;">Sticky</small> @endif</p></td>
                                </tr>
                                <tr>
                                    <td>
                                        @if(Auth::user()->id != $thread->user->id)
                                            <a href="/thread/edit/{{$thread->slug}}" class="btn btn-primary btn-xs disabled">Edit</a>
                                        @else
                                            <a href="/thread/edit/{{$thread->slug}}" class="btn btn-primary btn-xs">Edit</a>
                                        @endif
                                    </td>
                                    <td>@include('admin.forum.delete')</td>
                                    <td><a href="/thread/{{$thread->slug}}" class="btn btn-success btn-xs">Show</a></td>
                                    <td><span class="glyphicon glyphicon-comment"> {{$thread->forcomments->count()}}</span></td>
                                    <td>@include('admin.forum.status')</td>
                                    <td>
                                        <form class="form-inline" method="POST" action="/forum/sticky/{{$thread->id}}">
                                            {{csrf_field()}}
                                            <select class="form-control input-sm" name="sticky" required>
                                                @if($thread->sticky == 1)
                                                    <option value="{{$thread->sticky}}">Sticky Post</option>
                                                @endif
                                                <option value="0">Default</option>
                                                <option value="1">Set to sticky</option>
                                            </select>
                                            <input type="submit" class="btn btn-warning btn-sm" value="set">
                                        </form>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <a href="/threads/tag/{{$thread->menu->slug}}" class="btn btn-default btn-xs">
                                        <span class="glyphicon glyphicon-tag"></span> {{$thread->menu->menu}}</a>
                                    </td>
                                    <td colspan="2"><span class="glyphicon glyphicon-user"></span> <small><i>{{$thread->user->name}}</i></small></td>
                                    <td colspan="2"><small><i>
                                        <span class="glyphicon glyphicon-time"></span>
                                        Create: {{ date('d F, Y', strtotime($thread->created_at))}} - {{date('g:ia', strtotime($thread->created_at))}}
                                    </i></small></td>
                                    <td colspan="2"><small><i>
                                        <span class="glyphicon glyphicon-time"></span>
                                        Updated: {{ date('d F, Y', strtotime($thread->udated_at))}} - {{date('g:ia', strtotime($thread->updated_at))}}
                                    </i></small></td>
                                </tr>
                            @endforeach
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
