<?php if ($cart = $this->getCart()): ?>
	<?php $cartItems = $this->getCart()->getItems()->getData(); ?>
	<div class="container-fluid m-0 p-2 row">
		<form action="<?php echo $this->getUrl()->getUrl('updateCart','Admin\Cart'); ?>" method="post" id="cartForm">
			<div class="container-fluid m-1 p-0 row">
				<button type="button" class="btn btn-primary" onclick="object.setForm(this).load();">Update Cart</button>
			</div>
			<table class="table">
				<tr>
					<th>Id</th>
					<th>Product Id</th>
					<th>Price</th>
					<th>Quantity</th>
					<th>Row Total</th>
					<th>Discount</th>
					<th>Final Total</th>
					<th>Action</th>
				</tr>
				<?php foreach ($cartItems as $item): ?>
					<tr>
						<td><?php echo $item->cartItemId; ?></td>
						<td><?php echo $item->productId; ?></td>
						<td><?php echo $item->basePrice; ?></td>
						<td>
							<input type="number" name="quantity[<?php echo $item->cartItemId; ?>]" value="<?php echo $item->quantity; ?>">
						</td>
						<td><?php echo $item->basePrice * $item->quantity; ?></td>
						<td><?php echo $item->discount; ?></td>
						<td><?php echo $item->price; ?></td>
						<td>
							<button type='button' class="btn btn-outline-danger" 
							onclick="object.setUrl('<?php echo $this->getUrl()->getUrl('removeFromCart','Admin\Cart',['cartItemId'=>$item->cartItemId]); ?>').load();">Remove From Cart</button>
						</td>
					</tr>
				<?php endforeach; ?>
			</table>
		</form>
		<div class="container-fluid m-0 p-2">
			<button class="btn btn-outline-dark" type="button" 
					onclick="object.setUrl('<?php echo $this->getUrl()->getUrl('checkout','Admin\Cart'); ?>').load();">
				Process to checkout
			</button>
		</div>
	</div>
<?php else: ?>
	<center><p>Select customer first</p></center>
<?php endif; ?>