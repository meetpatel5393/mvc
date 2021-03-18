<?php
namespace Block\Customer\Layout;
class Header extends \Block\Core\Template
{
	public function __construct()
	{
		$this->setTemplate('Customer/layout/header.php');
	}
}