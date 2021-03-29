<?php
namespace Block\Admin\Cart\Edit\Checkout;
class Address extends \Block\Core\Template
{
	protected $cart = null;
	public function __construct()
	{
		$this->setTemplate('Admin\cart\edit\checkout\address.php');
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

	public function getBillingAddress(){
		$cartBillingAddress = $this->getCart()->getBillingAddress();
		if(!$cartBillingAddress) {
			$cartAddress = \Mage::getModel('Cart\Address');
			$cartAddress->customerId = $this->getCart()->customerId;
			$customerBillingAddress = $cartAddress->getCustomerBillingAddress()->getData();

			unset($customerBillingAddress['customerId']);
			$cartAddress = \Mage::getModel('Cart\Address');
			$cartAddress->setData($customerBillingAddress);
			$cartAddress->cartId = $cartAddress->getCart()->cartId;
			$cartAddress->save();
		}
		$cartBillingAddress = $this->getCart()->getBillingAddress();
		return $cartBillingAddress;
	}

	public function getShippingAddress(){
		$cartShippingAddress = $this->getCart()->getShippingAddress();
		if(!$cartShippingAddress) {
			$cartAddress = \Mage::getModel('Cart\Address');
			$cartAddress->customerId = $cartAddress->getCart()->customerId;
			$customerShippingAddress = $cartAddress->getCustomerShippingAddress()->getData();

			unset($customerShippingAddress['customerId']);
			$cartAddress = \Mage::getModel('Cart\Address');
			$cartAddress->setData($customerShippingAddress);
			$cartAddress->cartId = $cartAddress->getCart()->cartId;
			$cartAddress->save();
		}
		$cartShippingAddress = $this->getCart()->getShippingAddress();
		return $cartShippingAddress;
	}
}