<?php 
namespace Block\Admin\Product\Edit\Tabs;
\Mage::loadFileByClassName('Block\Core\Template');
class Category extends \Block\Core\Template
{
	protected $categorys = [];
	protected $product;
	protected $productCategory;
	public function __construct(){
		$this->setTemplate('Admin/Product/edit/tabs/category.php');
	}
	
	public function setCategorys($categorys = null){
		if(!$categorys){
			$categorys = \Mage::getModel('Category')->fetchAll();
		}
		$this->categorys = $categorys;
		return $this;
	}
	
	public function getCategorys(){
		if(!$this->categorys){
			$this->setCategorys();
		}
		return $this->categorys;
	}

	public function getPath($path){
		return \Mage::getModel('Category')->getPath($path);
	}

	public function validProduct()
    {
        $product = \Mage::getModel('Product');
        $productId = $this->getId();
        if ($productId) {
            if ($product->load($productId)) {
                $this->product = $product;
                return true;
            }
        }
        return false;
    }

    public function getProductCategory(){
    	$productCategoryModel = \Mage::getModel('Product\ProductCategory');
    	if($this->product->productId){
			$productCategoryModel->load($this->product->productId);
    	}
    	$this->productCategory = $productCategoryModel;
    	return $this->productCategory;
    }
}