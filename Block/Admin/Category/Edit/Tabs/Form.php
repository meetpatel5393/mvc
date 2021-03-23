<?php 
namespace Block\Admin\Category\Edit\Tabs;
\Mage::loadFileByClassName('Block\Core\Template');
class Form extends \Block\Core\Template
{
	protected $category = null;
	protected $parentDropDown = [];
	public function __construct(){
		$this->setTemplate('Admin/Category/edit/tabs/form.php');
	}

	public function getArrayOfStatus(){
		return \Mage::getModel('Category')->getArrayOfStatus();
	}

	public function featuredCategoryStatus(){
		return \Mage::getModel('Category')->featuredCategoryStatus();
	}

	public function setCategory($category = null){
		if(!$category){
			$category  = \Mage::getModel('Category');
			$categoryId = $this->getId();
			$category->load($categoryId);
		}
		$this->category = $category;
		return $this;
	}
	
	public function getCategory(){
		if(!$this->category){
			$this->setCategory();
		}
		return $this->category;
	}

	public function setParentDropDown($dropDown = null){
		if(!$dropDown){
			$query = "SELECT categoryId, name, parentId, path FROM `category`";
			$categoryData = \Mage::getModel('Category')->fetchAll($query)->getData();
			$categoryId = $this->getId();
			if($categoryId)
			{
				foreach ($categoryData as $value) {
					$this->parentDropDown[$value->categoryId] = \Mage::getModel('Category')->getPath( $value->path);
				}
				foreach ($this->parentDropDown as $key => $value) {
					if($key == $categoryId){
						unset($this->parentDropDown[$key]);
					}
				}
				foreach ($categoryData as $value) {
					if($value->parentId == $categoryId){
						unset($this->parentDropDown[$value->categoryId]);
					}
				}
				foreach ($categoryData as $value) {
					$flag = strpos($value->path, $this->category->path);
					if(is_int($flag)) {
						unset($this->parentDropDown[$value->categoryId]);
					}
				}
			}
			else
			{
				foreach ($categoryData as $value) {
					$this->parentDropDown[$value->categoryId] = \Mage::getModel('Category')->getPath( $value->path);
				}	
			}
		}
		return $this;
	}

	public function getParentDropDown(){
		if(!$this->parentDropDown){
			$this->setParentDropDown();
		}
		return $this->parentDropDown;
	}
}