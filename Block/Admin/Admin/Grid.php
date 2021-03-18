<?php
namespace Block\Admin\Admin;
\Mage::loadFileByClassName('Block\Core\Template');
class Grid extends \Block\Core\Template
{
	protected $admins = [];
	public function __construct(){
		$this->setTemplate('Admin/Admin/grid.php');
	}

	public function setAdmins($admins = null){
		if(!$admins){
			$model = \Mage::getModel('Admin');
			$admins = $model->fetchAll();	
		}
		$this->admins = $admins;
		return $this;
	}
	
	public function getAdmins(){
		if(!$this->admins){
			$this->setAdmins();
		}
		return $this->admins;
	}
}