<?php
namespace Block\Admin\Cart\Edit;
class Customer extends \Block\Core\Template
{
	protected $customers = null;
	protected $cart = null;
	public function __construct()
	{
		$this->setTemplate('Admin\cart\edit\customer.php');
	}

	public function setCustomers($customers = null){
		if(!$customers) {
			$customers = \Mage::getModel('Customer')->fetchAll();
		}
		$this->customers = $customers;
		return $this;
	}

	public function getCustomers(){
		if(!$this->customers){
			$this->setCustomers();
		}
		return $this->customers;
	}

	public function getCart(){
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