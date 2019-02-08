@extends('layouts.app')
@section('css')
    <link rel="stylesheet" type="text/css" href="/css/dashboard.css">
@endsection
@section('content')
<div class="container">
    <div class="row">
        
        @include('admin.dashboard-menu')
        <div class="col-md-4">
            <form method="POST" action="/admin/address/store">
                {{csrf_field()}}
                @include('products.address')
                <button class="btn btn-primary btn-sm"><span class="glyphicon glyphicon-send"></span></button>
            </form>
        </div>

        <div class="col-md-8">
            @foreach($orders as $order)
                <div class="col-md-12">
                    <div class="table-responsive">
                        <table class="table">
                          <tr>
                              <th>No Order</th>
                              <th>Details</th>
                              <th>Status</th>
                              <th>Order Date</th>
                              <th>Payement Date</th>
                          </tr>
                          <tr>
                              <td>{{$order->no_order}}</td>
                              <td><a href="/dashboard/order-details/{{$order->no_order}}" class="btn btn-primary btn-xs"><span class="glyphicon glyphicon-list-alt"></span></a></td>
                              <td>
                                    @if($order->status==0)
                                        <span class="warning">Menunggu pembayaran</span>
                                    @elseif($order->status==1)
                                        <span class="warning">Menunggu konfirmasi penjual</span>
                                    @elseif($order->status==2)
                                        <span class="success">Pesanan Sedang di prosses</span>
                                    @elseif($order->status==3)
                                        <span class="success">Sedang di dalam pengiriman oleh kurir</span>
                                    @elseif($order->status==4)
                                        <span class="success">Barang telah di terima</span>
                                    @elseif($order->status==5)
                                        <span class="danger">Pesanan anda sudah expired</span>
                                    @endif
                              </td>
                              <td>{{ date('d F, Y', strtotime($order->created_at))}}</td>
                              <td>{{ date('d F, Y', strtotime($order->updated_at))}}</td>
                          </tr>
                        </table>
                    </div>
                </div>
            @endforeach
        </div>

    </div>
</div>
@endsection
@section('js')
    <script type="text/javascript" src="/js/cart.js"></script>
@endsection