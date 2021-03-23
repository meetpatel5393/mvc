<?php
namespace Model\Category;
\Mage::loadFileByClassName('Model\Core\Table');
class Media extends \Model\Core\Table
{
	protected $media = [];
	public function __construct(){
		$this->setTableName('category_images');
	}

	public function saveCategoryImage(){
		$sql = "INSERT INTO `{$this->getTableName()}` (`".implode('`, `', array_keys($this->data))."`)  VALUES ('".implode('\',\'', array_values($this->data))."');";
		$returnId = $this->getAdapter()->insert($sql);
		$this->load($returnId);
		return true;
	}
	
	public function fetchMedias(int $id){
		$query = "SELECT * FROM `{$this->getTableName()}` WHERE `categoryId` = {$id}";
		return $this->fetchAll($query);
	}

	public function updateMedia(){		
		$data = $this->data;
		$query = '';
		if(array_key_exists('icon', $data)){
			$query .= "UPDATE `{$this->getTableName()}`
					SET icon = 1
					WHERE `imageName` = '{$data['icon'][0]}' AND `categoryId` = $data[categoryId];";

			$query.= "UPDATE `{$this->getTableName()}` 
					SET icon = 0 
					WHERE `imageName` NOT IN ('{$data['icon'][0]}') AND `categoryId` = $data[categoryId];";
		}

		if(array_key_exists('base', $data)){
			$query .= "UPDATE `{$this->getTableName()}`
					SET base = 1
					WHERE `imageName` = '{$data['base'][0]}' AND `categoryId` = $data[categoryId];";

			$query.= "UPDATE `{$this->getTableName()}` 
					SET base = 0 
					WHERE `imageName` NOT IN ('{$data['base'][0]}') AND `categoryId` = $data[categoryId];";
		}

		if(array_key_exists('banner', $data)){
			$imgs = implode('\',\'', array_keys($data['banner']));
			$query.= "UPDATE `{$this->getTableName()}` 
					SET banner = 1
					WHERE `imageName` IN ('{$imgs}') AND `categoryId` = $data[categoryId];";

			$query.= "UPDATE `{$this->getTableName()}` 
					SET banner = 0
					WHERE `imageName` NOT IN ('{$imgs}') AND `categoryId` = $data[categoryId];";
		}

		if(!array_key_exists('banner', $data)){
			$query .= "UPDATE `{$this->getTableName()}` 
					SET banner = 0
					WHERE `categoryId` = $data[categoryId];";
		}

		if($this->getAdapter()->multiQuery($query)){
			return true;
		}
		return false;
	}

	public function removeMedia(){
		$remove = $this->getData();
		foreach ($remove as $key => $value) {
			$query = "DELETE FROM `category_images` WHERE imageName = '{$key}'";
			return $this->getAdapter()->delete($query);
		}
	}

	public function getImagePath(){
		return \Mage::getBaseDir('Media\Category\\');
	}
}