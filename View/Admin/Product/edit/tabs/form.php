<?php 
	$product = $this->getProduct();
	$arrayOfStatus = $this->getArrayOfStatus();
	$productBrands = $this->getProductBrands()->getData();
?>
<div class="container-fluid m-0 p-2 row">
	<h3><?php if (!$product->productId) { echo "Create Product";} ?></h3>
	<h3><?php if ($product->productId) { echo "Update Product";} ?></h3>
</div>
<div class="row m-0 p-0">
	<div class="col-md-2 m-0 p-0">
		<p>Name</p>
	</div>
	<div class="col-md-5 m-0 p-0">
		<input type="text" name="product[name]" required="" value="<?php  echo $product->name; ?>">
	</div>
</div>
<div class="row m-0 p-0">
	<div class="col-md-2 m-0 p-0">
		<p>Sku</p>
	</div>
	<div class="col-md-5 m-0 p-0">
		<input type="number" name="product[sku]" required="" value="<?php echo $product->sku; ?>">
	</div>
</div>
<div class="row m-0 p-0">
	<div class="col-md-2 m-0 p-0">
		<p>Price</p>
	</div>
	<div class="col-md-5 m-0 p-0">
		<input type="number" name="product[price]" required="" value="<?php echo $product->price; ?>">
	</div>
</div>
<div class="row m-0 p-0">
	<div class="col-md-2 m-0 p-0">
		<p>Discount</p>
	</div>
	<div class="col-md-5 m-0 p-0">
		<input type="number" name="product[discount]" required="" value="<?php echo $product->discount; ?>">
	</div>
</div>
<div class="row m-0 p-0">
	<div class="col-md-2 m-0 p-0">
		<p>Quantity</p>
	</div>
	<div class="col-md-5 m-0 p-0">
		<input type="number" name="product[quantity]" required="" value="<?php echo $product->quantity; ?>">
	</div>
</div>
<div class="row m-0 p-0">
	<div class="col-md-2 m-0 p-0">
		<p>Status</p>
	</div>
	<div class="col-md-5 m-0 p-0">
		<?php foreach ($arrayOfStatus as $key => $value) : ?>
			<input type="radio" name="product[status]" value="<?php echo $key; ?>" 
			<?php if($product->productId && $product->status == $key) { echo 'checked';} ?> required="">
			<?php echo $value; ?>
		<?php endforeach; ?>
	</div>
</div>
<div class="row m-0 p-0">
	<div class="col-md-2 m-0 p-0">
		<p>Brand</p>
	</div>
	<div class="col-md-5 m-0 p-0">
		<select name="product[brandId]">
			<option selected="" value="0">Select Brand</option>
			<?php foreach ($productBrands as $key => $brand) : ?>
				<option value="<?php echo $brand->brandId; ?>" <?php if($brand->brandId == $product->brandId){echo 'selected';} ?>>
					<?php echo $brand->name; ?>
				</option>
			<?php endforeach; ?>
		</select>
	</div>
</div>
<div class="row m-0 p-0">
	<div class="col-md-2 m-0 p-0">
		<p>Description</p>
	</div>
	<div class="col-md-5 m-0 p-0">
		<textarea name="product[description]" rows="5" cols="23" required=""><?php echo $product->description; ?></textarea>
	</div>
</div>
<div class="row m-0 p-0">
	<div class="col-md-2 m-0 p-0">
		<button type="button" class="btn btn-success" onclick="object.setForm().load();" ><?php if (!$product->productId)  { echo "Create";} else {echo 'Update';} ?></button>
	</div>
</div>