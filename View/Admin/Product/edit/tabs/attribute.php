<?php $product = $this->getProduct()->getData(); ?>
<?php $attributes = $this->getAttribute()->getData(); ?>
<?php if($product): ?>
<div class="container-fluid m-0 p-4 col justify-content-center">
	<div class="row m-0 p-1">
		<button type="button" class="btn btn-success" onclick="object.setForm().setUrl('<?php echo $this->getUrl()->getUrl('save', 'Admin\Product\Attribute'); ?>').load();">Save</button>
	</div>
	<div class="col m-0 p-1">
		<?php if (count($attributes)) :?>
			<?php foreach ($attributes as $key => $attribute) :?>
				<?php if($attribute->inputType == 'select'): ?>
					<div class="row m-0 p-1">
						<div class="col-4 m-0 p-1">
							<h5><?php echo $attribute->name; ?></h5>
						</div>
						<div class="col-7 m-0 p-0">
							<select name="attribute[<?php echo $attribute->code; ?>]">
								<?php $options = $this->getAttributeOption($attribute->attributeId)->getData(); ?>
								<?php foreach ($options as $key => $option): ?>
									<option value="<?php echo $option->name; ?>" <?php if($option->name == $product[$option->code]){ echo "selected";} ?> >
										<?php echo $option->name; ?>
									</option>
								<?php endforeach; ?>
							</select>
						</div>
					</div>					
				<?php elseif($attribute->inputType == 'radio'): ?>
					<div class="row m-0 p-1">
						<div class="col-4 m-0 p-1">
							<h5><?php echo $attribute->name; ?></h5>
						</div>
						<div class="col-7 m-0 p-0">
							<?php $options = $this->getAttributeOption($attribute->attributeId)->getData(); ?>
							<?php foreach ($options as $key => $option): ?>
								<input class="p-1" type="<?php echo $attribute->inputType; ?>" name="attribute[<?php echo $attribute->code; ?>]" value="<?php echo $option->name; ?>" <?php if($option->name == $product[$option->code]){ echo "checked";} ?>>
								<?php echo $option->name; ?>
							<?php endforeach; ?>
						</div>
					</div>
				<?php else: ?>
					<div class="row m-0 p-1">
						<div class="col-4 m-0 p-1">
							<h5><?php echo $attribute->name; ?></h5>
						</div>
						<div class="col-7 m-0 p-0">
							<input type="<?php echo $attribute->inputType; ?>" name="attribute[<?php echo $attribute->code; ?>]" value="<?php echo $product[$attribute->code]; ?>" required>
						</div>
					</div>
				<?php endif; ?>
			<?php endforeach; ?>
		<?php else: ?>
			<center><p>No Attribute Available</p></center>
		<?php endif; ?>
	</div>	
</div>
<?php else: ?>
	<center><h5>Add Product First</h5></center>
<?php endif; ?>