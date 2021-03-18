<?php 
namespace Block\Admin\Attribute\Edit;
\Mage::loadFileByClassName('Block\Core\Edit');
class Option extends \Block\Core\Edit
{
	protected $attributeOptions;
	public function __construct()
	{
		$this->setTemplate('Admin\Attribute\Edit\option.php');
	}

	public function setAttributeOptions($attributeOptions = null){
		if(!$attributeOptions){
			$optionModel = \Mage::getModel('Attribute\Option');
			$query = "SELECT * FROM `{$optionModel->getTableName()}` 
			WHERE `attributeId` = {$this->getTableRow()->attributeId}";
			$attributeOptions = $optionModel->fetchAll($query);
		}
		$this->attributeOptions = $attributeOptions;
		return $this;
	}

	public function getAttributeOptions(){
		if(!$this->attributeOptions){
			$this->setAttributeOptions();
		}
		return $this->attributeOptions;
	}
}