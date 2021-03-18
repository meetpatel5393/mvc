<?php
namespace Block\Admin\Customer\Edit\Tabs;
\Mage::loadFileByClassName('Block\Core\Template');
class Address extends \Block\Core\Template
{
	protected $customerAddresses = [];
	public function __construct()
	{
		$this->setTemplate('Admin/Customer/edit/tabs/address.php');
	}
	
	public function validCustomer(){
		$customer = \Mage::getModel('Customer');
		$customerId = $this->getId();
		if($customerId){
			if($customer->load($customerId)){
				return true;
			}
		}
		return false;
	}

	public function setcustomerAddresses(array $customerAddresses = null){
		if($customerAddresses){
			$this->customerAddresses = $customerAddresses;
			return $this;
		}
		$customerId = $this->getId();
		if($customerId){
			$customerAddresses[] = \Mage::getModel('Customer\Address')->fetchAddress('billing',$customerId);
			$customerAddresses[] = \Mage::getModel('Customer\Address')->fetchAddress('shipping',$customerId);
		}
		$this->customerAddresses = $customerAddresses;
		return $this;
	}
	
	public function getcustomerAddresses(){
		if(!$this->customerAddresses){
			$this->setcustomerAddresses();
		}
		return $this->customerAddresses;
	}
}