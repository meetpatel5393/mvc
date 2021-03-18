<?php 
namespace Block\Admin\Payment;
\Mage::loadFileByClassName('Block\Core\Template');
class Grid extends \Block\Core\Template
{
	protected $payments = [];
	public function __construct()
	{
		$this->setTemplate('Admin/Payment/grid.php');
	}
	
	public function setPayments($payments = null){
		if($payments){
			$this->payments = $payments;
			return $this;
		}
		$model = \Mage::getModel('Payment');
		$this->payments = $model->fetchAll();
		return $this;
	}
	
	public function getPayments(){
		if(!$this->payments){
			$this->setPayments();
		}
		return $this->payments;
	}
}