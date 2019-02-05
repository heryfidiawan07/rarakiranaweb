@extends('layouts.app')
@section('css')
    <link rel="stylesheet" type="text/css" href="/css/dashboard.css">
@endsection
@section('content')
<div class="container">
    <div class="row">
        
        @include('admin.dashboard-menu')
        <div class="col-md-8">
            <div class="table-responsive">
                <table class="table-hover">
                    @foreach($carts as $item)
                    <tr>
                        <td><img src="/products/thumb/{{$item['item']['pictures'][0]['img']}}" width="100"></td>
                        <td>
                            {{$item['item']['title']}}
                            <p>Harga: <b><u>Rp {{number_format($item['item']['price'], 2)}}</u></b></p>
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
                                <span class="warning">Menunggu konfirmasi penjual</span>
                            @elseif($payment->status==2)
                                <span class="success">Sedang di prosses</span>
                            @elseif($payment->status==3)
                                <span class="success">Sedang di dalam pengiriman</span>
                            @elseif($payment->status==4)
                                <span class="success">Barang telah di terima</span>
                            @elseif($payment->status==5)
                                <span class="danger">Pesanan anda sudah expired</span>
                            @endif
                            <div class="well">
                                ATM transfer:
                                <table class="table">
                                    @foreach($rekenings as $rekening)
                                        <tr>
                                            <td>{{$rekening->number}}</td>
                                            <td>{{$rekening->name}} ({{$rekening->bank}})</td>
                                        </tr>
                                    @endforeach
                                </table>
                            </div>
                            @if($payment->status==0)
                                <form action="/user/{{$user->slug}}/payment/order/{{$order->no_order}}" method="POST" enctype="multipart/form-data">
                                    {{csrf_field()}}
                                    <div class="form-group">
                                        <label class="control-label">Unggah bukti pembayaran:</label>
                                    </div>
                                    <div class="form-group">
                                        <input type=text name="pengirim" class="form-control input-sm" value="{{old('name')}}" placeholder="Nama Pengirim" required>
                                    </div>
                                    <div class="form-group">
                                        <input type="file" name="resi" class="form-control input-sm" required>
                                        @if ($errors->has('resi'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('resi') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        <button class="btn btn-success btn-sm"><span class="glyphicon glyphicon-send"></span></button>
                                    </div>
                                </form>
                            @endif
                        </td>
                    </tr>
                    @if($payment->status > 0)
                        <tr>
                            <td>
                                <a href="/resi/{{$payment->resi}}">
                                    <img src="/resi/{{$payment->resi}}" width="50">
                                </a>
                            </td>
                            <td>Pengirim: {{$payment->pengirim}}</td>
                        </tr>
                    @endif
                    <tr>
                        <td>Jasa Pengiriman:</td>
                        <td>{{strtoupper($payment->kurir)}} - {{$payment->services}}</td>
                    </tr>
                    @if($payment->status > 3)
                        <tr>
                            <td>No Resi:</td>
                            <td><b>{{$payment->kurir_resi}}</b></td>
                        </tr>
                    @endif
                    <tr>
                        <td>Catatan:</td>
                        <td>{{$payment->note}}</td>
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
                        <td><b>Rp {{number_format($payment->total_price)}}</b></td>
                    </tr>
                </table>
            </div>
        </div>

        <div class="col-md-4">
            
        </div>

    </div>
</div>
@endsection
