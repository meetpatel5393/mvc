<?php
namespace Block\Home;
\Mage::loadFileByClassName('Block\Core\Template');
class Index extends \Block\Core\Template
{
	public function __construct()
	{
		$this->setTemplate('Home/index.php');
	}
}