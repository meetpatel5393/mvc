<?php
namespace Block\Admin\Shipping;
\Mage::loadFileByClassName('Block\Core\Template');
class Grid extends \Block\Core\Template
{
	protected $shippings = [];
	public function __construct()
	{
		$this->setTemplate('Admin/Shipping/grid.php');
	}
	
	public function setShippings($shippings = null){
		if($shippings){
			$this->shippings = $shippings;
			return $this;
		}
		$model = \Mage::getModel('Shipping');
		$this->shippings = $model->fetchAll();
		return $this;
	}
	
	public function getShippings(){
		if(!$this->shippings){
			$this->setShippings();
		}
		return $this->shippings;
	}
}