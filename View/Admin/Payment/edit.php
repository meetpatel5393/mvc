<?php
	$title = 'Payment';
	$payment = $this->getTableRow();
?>
<div class="container-fluid m-0 p-4">
<form method="post" action="<?php echo $this->getUrl()->getUrl('save','Admin\Payment');?>" id="paymentForm">
	<div class="container-fluid m-0 p-2 row">
		<h3><?php if (!$payment->methodId) { echo "Pay";} ?></h3>
		<h3><?php if ($payment->methodId) { echo "Update Payment";} ?></h3>
	</div>
	<div class="container-fluid m-0 p-2">
		<div class="row m-0 p-0">
			<div class="col-md-2 m-0 p-0">
				<p>Payment Name</p>
			</div>
			<div class="col-md-5 m-0 p-0">
				<input type="text" name="payment[name]"  value="<?php echo $payment->name; ?>">
			</div>
		</div>
		<div class="row m-0 p-0">
			<div class="col-md-2 m-0 p-0">
				<p>Payment Description</p>
			</div>
			<div class="col-md-5 m-0 p-0">
				<textarea name="payment[description]" rows="5" cols="23" required=""><?php echo $payment->description; ?></textarea>
			</div>
		</div>
		<div class="row m-0 p-0">
			<div class="col-md-2 m-0 p-0">
				<button type="button" class="btn btn-success" onclick="object.setForm().load();"><?php if (!$payment->methodId)  { echo "Pay";} else {echo 'Update';} ?></button>
			</div>
		</div>
	</div>
</form>
</div>