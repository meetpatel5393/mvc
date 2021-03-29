<?php
namespace Model\Cart;
class Address extends \Model\Core\Table
{	
	protected $cart = null;
	protected $cartId = null;
	public function __construct()
	{
		$this->setTableName('cart_address');
		$this->setPrimaryKey('cartAddressId');
	}

	public function setCart(\Model\Cart $cart){
		$this->cart = $cart;
		return $this;
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
			$this->setCart($cart);
			return $this->cart;
		}
	}

	public function setCustomerBillingAddress(\Model\Customer\Address $customerBillingAddress){
		$this->customerBillingAddress = $customerBillingAddress;
		return $this;
	}

	public function setCustomerShippingAddress(\Model\Customer\Address $customerShippingAddress){
		$this->customerShippingAddress = $customerShippingAddress;
		return $this;
	}

	public function getCustomerBillingAddress(){
		$query = "SELECT * FROM `customer_address` WHERE customerId = {$this->customerId} AND addressType='billing'";
		$customerBillingAddress = \Mage::getModel('Customer\Address');
		$customerBillingAddress->fetchRow($query);
		$this->setCustomerBillingAddress($customerBillingAddress);
		return $this->customerBillingAddress;
	}

	public function getCustomerShippingAddress(){
		$query = "SELECT * FROM `customer_address` WHERE customerId = {$this->customerId} AND addressType='shipping'";
		$customerShippingAddress = \Mage::getModel('Customer\Address');
		$customerShippingAddress->fetchRow($query);
		$this->setCustomerShippingAddress($customerShippingAddress);
		return $this->customerShippingAddress;
	}
}