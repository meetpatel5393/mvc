<?php
namespace Controller\Core;
\Mage::loadFileByClassName('Controller\Core\Abstracts');
class Admin extends Abstracts
{
	public function setMessage(){
		$this->message = \Mage::getModel('Admin\Message');
		return $this;
	}
	
	public function setLayout(\Block\Core\Layout $layout = null){
		if(!$layout){
			$layout = \Mage::getBlock('Admin\Layout');
		}
		$this->layout = $layout;
		return $this;
	}
}