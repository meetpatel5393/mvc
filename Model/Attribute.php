<?php 
namespace Model;
\Mage::loadFileByClassName('Model\Core\Table');
class Attribute extends \Model\Core\Table
{
	public function __construct()
	{
		$this->setTableName('attribute');
		$this->setPrimaryKey('attributeId');
	}

	public function getBackEndTypeOption(){
		return [
			'varchar'=>'Varchar',
			'int'=>'Int',
			'decimal'=>'Decimal',
			'text'=>'Text'
		];
	}

	public function getInputTypeOption(){
		return [
			'text'=>'Text Box',
			'textarea'=>'Text Area',
			'select'=>'Select',
			'checkbox'=>'CheckBox',
			'radio'=>'Radio'
		];
	}

	public function getEntityTypeOption(){
		return [
			'product'=>'Product',
			'category'=>'Category'
		];
	}

	public function makeColumn(){
		if(!$this->attributeId){
			$query = "ALTER TABLE {$this->entityTypeId}
					ADD {$this->code} {$this->backendType}(50)";
			return $this->getAdapter()->executeQuery($query);
		}
	}

	public function deleteColumn(){
		$query = "ALTER TABLE {$this->entityTypeId} DROP COLUMN {$this->code}";
		return $this->getAdapter()->executeQuery($query);
	}
}