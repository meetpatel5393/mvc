<?php
namespace Block\Admin\Layout;
class Header extends \Block\Core\Template
{
	public function __construct()
	{
		$this->setTemplate('admin/layout/header.php');
	}
}