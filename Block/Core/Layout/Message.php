<?php
namespace Block\Core\Layout;
class Message extends \Block\Core\Template
{
	public function __construct()
	{
		$this->setTemplate('core/layout/message.php');
	}
}