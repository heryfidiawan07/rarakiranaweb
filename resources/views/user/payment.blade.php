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
                                @if($order->status==4)
                                @foreach($products->where('id',$item['item']['id']) as $product)
                                @if($product->review)
                                    <div class="alert alert-info">
                                        <p><b>Ulasan:</b></p>
                                        {!! nl2br($product->review->description) !!}
                                    </div>
                                @endif
                                @endforeach
                                @endif
                            </td>
                        </tr>
                        @if($order->status==4)
                        @foreach($products->where('id',$item['item']['id']) as $product)
                        @if(!$product->review)
                        <tr>
                            <td>Beri Ulasan</td>
                            <td>
                                <form method="POST" action="/send-review/product/{{$item['item']['slug']}}">
                                    {{csrf_field()}}
                                    <textarea rows="2" class="form-control" name="review" required></textarea>
                                    <button class="btn btn-warning btn-sm">
                                        <span class="glyphicon glyphicon-send" aria-hidden="true"></span>
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @endif
                        @endforeach
                        @endif
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
                                <a type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#cancel-order">Batalkan Pesanan <span class="caret"></span></a>
                                    
                                <div class="modal fade" id="cancel-order" tabindex="-1" role="dialog" aria-labelledby="cancel-order-label" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-body text-center">
                                                <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">CLOSE</button>
                                                <a href="/user/{{$user->slug}}/cancel/order/{{$order->no_order}}" class="btn btn-danger btn-sm">Batalkan Pesanan</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <hr>
                            @elseif($order->status==1)
                                <span class="warning">Menunggu konfirmasi</span>
                            @elseif($order->status==2)
                                <span class="success">Pesanan sedang di prosses</span>
                            @elseif($order->status==3)
                                <span class="success">Pesanan dalam pengiriman oleh kurir</span> - 
                                <a href="/user/{{$user->slug}}/done/order/{{$order->no_order}}" class="btn btn-success btn-sm">Konfirmasi pesnan telah diterima</a>
                                <hr>
                            @elseif($order->status==4)
                                <span class="success">Transaksi selesai</span>
                            @elseif($order->status==5)
                                <span class="danger">Pesanan anda di tolak</span>
                                <div class="alert alert-danger">{{$order->payment->keterangan}}</div>
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
                            @if($order->status < 1)
                                <form action="/user/{{$user->slug}}/payment/store/{{$order->no_order}}" method="POST" enctype="multipart/form-data">
                                    {{csrf_field()}}
                                    <div class="form-group">
                                        <label class="control-label">Unggah bukti pembayaran:</label>
                                    </div>
                                    <div class="form-group">
                                        <input type=text name="pengirim" class="form-control input-sm" value="{{old('name')}}" placeholder="Nama Pengirim" required>
                                    </div>
                                    <div class="form-group">
                                        <input type="file" name="resi_img" class="form-control input-sm" required>
                                        @if ($errors->has('resi_img'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('resi_img') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        <button class="btn btn-success btn-sm"><span class="glyphicon glyphicon-send"></span></button>
                                    </div>
                                </form>
                            @elseif($order->status < 2 || $order->status == 5)
                                <form action="/user/{{$user->slug}}/payment/update/{{$order->no_order}}" method="POST" enctype="multipart/form-data">
                                    {{csrf_field()}}
                                    <div class="form-group">
                                        <label class="control-label">Ubah :</label>
                                    </div>
                                    <div class="form-group">
                                        <input type=text name="updatePengirim" class="form-control input-sm" value="{{old('name')}}" placeholder="Nama Pengirim" required>
                                    </div>
                                    <div class="form-group">
                                        <input type="file" name="updateImgResi" class="form-control input-sm">
                                        @if ($errors->has('updateImgResi'))
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
                            <td>Pengirim: {{$order->payment->pengirim}} - <a href="/resi/{{$order->payment->resi_img}}" target="_blank">Buka Gambar</a></td>
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
                        <td>{!! nl2br($order->note) !!}</td>
                    </tr>
                    <tr>
                        <td>Alamat:</td>
                        <td>
                            {!! nl2br($order->address->address) !!}
                            <p>Kecamatan {{$order->address->kecamatan}}</p>
                            <p>{{$order->address->kabupaten}} - {{$order->address->postal_code}}</p>
                        </td>
                    </tr>
                    <tr class="info">
                        <td>Harga Barang</td>
                        <td>Rp {{number_format($subTotalPrice)}}</td>
                    </tr>
                    <tr class="info">
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