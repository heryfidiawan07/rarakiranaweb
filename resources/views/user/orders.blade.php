<h4 class="text-center"><b>TRANSAKSI</b></h4>
@foreach($user->orders as $order)
	<p>
		<b>No Order: <a href="/user/{{$user->slug}}/payment/{{$order->no_order}}">{{$order->no_order}}</a></b>
		- <small><i>{{ date('d F, Y', strtotime($order->created_at))}}</i></small>
	</p>
@endforeach
<hr>