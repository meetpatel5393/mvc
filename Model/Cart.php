<?php
namespace Model;
class Cart extends \Model\Core\Table
{
	protected $billingAddress = null;
	protected $shippingAddress = null;
	public function __construct()
	{
		$this->setTableName('cart');
		$this->setPrimaryKey('cartId');
	}

	public function setCustomer(\Model\Customer $customer){
		$this->customer = $customer;
		return $this;
	}

	public function getCustomer(){
		if($this->customer) {
			return $this->customer;
		}
		if(!$this->customerId){
			return false;
		}
		$customer = \Mage::getModel('Customer')->load($this->customerId);
		$this->setCustomer($customer);
		return $this->customer;
	}

	public function setItems(\Model\Cart\Item\Collection $items){
		$this->items = $items;
		return $this;
	}

	public function getItems(){
		if(!$this->cartId) {
			return false;
		}
		$query = "SELECT * FROM `cart_item` WHERE cartId = '{$this->cartId}'";
		$items = \Mage::getModel('Cart\Item')->fetchAll($query);
		$this->setItems($items);
		return $this->items;
	}

	public function setBillingAddress($billingAddress){
		$this->billingAddress = $billingAddress;
		return $this;
	}

	public function getBillingAddress(){
		if(!$this->cartId){
			return false;
		}
		$query = "SELECT * FROM `cart_address` WHERE cartId='{$this->cartId}' AND addressType = 'billing'";
		$billingAddress = \Mage::getModel('Cart\Address')->fetchRow($query);
		$this->setBillingAddress($billingAddress);
		return $this->billingAddress;
	}

	public function setShippingAddress($shippingAddress){
		$this->shippingAddress = $shippingAddress;
		return $this;
	}

	public function getShippingAddress(){
		if(!$this->cartId){
			return false;
		}
		$query = "SELECT * FROM `cart_address` WHERE cartId='{$this->cartId}' AND addressType = 'shipping'";
		$shippingAddress = \Mage::getModel('Cart\Address')->fetchRow($query);
		$this->setShippingAddress($shippingAddress);
		return $this->shippingAddress;
	}
}