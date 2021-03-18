<?php 
namespace Block\Admin\DashBoard;
\Mage::loadFileByClassName('Block\Core\Template');
class DashBoard extends \Block\Core\Template
{
	public function __construct()
	{
		$this->setTemplate('Admin/DashBoard/dashboard.php');
	}
}