<?php 
	$title = 'Payment';
	$payments = $this->getPayments();
?>
<div class="container-fluid m-0 p-4 col">
	<div class="row m-0 p-1">
		<button class="btn btn-success" onclick="object.setUrl('<?php echo $this->getUrl()->getUrl('show','Admin\Payment',null,true);?>').resetParams().load();">Pay</button>
	</div>
	<h3>Payment Grid</h3>
	<table class="table">
		<tr>
			<th>Method Id</th>
			<th>Payment Name</th>
			<th>Code</th>
			<th>Description</th>
			<th>Status</th>
			<th>Created Date</th>
			<th colspan="2">Action</th>
		</tr>
		<?php if ($payments) : ?>
			<?php foreach ($payments->getData() as $key => $payment) : ?>
				<tr>
					<td><?php echo $payment->methodId; ?></td>
					<td><?php echo $payment->name; ?></td>
					<td><?php echo $payment->code; ?></td>
					<td><?php echo $payment->description; ?></td>
					<td><?php echo $payment->status; ?></td>
					<td><?php echo $payment->createdDate; ?></td>
					<td>
						<button class='btn p-0 m-0 pr-3' onclick="object.setUrl('<?php echo $this->getUrl()->getUrl('delete','Admin\Payment',['methodId'=>$payment->methodId]);?>').resetParams().load();" ><i class="fa fa-trash" aria-hidden="true"></i></button>

						<button class='btn p-0 m-0 pr-3' onclick="object.setUrl('<?php echo $this->getUrl()->getUrl('show','Admin\Payment',['methodId'=>$payment->methodId]);?>').resetParams().load();" ><i class='fa fa-pencil' aria-hidden='true'></i></button>
					</td>
				</tr>
			<?php endforeach; ?>
		<?php endif; ?>
		<?php if(!$payments) : ?>
			<center><p>No Payment Detail Available</p></center>
		<?php endif; ?>
	</table>
</div>