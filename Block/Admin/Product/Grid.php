<?php
namespace Block\Admin\Product;
\Mage::loadFileByClassName('Block\Core\Template');
class Grid extends \Block\Core\Template
{
	protected $products;
	public function __construct(){
		$this->setTemplate('Admin/Product/grid.php');
	}
	
	public function getProducts(){
		if(!$this->products){
			$this->setProducts();
		}
		return $this->products;
	}
	
	public function setProducts($products = null){
		if(!$products){
			$product = \Mage::getModel('Product');
			$products = $product->fetchAll();
		}
		$this->products = $products;
		return $this;
	}
}
?>