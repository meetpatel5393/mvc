<?php
namespace Block\Admin\Cart\Edit\Checkout;
class Payment extends \Block\Core\Template
{
	protected $paymentMehod = null;
	public function __construct()
	{
		$this->setTemplate('Admin\cart\edit\checkout\payment.php');
	}

	public function getPaymentMethods() {
		$paymentModel = \Mage::getModel('Payment');
		return $paymentModel->fetchAll();
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