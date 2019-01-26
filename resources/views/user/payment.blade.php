@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        
        <div class="col-md-6">
            <h1 class="text-center">Payment</h1>
            <h5><b>Detail Pembelian</b></h5><hr>
            <p>
                Status Pembelian
                @if($payment->status==0)
                    <span class="warning">Menunggu pembayaran</span>
                @elseif($payment->status==1)
                    <span class="success">Sedang di prosses</span>
                @elseif($payment->status==2)
                    <span class="success">Sedang di dalam pengiriman</span>
                @elseif($payment->status==3)
                    <span class="success">Barang telah di terima</span>
                @endif
            </p>
            <p>Jasa Pengiriman: <b>{{strtoupper($payment->kurir)}} {{$payment->services}}</b></p>
            @if($payment->status==1)
                <p>No Resi: <b>{{$payment->no_resi}}</b></p>
            @endif
            <p>Catatan: <b>{{$payment->note}}</b></p>
        </div>

    </div>
</div>
@endsection
