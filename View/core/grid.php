<?php $collection = $this->getCollection()->getData(); ?>
<?php $this->getFilter()->getFilters();?>
<form method="post" id='grid'>
	<div class="container-fluid m-0 p-4">
		<div class="row m-0 p-1">
			<?php foreach ($this->getButtons() as $key => $button) : ?>
				<?php $method = $button['method']; ?>
				<?php if($button['ajax']) : ?>
					<?php if ($key == 'applyFilter'): ?>
						<button type="button" class="<?php echo $button['class'] ?> m-1" onclick="object.setForm().setUrl('<?php echo $this->$method(); ?>').load();">
							<?php echo $button['label']; ?>
						</button>
					<?php else: ?>					
						<button type="button" class="<?php echo $button['class'] ?> m-1" onclick="object.setUrl('<?php echo $this->$method(); ?>').resetParams().load();">
							<?php echo $button['label']; ?>
						</button>
					<?php endif; ?>
				<?php else : ?>
					</button>
					<a class="<?php echo $button['class'] ?> m-1" href="<?php echo $this->$method(); ?>"><?php echo $button['label']; ?></a>
				<?php endif; ?>
			<?php endforeach; ?>
		</div>
		<h3><?php echo $this->getTitle(); ?></h3>
		<div class="container-fluid m-0 p-1">
			<table class="table">
				<tr>
					<?php foreach ($this->getColumns() as  $column): ?>
						<th><?php echo $column['label']; ?></th>
					<?php endforeach ?>
				</tr>

				<tr>
					<?php foreach ($this->getColumns() as  $column): ?>
						<?php if ($column['field'] != 'action'): ?>
							<td><input class="m-0 p-0" type="text" 
								name="filter[<?php echo $column['type'] ?>][<?php echo $column['field'] ?>]" style="width:100px;" 
								value="<?php echo $this->getFilter()->getFilterValue($column['type'], $column['field']); ?>">
							</td>
						<?php endif; ?>
					<?php endforeach; ?>
				</tr>

				<?php if (count($collection)): ?>
					<?php foreach ($collection as $key => $value): ?>
						<tr>
							<?php foreach ($this->getColumns() as $column): ?>
								<?php if ($column['field'] != 'action'): ?>
									<td><?php echo $this->getFieldValue($value, $column['field']); ?></td>
								<?php endif ?>
							<?php endforeach ?>
							
							<td>
								<?php foreach ($this->getActions() as $key => $action): ?>
									<?php if($action['ajax'] && $key != 'changeStatus'): ?>
										<button type="button" class='btn p-0 m-0 pr-3' onclick="object.setUrl('<?php echo $this->getMethodUrl($value, $action['method']);?>').resetParams().load();"><?php echo $action['label']; ?></button>
									<?php endif; ?>

									<?php if(!$action['ajax'] && $key != 'changeStatus'): ?>
										<a class="btn" href="<?php $this->getMethodUrl($value, $action['method']);?>"><?php echo $action['label']; ?></a>
									<?php endif; ?>

									<?php if ($key == 'changeStatus' && $action['ajax']): ?>
										<button type="button" class="btn p-2 m-0 <?php if($value->status==1){ echo 'btn-success';}else{ echo 'btn-danger';} ?>" onclick="object.setUrl('<?php echo $this->getChangeStatusUrl($value,$action['method']); ?>').resetParams().load();">

											<?php if ($value->status == 1): ?>
												<?php echo 'Enabled' ?>
											<?php else: ?>
												<?php echo 'Disabled' ?>
											<?php endif;?>
										</button>
									<?php endif ?>
								<?php endforeach ?>
							</td>
						</tr>
					<?php endforeach ?>
				<?php else: ?>
					<center><p>No Data Found</p></center>
				<?php endif; ?>
			</table>
		</div>
	</div>	
</form>