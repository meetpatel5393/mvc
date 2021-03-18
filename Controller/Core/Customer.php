<?php
namespace Controller\Core;
\Mage::loadFileByClassName('Controller\Core\Abstracts');
class Customer extends Abstracts
{	
	public function setMessage(){
		$this->message = \Mage::getModel('Customer\Message');
		return $this;
	}

	public function setLayout(\Block\Core\Layout $layout = null){
		if(!$layout){
			$layout = \Mage::getBlock('Customer\Layout');
		}
		$this->layout = $layout;
		return $this;
	}
}