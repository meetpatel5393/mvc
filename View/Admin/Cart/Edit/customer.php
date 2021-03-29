<?php $cart = $this->getCart();?>
<?php $customers = $this->getCustomers()->getData(); ?>
<?php if (!$cart): ?>
	<?php $customerId = 0; ?>
<?php else: ?>
	<?php $customerId = $this->getCart()->customerId;?>
<?php endif; ?>
<div class="container-fluid m-0 p-2 row">
	<form action="<?php echo $this->getUrl()->getUrl('selectCustomer','Admin\Cart'); ?>" method="post" id="customerCartForm">
		<select name="customer">
			<option disabled="" selected="">Select Customer</option>
			<?php foreach ($customers as $customer): ?>
				<option value="<?php echo $customer->customerId; ?>" <?php if($customer->customerId == $customerId){ echo 'selected';} ?>>
					<?php echo $customer->firstName.' '.$customer->lastName; ?>
				</option>
			<?php endforeach ?>	
		</select>
		<button type="button" class="btn btn-success" onclick="object.setForm().load();">Select</button>
	</form>
</div>


