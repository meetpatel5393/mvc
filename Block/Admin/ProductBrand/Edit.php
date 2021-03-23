<?php
namespace Block\Admin\ProductBrand;
\Mage::loadFileByClassName('Block\Core\Edit');
class Edit extends \Block\Core\Edit
{
	public function __construct()
	{
		$this->setTemplate('Admin\ProductBrand\edit.php');
	}

	public function getArrayOfStatus()
    {
        $model = \Mage::getModel('ProductBrand');
        return $model->getArrayOfStatus();
    }
    
}