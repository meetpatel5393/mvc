<?php 
namespace Block\Admin\Category\Edit\Tabs;
\Mage::loadFileByClassName('Block\Core\Template');
class Media extends \Block\Core\Template
{
	public function __construct(){
		$this->setTemplate('Admin/Category/edit/tabs/media.php');
	}
}