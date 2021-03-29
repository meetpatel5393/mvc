<?php $cart = $this->getCart(); ?>
<?php if ($cart): ?>
	<div class="container-fluid m-0 p-4 col">
		<?php echo \Mage::getBlock('Admin\Cart\Edit\Checkout\Address')->toHtml(); ?>
		<div class="container-fluid m-0 p-0 row">
			<?php echo \Mage::getBlock('Admin\Cart\Edit\Checkout\Payment')->toHtml(); ?>
			<?php echo \Mage::getBlock('Admin\Cart\Edit\Checkout\Shipment')->toHtml(); ?>
		</div>
		<?php echo \Mage::getBlock('Admin\Cart\Edit\Checkout\OrderBill')->toHtml(); ?>
	</div>
<?php else: ?>
	<center><p>No cart available</p></center>
<?php endif; ?>