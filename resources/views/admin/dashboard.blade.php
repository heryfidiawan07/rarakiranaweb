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
                        <h5>{{$orders->count()}} New Orders</h5>
                        <h5>{{$sold}} Product Sold</h5>
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
                        <h5>{{$users->count()}} Users</h5>
                        <h5>{{$online}} Online</h5>
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
                        <h5>{{$today[0]['visitors']}} Today Visitor</h5>
                        <h5>{{$today[0]['pageViews']}} Page Views</h5>
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
                        <h5>{{$countPostComment->count()}} Comments</h5>
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
                        <h5>{{$countThreadComment->count()}} Comments</h5>
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
                        <h5>{{$countProductComment->count()}} Discus</h5>
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
                        <h5>{{$questions->where('status',0)->count()}} New Shipment</h5>
                        <h5>{{$questions->count()}} Shipment</h5>
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
                        <h5>{{$messages->where('status',0)->count()}} New Messages</h5>
                        <h5>{{$messages->count()}} Messages</h5>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
