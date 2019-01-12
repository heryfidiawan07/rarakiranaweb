@extends('layouts.app')
@section('css')
    <link rel="stylesheet" type="text/css" href="/css/dashboard.css">
@endsection
@section('content')
<div class="container">
    <div class="row">
		@include('admin.dashboard-menu')
        <div class="col-md-3">
            <div class="panel panel-default">
                <div class="panel-body">
                	<h5>MEMBER</h5><hr>
                    <p>{{$users->count()}} users - <i>Online: {{$online}}</i></p>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="panel panel-default">
                <div class="panel-body">
            	   <h5>POSTS</h5><hr>
                   <p>{{$posts->count()}} posts</p>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="panel panel-default">
                <div class="panel-body">
                   <h5>THREADS</h5><hr>
                   <p>{{$threads->count()}} threads</p>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="panel panel-default">
                <div class="panel-body">
                   <h5>PRODUCTS</h5><hr>
                   <p>{{$products->count()}} products</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
