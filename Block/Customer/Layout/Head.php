<?php
namespace Block\Customer\Layout;
class Head extends \Block\Core\Template
{
	public function __construct()
	{
		$this->setTemplate('customer/layout/head.php');
	}
}