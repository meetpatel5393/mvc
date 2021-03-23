<?php
namespace Block\Home;
\Mage::loadFileByClassName('Block\Core\Template');
class BrandImage extends \Block\Core\Template
{
	public function __construct()
	{
		$this->setTemplate('Home/brandImage.php');
	}

	public function getFileCount(){
		return $this->fileCount;
	}

	public function getBrands(){
		$model = \Mage::getModel('productBrand');
		$query = "SELECT * FROM `product_brand` ORDER BY `sortOrder`";
		$collection = $model->fetchAll($query);
		return $collection;
	}
}