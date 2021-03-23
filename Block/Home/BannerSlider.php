<?php
namespace Block\Home;
\Mage::loadFileByClassName('Block\Core\Template');
class BannerSlider extends \Block\Core\Template
{
	public function __construct()
	{
		$this->setTemplate('Home/bannerSlider.php');
	}
}