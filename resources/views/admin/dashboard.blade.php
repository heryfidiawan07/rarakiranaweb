@extends('layouts.app')
@section('css')
    <link rel="stylesheet" type="text/css" href="/css/dashboard.css">
@endsection
@section('content')
<div class="container">
    <div class="row">
		@include('admin.dashboard-menu')
        <div class="col-md-3">
            <div class="well">
            	<h5 class="text-center">MEMBER</h5>
            </div>
        </div>
        <div class="col-md-3">
            <div class="well">
            	<h5 class="text-center">ARTICLES</h5>
            </div>
        </div>
        <div class="col-md-3">
            <div class="well">
            	<h5 class="text-center">THREADS</h5>
            </div>
        </div>
        <div class="col-md-3">
            <div class="well">
            	<h5 class="text-center">PRODUCT</h5>
            </div>
        </div>
    </div>
</div>
@endsection
