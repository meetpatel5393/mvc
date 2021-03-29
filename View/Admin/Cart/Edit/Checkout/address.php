<?php $billingAddress = $this->getBillingAddress();?>
<?php $shippingAddress = $this->getShippingAddress(); ?>
<div class="container-fluid m-0 p-2 row">
	<div class="container-fluid m-0 p-2 col-md-6">
		<div class="container-fluid m-0 p-1">
			<h3>Billing Address</h3>
		</div>
		<form method="post" id="cartBillingAddress">
			<div class="container-fluid m-0 p-0 col">
				<div class="container-fluid m-1 p-1 row">
					<input class="form-control" type="text" name="billing[<?php echo $billingAddress->cartAddressId; ?>][address]" placeholder="Address" 
					value="<?php echo $billingAddress->address ?>">
				</div>
				<div class="container-fluid m-1 p-1 row">
					<input class="form-control" type="text" name="billing[<?php echo $billingAddress->cartAddressId; ?>][city]" placeholder="City" 
						value="<?php echo $billingAddress->city ?>">
				</div>
				<div class="container-fluid m-1 p-1 row">
					<input class="form-control" type="text" name="billing[<?php echo $billingAddress->cartAddressId; ?>][state]" placeholder="State" 
						value="<?php echo $billingAddress->state ?>">
				</div>
				<div class="container-fluid m-1 p-1 row">
					<input class="form-control" type="text" name="billing[<?php echo $billingAddress->cartAddressId; ?>][country]" placeholder="Country"
						value="<?php echo $billingAddress->country ?>">
				</div>
				<div class="container-fluid m-1 p-1 row">
					<input class="form-control" type="number" name="billing[<?php echo $billingAddress->cartAddressId; ?>][zipcode]" placeholder="Zipcode"
						value="<?php echo $billingAddress->zipcode ?>">
				</div>
				<div class="container-fluid m-1 p-1 row">
					<div class="container-fluid m-0 p-2 col-3">
						<button type="button" class="btn btn-primary" onclick="object.setForm().setUrl('<?php echo $this->getUrl()->getUrl('saveBillingAddress','Admin\Cart\Checkout'); ?>').load();">Save</button>
					</div>
					<div class="container-fluid m-0 p-2 col-6">
						<input type="checkbox" name="addressBookFlagBilling"> Save In Address Book
					</div>
				</div>
			</div>
		</form>
	</div>

	<div class="container-fluid m-0 p-2 col-md-6">
		<div class="container-fluid m-0 p-1">
			<h3>Shipping Address</h3>
		</div>
		<form method="post" id="cartShippingAddress">
			<div class="container-fluid m-0 p-0 col">
				<div class="container-fluid m-1 p-1 row">
					<input class="form-control" type="text" name="shipping[<?php echo $shippingAddress->cartAddressId; ?>][address]" placeholder="Address"
					value="<?php echo $shippingAddress->address; ?>">
				</div>
				<div class="container-fluid m-1 p-1 row">
					<input class="form-control" type="text" name="shipping[<?php echo $shippingAddress->cartAddressId; ?>][city]" placeholder="City"
						value="<?php echo $shippingAddress->city; ?>">
				</div>
				<div class="container-fluid m-1 p-1 row">
					<input class="form-control" type="text" name="shipping[<?php echo $shippingAddress->cartAddressId; ?>][state]" placeholder="State"
						value="<?php echo $shippingAddress->state; ?>">
				</div>
				<div class="container-fluid m-1 p-1 row">
					<input class="form-control" type="text" name="shipping[<?php echo $shippingAddress->cartAddressId; ?>][country]" placeholder="Country"
						value="<?php echo $shippingAddress->country; ?>">
				</div>
				<div class="container-fluid m-1 p-1 row">
					<input class="form-control" type="number" name="shipping[<?php echo $shippingAddress->cartAddressId; ?>][zipcode]" placeholder="Zipcode"
						value="<?php echo $shippingAddress->zipcode; ?>">
				</div>
				<div class="container-fluid m-1 p-1 row">
					<div class="container-fluid m-0 p-2 col-3">
						<button type="button" class="btn btn-primary" onclick="object.setForm(this).setUrl('<?php echo $this->getUrl()->getUrl('saveShippingAddress','Admin\Cart\Checkout'); ?>').load();">Save</button>
					</div>
					<div class="container-fluid m-0 p-2 col-4">
						<input type="checkbox" name="addressBookFlagShipping"> Save In Address Book
					</div>
					<div class="container-fluid m-0 p-2 col-4">
						<input type="checkbox" name="sameAsBillingFlag"> Same As Billing
					</div>
				</div>
			</div>
		</form>
	</div>
</div>