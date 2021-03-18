<?php 
namespace Model\Customer;
\Mage::loadFileByClassName('Model\Core\Table');
class Group extends \Model\Core\Table
{
	public const STATUS_ENABLED = 1;
	public const STATUS_DISABLED = 0;
	public $arrayOfStatus = [
		self::STATUS_ENABLED => 'Enabled',
		self::STATUS_DISABLED => 'Disabled'
	];
	
	public function __construct() {
		$this->setTableName('customer_group');
		$this->setPrimaryKey('groupId');
	}

	public function getArrayOfStatus(){
		return $this->arrayOfStatus;
	}
}

?>