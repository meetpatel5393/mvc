<?php
namespace Block\Home\Menu;
\Mage::loadFileByClassName('Block\Core\Template');
class CategoryMenu extends \Block\Core\Template
{
	protected $collection;
	public function __construct()
	{
		$this->setTemplate('Home/Menu/categoryMenu.php');
	}

	public function prepareCollection(){
		$model = \Mage::getModel('Category');
		$collection = $model->fetchAll();
		$this->setCollection($collection);
	}

	public function setCollection($collection){
		$this->collection = $collection;
		return $this;
	}

	public function getCollection(){
		if(!$this->collection){
			$this->prepareCollection();
		}
		return $this->collection;
	}
}