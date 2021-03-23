<?php $arrayOfStatus = $this->getArrayOfStatus(); ?>
<?php $brand = $this->getTableRow(); ?>
<div class="container-fluid m-0 p-4">
<form method="post" id="brand">
	<div class="container-fluid m-0 p-2">
		<div class="row m-0 p-0">
			<div class="col-md-2 m-0 p-0">
				<p>Brand Name</p>
			</div>
			<div class="col-md-5 m-0 p-0">
				<input type="text" name="name" required="" value="<?php echo $brand->name; ?>">
			</div>
		</div>
		<div class="row m-0 p-0">
			<div class="col-md-2 m-0 p-0">
				<p>SortOrder</p>
			</div>
			<div class="col-md-5 m-0 p-0">
				<input type="number" name="sortOrder" required="" value="<?php echo $brand->sortOrder; ?>">
			</div>
		</div>
		<div class="row m-0 p-0">
			<div class="col-md-2 m-0 p-0">
				<p>Brand Image</p>
			</div>
			<div class="col-md-5 m-0 p-0">
				<input type="file" id="file" required="">
			</div>
		</div>
		<div class="row m-0 p-0">
			<div class="col-md-2 m-0 p-0">
				<p>Status</p>
			</div>
			<div class="col-md-5 m-0 p-0">
				<?php foreach ($arrayOfStatus as $key => $value): ?>
					<input type="radio" name="status" value="<?php echo $key; ?>" 
					<?php if($brand->brandId && $brand->status == $key): ?>
						<?php  echo 'checked'; ?>
					<?php endif; ?>
					 required="">
					<?php echo $value; ?>
				<?php endforeach; ?>
			</div>
		</div>
		<div class="row m-0 p-0">
			<div class="col-md-2 m-0 p-0">
				<button type="button" onclick="object.setUrl('<?php echo $this->getUrl()->getUrl('save','Admin\ProductBrand');?>').uploadBrandData();" class="btn btn-success" id="brandForm"><?php if (!$brand->brandId) { echo "Create";} else {echo 'Update';} ?></button>
			</div>
		</div>
	</div>
</form>
</div>