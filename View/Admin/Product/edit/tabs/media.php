<h2>Media Grid</h2>
<?php if ($this->validProduct()) : ?>
	<button type="button" class="btn btn-danger float-right" onclick="object.update(this.id).setUrl('<?php echo $this->getUrl()->getUrl('upload', 'Admin\Product\Media'); ?>').load();" id="removeMedia">Remove</button>
	<button type="button" class="btn btn-primary float-right mr-2" onclick="object.update(this.id).setUrl('<?php echo $this->getUrl()->getUrl('upload', 'Admin\Product\Media'); ?>').load();" id="updateMedia">Update</button>
<?php endif; ?>
<table class="table" id="mediaGrid">
	<?php $productMedias = $this->getProductMedias()->getData(); ?>
	<tr>
		<th>Image</th>
		<th>Label</th>
		<th>Small</th>
		<th>Thumb</th>
		<th>Base</th>
		<th>Gallery</th>
		<th>Remove</th>
	</tr>
	<?php if($productMedias) : ?>
		<?php foreach ($productMedias as $key => $productMedia) : ?>
		<tr>
			<td><img class="m-0 p-0" width="50px" height="50px" src="<?php echo './image/product/'.$productMedia->imageName; ?>"></td>
			<td><input type="text" name="label[<?php echo $productMedia->imageName; ?>]" value="<?php echo $productMedia->label; ?>"></td>
			<td><input type="radio" name="small[]" <?php if($productMedia->small == 1){ echo "checked"; } ?> value="<?php echo $productMedia->imageName; ?>"></td>
			<td><input type="radio" name="thumb[]" <?php if($productMedia->thumb == 1){ echo "checked"; } ?> value="<?php echo $productMedia->imageName; ?>"></td>
			<td><input type="radio" name="base[]" <?php if($productMedia->base == 1){ echo "checked"; } ?> value="<?php echo $productMedia->imageName; ?>"></td>
			<td><input type="checkbox" <?php if($productMedia->gallery == 'on'){ echo "checked"; } ?> name="gallery[<?php echo $productMedia->imageName; ?>]"></td>
			<td><input type="checkbox" name="remove[<?php echo $productMedia->imageName; ?>]"></td>
		</tr>
		<?php endforeach; ?>
	<?php endif; ?>
</table>

<?php if ($this->validProduct()): ?>
<div>
	<input type="file" id="file" required="">
	<button type="button" class="btn btn-success" id='upload' onclick="object.setUrl('<?php echo $this->getUrl()->getUrl('upload', 'Admin\Product\Media'); ?>').upload(this.id);" >Upload</button>
</div>
<?php else : ?>
	<center><p>Add Product First</p></center>
<?php endif; ?>