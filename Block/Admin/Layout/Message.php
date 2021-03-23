<?php
namespace Block\Admin\Layout;
class Message extends \Block\Core\Template
{
	public function __construct()
	{
		$this->setTemplate('admin/layout/message.php');
		$this->setMessage();
	}

	public function setMessage(){
		$this->message = \Mage::getModel('Admin\Message');
		return $this;
	}
}