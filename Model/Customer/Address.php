<?php 
namespace Model\Customer;
\Mage::loadFileByClassName('Model\Core\Table');
class Address extends \Model\Core\Table
{
	public function __construct(){
		$this->setTableName('customer_address');
		$this->setPrimaryKey('customerId');
	}

	public function fetchAddress($addressType, $customerId){
		$query = "SELECT * FROM `{$this->getTableName()}` WHERE `{$this->getPrimaryKey()}` = $customerId AND `addressType` = '{$addressType}'";
		$this->fetchRow($query);
		return $this;
	}

	public function saveAddress($action){
		if($action == 'insert'){
			$query = "INSERT INTO `{$this->getTableName()}` (`".implode('`, `', array_keys($this->data))."`)  VALUES ('".implode('\',\'', array_values($this->data))."');";
			return $this->getAdapter()->insert($query);
		}
		if($action == 'update'){
			$param = null;
			foreach ($this->data as $key => $value) {
				if($key != $this->getPrimaryKey() && $key != 'addressType') {
					$param.= "`{$key}` = '{$value}',";
				}
			}
			$param = rtrim($param,",");
			$query = "UPDATE `{$this->getTableName()}` SET {$param} WHERE {$this->getPrimaryKey()}={$this->data[$this->getPrimaryKey()]}
				AND `addressType`='{$this->data['addressType']}'";
			return $this->getAdapter()->update($query);
		}
	}
}
?>