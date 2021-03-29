<?php
namespace Block\Admin\Cart\Edit;
class item extends \Block\Core\Template
{
	protected $cart = null;
	public function __construct()
	{
		$this->setTemplate('Admin\cart\edit\item.php');
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