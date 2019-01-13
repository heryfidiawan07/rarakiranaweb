@extends('layouts.app')
@section('css')
    <link rel="stylesheet" type="text/css" href="/css/dashboard.css">
@endsection
@section('content')
<div class="container">
    <div class="row">

        <div class="col-md-4">
            @include('admin.dashboard-menu')
        </div>

        <div class="col-md-8"><hr>
            <h4 class="text-center"><b>MEMBER LIST</b></h4>
            <div class="table-responsive">
                <table class="table table-hover">
                    @foreach($users as $user)
                        <tr>
                            <td>
                                <a href="/user/{{$user->slug}}">
                                    <img src="<?php if ($user->img != null){ echo "/users/".$user->img;}else if($user->graph != null){echo $user->graph;}else{echo $user->avatar();} ?>
                                    " class="img-responsive" style="height: 30px;">
                                </a>
                            </td>
                            <td>
                                <a href="/user/{{$user->slug}}">{{ucfirst($user->name)}}</a>
                            </td>
                            <td>
                                Status :
                                @if($user->status==1)
                                    @if($user->admin==1)
                                        <a class="btn btn-default btn-xs" disabled><span class="caret"></span> Admin</a>
                                    @else
                                        <a type="button" data-toggle="modal" data-target="#status_{{$user->id}}" href="#" class="btn btn-success btn-xs"><span class="caret"></span> Active</a>
                                    @endif
                                @elseif($user->status==2)
                                    <a type="button" data-toggle="modal" data-target="#status_{{$user->id}}" href="#" class="btn btn-danger btn-xs"><span class="caret"></span> Banned</a>
                                @else
                                    <a type="button" data-toggle="modal" data-target="#status_{{$user->id}}" href="#" class="btn btn-warning btn-xs"><span class="caret"></span> No Active</a>
                                @endif
                                @include('admin.users.status')
                            </td>
                            <td>
                                {{$user->threads->count()}} threads
                            </td>
                            <td>Joined : 
                                {{ date('d F, Y', strtotime($user->created_at))}} - {{date('g:ia', strtotime($user->created_at))}}
                            </td>
                        </tr>
                    @endforeach
                </table>
            </div>
        </div>

    </div>
</div>
@endsection
