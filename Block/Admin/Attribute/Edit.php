<?php 
namespace Block\Admin\Attribute;
\Mage::loadFileByClassName('Block\Core\Edit');
class Edit extends \Block\Core\Edit
{
	public function __construct()
	{
		$this->setTemplate('Admin\Attribute\edit.php');
	}
}