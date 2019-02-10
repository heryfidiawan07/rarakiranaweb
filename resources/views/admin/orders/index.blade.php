@extends('layouts.app')
@section('css')
    <link rel="stylesheet" type="text/css" href="/css/dashboard.css">
@endsection
@section('content')
<div class="container">
    <div class="row">
        
        @include('admin.dashboard-menu')
        <div class="col-md-4">
            <div class="text-center"><h4>SET UP ADMIN ADDRESS</h4></div>
            <form method="POST" action="/admin/address/store">
                {{csrf_field()}}
                <div class="form-group">
                    <input type="text" name="kabupaten" id="kabupaten" class="form-control input-sm" placeholder="Kabupaten" autocomplete="off" @if($address) value="{{$address->kabupaten}}" @endif required>
                    <input type="hidden" name="kabHidden" id="kabHidden" @if($address) value="{{$address->kab_id}}" @endif>
                    @if ($errors->has('kabupaten'))
                        <span class="help-block">
                            <strong>{{ $errors->first('kabupaten') }}</strong>
                        </span>
                    @endif
                    <div id="list-kabupaten-frame">
                        <table id="list-kabupaten" class="table table-hover">
                            @for($i = 0; $i < count($kabupaten); $i++)
                                <tr>
                                    <td class="list-kabupaten-item" data-id="{{$kabupaten[$i]['city_id']}}" data-name="{{$kabupaten[$i]['city_name']}}" postal-code="{{$kabupaten[$i]['postal_code']}}">{{$kabupaten[$i]['type']}} - {{$kabupaten[$i]['city_name']}} - {{$kabupaten[$i]['province']}}</td>
                                </tr>
                            @endfor
                        </table>
                    </div>
                </div>
                <div class="form-group">
                    <input type="text" name="kecamatan" id="kecamatan" class="form-control input-sm" placeholder="Kecamatan" autocomplete="off" @if($address) value="{{$address->kecamatan}}" @endif readonly required>
                    <input type="hidden" name="kecHidden" id="kecHidden" @if($address) value="{{$address->kec_id}}" @endif>
                    @if ($errors->has('kecamatan'))
                        <span class="help-block">
                            <strong>{{ $errors->first('kecamatan') }}</strong>
                        </span>
                    @endif
                </div>
                <div class="form-group">
                    <input type="text" name="postal_code" id="postal_code" class="form-control input-sm" placeholder="Kode Pos" autocomplete="off" @if($address) value="{{$address->postal_code}}" @endif readonly required>
                </div>
                <div class="form-group">
                    <input type="text" name="phone" id="phone" class="form-control input-sm" placeholder="Nomor Telephone" autocomplete="off" @if($address) value="{{$address->phone}}" @endif required>
                </div>
                <button class="btn btn-primary btn-sm"><span class="glyphicon glyphicon-send"></span></button>
            </form>
            <hr>
            <div class="text-center"><h4>ADMIN ADDRESS</h4></div>
            <table class="table">
                <tr>
                    <td>Kabupaten</td>
                    <td>{{$address->kabupaten}}</td>
                </tr>
                <tr>
                    <td>Kecamatan</td>
                    <td>{{$address->kecamatan}}</td>
                </tr>
                <tr>
                    <td>Kode Pos</td>
                    <td>{{$address->postal_code}}</td>
                </tr>
                <tr>
                    <td>Nomor Hp</td>
                    <td>{{$address->phone}}</td>
                </tr>
            </table>
        </div>

        <div class="col-md-8">
            <div class="text-center"><h4>ORDER LIST</h4></div>
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