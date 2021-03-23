<?php
namespace Model;
\Mage::loadFileByClassName('Model\Core\Table');
class Category extends \Model\Core\Table
{
	protected $categoriesData = [];
	protected $categoryOptions = [];
	public const STATUS_ENABLED = 1;
	public const STATUS_DISABLED = 0;
	public const STATUS_YES = 1;
	public const STATUS_NO = 0;
	public $arrayOfStatus = [
		self::STATUS_ENABLED => 'Enabled',
		self::STATUS_DISABLED => 'Disabled'
	];
	
	public $featuredCategoryStatus = [
		self::STATUS_YES => 'Yes',
		self::STATUS_NO => 'No'
	];

	public function __construct(){
		$this->setTableName('category');
		$this->setPrimaryKey('categoryId');
	}
	
	public function getArrayOfStatus(){
		return $this->arrayOfStatus;
	}

	public function featuredCategoryStatus(){
		return $this->featuredCategoryStatus;
	}

	public function setCategoriesData($categoriesData = null){
		if(!$categoriesData){
			$query = "SELECT categoryId, parentId, path,name FROM `{$this->getTableName()}`;";
			$categoriesData = $this->fetchAll($query)->getData();
		}
		$this->categoriesData = $categoriesData;
		return $this;
	}

	public function getCategoriesData(){
		if(!$this->categoriesData){
			$this->setCategoriesData();
		}
		return $this->categoriesData;
	}

	public function setCategoryOptions($categoryOptions = null){
		$this->getCategoriesData();
		if(!$categoryOptions){
			foreach ($this->categoriesData as  $value) {
				$this->categoryOptions[$value->categoryId] = $value->name;
			}
		}
		return $this;
	}

	public function getCategoryOptions(){
		if(!$this->categoryOptions){
			$this->setCategoryOptions();
		}
		return $this->categoryOptions;
	}

	public function getPath($path){
		$this->getCategoryOptions();
		$pathInStr = '';
		$path = explode('=', $path);
		foreach ($path as $value) {
			foreach ($this->categoryOptions as $key => $value1) {
				if($value == $key){
					$pathInStr.=$value1.' => ';
				}
			}
		}
		$pathInStr = trim($pathInStr,'=> ');
		return $pathInStr;
	}

	/*for only data update*/
	public function updatePaths($categoryId, $newPath, $oldPath){
		foreach ($this->categoriesData as  $category) {
			$category = $category->getData();
			if ($category['categoryId'] != $categoryId) {
				$flag = strpos($category['path'], $oldPath);
				if(is_int($flag)){
					$childNewPath = str_replace($oldPath, $newPath, $category['path']);
					$query = "UPDATE `category` SET `path` = '{$childNewPath}'
							WHERE `{$this->getPrimaryKey()}` = {$category['categoryId']}";
					$this->update(null,$query);
				}	
			}
		}
	}

	/*for data delete*/
	public function updateChildPaths($categoryId, $parentId, $oldPath) {
		if(!$parentId){
			$newPath = 0;
			$newParent = 0;
		}
		if($parentId){
			foreach ($this->categoriesData as  $category) {
				$category = $category->getData();
				if($category['categoryId'] == $parentId){
					$newPath = $category['path'];
				}
			}
		}
		foreach ($this->categoriesData as  $category) {
			$category = $category->getData();
			if ($category['categoryId'] != $categoryId) {
				$flag = strpos($category['path'], $oldPath);
				if(is_int($flag)) {
					if(!$newPath){
						$childNewPath = str_replace($oldPath.'=', '', $category['path']);	
					}
					if($newPath){
						$childNewPath = str_replace($oldPath, $newPath, $category['path']);
					}
					$query = "UPDATE `category` SET `path` = '{$childNewPath}'  WHERE `{$this->getPrimaryKey()}` = {$category['categoryId']}";
					if($category['parentId'] == $categoryId){
						$query = "UPDATE `category` SET `path` = '{$childNewPath}', `parentId` = '{$parentId}' WHERE `{$this->getPrimaryKey()}` = {$category['categoryId']}";
					}
					$this->update(null,$query);
				}
			}
		}
	}
}