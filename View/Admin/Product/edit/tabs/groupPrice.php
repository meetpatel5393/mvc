<?php if($this->validProduct()): ?>
<?php $groupsPrice = $this->getGroupsPrice()->getData(); ?>
<div class="container-fluid m-0 p-4 col justify-content-center">
	<div class="row m-0 p-1">
		<button type="button" class="btn btn-success" onclick="object.setForm().setUrl('<?php echo $this->getUrl()->getUrl('save', 'Admin\Product\GroupPrice'); ?>').load();">Update</button>
	</div>
	<table class="table">
		<tr>
			<th>Group Id</th>
			<th>Group Name</th>
			<th>Product Price</th>
			<th>Group Price</th>
		</tr>
		<?php if(!count($groupsPrice)): ?>
			<center><h6>No Customer Group Available</h6></center>
		<?php else: ?>
			<?php foreach ($groupsPrice as $key => $value): ?>
				<tr>
					<td> <?php echo $value->groupId; ?> </td>
					<td> <?php echo $value->name; ?> </td>
					<td> <?php echo $value->price; ?> </td>
					<?php $status = ($value->entityId) ? 'exits' : 'new'; ?>
					<td> 
						<input type="number" name="groupsPrice[<?php echo $status ?>][<?php echo $value->groupId; ?>]" value="<?php echo $value->groupPrice; ?>">
					</td>
				</tr>
			<?php endforeach; ?>
		<?php endif; ?>
	</table>
</div>
<?php else: ?>
	<center><h5>Please Add Product First</h5></center>
<?php endif; ?>