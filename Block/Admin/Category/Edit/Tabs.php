<?php 
namespace Block\Admin\Category\Edit;
\Mage::loadFileByClassName('Block\Core\Template');
class Tabs extends \Block\Core\Template
{
	protected $tabs = [];
	protected $defaultTab = null;
	public function __construct(){
		$this->setTemplate('Admin/Category/edit/tabs.php');
		$this->prepareTabs();
	}

	public function prepareTabs(){
		$this->addTab('form', ['label'=>'Category Information', 'block'=>'Admin\Category\Edit\Tabs\Form']);
		$this->addTab('media', ['label'=>'Media', 'block'=>'Admin\Category\Edit\Tabs\Media']);
		$this->setDefaultTab('form');
	}
}

?>