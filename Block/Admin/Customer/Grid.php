<?php
namespace Block\Admin\Customer;
\Mage::loadFileByClassName('Block\Core\Template');
class Grid extends \Block\Core\Template
{
	protected $customers = [];
	public function __construct()
	{
		$this->setTemplate('Admin/Customer/grid.php');
	}
	
	public function setCustomers($customers = null){
		if($customers){
			$this->customers = $customers;
			return $this;
		}
		$customer = \Mage::getModel('Customer');
		$this->customers = $customer->customerData();
		return $this;
	}
	
	public function getCustomers(){
		if(!$this->customers){
			$this->setCustomers();
		}
		return $this->customers;
	}
}