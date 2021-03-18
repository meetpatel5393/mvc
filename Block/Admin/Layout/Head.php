<?php
namespace Block\Admin\Layout;
class Head extends \Block\Core\Template
{
	public function __construct()
	{
		$this->setTemplate('admin/layout/head.php');
	}
}