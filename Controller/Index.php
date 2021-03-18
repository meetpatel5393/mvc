<?php
namespace Controller;
\Mage::loadFileByClassName('Controller\Core\Admin');
class Index extends Core\Admin 
{
	public function indexAction() 
	{
		$layout = $this->getLayout();
		$content = $layout->getChild('content');
		$dashBoard = \Mage::getBlock('Admin\DashBoard\DashBoard');
		$content->addChild($dashBoard,'dashBoard');
		$this->renderLayout();
	}
}