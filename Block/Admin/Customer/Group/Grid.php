<?php 
namespace Block\Admin\Customer\Group;
\Mage::loadFileByClassName('Block\Core\Template');
class Grid extends \Block\Core\Template
{
	protected $customerGroup = [];
	public function __construct() {
		$this->setTemplate('Admin/Customer/group/grid.php');
	}

	public function setCustomerGroup($customerGroup = null){
		if($customerGroup){
			$this->customerGroup = $customerGroup;
			return $this;
		}
		$customer = \Mage::getModel('Customer\Group');
		$this->customerGroup = $customer->fetchAll();
		return $this;
	}
	
	public function getCustomerGroup(){
		if(!$this->customerGroup){
			$this->setCustomerGroup();
		}
		return $this->customerGroup;
	}
}