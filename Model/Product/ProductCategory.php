<?php
namespace Model\Product;
\Mage::loadFileByClassName('Model\Core\Table');
class ProductCategory extends \Model\Core\Table
{
	public function __construct()
	{
		$this->setTableName('product_category');
		$this->setPrimaryKey('primaryId');
	}

	public function load($id){
		if(!$id) {
			return false;
		}
		$sql = "SELECT * FROM `{$this->getTableName()}` WHERE `productId`='{$id}'";
		return $this->fetchRow($sql);
	}
}
