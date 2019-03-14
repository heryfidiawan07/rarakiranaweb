@extends('layouts.app')

@section('url') {{Request::url()}} @endsection
@if($user)
    @section('image') http://rarakirana.com/users/{{$user->img}} @endsection
    @section('title') {{$user->name}} @endsection
    @section('description') {{strip_tags($user->bio)}} @endsection
@endif

@section('content')
<div class="container">
    <div class="row">
        
        <div class="col-sm-5">
            <div class="text-center">
                <img src="<?php if ($user->img != null){ echo "/users/".$user->img;}else if($user->graph != null){echo $user->graph;}else{echo $user->avatar();} ?>
                " class="img-responsive" style="height: 150px;">
            </div>
            
            @include('user.user-img-edit')
            @include('user.user-name-edit')
            @include('user.user-bio-edit')
            
            <div class="panel userbio" style="min-height: 200px;">
                Bio :
                <div class="panel-body" style="border-top: 1px solid grey;">
                    {!! nl2br($user->bio) !!}
                </div>
            </div>
        </div>
        <div class="col-sm-7">
            @include('user.user-content')
        </div>

    </div>
</div>
@endsection
