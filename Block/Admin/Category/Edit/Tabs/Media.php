<?php 
namespace Block\Admin\Category\Edit\Tabs;
\Mage::loadFileByClassName('Block\Core\Template');
class Media extends \Block\Core\Template
{
	protected $categoryMedia = [];
	public function __construct(){
		$this->setTemplate('Admin/Category/edit/tabs/media.php');
	}

	public function validCategory(){
		$category = \Mage::getModel('Category');
		$categoryId = $this->getId();
		if($categoryId){
			if($category->load($categoryId)){
				return true;
			}
		}
		return false;		
	}

	public function setCategoryMedia($categoryMedia = null) {
		if(!$categoryMedia){
			$categoryModel = \Mage::getModel('Category\Media');
			$categoryId = $this->getId();
			$categoryMedia = $categoryModel->fetchMedias($categoryId);
		}
		$this->categoryMedia = $categoryMedia;
		return $this;
	}

	public function getCategoryMedias(){
		if(!$this->categoryMedia){
			$this->setCategoryMedia();
		}
		return $this->categoryMedia;
	}

	public function getImagePath(){
		$categoryModel = \Mage::getModel('Category\Media');
		return $categoryModel->getImagePath();
	}
}