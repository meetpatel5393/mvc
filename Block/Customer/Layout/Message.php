<?php
namespace Block\Customer\Layout;
class Message extends \Block\Core\Template
{
	public function __construct()
	{
		$this->setTemplate('Customer/layout/message.php');
		$this->setMessage();
	}

	public function setMessage(){
		$this->message = \Mage::getModel('Customer\Message');
		return $this;
	}
}