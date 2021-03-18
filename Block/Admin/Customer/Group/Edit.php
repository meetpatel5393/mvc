<?php
namespace Block\Admin\Customer\Group;
\Mage::loadFileByClassName('Block\Core\Edit');
class Edit extends \Block\Core\Edit
{
	public function __construct() {
		$this->setTemplate('Admin/Customer/group/edit.php');
	}

	public function getArrayOfStatus(){
		$model = \Mage::getModel('Customer\Group');
		return $model->getArrayOfStatus();
	}
}