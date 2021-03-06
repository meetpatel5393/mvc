<?php 
namespace Block\Admin\Product\Edit\Tabs;
\Mage::loadFileByClassName('Block\Core\Template');
class Form extends \Block\Core\Template
{
	protected $product = null;
	protected $productBrands;
	public function __construct()
	{
		$this->setTemplate('Admin/Product/edit/tabs/form.php');
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
	
	public function getArrayOfStatus(){
		$model = \Mage::getModel('Product');
		return $model->getArrayOfStatus();
	}	

	public function setProductBrands($productBrands = null){
		if(!$productBrands){
			$model = \Mage::getModel('productBrand');
			$productBrands = $model->fetchAll();
		}
		$this->productBrands = $productBrands;
		return $this;
	}

	public function getProductBrands(){
		if(!$this->productBrands){
			$this->setProductBrands();
		}
		return $this->productBrands;
	}
}
