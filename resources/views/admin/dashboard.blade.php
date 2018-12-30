@extends('layouts.app')
@section('css')
    <link rel="stylesheet" type="text/css" href="/css/dashboard.css">
@endsection
@section('content')
<div class="container">
    <div class="row">

        <div class="col-md-12">
            @include('admin.dashboard-menu')
        </div>
        
    </div>
</div>
@endsection
