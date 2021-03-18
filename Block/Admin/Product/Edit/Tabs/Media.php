<?php 
namespace Block\Admin\Product\Edit\Tabs;
\Mage::loadFileByClassName('Block\Core\Edit');
class Media extends \Block\Core\Edit
{	
	protected $productMedias = [];
	public function __construct(){
		$this->setTemplate('Admin/Product/edit/tabs/media.php');
	}
	
	public function validProduct(){
		$product = \Mage::getModel('Product');
		$productId = $this->getId();
		if($productId){
			if($product->load($productId)){
				return true;
			}
		}
		return false;
	}

	public function setProductMedias($productMedias = null) {
		if(!$productMedias){
			$productModel = \Mage::getModel('Product\Media');
			$productId = $this->getId();
			$productMedias = $productModel->fetchMedias($productId);
		}
		$this->productMedias = $productMedias;
		return $this;
	}

	public function getProductMedias(){
		if(!$this->productMedias){
			$this->setProductMedias();
		}
		return $this->productMedias;
	}

	public function getImagePath(){
		$productModel = \Mage::getModel('Product\Media');
		return $productModel->getImagePath();
	}
}