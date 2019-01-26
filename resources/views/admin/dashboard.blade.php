@extends('layouts.app')
@section('css')
    <link rel="stylesheet" type="text/css" href="/css/dashboard.css">
@endsection
@section('content')
<div class="container">
    <div class="row">
		@include('admin.dashboard-menu')
        <div class="col-md-3">
            <div class="panel panel-default panel-dashboard">
                <div class="panel-body">
                    <div class="panel-left">
                        <i class="fas fa-shopping-bag fa-3x"></i>
                    </div>
                    <div class="panel-right">
                        <h5>25 New Orders</h5>
                        <h5>100 Product Sold</h5>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="panel panel-default panel-dashboard">
                <div class="panel-body">
                    <div class="panel-left">
                        <i class="fas fa-users fa-3x"></i>
                    </div>
                    <div class="panel-right">
                        <h5>Users: </h5>
                        <h5>Online: </h5>
                        <!-- <p>{{$users->count()}} users - <i>Online: {{$online}}</i></p> -->
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="panel panel-default panel-dashboard">
                <div class="panel-body">
                    <div class="panel-left">
                        <i class="fas fa-chart-pie fa-3x"></i>
                    </div>
                    <div class="panel-right">
                        <h5>250 Today Visitor</h5>
                        <h5>1200 Unique Visitors</h5>
                        <!-- <p>{{$users->count()}} users - <i>Online: {{$online}}</i></p> -->
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="panel panel-default panel-dashboard">
                <div class="panel-body">
                    <div class="panel-left">
                        <i class="fas fa-blog fa-3x"></i>
                    </div>
                    <div class="panel-right">
                        <h5>{{$posts->count()}} Posts</h5>
                        <h5>10 Comments</h5>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="panel panel-default panel-dashboard">
                <div class="panel-body">
                   <div class="panel-left">
                        <i class="fas fa-user-friends fa-3x"></i>
                    </div>
                    <div class="panel-right">
                        <h5>{{$threads->count()}} Threads</h5>
                        <h5>10 Comments</h5>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="panel panel-default panel-dashboard">
                <div class="panel-body">
                   <div class="panel-left">
                        <i class="fas fa-cart-plus fa-3x"></i>
                    </div>
                    <div class="panel-right">
                        <h5>{{$products->count()}} Products</h5>
                        <h5>10 Comments</h5>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="panel panel-default panel-dashboard">
                <div class="panel-body">
                   <div class="panel-left">
                        <i class="fas fa-envelope fa-3x"></i>
                    </div>
                    <div class="panel-right">
                        <h5>5 New Messages</h5>
                        <h5>30 Messages</h5>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
