<?php 
namespace Block\Admin\Shipping;
\Mage::loadFileByClassName('Block\Core\Edit');
class Edit extends \Block\Core\Edit
{
	protected $shipping = null;
	public function __construct()
	{
		parent::__construct();
		$this->setTemplate('Admin/Shipping/edit.php');
	}
}