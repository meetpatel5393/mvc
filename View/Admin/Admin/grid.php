<?php 
	$title = 'Admin';
	$admins = $this->getAdmins();
?>
<div class="container-fluid m-0 p-4">
	<div class="row m-0 p-1">
		<button class="btn btn-success" onclick="object.setUrl('<?php echo $this->getUrl()->getUrl('show','Admin\Admin',null,true); ?>').resetParams().load();">Create Admin</button>
	</div>
	<h3>Admin Grid</h3>
	<div class="container-fluid m-0 p-1">
		<table class="table">
			<tr>
				<th>Admin Id</th>
				<th>User Name</th>
				<th>Status</th>
				<th>Created Date</th>
				<th colspan="2">Action</th>
			</tr>
			<?php if($admins): ?>
				<?php foreach ($admins->getData() as $admin) : ?>
					<tr>
						<td><?php echo $admin->adminId; ?></td>
						<td><?php echo $admin->userName; ?></td>
						<td><?php echo $admin->status; ?></td>
						<td><?php echo $admin->createdDate; ?></td>
						<td>
							<button class='btn p-0 m-0 pr-3' onclick="object.setUrl('<?php echo $this->getUrl()->getUrl('delete','Admin\Admin',['adminId'=>$admin->adminId]);?>').resetParams().load();"><i class="fa fa-trash" aria-hidden="true"></i></button>

							<button class='btn p-0 m-0 pr-3' onclick="object.setUrl('<?php echo $this->getUrl()->getUrl('show','Admin\Admin',['adminId'=>$admin->adminId]);?>').resetParams().load();"><i class="fa fa-pencil" aria-hidden="true"></i></button>
						</td>
						<td>
							<button class="btn p-2 m-0 <?php if($admin->status==1){ echo 'btn-success';}else{ echo 'btn-danger';} ?>" onclick="object.setUrl('<?php echo $this->getUrl()->getUrl('changeStatus', 'Admin\Admin', ['adminId' => $admin->adminId]); ?>').resetParams().load();">
								<?php if ($admin->status == 1): ?>
									<?php echo 'Enabled' ?>
								<?php else: ?>
									<?php echo 'Disabled' ?>
								<?php endif;?>
							</button>
						</td>
					</tr>
				<?php endforeach; ?>
			<?php endif; ?>
			<?php if($admins == false) : ?>
			<?php echo "<center>No Admin Available</center>";?>
			<?php endif; ?>
		</table>
	</div>
</div>