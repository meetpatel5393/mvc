<?php
namespace Block\Admin\Payment;
\Mage::loadFileByClassName('Block\Core\Edit');
class Edit extends \Block\Core\Edit
{
	public function __construct()
	{
		parent::__construct();
		$this->setTemplate('Admin/Payment/edit.php');
	}
}