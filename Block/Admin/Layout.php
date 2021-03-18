<?php
namespace Block\Admin;
\Mage::loadFileByClassName('Block\Core\Layout');
class Layout extends \Block\Core\Layout
{
	public function __construct()
	{	
		$this->setTemplate('admin/layout/oneColumn.php');
		$this->prepareChildren();
	}
	
	public function prepareChildren()
	{
		$this->addChild(\Mage::getBlock('Admin\Layout\Head'), 'head');
		$this->addChild(\Mage::getBlock('Admin\Layout\Header'), 'header');
		$this->addChild(\Mage::getBlock('Admin\Layout\Footer'), 'footer');
		$this->addChild(\Mage::getBlock('Admin\Layout\Message'), 'message');
		$this->addChild(\Mage::getBlock('Admin\Layout\Content'), 'content');
		$this->addChild(\Mage::getBlock('Admin\Layout\Left'), 'left');
	}
}