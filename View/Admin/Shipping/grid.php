<?php 
	$title = 'Shipping';
	$shippings = $this->getShippings();
?>
<div class="container-fluid m-0 p-4 col">
	<div class="row m-0 p-1">
		<button class="btn btn-success" onclick="object.setUrl('<?php echo $this->getUrl()->getUrl('show','Admin\Shipping',null,true);?>').resetParams().load();"> Create Shipping </button>
	</div>
	<h3>Shipping Grid</h3>
	<table class="table">
		<tr>
			<th>Method Id</th>
			<th>Name</th>
			<th>Code</th>
			<th>Amount</th>
			<th>Description</th>
			<th>Status</th>
			<th>Created Date</th>
			<th colspan="2">Action</th>
		</tr>
		<?php if($shippings) : ?>
			<?php foreach ($shippings->getData() as $key => $value) : ?>
				<tr>
					<td><?php echo $value->methodId ?></td>
					<td><?php echo $value->name ?></td>
					<td><?php echo $value->code ?></td>
					<td><?php echo $value->amount ?></td>
					<td><?php echo $value->description ?></td>
					<td><?php echo $value->status ?></td>
					<td><?php echo $value->createdDate ?></td>
					<td>
						<button class="btn" onclick="object.setUrl('<?php echo $this->getUrl()->getUrl('delete','Admin\Shipping',['methodId'=>$value->methodId]);?>').resetParams().load();"><i class="fa fa-trash" aria-hidden="true"></i></button>

						<button class="btn" onclick="object.setUrl('<?php echo $this->getUrl()->getUrl('show','Admin\Shipping',['methodId'=>$value->methodId]);?>').resetParams().load();"><i class='fa fa-pencil' aria-hidden='true'></i></button>
					</td>
				</tr>
			<?php endforeach; ?>
		<?php endif; ?>
		<?php if (!$shippings) : ?>
			<center><p>Shipping Record Not Available</p></center>
		<?php endif; ?>
	</table>
</div>