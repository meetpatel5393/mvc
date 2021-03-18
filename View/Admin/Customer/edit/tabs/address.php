<?php $customerAddresses = $this->getcustomerAddresses(); ?>
<?php $billing = $customerAddresses[0]; ?>
<?php $shipping = $customerAddresses[1]; ?>
<?php if($this->validCustomer()){ ?>
<div class="row m-0 p-0">
	<div class="container-fluid col-md-6 m-0 p-1">
		<div class="row m-0 p-2">
			<h3>Billing Address</h3>
		</div>
		<div class="row m-0 p-0">
			<div class="col-md-3 m-0 p-0">
				<p>Address</p>
			</div>
			<div class="col-md-9 m-0 p-0">
				<input type="text" name="billing[address]" required="" value="<?php echo $billing->address ?>">
			</div>
		</div>
		<div class="row m-0 p-0">
			<div class="col-md-3 m-0 p-0">
				<p>City</p>
			</div>
			<div class="col-md-9 m-0 p-0">
				<input type="text" name="billing[city]" required="" value="<?php echo $billing->city ?>">
			</div>
		</div>
		<div class="row m-0 p-0">
			<div class="col-md-3 m-0 p-0">
				<p>State</p>
			</div>
			<div class="col-md-9 m-0 p-0">
				<input type="text" name="billing[state]" required="" value="<?php echo $billing->state ?>">
			</div>
		</div>
		<div class="row m-0 p-0">
			<div class="col-md-3 m-0 p-0">
				<p>Zip Code</p>
			</div>
			<div class="col-md-9 m-0 p-0">
				<input type="number" name="billing[zipCode]" required="" value="<?php echo $billing->zipcode ?>">
			</div>
		</div>
		<div class="row m-0 p-0">
			<div class="col-md-3 m-0 p-0">
				<p>Country</p>
			</div>
			<div class="col-md-9 m-0 p-0">
				<input type="text" name="billing[country]" required="" value="<?php echo $billing->country ?>">
			</div>
		</div>
	</div>
	<div class="container-fluid col-md-6 m-0 p-1">
		<div class="row m-0 p-2">
			<h3>Shipping Address</h3>
		</div>
		<div class="row m-0 p-0">
			<div class="col-md-3 m-0 p-0">
				<p>Address</p>
			</div>
			<div class="col-md-9 m-0 p-0">
				<input type="text" name="shipping[address]" required="" value="<?php echo $shipping->address ?>">
			</div>
		</div>
		<div class="row m-0 p-0">
			<div class="col-md-3 m-0 p-0">
				<p>City</p>
			</div>
			<div class="col-md-9 m-0 p-0">
				<input type="text" name="shipping[city]" required="" value="<?php echo $shipping->city ?>">
			</div>
		</div>
		<div class="row m-0 p-0">
			<div class="col-md-3 m-0 p-0">
				<p>State</p>
			</div>
			<div class="col-md-9 m-0 p-0">
				<input type="text" name="shipping[state]" required="" value="<?php echo $shipping->state ?>">
			</div>
		</div>
		<div class="row m-0 p-0">
			<div class="col-md-3 m-0 p-0">
				<p>Zip Code</p>
			</div>
			<div class="col-md-9 m-0 p-0">
				<input type="number" name="shipping[zipCode]" required="" value="<?php echo $shipping->zipcode ?>">
			</div>
		</div>
		<div class="row m-0 p-0">
			<div class="col-md-3 m-0 p-0">
				<p>Country</p>
			</div>
			<div class="col-md-9 m-0 p-0">
				<input type="text" name="shipping[country]" required="" value="<?php echo $shipping->country ?>">
			</div>
		</div>
	</div>
</div>
<div class="row m-0 p-2 justify-content-center">
	<div class="col-md-3 m-0 p-0">
		<button type="button" onclick="object.setForm().setUrl('<?php echo $this->getUrl()->getUrl('saveAddress'); ?>').load();" class="btn btn-success"><?php if (!$billing->customerId)  { echo "Add Address";} else {echo 'Update Address';} ?></button>
		<button type="reset" class="btn btn-danger" onclick="object.setUrl('<?php echo $this->getUrl()->getUrl('grid','Customer');?>').resetParams().load();">Cancle</button>
	</div>
</div>
<?php } else {?>
<p>Register First</p>
<?php } ?>