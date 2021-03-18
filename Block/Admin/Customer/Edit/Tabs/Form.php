<?php 
namespace Block\Admin\Customer\Edit\Tabs;
\Mage::loadFileByClassName('Block\Core\Template');
class Form extends \Block\Core\Template
{
	protected $customer = null;
	protected $customerGroup = [];
	public function __construct()
	{
		$this->setTemplate('Admin/Customer/edit/tabs/form.php');
	}

	public function setCustomer($customer = null){
		if($customer){
			$this->customer = $customer;
			return $this;
		}
		$customer = \Mage::getModel('Customer');
		$customerId = $this->getId();
		if($customerId){
			$customer->load($customerId);
		}
		$this->customer = $customer;
		return $this;
	}
	
	public function getCustomer(){
		if(!$this->customer){
			$this->setCustomer();
		}
		return $this->customer;
	}
		
	public function getCustomerGroupArray(){
		$customer = \Mage::getModel('Customer\Group');
		$this->customerGroup = $customer->fetchAll();
		return $this->customerGroup;
	}

	public function getArrayOfStatus(){
		$model = \Mage::getModel('Customer');
		return $model->getArrayOfStatus();
	}
}
