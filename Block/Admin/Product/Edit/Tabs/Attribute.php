<?php 
namespace Block\Admin\Product\Edit\Tabs;
\Mage::loadFileByClassName('Block\Core\Template');
class Attribute extends \Block\Core\Template
{
	protected $attributes;
	protected $product = null;
	public function __construct(){
		$this->setTemplate('Admin/Product/edit/tabs/attribute.php');
	}

	public function setAttribute($attributes = null){
		if(!$attributes){
			$productId = $this->getId();
			$attributeModel = \Mage::getModel('Attribute');
			$query = "SELECT * FROM `attribute` WHERE `entityTypeId` = 'product' ORDER BY `sortOrder`";
			$attributes = $attributeModel->fetchAll($query);
		}
		$this->attributes = $attributes;
		return $this;
	}

	public function getAttribute(){
		if(!$this->attributes){
			$this->setAttribute();
		}
		return $this->attributes;
	}

	public function getAttributeOption($attributeId) {
		$attributeOptionModel = \Mage::getModel('Attribute\Option');
		$query = "SELECT attributeoption.* , attribute.code FROM attributeOption LEFT JOIN attribute ON attributeoption.attributeId = attribute.attributeId WHERE attribute.attributeId = {$attributeId} ORDER BY `sortOrder`";
		return $attributeOptionModel->fetchAll($query);
	}

	public function setProduct($product = null){
		try {
			if($product){
				$this->product = $product;
				return $this;
			}
			$product = \Mage::getModel('Product');
			$productId = $this->getId();
			if($productId){
				$product->load($productId);
			}
			$this->product = $product;
			return $this;
		} catch (Exception $e) {
			echo $e->getMessage();
		}
	}
	
	public function getProduct(){
		if(!$this->product){
			$this->setProduct();
		}
		return $this->product;
	}
}