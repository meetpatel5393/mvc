<?php 
	$title = 'Create Category';
	$admin = $this->getTableRow();
	$arrayOfStatus = $this->getArrayOfStatus();
?>
<div class="container-fluid m-0 p-4">
<form method="post" action="<?php echo $this->getUrl()->getUrl('save','Admin\Admin');?>" id="adminForm">
	<div class="container-fluid m-0 p-2 row">
		<h3><?php if (!$admin->adminId) { echo "Create Admin";} ?></h3>
		<h3><?php if ($admin->adminId) { echo "Update Admin";} ?></h3>
	</div>
	<div class="container-fluid m-0 p-2">
		<div class="row m-0 p-0">
			<div class="col-md-2 m-0 p-0">
				<p>User Name</p>
			</div>
			<div class="col-md-5 m-0 p-0">
				<input type="text" name="admin[userName]" required="" value="<?php echo $admin->userName; ?>">
			</div>
		</div>
		<div class="row m-0 p-0">
			<div class="col-md-2 m-0 p-0">
				<p>Password</p>
			</div>
			<div class="col-md-5 m-0 p-0">
				<input type="password" name="admin[password]" required="" value="<?php echo $admin->password; ?>">
			</div>
		</div>
		<div class="row m-0 p-0">
			<div class="col-md-2 m-0 p-0">
				<p>Status</p>
			</div>
			<div class="col-md-5 m-0 p-0">
				<?php foreach ($arrayOfStatus as $key => $value): ?>
					<input type="radio" name="admin[status]" value="<?php echo $key; ?>" 
					<?php if($admin->adminId && $admin->status == $key): ?>
						<?php  echo 'checked'; ?>
					<?php endif; ?>
					 required="">
					<?php echo $value; ?>
				<?php endforeach; ?>
			</div>
		</div>
		<div class="row m-0 p-0">
			<div class="col-md-2 m-0 p-0">
				<button type="button" onclick="object.setForm().load();" class="btn btn-success"><?php if (!$admin->adminId) { echo "Create";} else {echo 'Update';} ?></button>
			</div>
		</div>
	</div>
</form>
</div>