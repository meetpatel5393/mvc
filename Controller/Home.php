<?php
namespace Controller;
\Mage::loadFileByClassName('Controller\Core\Customer');
class Home extends Core\Customer
{
	public function indexAction() 
	{
		$layout = $this->getLayout();		
		$content = $layout->getChild('content');
		$home = \Mage::getBlock('Home\Index');
		$content->addChild($home,'home');
		$this->renderLayout();
	}
}