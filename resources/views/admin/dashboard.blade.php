@extends('layouts.app')
@section('css')
    <link rel="stylesheet" type="text/css" href="/css/dashboard.css">
@endsection
@section('content')
<div class="container">
    <div class="row">

        <div class="col-md-3">
            @include('admin.dashboard-menu')
        </div>
        <div class="col-md-9"></div>
        
    </div>
</div>
@endsection
