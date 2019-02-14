@if($user->orders->count())
	<h4 class="text-center"><b>TRANSAKSI</b></h4>
	@foreach($user->orders as $order)
		<p>
			<b>No Order: <a href="/user/{{$user->slug}}/payment/{{$order->no_order}}">{{$order->no_order}}</a></b>
			@if($order->status==0)
				<span class="warning">- Menunggu pembayaran</span>
			@elseif($order->status==1)
				<span class="warning">- Menunggu konfirmasi</span>
			@elseif($order->status==2)
				<span class="success">- Pesanan sedang di prosses</span>
			@elseif($order->status==3)
				<span class="success">- Pesanan dalam pengiriman oleh kurir</span> - 
			@elseif($order->status==4)
				<span class="success">- Transaksi selesai</span>
			@elseif($order->status==5)
				<span class="danger">Pesanan anda di tolak</span>
			@endif
			- <small><i>{{ date('d F, Y', strtotime($order->created_at))}}</i></small>
		</p>
	@endforeach
	<hr>
@endif