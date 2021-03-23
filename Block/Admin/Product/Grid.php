<?php
namespace Block\Admin\Product;
\Mage::loadFileByClassName('Block\Core\Grid');
class Grid extends \Block\Core\Grid
{
	public function __construct(){
		parent::__construct();
		$this->prepareColumn();
		$this->prepareActions();
		$this->prepareButton();
	}

	public function prepareCollection(){
        $model = \Mage::getModel('Product');
        $filterModel = \Mage::getModel('Core\Filter');

        $filterModel->setNamespace('Product');
        $query = '';
        if(array_key_exists('Product', $_SESSION)) {
            $filterFields = $filterModel->ProductGrid;
            if(empty(implode('', array_values($filterFields)))){
                $collection = $model->fetchAll();
            } else {
                foreach ($filterFields as $key => $value) {
                    if($value) {
                        $query.= "$key LIKE '$value%' AND ";
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
	}

	public function getAddNewUrl(){
		return $this->getUrl()->getUrl('show', 'Admin\Product', [], true);
	}

	public function getApplyFilterUrl(){
		return $this->getUrl()->getUrl('setFilters', 'Admin\Product');
	}

}