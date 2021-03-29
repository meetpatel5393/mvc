<?php
namespace Block\Admin\Cart\Edit\Checkout;
class Shipment extends \Block\Core\Template
{
	public function __construct()
	{
		$this->setTemplate('Admin\cart\edit\checkout\shipment.php');
	}

	public function getShippingMethods() {
		$shippingModel = \Mage::getModel('Shipping');
		return $shippingModel->fetchAll();
	}

	public function getCart() {
		$session = \Mage::getModel('Admin\Session');
		$cart = \Mage::getModel('Cart');		
		$customerId = $session->customerId;
		if(!$customerId) {
			return false;
		}

		if($customerId) {
			$query = "SELECT * FROM `cart` WHERE customerId = {$customerId}";
			$cart->fetchRow($query);
			$this->cart = $cart;
			return $this->cart;
		}
	}
}