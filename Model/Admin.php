<?php 
namespace Model;
\Mage::loadFileByClassName('Model\Core\Table');
class Admin extends \Model\Core\Table
{
	public const STATUS_ENABLED = 1;
	public const STATUS_DISABLED = 0;
	public $arrayOfStatus = [
		self::STATUS_ENABLED => 'Enabled',
		self::STATUS_DISABLED => 'Disabled'
	];
	
	public function __construct(){
		$this->setTableName('admin');
		$this->setPrimaryKey('adminId');
	}
	
	public function getArrayOfStatus(){
		return $this->arrayOfStatus;
	}
}