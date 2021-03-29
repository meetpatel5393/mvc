<?php $shippingMethods = $this->getShippingMethods()->getData(); ?>
<?php $shippingMethodId = $this->getCart()->shippingMethodId; ?>
<div class="container-fluid m-0 p-2 col-6">
	<div class="container-fluid m-0 p-2 col-md-6">
		<div class="container-fluid m-0 p-1">
			<h3>Shipping Method</h3>
		</div>
		<form method="post" id="shippingMethodForm">
			<div class="container-fluid m-0 p-0 col">
				<div class="container-fluid m-1 p-1 row">
					<?php foreach ($shippingMethods as $shippingMethod) : ?>
						<div class="container-fluid m-0 p-0 row">
							<div class="container-fluid m-0 p-0 col-1">
								<input type="radio" name="shippingMethod" value='<?php echo $shippingMethod->methodId; ?>'
								<?php if ($shippingMethod->methodId == $shippingMethodId): ?>
									<?php echo 'checked'; ?>
								<?php endif ?> >
							</div>
							<div class="container-fluid m-0 p-0 col-6">
								<?php echo $shippingMethod->name; ?>
								<?php echo "(Rs.$shippingMethod->amount)"; ?>
							</div>
						</div>
					<?php endforeach; ?>
				</div>
				<div class="container-fluid m-1 p-1 row">
					<div class="container-fluid m-0 p-2 col-3">
						<button type="button" class="btn btn-primary" onclick="object.setForm(this).setUrl('<?php echo $this->getUrl()->getUrl('saveShipping','Admin\Cart\Checkout'); ?>').load();">Save</button>
					</div>
				</div>
			</div>
		</form>
	</div>
</div>