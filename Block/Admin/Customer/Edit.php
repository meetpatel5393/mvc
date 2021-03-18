<?php 
namespace Block\Admin\Customer;
\Mage::loadFileByClassName('Block\Core\Edit');
class Edit extends \Block\Core\Edit
{
	public function __construct()
	{
		parent::__construct();
		$this->setClass(\Mage::getBlock('Admin\Customer\Edit\Tabs'));
	}
}