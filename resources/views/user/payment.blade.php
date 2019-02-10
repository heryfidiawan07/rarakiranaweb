@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        
        <div class="col-md-7">
            <h1 class="text-center">Payment</h1>
            <div class="table-responsive">
                <table class="table table-hover">
                    <h4>
                        <b>Detail Pembelian
                            - <a href="/user/{{$user->slug}}/print/invoice/{{$order->no_order}}" target="_blank">
                            <span class="glyphicon glyphicon-print" aria-hidden="true"></span>Print Invoice</a>
                        </b>
                    </h4>
                    @foreach($carts as $item)
                        <tr>
                            <td><img src="/products/thumb/{{$item['item']['pictures'][0]['img']}}" width="80"></td>
                            <td>
                                <a href="/show/product/{{$item['item']['slug']}}" class="a-black">{{$item['item']['title']}}</a>
                                <p>Harga: <b><u>Rp {{number_format($item['item']['price'])}}</u></b></p>
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
                            @if($order->status < 2)
                                <form action="/user/{{$user->slug}}/payment/order/{{$order->no_order}}" method="POST" enctype="multipart/form-data">
                                    {{csrf_field()}}
                                    <div class="form-group">
                                        @if($order->payment->status==0)
                                            <label class="control-label">Unggah bukti pembayaran:</label>
                                        @elseif($order->payment->status==1)
                                            <label class="control-label">Ubah bukti pembayaran:</label>
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        <input type=text name="pengirim" class="form-control input-sm" value="{{old('name')}}" placeholder="Nama Pengirim" required>
                                    </div>
                                    <div class="form-group">
                                        <input type="file" name="resi_img" class="form-control input-sm" required>
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
                    @if($order->payment->status > 0)
                        <tr>
                            <td>
                                <a href="/resi/{{$order->payment->resi_img}}">
                                    <img src="/resi/{{$order->payment->resi_img}}" width="50">
                                </a>
                            </td>
                            <td>Pengirim: {{$order->payment->pengirim}} - <a href="/resi/{{$order->payment->resi_img}}">Buka Gambar</a></td>
                        </tr>
                    @endif
                    <tr>
                        <td>Jasa Pengiriman:</td>
                        <td>{{strtoupper($order->kurir)}} - {{$order->services}}</td>
                    </tr>
                    @if($order->status > 2)
                        <tr>
                            <td>No Resi:</td>
                            <td><b>{{$order->kurir_resi}}</b></td>
                        </tr>
                    @endif
                    <tr>
                        <td>Catatan:</td>
                        <td>{{$order->note}}</td>
                    </tr>
                    <tr>
                        <td>Alamat:</td>
                        <td>
                            {!! nl2br($order->address->address) !!}
                            <p>Kecamatan {{$order->address->kecamatan}}</p>
                            <p>{{$order->address->kabupaten}} - {{$order->address->postal_code}}</p>
                        </td>
                    </tr>
                    <tr class="warning">
                        <td>Harga Barang</td>
                        <td>Rp {{number_format($subTotalPrice)}}</td>
                    </tr>
                    <tr class="warning">
                        <td>Ongkor Kirim</td>
                        <td>Rp {{number_format($order->ongkir)}}</td>
                    </tr>
                    <tr class="success">
                        <td><b>Total Tagihan:</b></td>
                        <td><b>Rp {{number_format($order->total_price)}}</b></td>
                    </tr>
                </table>
            </div>
        </div>

    </div>
</div>
@endsection
