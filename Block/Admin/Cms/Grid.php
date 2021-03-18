<?php
namespace Block\Admin\Cms;
\Mage::loadFileByClassName('Block\Core\Template');
class Grid extends \Block\Core\Template
{
	protected $cmsPages = [];
    public function __construct()
    {
        $this->setTemplate('Admin/Cms/grid.php');
    }

    public function setCmsPages($cmsPages = null){
    	if(!$cmsPages){
    		$cmsModel = \Mage::getModel('Cms');
    		$cmsPages = $cmsModel->fetchAll();
    	}
    	$this->cmsPages = $cmsPages;
    	return $this;
    }

    public function getCmsPages(){
    	if(!$this->cmsPages){
    		$this->setCmsPages();
    	}
    	return $this->cmsPages;
    }
}
