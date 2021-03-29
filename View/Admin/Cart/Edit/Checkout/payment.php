<?php $paymentMethods = $this->getPaymentMethods()->getData(); ?>
<?php $paymentMethodId = $this->getCart()->paymentMethodId; ?>
<div class="container-fluid m-0 p-2 col-6">
	<div class="container-fluid m-0 p-2 col-md-6">
		<div class="container-fluid m-0 p-1">
			<h3>Payment Method</h3>
		</div>
		<form method="post" id="paymetMethodForm">
			<div class="container-fluid m-0 p-0 col">
				<div class="container-fluid m-1 p-1 row">
					<?php foreach ($paymentMethods as $paymentMethod) : ?>
						<div class="container-fluid m-0 p-0 row">
							<div class="container-fluid m-0 p-0 col-1">
								<input type="radio" name="paymentMethod" value='<?php echo $paymentMethod->methodId; ?>'
								<?php if ($paymentMethod->methodId == $paymentMethodId): ?>
									<?php echo 'checked'; ?>
								<?php endif ?> >
							</div>
							<div class="container-fluid m-0 p-0 col-6">
								<?php echo $paymentMethod->name; ?>
							</div>
						</div>
					<?php endforeach; ?>
				</div>
				<div class="container-fluid m-1 p-1 row">
					<div class="container-fluid m-0 p-2 col-3">
						<button type="button" class="btn btn-primary" onclick="object.setForm(this).setUrl('<?php echo $this->getUrl()->getUrl('savePayment','Admin\Cart\Checkout'); ?>').load();">Save</button>
					</div>
				</div>
			</div>
		</form>
	</div>
</div>