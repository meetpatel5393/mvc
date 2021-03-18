<?php
namespace Model;
\Mage::loadFileByClassName('Model\Core\Table');
class Customer extends Core\Table
{
	public const STATUS_ENABLED = 1;
	public const STATUS_DISABLED = 0;
	public $arrayOfStatus = [
		self::STATUS_ENABLED => 'Enabled',
		self::STATUS_DISABLED => 'Disabled'
	];
	
	public function __construct(){
		$this->setTableName('customer');
		$this->setPrimaryKey('customerId');
	}
	
	public function getArrayOfStatus(){
		return $this->arrayOfStatus;
	}

	public function customerData(){
		$query = "SELECT customer.customerId,customer.firstName,customer.lastName,customer.email,customer.status ,customer.createdDate, customer_group.name , customer_address.zipcode
			FROM ((customer LEFT JOIN customer_group ON customer.groupId = customer_group.groupId)
			LEFT JOIN customer_address ON customer.customerId = customer_address.customerId AND customer_address.addressType = 'billing');
            ";
        return $this->fetchAll($query);
	}
}