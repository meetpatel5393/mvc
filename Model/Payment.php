<?php
namespace Model;
\Mage::loadFileByClassName('Model\Core\Table');
class Payment extends \Model\Core\Table
{	
	public $paymentNameArray = [
		'type1' => 'Cod',
		'type2' => 'Google Pay',
		'type3' => 'Card'
	];
	
	public function __construct(){
		$this->setTableName('payment');
		$this->setPrimaryKey('methodId');
	}
	
	public function getArrayOfPaymentName(){
		return $this->paymentNameArray;
	}
}