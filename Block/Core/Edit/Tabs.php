<?php 
namespace Block\Core\Edit;
\Mage::loadFileByClassName('Block\Core\Template');
class Tabs extends \Block\Core\Template
{
	public function __construct(){
		$this->setTemplate('core/edit/tabs.php');
	}

	public function prepareTabs(){
		
	}
}
?>