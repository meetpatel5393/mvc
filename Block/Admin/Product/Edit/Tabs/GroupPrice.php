<?php
namespace Block\Admin\Product\Edit\Tabs;
\Mage::loadFileByClassName('Block\Core\Template');
class GroupPrice extends \Block\Core\Template
{
	protected $groupPrice;
    protected $product;
    public function __construct()
    {
        $this->setTemplate('Admin/Product/edit/tabs/groupPrice.php');
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

    public function setGroupPrice($groupPrice = null)
    {
    	$productId = $this->getId();
    	$product = \Mage::getModel('Product\GroupPrice');
    	if(!$groupPrice){
    		$query = "SELECT cg.* , cgp.productId, cgp.entityId, cgp.groupPrice ,
                    if(p.price IS NULL, '{$this->product->price}', p.price) as price
                        FROM customer_group cg
                        LEFT JOIN customer_group_price cgp
                            ON cgp.groupId = cg.groupId
                                AND cgp.productId = {$productId}
                        LEFT JOIN product p
                            ON cgp.productId = p.productId;";
    		$groupPrice = $product->fetchAll($query);
    	}
    	$this->groupPrice = $groupPrice;
    	return $this;
    }

    public function getGroupsPrice()
    {
        if(!$this->groupPrice){
        	$this->setGroupPrice();
        }
        return $this->groupPrice;
    }
}