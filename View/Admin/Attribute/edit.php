<?php $attribute = $this->getTableRow(); ?>
<form method="post" action="<?php echo $this->getUrl()->getUrl('save', 'Admin\Attribute'); ?>" id="attributeForm">
<div class="container-fluid m-0 p-4">
	<div class="container-fluid m-0 p-2 row">
		<h3><?php if(!$attribute->attributeId){ echo 'Create Attribute'; } ?></h3>
		<h3><?php if($attribute->attributeId){ echo 'Update Attribute'; } ?></h3>
	</div>
	<div class="container-fluid m-0 p-2">
		<div class="row m-0 p-0">
			<div class="col-md-2 m-0 p-0">
				<p>Entity Type</p>
			</div>
			<div class="col-md-5 m-0 p-0">
				<select name="attribute[entityTypeId]">
					<option value="" selected="" disabled="">select</option>
					<?php foreach ($attribute->getEntityTypeOption() as $key => $label): ?>
						<option value="<?php echo $key ?>"><?php echo $label; ?></option>
					<?php endforeach; ?>
				</select>
			</div>
		</div>
		<div class="row m-0 p-0">
			<div class="col-md-2 m-0 p-0">
				<p>Name</p>
			</div>
			<div class="col-md-5 m-0 p-0">
				<input type="text" name="attribute[name]" required="" >
			</div>
		</div>
		<div class="row m-0 p-0">
			<div class="col-md-2 m-0 p-0">
				<p>Code</p>
			</div>
			<div class="col-md-5 m-0 p-0">
				<input type="text" name="attribute[code]" required="">
			</div>
		</div>
		<div class="row m-0 p-0">
			<div class="col-md-2 m-0 p-0">
				<p>Backend Type</p>
			</div>
			<div class="col-md-5 m-0 p-0">
				<select name="attribute[backendType]">
					<option value="" selected="" disabled="">select</option>
					<?php foreach ($attribute->getBackEndTypeOption() as $key => $label): ?>
						<option value="<?php echo $key ?>"><?php echo $label; ?></option>
					<?php endforeach; ?>
				</select>
			</div>
		</div>
		<div class="row m-0 p-0">
			<div class="col-md-2 m-0 p-0">
				<p>Input Type</p>
			</div>
			<div class="col-md-5 m-0 p-0">
				<select name="attribute[inputType]">
					<option value="" selected="" disabled="">select</option>
					<?php foreach ($attribute->getInputTypeOption() as $key => $label): ?>
						<option value="<?php echo $key ?>"><?php echo $label; ?></option>
					<?php endforeach; ?>
				</select>
			</div>
		</div>
		<div class="row m-0 p-0">
			<div class="col-md-2 m-0 p-0">
				<p>Sort Order</p>
			</div>
			<div class="col-md-5 m-0 p-0">
				<input type="number" name="attribute[sortOrder]">
			</div>
		</div>
		<div class="row m-0 p-0">
			<div class="col-md-2 m-0 p-0">
				<p>Backend Model</p>
			</div>
			<div class="col-md-5 m-0 p-0">
				<input type="text" name="attribute[backendModel]">
			</div>
		</div>
		<div class="row m-0 p-0">
			<div class="col-md-2 m-0 p-0">
				<button id="saveAttribute" type="button" class="btn btn-success" onclick="object.setForm().load();" ><?php if (!$attribute->attributeId)  { echo "Create";} else {echo 'Update';} ?></button>
			</div>
		</div>
	</div>	
</div>
</form>