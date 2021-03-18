<?php
namespace Model;
\Mage::loadFileByClassName('Model\Core\Table');
class Product extends \Model\Core\Table
{
	public const STATUS_ENABLED = 1;
	public const STATUS_DISABLED = 0;
	public $arrayOfStatus = [
		self::STATUS_ENABLED => 'Enabled',
		self::STATUS_DISABLED => 'Disabled'
	];
	
	public function __construct(){
		$this->setTableName('product');
		$this->setPrimaryKey('productId');
	}
	
	public function getArrayOfStatus(){
		return $this->arrayOfStatus;
	}
}