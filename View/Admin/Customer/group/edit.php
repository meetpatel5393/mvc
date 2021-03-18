<?php
	$customerGroup = $this->getTableRow();
	$arrayOfStatus = $this->getArrayOfStatus();
?>
<form method="post" action="<?php echo $this->getUrl()->getUrl('save', 'Admin\Customer\Group'); ?>" id="groupForm">
	<div class="container-fluid m-0 p-2 row">
		<h3><?php if (!$customerGroup->groupId) { echo "Add Customer Group";} ?></h3>
		<h3><?php if ($customerGroup->groupId) { echo "Update Customer Group";} ?></h3>
	</div>
	<div class="row m-0 p-0">
		<div class="col-md-2 m-0 p-0">
			<p>Group Name</p>
		</div>
		<div class="col-md-5 m-0 p-0">
			<input type="text" name="group[name]" required="" value="<?php echo $customerGroup->name ?>">
		</div>
	</div>
	<div class="row m-0 p-0">
		<div class="col-md-2 m-0 p-0">
			<p>Status</p>
		</div>
		<div class="col-md-5 m-0 p-0">
			<?php foreach ($arrayOfStatus as $key => $value) : ?>
				<input type="radio" name="group[status]" value="<?php echo $key; ?>" 
				<?php if($customerGroup->groupId && $customerGroup->status == $key) { echo 'checked';} ?> required="">
				<?php echo $value; ?>
			<?php endforeach; ?>
		</div>
	</div>
	<div class="row m-0 p-0">
		<div class="col-md-2 m-0 p-0">
			<button type="button" onclick="object.setForm().load();" class="btn btn-success"><?php if (!$customerGroup->groupId)  { echo "Add";} else {echo 'Update';} ?></button>
		</div>
	</div>
</form>