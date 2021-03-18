<?php $attributes = $this->getAttributes()->getData(); ?>
<div class="container-fluid m-0 p-4 col">
	<div class="row m-0 p-1">
		<button class="btn btn-success" onclick="object.setUrl('<?php echo $this->getUrl()->getUrl('show','Admin\Attribute',null,true);?>').resetParams().load();"> Create Attribute </button>
	</div>
	<h3>Attribute Grid</h3>
	<table class="table">
		<tr>
			<th>Attribute Id</th>
			<th>Entity Type Id</th>
			<th>Name</th>
			<th>Code</th>
			<th>Input Type</th>
			<th>Backend Type</th>
			<th colspan="2">Action</th>
		</tr>
		<?php if($attributes): ?>
			<?php foreach ($attributes as $attribute): ?>
				<tr>
					<td><?php echo $attribute->attributeId; ?></td>
					<td><?php echo $attribute->entityTypeId; ?></td>
					<td><?php echo $attribute->name; ?></td>
					<td><?php echo $attribute->code; ?></td>
					<td><?php echo $attribute->inputType; ?></td>
					<td><?php echo $attribute->backendType; ?></td>
					<td>
						<button class='btn p-0 m-0 pr-3' onclick="object.setUrl('<?php echo $this->getUrl()->getUrl('delete', 'Admin\Attribute', ['attributeId' => $attribute->attributeId]); ?>').resetParams().load();"><i class="fa fa-trash" aria-hidden="true"></i></button>

						<button class='btn p-1 m-0 border' onclick="object.setUrl('<?php echo $this->getUrl()->getUrl('show', 'Admin\Attribute\Option', ['attributeId' => $attribute->attributeId]); ?>').resetParams().load();">Add Option</button>
					</td>
				</tr>
			<?php endforeach; ?>
		<?php else: ?>
			<p>No Attribute Available</p>
		<?php endif; ?>
	</table>
</div>