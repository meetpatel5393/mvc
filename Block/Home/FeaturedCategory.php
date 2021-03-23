<?php
namespace Block\Home;
\Mage::loadFileByClassName('Block\Core\Template');
class FeaturedCategory extends \Block\Core\Template
{
	public function __construct()
	{
		$this->setTemplate('Home/featuredCategory.php');
	}

	public function getFeaturedCategory(){
		$model = \Mage::getModel('Category');
		$query = "SELECT * FROM `category` 
				LEFT JOIN `category_images` 
				ON category.categoryId = category_images.categoryId 
				WHERE category.featured = 1 
				GROUP BY category.categoryId LIMIT 5;";
		$featuredCategory = $model->fetchAll($query);
		return $featuredCategory;
	}
}