<?php 
namespace Block\Admin\Customer\Edit;
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
		$this->addTab('form',['label'=>'Customer Information', 'block'=>'Admin\Customer\Edit\Tabs\Form']);
		$this->addTab('address', ['label'=>'Customer Address', 'block'=>'Admin\Customer\Edit\Tabs\Address']);
		$this->setDefaultTab('form');
		return $this;
	}
}