@extends('layouts.app')
@section('css')
    <link rel="stylesheet" type="text/css" href="/css/dashboard.css">
@endsection
@section('content')
<div class="container">
    <div class="row">

        @include('admin.dashboard-menu')
        <div class="col-md-12">
            <div class="table-responsive well">
                <table class="activate-tabel"><tr><td>
                    @if($forumTag)
                        <form class="form-inline" method="POST" action="/forum/update/{{$forumTag->id}}">
                            {{csrf_field()}}
                            <div class="input-group input-group-sm">
                                <input type="text" name="forumUpdate" class="form-control" value="{{$forumTag->name}}" required>
                                <div class="input-group-addon">
                                    <button class="glyphicon glyphicon-send"></button>
                                </div>
                            </div>
                        </form>
                    @endif
                    </td>
                    @if($forumTag)
                    <td>
                        <form class="form-inline" method="POST" action="/forum/update/status/{{$forumTag->id}}">
                            {{csrf_field()}}
                            <div class="input-group input-group-sm">
                                <select name="statusForum" class="form-control">
                                    @if($forumTag->status==0)
                                        <option value="0">No Activate</option>
                                    @endif
                                    <option value="1">Activate</option>
                                    <option value="0">No Activate</option>
                                </select>
                                <div class="input-group-addon">
                                    <button class="glyphicon glyphicon-send"></button>
                                </div>
                            </div>
                        </form>
                    </td>
                    @else
                    <td>
                        <form class="form-inline" method="POST" action="/activate/forum">
                            {{csrf_field()}}
                            <div class="input-group input-group-sm">
                                <input type="text" name="forumName" class="form-control input-sm" placeholder="Create Menu Forum" required>
                                <div class="input-group-addon">
                                    <button class="glyphicon glyphicon-send"></button>
                                </div>
                            </div>
                        </form>
                    </td>
                    @endif
                </tr></table>
            </div>
        </div>

        @if($tags->where('setting',10)->where('status',1)->count())
            <div class="col-md-4">
                <h4 class="text-center"><b>ADD TAG</b></h4><hr>
                <form class="form-horizontal" role="form" method="POST" action="/tag/store">
                    {{ csrf_field() }}

                    <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                        <label for="name" class="col-md-4 control-label">Name</label>

                        <div class="col-md-6">
                            <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}" required autofocus>

                            @if ($errors->has('name'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('name') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group{{ $errors->has('parent_id') ? ' has-error' : '' }}">
                        <label for="parent_id" class="col-md-4 control-label">Parent</label>

                        <div class="col-md-6">
                            <select name="parent_id" class="form-control">
                                <option value="0">Select parent</option>
                                @if($tags->count())
                                    @foreach($tags->where('setting',0)->where('parent_id',0) as $tag)
                                        <option value="{{$tag->id}}">{{$tag->name}}</option>
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
                            <button type="submit" class="btn btn-primary btn-sm"><span class="glyphicon glyphicon-send" aria-hidden="true"></span></button>
                        </div>
                    </div>
                </form>
            </div>

            <div class="col-md-8">
                <h4 class="text-center"><b>{{$mainTag->name}} TAG LIST</b></h4>
                @if(session('warningEdit'))
                    <div class="alert alert-warning">
                        {{session('warningEdit')}}
                    </div>
                @endif
                <div class="table-responsive">
                    <table class="table table-hovered">
                    <tr>
                        <th>TAG</th>
                        <th>EDIT NAME</th>
                        <th>EDIT PARENT</th>
                        <th>DELETE</th>
                        <th>STATUS</th>
                        <th>POSTED BY</th>
                    </tr>
                    @foreach($tags->where('setting','!=',10)->where('parent_id',0) as $tag)
                        <tr>
                            <td>{{$tag->name}} - <small>{{$tag->threads->count()}} threads</small></td>
                            <td>@include('admin.threads.tag.edit-name')</td>
                            <td>@include('admin.threads.tag.edit')</td>
                            <td>@include('admin.threads.tag.delete')</td>
                            <td>@include('admin.threads.tag.status')</td>
                            <td>
                                <span class="glyphicon glyphicon-user" aria-hidden="true"></span>
                                <small><i>{{$tag->user->name}}</i></small>
                            </td>
                            <tr>
                        <tr>
                        @foreach($tag->parent as $child)
                        <tr>
                            <td>
                                <span class="glyphicon glyphicon-arrow-right"></span>
                                {{$child->name}} - <small>{{$child->threads->count()}} threads</small>
                            </td>
                            <td>@include('admin.threads.tag.edit-child-name')</td>
                            <td>@include('admin.threads.tag.editChild')</td>
                            <td>@include('admin.threads.tag.deleteChild')</td>
                            <td>@include('admin.threads.tag.statusChild')</td>
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
                <h4 class="text-center"><b>THREADS LIST</b></h4>
                <div class="panel panel-default">
                    <div class="panel-heading text-center">
                        <a href="/thread/create" class="btn btn-primary btn-sm">
                            <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>CREATE
                        </a>
                    </div>
                    <div class="panel-body">
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                @foreach($threads as $thread)
                                    <tr>
                                        <td colspan="7"><p class="@if($thread->sticky == 1) sticky @endif">{{$thread->title}} @if($thread->sticky == 1) - <small style="color: black;">Sticky</small> @endif</p></td>
                                    </tr>
                                    <tr>
                                        <td>@include('admin.threads.delete')</td>
                                        <td><a href="/thread/{{$thread->slug}}" class="btn btn-success btn-sm"><span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span></a></td>
                                        <td><span class="glyphicon glyphicon-comment"> {{$thread->comments->count()}}</span></td>
                                        <td>@include('admin.threads.status')</td>
                                        <td>
                                            <form class="form-inline" method="POST" action="/thread/sticky/{{$thread->id}}">
                                                {{csrf_field()}}
                                                <div class="input-group input-group-sm">
                                                    <select class="form-control" name="sticky" required>
                                                        @if($thread->sticky == 1)
                                                            <option value="{{$thread->sticky}}">Sticky Post</option>
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
                                    </tr>
                                    <tr>
                                        <td colspan="2">
                                            <a href="/threads/tag/{{$thread->tag->slug}}" class="btn btn-default btn-sm">
                                            <span class="glyphicon glyphicon-tag"></span> {{$thread->tag->name}}</a>
                                        </td>
                                        <td>
                                            <span class="glyphicon glyphicon-user"></span> <small><i>{{$thread->user->name}}</i></small>
                                        </td>
                                        <td><small><i>
                                            <span class="glyphicon glyphicon-time"></span>
                                            Create: {{ date('d F, Y', strtotime($thread->created_at))}} - {{date('g:ia', strtotime($thread->created_at))}}
                                        </i></small></td>
                                        <td><small><i>
                                            <span class="glyphicon glyphicon-time"></span>
                                            Updated: {{ date('d F, Y', strtotime($thread->udated_at))}} - {{date('g:ia', strtotime($thread->updated_at))}}
                                        </i></small></td>
                                    </tr>
                                @endforeach
                            </table>
                        </div>
                    </div>
                    <div class="panel-footer">
                        <small>{{$threads->links()}}</small>
                    </div>
                </div>
            </div>
        @endif

    </div>
</div>
@endsection
