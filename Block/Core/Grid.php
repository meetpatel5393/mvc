<?php
namespace Block\Core;
\Mage::loadFileByClassName('Block\Core\Template');
class Grid extends \Block\Core\Template
{
	protected $columns = [];
	protected $actions = [];
	protected $buttons = [];
	protected $collection;
	public function __construct()
	{
		$this->setTemplate('core/grid.php');
	}

	public function prepareColumn(){}

	public function prepareActions(){}

	public function prepareButton(){}

	public function prepareCollection(){
		return $this;
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

	public function getColumns(){
		return $this->columns;
	}

	public function addColumn($key, $value){
		$this->columns[$key] = $value;
		return $this;
	}

	public function addAction($key, $value){
		$this->actions[$key] = $value;
		return $this;
	}

	public function getActions(){
		return $this->actions;
	}

	public function addButton($key, $value){
		$this->buttons[$key] = $value;
		return $this;
	}

	public function getButtons(){
		return $this->buttons;
	}

	public function getMethodUrl($row, $methodName){
		return $this->$methodName($row);
	}

	public function getFieldValue($obj, $fieldName){
		return $obj->$fieldName;
	}

	public function getTitle(){
		return 'Default Title';
	}
}