<?php 
	$customerGroups = $this->getCustomerGroup();
?>
<div class="container-fluid m-0 p-4  col justify-content-center">
	<div class="row m-0 p-1">
		<button type="button" class="btn btn-success" onclick="object.setUrl('<?php echo $this->getUrl()->getUrl('show','Admin\Customer\Group',null,true);?>').resetParams().load();">Add Customer Group</button>
	</div>
	<h3>Customer Group</h3>
	<table class="table">
		<tr>
			<th>Group Id</th>
			<th>Name</th>
			<th>Status</th>
			<th>Created Date</th>
			<th colspan="2">Action</th>
		</tr>
		<?php if($customerGroups) : ?>
			<?php foreach ($customerGroups->getData() as $key => $customerGroup) : ?>
			<tr>
				<td><?php echo $customerGroup->groupId; ?></td>
				<td><?php echo $customerGroup->name; ?></td>
				<td><?php echo $customerGroup->status; ?></td>
				<td><?php echo $customerGroup->createdDate; ?></td>
				<td>
					<button class='btn p-0 m-0 pr-3' onclick="object.setUrl('<?php echo $this->getUrl()->getUrl('delete','Admin\Customer\Group',['groupId'=>$customerGroup->groupId]);?>').resetParams().load();"><i class="fa fa-trash" aria-hidden="true"></i> </button>

					<button class='btn p-0 m-0 pr-3' onclick="object.setUrl('<?php echo $this->getUrl()->getUrl('show','Admin\Customer\Group',['groupId'=>$customerGroup->groupId]);?>').resetParams().load();"><i class="fa fa-pencil" aria-hidden="true"></i> </button>
				</td>
				<td>
					<button class="btn p-2 m-0 <?php if($customerGroup->status==1){ echo 'btn-success';}else{ echo 'btn-danger';} ?>" onclick="object.setUrl('<?php echo $this->getUrl()->getUrl('changeStatus', 'Admin\Customer\Group', ['groupId' => $customerGroup->groupId]); ?>').resetParams().load();">
						<?php if ($customerGroup->status == 1): ?>
						<?php echo 'Enabled' ?>
						<?php else: ?>
						<?php echo 'Disabled' ?>
						<?php endif;?>
					</button>
				</td>
			</tr>
			<?php endforeach; ?>
		<?php endif; ?>
		<?php if(!$customerGroups) : ?>
			<center><p>No Customer Group Available</p></center>
		<?php endif; ?>
	</table>
</div>