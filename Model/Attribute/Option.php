<?php 
namespace Model\Attribute;
\Mage::loadFileByClassName('Model\Core\Table');
class Option extends \Model\Core\Table
{
	public function __construct()
	{
		$this->setTableName('attributeoption');
		$this->setPrimaryKey('optionId');
	}

	public function deleteOption($optionIds,$attributeId){
		$query = "DELETE FROM `{$this->getTableName()}` 
		WHERE `{$this->getPrimaryKey()}` NOT IN ($optionIds) AND `attributeId` = $attributeId;";
		return $this->getAdapter()->delete($query);
	}

}