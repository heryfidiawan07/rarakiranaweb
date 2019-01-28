@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        
        <div class="col-md-7">
            <h1 class="text-center">Payment</h1>
            <div class="table-responsive">
                <table class="table table-hover">
                    <h5><b>Detail Pembelian</b></h5>
                    @foreach($carts as $item)
                        <tr>
                            <td><img src="/products/thumb/{{$item['item']['pictures'][0]['img']}}" width="150"></td>
                            <td>
                                {{$item['item']['title']}}<hr>
                                Harga: Rp {{number_format($item['item']['price'], 2)}}
                            </td>
                        </tr>
                    @endforeach
                    <tr>
                        <td>No Order</td>
                        <td><b>{{$order->no_order}}</b></td>
                    </tr>
                    <tr>
                        <td>Status Pembelian</td>
                        <td>
                            @if($payment->status==0)
                                <span class="warning">Menunggu pembayaran</span>
                            @elseif($payment->status==1)
                                <span class="success">Sedang di prosses</span>
                            @elseif($payment->status==2)
                                <span class="success">Sedang di dalam pengiriman</span>
                            @elseif($payment->status==3)
                                <span class="success">Barang telah di terima</span>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <td>Jasa Pengiriman:</td>
                        <td><b>{{strtoupper($payment->kurir)}} {{$payment->services}}</b></td>
                    </tr>
                    @if($payment->status==1)
                        <tr>
                            <td>No Resi:</td>
                            <td><b>{{$payment->no_resi}}</b></td>
                        </tr>
                        <tr>
                            <td>Pengirim:</td>
                            <td><b>{{$payment->pengirim}}</b></td>
                        </tr>
                    @endif
                    <tr>
                        <td>Catatan:</td>
                        <td><b>{{$payment->note}}</b></td>
                    </tr>
                    <tr>
                        <td>Alamat:</td>
                        <td>
                            {!! nl2br($payment->address->address) !!}
                            <p>Kecamatan {{$payment->address->kecamatan}}</p>
                            <p>{{$payment->address->kabupaten}}</p>
                        </td>
                    </tr>
                    <tr>
                        <td>Total Tagihan:</td>
                        <td><b>Rp {{number_format($payment->total_price, 2)}}</b></td>
                    </tr>
                </table>
            </div>
        </div>

    </div>
</div>
@endsection
