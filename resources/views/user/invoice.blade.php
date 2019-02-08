<h2 id="webName">RARAKIRANA</h2><hr>

<table width="70%" align="left">
    <tr>
      <th></th>
      <th align="left">Invoice</th>
    </tr>
  	<tr>
		<td align="left"><?=$order->payment->no_invoice ?></td>
 		<td align="left">No Invoice</td>
  	</tr>
  	<tr>
  		<td align="left"><?=date_format($order->payment->created_at,"Y/m/d") ?></td>
 		<td align="left">Tanggal</td>
  	</tr>
</table>
<hr>
<table width="100%" align="left">
  	<tr>
  		<th align="left">Subtotal</th>
  		<th align="left">Harga Barang</th>
  		<th align="center">Berat</th>
  		<th align="center">Qty</th>
		  <th align="left">Nama Produk</th>
  	</tr>
  	<?php foreach ($carts as $item) : ?>
  	<tr>
  		<td align="left">Rp <?=number_format($item['price']) ?></td>
  		<td align="left">Rp <?=number_format($item['item']['price']) ?></td>
  		<td align="center"><?=$item['item']['weight'].'kg' ?></td>
  		<td align="center"><?=$item['qty'] ?></td>
  		<td align="left">...<?=substr($item['item']['title'], -150, 20) ?></td>
  	</tr>
  	<?php endforeach ?>
  	<tr id="sub-price">
  		<td align="left"><b>Rp <?=number_format($subTotalPrice) ?><b></td>
  		<td align="left" colspan="5"><b>Subtotal</b></td>
  	</tr>
    <tr><td colspan="6"><hr></td></tr>
  	<tr>
		<td align="left">Rp <?=$order->ongkir ?></td>
		<td align="center"></td>
  		<td align="center"><?=$order->total_weight/1000 ?>kg</td>
  		<td align="left" colspan="2"><b><?=strtoupper($order->kurir) ?></b> - <?=$order->services ?></td>
  	</tr>
  	<tr id="sub-price">
  		<td align="left"><b>Rp <?=number_format($order->ongkir) ?><b></td>
  		<td align="left" colspan="5"><b>Subtotal</b></td>
  	</tr>
    <tr><td colspan="6"><hr></td></tr>
  	<tr id="sub-price">
  		<td align="left"><b>Rp <?=number_format($order->total_price) ?><b></td>
  		<td align="left" colspan="5"><b>Total Tagihan</b></td>
  	</tr>
</table>
