<?php 
namespace Block\Admin\Attribute;
\Mage::loadFileByClassName('Block\Core\Template');
class Grid extends \Block\Core\Template
{
	protected $attributes;
	public function __construct()
	{
		$this->setTemplate('Admin\Attribute\grid.php');
	}

	public function setAttributes($attributes = null){
		if(!$attributes){
			$attributeModel = \Mage::getModel('Attribute');
			$attributes = $attributeModel->fetchAll();
		}
		$this->attributes = $attributes;
		return $this;
	}

	public function getAttributes(){
		if(!$this->attributes){
			$this->setAttributes();
		}
		return $this->attributes;
	}
}