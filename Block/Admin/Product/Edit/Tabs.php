<?php 
namespace Block\Admin\Product\Edit;
\Mage::loadFileByClassName('Block\Core\Edit\Tabs');
class Tabs extends \Block\Core\Edit\Tabs
{
	protected $tabs = [];
	protected $defaultTab = null;
	public function __construct()
	{
		parent::__construct();
		$this->prepareTabs();
	}

	public function prepareTabs(){
		$this->addTab('form', ['label'=>'Product Information','block'=>'Admin\Product\Edit\Tabs\Form']);
		$this->addTab('Media', ['label'=>'Media','block'=>'Admin\Product\Edit\Tabs\Media']);
		$this->addTab('Category', ['label'=>'Category','block'=>'Admin\Product\Edit\Tabs\Category']);
		$this->addTab('Group', ['label'=>'Customer Group Price','block'=>'Admin\Product\Edit\Tabs\GroupPrice']);
		$this->addTab('attribute', ['label'=>'Attribute','block'=>'Admin\Product\Edit\Tabs\Attribute']);
		$this->setDefaultTab('form');
		return $this;
	}
}
?>