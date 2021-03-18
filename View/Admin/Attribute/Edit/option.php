<?php $attributeOptions = $this->getAttributeOptions()->getData(); ?>
<div class="container-fluid m-0 p-4">
	<form method="post" action="<?php echo $this->getUrl()->getUrl('save','Admin\Attribute\Option'); ?>" id="optionForm">
		<button type="button" class="btn btn-success" onclick="object.addOption();">Add Option</button>
		<button type="button" class="btn btn-primary" onclick="object.setForm().load()">Update</button>
		<div class="container-fluid m-0 p-2">
			<table>
				<tbody id="existingOption">
					<?php if ($attributeOptions) : ?>
						<?php foreach ($attributeOptions as $option): ?>
							<tr>
								<td><input type="text" name="exits[<?php echo $option->optionId ?>][name]" value="<?php echo $option->name ?>"></td>
								<td><input type="number" name="exits[<?php echo $option->optionId ?>][sortOrder]" value="<?php echo $option->sortOrder ?>"></td>
								<td><button type="button" class="btn btn-danger m-0 p-1" onclick="object.remove(this);">Remove Option</button></td>
							</tr>
						<?php endforeach; ?>
					<?php else: ?>
						<p>No Options Avialble For This Attribute</p>
					<?php endif; ?>
				</tbody>
			</table>
		</div>
	</form>
</div>


<div style="display: none;">
	<table id="newOption">
		<tbody>
			<tr>
				<td><input type="text" name="new[name][]"></td>
				<td><input type="number" name="new[sortOrder][]"></td>
				<td><button type="button" class="btn btn-danger m-0 p-1" onclick="object.remove(this);">Remove Option</button></td>
			</tr>
		</tbody>
	</table>
</div>