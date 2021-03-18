<?php 
namespace Block\Customer;
\Mage::loadFileByClassName('Block\Core\Layout');
class Layout extends \Block\Core\Layout
{
	public function __construct()
	{
		$this->setTemplate('Customer/layout/oneColumn.php');
		$this->prepareChildren();
	}
	
	public function prepareChildren()
	{
		$this->addChild(\Mage::getBlock('Customer\Layout\Head'), 'head');
		$this->addChild(\Mage::getBlock('Customer\Layout\Header'), 'header');
		$this->addChild(\Mage::getBlock('Customer\Layout\Footer'), 'footer');
		$this->addChild(\Mage::getBlock('Customer\Layout\Message'), 'message');
		$this->addChild(\Mage::getBlock('Customer\Layout\Content'), 'content');
		$this->addChild(\Mage::getBlock('Customer\Layout\Left'), 'left');
	}
}