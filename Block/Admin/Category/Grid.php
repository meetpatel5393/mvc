<?php
namespace Block\Admin\Category;
\Mage::loadFileByClassName('Block\Core\Template');
class Grid extends \Block\Core\Template
{
	protected $categorys = [];
	public function __construct() {
		$this->setTemplate('Admin/Category/grid.php');
	}

	public function setCategorys($categorys = null){
		if(!$categorys){
			$categorys = \Mage::getModel('Category')->fetchAll();
		}
		$this->categorys = $categorys;
		return $this;
	}
	
	public function getCategorys(){
		if(!$this->categorys){
			$this->setCategorys();
		}
		return $this->categorys;
	}

	public function getPath($path){
		return \Mage::getModel('Category')->getPath($path);
	}
}