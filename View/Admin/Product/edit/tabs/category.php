<?php $categorys = $this->getCategorys()->getData(); ?>
<?php if($this->validProduct()): ?>
<?php $productCategory = $this->getProductCategory(); ?>
<div class="container-fluid m-0 p-1">
	<div class="col-md-10 m-0 p-0">
		<div class="row m-0 p-1">
			<h5>Select Category</h5>
		</div>
		<div class="row m-0 p-1">
			<select name='category[categoryId]' required="" class="m-0 p-0 form-control">
				<?php foreach ($categorys as $category): ?>
					<option value="<?php echo $category->categoryId ?>"
						<?php if($productCategory->categoryId == $category->categoryId) {echo "selected";} ?> >
						<?php echo $category->path; ?>
					</option>
				<?php endforeach; ?>
			</select>
		</div>
		<div class="row m-0 p-1">
			<button type="button" class="btn btn-success" onclick="object.setForm().setUrl('<?php echo $this->getUrl()->getUrl('saveCategory'); ?>').load();">Save Category</button>
		</div>
	</div>
</div>
<?php else: ?>
	<center><p>Please Enter Product First</p></center>
<?php endif; ?>