<?php 
namespace Model;
\Mage::loadFileByClassName('Model\Core\Table');
class Shipping extends \Model\Core\Table
{
	public function __construct(){
		$this->setTableName('shipping');
		$this->setPrimaryKey('methodId');
	}
}