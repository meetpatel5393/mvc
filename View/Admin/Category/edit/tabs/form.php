<?php 
	$category = $this->getCategory();
	$arrayOfStatus = $this->getArrayOfStatus();
	$categoryDropDown = $this->getParentDropDown();
?>
<div class="container-fluid m-0 p-2 row">
	<h3><?php if (!$category->categoryId) { echo "Create Category";} ?></h3>
	<h3><?php if ($category->categoryId) { echo "Update Category";} ?></h3>
</div>
<div class="row m-0 p-0">
	<div class="col-md-2 m-0 p-0">
		<p>Parent Category</p>
	</div>
	<div class="col-md-5 m-0 p-0">
		<select name='category[parentId]' required="">
			<option value="0" selected="" disabled="">Select Parent</option>
			<?php foreach ($categoryDropDown as $categoryId => $categoryPath): ?>
				<option value="<?php echo $categoryId ?>" 
					<?php if($category->parentId == $categoryId){ echo 'selected';} ?> >
					<?php echo $categoryPath; ?>
				</option>
			<?php endforeach; ?>
		</select>
	</div>
</div>
<div class="row m-0 p-0">
	<div class="col-md-2 m-0 p-0">
		<p>Name</p>
	</div>
	<div class="col-md-5 m-0 p-0">
		<input type="text" name="category[name]" required="" value="<?php echo $category->name; ?>">
	</div>
</div>
<div class="row m-0 p-0">
	<div class="col-md-2 m-0 p-0">
		<p>Status</p>
	</div>
	<div class="col-md-5 m-0 p-0">
		<?php foreach ($arrayOfStatus as $key => $value) { ?>
			<input type="radio" name="category[status]" value="<?php echo $key; ?>" 
			<?php if($category->categoryId && $category->status == $key) { echo 'checked';} ?> required="">
			<?php echo $value; ?>
		<?php } ?>
	</div>
</div>
<div class="row m-0 p-0">
	<div class="col-md-2 m-0 p-0">
		<p>Description</p>
	</div>
	<div class="col-md-5 m-0 p-0">
		<textarea name="category[description]" rows="5" cols="23" required="">
			<?php echo $category->description; ?>
		</textarea>
	</div>
</div>
<div class="row m-0 p-0">
	<div class="col-md-2 m-0 p-0">
		<button type="button" class="btn btn-success" onclick="object.setForm().load();">
			<?php if (!$category->categoryId) { echo "Create";} else {echo 'Update';} ?>
		</button>
	</div>
</div>