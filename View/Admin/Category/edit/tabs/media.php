<h2>Media Grid</h2>
<?php if ($this->validCategory()) : ?>
	<button type="button" class="btn btn-danger float-right" onclick="object.update(this.id).setUrl('<?php echo $this->getUrl()->getUrl('upload', 'Admin\Category\Media'); ?>').load();" id="removeMedia">Remove</button>
	<button type="button" class="btn btn-primary float-right mr-2" onclick="object.update(this.id).setUrl('<?php echo $this->getUrl()->getUrl('upload', 'Admin\Category\Media'); ?>').load();" id="updateMedia">Update</button>
<?php endif; ?>
<table class="table" id="mediaGrid">
	<?php $categoryMedias = $this->getCategoryMedias()->getData(); ?>
	<tr>
		<th>Image</th>
		<th>Icon</th>
		<th>Base</th>
		<th>Banner</th>
		<th>Active</th>
		<th>Remove</th>
	</tr>
	<?php if($categoryMedias) : ?>
		<?php foreach ($categoryMedias as $key => $categoryMedia) : ?>
		<tr>
			<td><img class="m-0 p-0" width="50px" height="50px" src="<?php echo './Media/Category/'.$categoryMedia->imageName; ?>"></td>
			<td><input type="radio" name="icon[]" <?php if($categoryMedia->icon == 1){ echo "checked"; } ?> value="<?php echo $categoryMedia->imageName; ?>"></td>
			<td><input type="radio" name="base[]" <?php if($categoryMedia->base == 1){ echo "checked"; } ?> value="<?php echo $categoryMedia->imageName; ?>"></td>
			<td><input type="checkbox" <?php if($categoryMedia->banner == 1){ echo "checked"; } ?> name="banner[<?php echo $categoryMedia->imageName; ?>]"></td>
			<td></td>
			<td><input type="checkbox" name="remove[<?php echo $categoryMedia->imageName; ?>]"></td>
		</tr>
		<?php endforeach; ?>
	<?php endif; ?>
</table>

<?php if ($this->validCategory()): ?>
<div>
	<input type="file" id="file" required="">
	<button type="button" class="btn btn-success" id='upload' onclick="object.setUrl('<?php echo $this->getUrl()->getUrl('upload', 'Admin\Category\Media'); ?>').upload(this.id);" >Upload</button>
</div>
<?php else : ?>
	<center><p>Add Category First</p></center>
<?php endif; ?>