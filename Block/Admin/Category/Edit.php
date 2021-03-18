<?php 
namespace Block\Admin\Category;
\Mage::loadFileByClassName('Block\Core\Edit');
class Edit extends \Block\Core\Edit
{
	public function __construct()
	{
		parent::__construct();
		$this->setClass(\Mage::getBlock('Admin\Category\Edit\Tabs'));
	}
}