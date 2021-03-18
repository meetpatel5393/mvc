<?php 
namespace Block\Core;
\Mage::loadFileByClassName('Block\Core\Template');
class Edit extends \Block\Core\Template
{
	protected $tab;
	protected $tabClass = null;
	protected $tableRow;
	public function __construct()
	{
		$this->setTemplate('Core\edit.php');
	}

	public function getTabHtml(){
		if($this->getTab()){
			return $this->getTab()->toHtml();
		}
	}

	public function setTab($tabObj = null){
		if(!$tabObj){
			$tabObj = $this->getClass();
		}
		$this->tab = $tabObj;
		return $this;
	}

	public function getTab(){
		if(!$this->tab) {
			$this->setTab();
		}
		return $this->tab;
	}

	public function setClass(\Block\Core\Template $tabClass){
		$this->tabClass = $tabClass;
		return $this;
	}

	public function getClass(){
		return $this->tabClass;
	}

	public function getFormUrl(){
		return $this->getUrl()->getUrl('save');
	}

	public function setTableRow(\Model\Core\Table $tableRow){
		$this->tableRow = $tableRow;
		return $this;
	}

	public function getTableRow(){
		return $this->tableRow;
	}

	public function getTabContent(){
		if($this->getTab()) {
			$tabObject = $this->getTab();
			$tabs = $tabObject->getTabs();
			
			$tab = $this->getTabName();

			if(!array_key_exists($tab, $tabs)){
				$tab = $tabObject->getDefaultTab();
			}

			$blockName = $tabs[$tab]['block'];
			$blockObject = \Mage::getBlock($blockName)->setId($this->getId());
			return $blockObject->toHtml();
		}
	}
}