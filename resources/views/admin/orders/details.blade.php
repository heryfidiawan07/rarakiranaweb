@extends('layouts.app')
@section('css')
    <link rel="stylesheet" type="text/css" href="/css/dashboard.css">
@endsection
@section('content')
<div class="container">
    <div class="row">
        
        @include('admin.dashboard-menu')
        <div class="col-md-9">
            <div class="table-responsive">
                <table class="table table-hover">
                    <tr>
                        <th>
                            <a class="success" href="/order/print/invoice/{{$order->no_order}}" target="_blank">
                                <b><span class="glyphicon glyphicon-print" aria-hidden="true"></span>Print Invoice</b>
                            </a>
                        </th>
                        <th>
                            <a href="/order/print/delivery/{{$order->no_order}}" target="_blank">
                                <b><span class="glyphicon glyphicon-print" aria-hidden="true"></span>Print Delivery Order</b>
                            </a>
                        </th>
                    </tr>
                    @foreach($carts as $item)
                    <tr>
                        <td><img src="/products/thumb/{{$item['item']['pictures'][0]['img']}}" width="100"></td>
                        <td>
                            {{$item['item']['title']}}
                            <p>Harga: <b><u>Rp {{number_format($item['item']['price'])}}</u></b></p>
                        </td>
                    </tr>
                    @endforeach
                    <tr>
                        <td>No Order</td>
                        <td><b>{{$order->no_order}}</b></td>
                    </tr>
                    @if($order->payment->status > 0)
                        <tr>
                            <td>
                                <a href="/resi/{{$order->payment->resi_img}}" target="_blank">
                                    <img src="/resi/{{$order->payment->resi_img}}" width="50">
                                </a>
                            </td>
                            <td>Pengirim: {{$order->payment->pengirim}} - <a href="/resi/{{$order->payment->resi_img}}" target="_blank">Buka Gambar</a></td>
                        </tr>
                    @endif
                    <tr>
                        <td>Status:</td>
                        <td>
                            @if($order->status==0)
                                <span class="warning">Menunggu pembayaran</span>
                            @elseif($order->status==1)
                                <span class="warning">Menunggu konfirmasi admin</span>
                            @elseif($order->status==2)
                                <span class="success">Sedang di prosses</span>
                            @elseif($order->status==3)
                                <span class="success">Sedang dalam pengiriman</span>
                            @elseif($order->status==4)
                                <span class="success">Barang telah di terima</span>
                            @elseif($order->status==5)
                                <span class="danger">Anda <i>(admin)</i> menolak pesanan</span>
                            @endif
                            @if($order->status==1)
                                <a href="/proses/order/{{$order->no_order}}" class="btn btn-primary btn-sm">Proses Pesanan</a> | 
                            @endif
                            @if($order->status < 2)
                                <hr>
                                <form metod="POST" action="/reject/order/{{$order->no_order}}">
                                    {{csrf_field()}}
                                    <div class="form-group">
                                        <input type="text" name="keterangan" class="form-control input-sm" placeholder="Keterangan" required>
                                    </div>
                                    <div class="form-group">
                                        <input type="submit" class="btn btn-warning btn-sm" value="Tolak Pesanan">
                                    </div>
                                </form>
                            @endif
                            @if($order->status == 5)
                                <a type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#delete-order">Hapus ! <span class="caret"></span></a>
                                    
                                <div class="modal fade" id="delete-order" tabindex="-1" role="dialog" aria-labelledby="delete-order-label" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-body text-center">
                                                <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">CLOSE</button>
                                                <a href="/delete/order/{{$order->no_order}}" class="btn btn-danger btn-sm">Hapus !</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endif
                            @if($order->status==3)
                                <a href="/done/order/{{$order->no_order}}" class="btn btn-success btn-sm">Pesanan Telah di Terima</a>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <td>Jasa Pengiriman:</td>
                        <td>{{strtoupper($order->kurir)}} - {{$order->services}}</td>
                    </tr>
                    @if($order->status > 1)
                        <tr>
                            <td>No Resi:</td>
                            <td><b>{{$order->kurir_resi}}</b></td>
                        </tr>
                        @if($order->status < 4)
                            <tr>
                                <td>
                                    @if($order->payment->kurir_resi === 'yet')
                                        Input No Resi
                                    @else
                                        Update No Resi
                                    @endif
                                </td>
                                <td>
                                    <form method="POST" action="/order/input/resi/{{$order->no_order}}">
                                        {{csrf_field()}}
                                        <div class="input-group input-group-sm">
                                            <input type="text" name="kurir_resi" placeholder="input no resi" class="form-control" required>
                                            <div class="input-group-addon">
                                                <button class="glyphicon glyphicon-send"></button>
                                            </div>
                                        </div>
                                    </form>
                                </td>
                            </tr>
                        @endif
                    @endif
                    <tr>
                        <td>Catatan:</td>
                        <td>{!! nl2br($order->note) !!}</td>
                    </tr>
                    <tr>
                        <td>Alamat:</td>
                        <td>
                            {!! nl2br($order->address->address) !!}
                            <p>Kecamatan {{$order->address->kecamatan}}</p>
                            <p>{{$order->address->kabupaten}}</p>
                        </td>
                    </tr>
                    <tr>
                        <td>Total Tagihan:</td>
                        <td><b>Rp {{number_format($order->total_price)}}</b></td>
                    </tr>
                </table>
            </div>
        </div>

        <div class="col-md-3">
            
        </div>

    </div>
</div>
@endsection
