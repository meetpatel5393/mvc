<?php
namespace Model\Product;
\Mage::loadFileByClassName('Model\Core\Table');
class GroupPrice extends \Model\Core\Table
{
	public function __construct()
	{
		$this->setTableName('customer_group_price');
		$this->setPrimaryKey('entityId');
	}

	public function fetchGroupPriceData($productId, $groupId){
		$query = "	SELECT * FROM `{$this->getTableName()}`
					WHERE `productId` = {$productId}
					AND `groupId` = {$groupId} ";
		return $this->fetchRow($query);
	}
}
