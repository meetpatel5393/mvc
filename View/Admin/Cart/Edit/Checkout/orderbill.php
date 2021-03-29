<?php $items = $this->getCart()->getItems()->getData(); ?>
<?php $shippingCharge = $this->getCart()->shippingAmount; ?>
<?php $total = null; ?>
<div class="container-fluid m-0 p-0">
	<div class="container-fluid m-0 p-0 row">
		<h3>Order Summary</h3>
	</div>
	<table class="table">
		<tbody>
			<tr>
				<th>ProductId</th>
				<th>Quantity</th>
				<th>Total</th>
			</tr>			
			<?php foreach ($items as $item): ?>				
				<tr>
					<td><?php echo $item->productId; ?></td>
					<td><?php echo $item->quantity; ?></td>
					<td><?php echo $item->price;  ?></td>
					<?php $total+= $item->price; ?>
				</tr>
			<?php endforeach ?>
			<tr>
				<th colspan="2">Shipping Charge</th>
				<td><?php echo $shippingCharge; ?></td>
			</tr>
			<tr>
				<th colspan="2">Total</th>
				<td><?php echo $total+$shippingCharge; ?></td>
			</tr>
		</tbody>
	</table>
</div>