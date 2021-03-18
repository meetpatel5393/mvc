<?php
$title    = 'Index';
$products = $this->getProducts();
?>
<div class="container-fluid m-0 p-4 col justify-content-center">
	<div class="row m-0 p-1">
		<button class="btn btn-success" onclick="object.setUrl('<?php echo $this->getUrl()->getUrl('show', 'Admin\Product', [], true); ?>').resetParams().load();">Create Product</button>
	</div>
	<h3>Product Grid</h3>
	<table class="table">
		<tr>
			<th>Product Id</th>
			<th>Name</th>
			<th>Sku</th>
			<th>Price</th>
			<th>Discount</th>
			<th>Quantity</th>
			<th>Description</th>
			<th>Status</th>
			<th colspan="3">Action</th>
		</tr>
		<?php if ($products) :?>
			<?php foreach ($products->getData() as $key => $product) :?>
			<tr>
				<td><?php echo $product->productId; ?></td>
				<td><?php echo $product->name; ?></td>
				<td><?php echo $product->sku; ?></td>
				<td><?php echo $product->price; ?></td>
				<td><?php echo $product->discount; ?></td>
				<td><?php echo $product->quantity; ?></td>
				<td><?php echo $product->description; ?></td>
				<td><?php echo $product->status; ?></td>
				<td>
					<button class='btn p-0 m-0 pr-3' onclick="object.setUrl('<?php echo $this->getUrl()->getUrl('delete', 'Admin\Product', ['productId' => $product->productId]); ?>').resetParams().load();"><i class="fa fa-trash" aria-hidden="true"></i></button>

					<button class='btn p-0 m-0 pr-3' onclick="object.setUrl('<?php echo $this->getUrl()->getUrl('show', 'Admin\Product', ['productId' => $product->productId]); ?>').resetParams().load();"><i class='fa fa-pencil' aria-hidden='true'></i></button>
				</td>
				<td>
					<button class="btn p-2 m-0 <?php if($product->status==1){ echo 'btn-success';}else{ echo 'btn-danger';} ?>" onclick="object.setUrl('<?php echo $this->getUrl()->getUrl('changeStatus', 'Admin\Product', ['productId' => $product->productId]); ?>').resetParams().load();">
						<?php if ($product->status == 1): ?>
						<?php echo 'Enabled' ?>
						<?php else: ?>
						<?php echo 'Disabled' ?>
						<?php endif;?>
					</button>
				</td>
			</tr>
			<?php endforeach; ?>
		<?php endif; ?>
		<?php if (!$products): ?>
			<center><p>No Product Available</p></center>
		<?php endif; ?>
	</table>
</div>