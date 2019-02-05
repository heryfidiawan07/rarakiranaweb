@extends('layouts.app')
@section('css')
    <link rel="stylesheet" type="text/css" href="/css/dashboard.css">
@endsection
@section('content')
<div class="container">
    <div class="row">
        
        @include('admin.dashboard-menu')
        <div class="col-md-4">
            @foreach($orders as $order)
                <div class="col-md-12">
                    <a href="/dashboard/order-details/{{$order->no_order}}"> {{$order->no_order}} </a>
                </div>
            @endforeach
        </div>

        <div class="col-md-8">
            
        </div>

    </div>
</div>
@endsection
