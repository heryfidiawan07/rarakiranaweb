<h2 align="center" id="webName">{{ config('app.name') }}</h2>

<table width="70%" align="left">
    <tr>
      <th align="left"><h3>Offering Letter</h3></th>
    </tr>
</table>

<div style="border: 0.5px solid grey;"></div>

<table width="70%" align="left">
    <tr>
      <td align="left"><?=$offer->title ?></td>
      <td align="left">Subject</td>
    </tr>
    <tr>
      <td align="left"><?=$offer->email ?></td>
      <td align="left">Email</td>
    </tr>
    <tr>
      <td align="left"><?=$offer->phone ?></td>
      <td align="left">Phone</td>
    </tr>
    <tr>
      <td align="left"><?=$offer->description ?></td>
      <td align="left">Description</td>
    </tr>
</table>

<hr><br><br>

<table width="70%" align="left">
    <tr>
      <th align="left"><h3>Product Details</h3></th>
    </tr>
</table>

<div style="border: 0.5px solid grey;"></div>

<table width="70%" align="left">
    <tr>
      <td align="left"><?=$product->title ?></td>
      <td align="left">Title</td>
    </tr>
    <tr>
      <td align="left">
        <img src="<?=$img.$product->pictures[0]->img ?>" width="100">
        <td align="left">Image</td>
      </td>
    </tr>
    <tr>
      <td align="left"><?=number_format($product->price) ?></td>
      <td align="left">Price</td>
    </tr>
    <tr>
      <td align="left">Rp <?=number_format($product->discount) ?></td>
      <td align="left">Discount</td>
    </tr>
    <tr>
      <td align="left"><?=$product->description ?></td>
      <td align="left">Description</td>
    </tr>
</table>