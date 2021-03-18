<?php
namespace Model\Product;
\Mage::loadFileByClassName('Model\Core\Table');
class Media extends \Model\Core\Table
{
	protected $media = [];
	public function __construct(){
		$this->setTableName('product_images');
	}
	
	public function saveProductImage(){
		$sql = "INSERT INTO `{$this->getTableName()}` (`".implode('`, `', array_keys($this->data))."`)  VALUES ('".implode('\',\'', array_values($this->data))."');";
		$returnId = $this->getAdapter()->insert($sql);
		$this->load($returnId);
		return true;
	}
	
	public function fetchMedias(int $id){
		$query = "SELECT * FROM `{$this->getTableName()}` WHERE `productId` = {$id}";
		return $this->fetchAll($query);
	}

	public function updateMedia(){		
		$data = $this->data;
		if(array_key_exists('label', $data)) {
			foreach ($data['label'] as $key => $value) {
				$this->media[$key] = [
					'label' => $value,
					'gallery' => 'off'
				];
			}
		}

		foreach ($this->media as $key => $value) {
			if(array_key_exists('small', $data)){
				if($data['small'][0] == $key){
					$this->media[$key]['small'] = 1;
				} else {
					$this->media[$key]['small'] = 0;
				}
			}

			if(array_key_exists('thumb', $data)){
				if($data['thumb'][0] == $key){
					$this->media[$key]['thumb'] = 1;
				} else {
					$this->media[$key]['thumb'] = 0;
				}
			}

			if(array_key_exists('base', $data)){
				if($data['base'][0] == $key){
					$this->media[$key]['base'] = 1;
				} else {
					$this->media[$key]['base'] = 0;
				}
			}

			if(array_key_exists('gallery', $data)){
				foreach ($data['gallery'] as $key1 => $value1) {
					if($key == $key1){
						$this->media[$key]['gallery'] = 'on';
					}
				}
			}
		}

		foreach ($this->media as $key => $value) 
		{
			$param = null;
			foreach ($value as $key1 => $value1) {
				$param.= "`{$key1}` = '{$value1}',";
			}
			$param = rtrim($param,",");
			$query = "UPDATE `{$this->getTableName()}`
					SET {$param} 
					WHERE `imageName` = '{$key}'";
			$this->getAdapter()->update($query);
		}
		return true;
	}

	public function removeMedia(){
		$remove = $this->getData();
		foreach ($remove as $key => $value) {
			$query = "DELETE FROM `product_images` WHERE imageName = '{$key}'";
			return $this->getAdapter()->delete($query);
		}
	}

	public function getImagePath(){
		return \Mage::getBaseDir('Image\product\\');
	}
}
?>