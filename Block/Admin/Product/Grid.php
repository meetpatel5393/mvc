<?php
namespace Block\Admin\Product;
class Grid extends \Block\Core\Grid
{
	protected $filter;
	public function __construct(){
		parent::__construct();
		$this->prepareColumn();
		$this->prepareActions();
		$this->prepareButton();
	}

	public function setFilter($filter = null){
		if(!$filter){
			$filter = \Mage::getModel('Core\Filter');
		}
		$filter->setNamespace('Product');
		$filter->setFilters($filter->productFilters);
		$this->filter = $filter;
		return $this;
	}

	public function getFilter(){
		if(!$this->filter){
			$this->setFilter();
		}
		return $this->filter;
	}

	public function prepareCollection(){
        $model = \Mage::getModel('Product');
        $filterModel = \Mage::getModel('Core\Filter');
        $filterModel->setNamespace('Product');

        $query = '';
        if(array_key_exists('Product', $_SESSION)) {
            $filterFields = $filterModel->ProductGrid;
           	$filterModel->setFilters($filterModel->productFilters);

        	if(!$filterModel->getFilters()) 
        	{
                $collection = $model->fetchAll();
        	}
            else 
            {
                foreach ($filterModel->getFilters() as $fieldType => $fieldNames) {
                	foreach ($fieldNames as $fieldName => $value) {
                        $query.= "$fieldName LIKE '$value%' AND ";
                	}
                }
                $query = "SELECT * FROM `product` WHERE {$query}";
                $query = rtrim($query, ' AND ');
                $collection = $model->fetchAll($query);
            }
        } else {
            $collection = $model->fetchAll();
        }
        $this->setCollection($collection);
        return $this;
    }

	public function prepareColumn(){
		$this->addColumn('productId',[
			'field'=>'productId',
			'label'=>'Product Id',
			'type'=>'number'
		]);
		$this->addColumn('name',[
			'field'=>'name',
			'label'=>'Name',
			'type'=>'text'
		]);
		$this->addColumn('sku',[
			'field'=>'sku',
			'label'=>'Sku',
			'type'=>'number'
		]);
		$this->addColumn('price',[
			'field'=>'price',
			'label'=>'Price',
			'type'=>'number'
		]);
		$this->addColumn('discount',[
			'field'=>'discount',
			'label'=>'Discount',
			'type'=>'number'
		]);
		$this->addColumn('quantity',[
			'field'=>'quantity',
			'label'=>'Quantity',
			'type'=>'number'
		]);
		$this->addColumn('status',[
			'field'=>'status',
			'label'=>'Status',
			'type'=>'number'
		]);
		$this->addColumn('action',[
			'field'=>'action',
			'label'=>'Action',
			'type'=>''
		]);
	}

	public function prepareActions(){
		$this->addAction('edit',[
			'label'=>'Edit',
			'ajax'=>true,
			'method'=>'getEditUrl',
			'type'=>'button'
		]);
		$this->addAction('delete',[
			'label'=>'Delete',
			'ajax'=>true,
			'method'=>'getDeleteUrl',
			'type'=>'checkbox'
		]);
		$this->addAction('addToCart',[
			'label'=>'Add To Cart',
			'ajax'=>true,
			'method'=>'getAddToCartUrl',
		]);
		$this->addAction('changeStatus',[
			'label'=>'Enabled',
			'ajax'=>true,
			'method'=>'getChangeStatusUrl',
			'type'=>'button'
		]);
	}

	public function getEditUrl($row){
		return $this->getUrl()->getUrl('show', 'Admin\Product', ['productId' => $row->productId]);
	}

	public function getChangeStatusUrl($row){
		return $this->getUrl()->getUrl('changeStatus', 'Admin\Product', ['productId' => $row->productId]);
	}

	public function getDeleteUrl($row){
		return $this->getUrl()->getUrl('delete', 'Admin\Product', ['productId' => $row->productId]);
	}

	public function prepareButton(){
		$this->addButton('addNew',[
			'label'=>'Add Product',
			'ajax'=>true,
			'method'=>'getAddNewUrl',
			'class'=>'btn btn-success'
		]);
		$this->addButton('applyFilter',[
			'label'=>'Apply Filter',
			'ajax'=>true,
			'method'=>'getApplyFilterUrl',
			'class'=>'btn btn-primary'
		]);
		$this->addButton('gotocart',[
			'label'=>'Go To Cart',
			'ajax'=>true,
			'method'=>'getGoToCartUrl',
			'class'=>'btn btn-outline-danger'
		]);
	}

	public function getAddNewUrl(){
		return $this->getUrl()->getUrl('show', 'Admin\Product', [], true);
	}

	public function getApplyFilterUrl(){
		return $this->getUrl()->getUrl('setFilters', 'Admin\Product');
	}

	public function getAddToCartUrl($row){
		return $this->getUrl()->getUrl('addToCart', 'Admin\Cart', ['productId' => $row->productId]);
	}

	public function getGoToCartUrl(){
		return $this->getUrl()->getUrl('index', 'Admin\Cart');
	}
}