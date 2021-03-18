<?php
	$title = 'Shipping';
	$shipping = $this->getTableRow();
?>
<div class="container-fluid m-0 p-4">
<form method="post" action="<?php echo $this->getUrl()->getUrl('save','Admin\Shipping'); ?>" id="shippingForm">
	<div class="container-fluid m-0 p-2 row">
		<h3><?php if(!$shipping->methodId){ echo 'Create Shipping'; } ?></h3>
		<h3><?php if($shipping->methodId){ echo 'Update Shipping'; } ?></h3>
	</div>
	<div class="container-fluid m-0 p-2">
		<div class="row m-0 p-0">
			<div class="col-md-2 m-0 p-0">
				<p>Shipping Name</p>
			</div>
			<div class="col-md-5 m-0 p-0">
				<input type="text" name="shipping[name]" required="" value="<?php echo $shipping->name ?>">
			</div>
		</div>
		<div class="row m-0 p-0">
			<div class="col-md-2 m-0 p-0">
				<p>Amount</p>
			</div>
			<div class="col-md-5 m-0 p-0">
				<input type="number" name="shipping[amount]" required=""value="<?php echo $shipping->amount ?>"></input>
			</div>
		</div>
		<div class="row m-0 p-0">
			<div class="col-md-2 m-0 p-0">
				<p>Description</p>
			</div>
			<div class="col-md-5 m-0 p-0">
				<textarea name="shipping[description]" rows="5" cols="23" required=""><?php echo $shipping->description; ?></textarea>
			</div>
		</div>
		<div class="row m-0 p-0">
			<div class="col-md-2 m-0 p-0">
				<button class="btn btn-success" type="button" onclick="object.setForm().load();">
					<?php if(!$shipping->methodId) {echo 'Process';} else {echo 'Update';} ?>
				</button>
			</div>
		</div>
	</div>
</form>
</div>