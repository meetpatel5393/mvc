<?php
namespace Block\Admin\ProductBrand;
\Mage::loadFileByClassName('Block\Core\Grid');
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
		$filter->setNamespace('ProductBrand');
		$filter->setFilters($filter->productBrandFilters);
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
        $model = \Mage::getModel('ProductBrand');
        $filterModel = \Mage::getModel('Core\Filter');
        $filterModel->setNamespace('ProductBrand');

        $query = '';
        if(array_key_exists('ProductBrand', $_SESSION)) {
            $filterModel->setFilters($filterModel->productBrandFilters);

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
                $query = "SELECT * FROM `product_brand` WHERE {$query}";
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
		$this->addColumn('brandId', [
			'field'=>'brandId',
			'label'=>'Brand Id',
			'type'=>'number'
		]);
		$this->addColumn('name', [
			'field'=>'name',
			'label'=>'Name',
			'type'=>'text'
		]);
		$this->addColumn('sortOrder', [
			'field'=>'sortOrder',
			'label'=>'SortOrder',
			'type'=>'number'
		]);
		$this->addColumn('status', [
			'field'=>'status',
			'label'=>'Status',
			'type'=>'number'
		]);
		$this->addColumn('createdDate', [
			'field'=>'createdDate',
			'label'=>'Created Date',
			'type'=>'date'
		]);
		$this->addColumn('action', [
			'field'=>'action',
			'label'=>'Action',
			'type'=>''
		]);
	}

	public function prepareActions(){
		$this->addAction('edit', [
			'label'=>'Edit',
			'method'=>'getEditUrl',
			'ajax'=>true
		]);
		$this->addAction('delete', [
			'label'=>'Delete',
			'method'=>'getDeleteUrl',
			'ajax'=>true
		]);
		$this->addAction('changeStatus', [
			'label'=>'Enabled',
			'method'=>'getChangeStatusUrl',
			'ajax'=>true
		]);
	}

	public function prepareButton(){
		$this->addButton('addNew', [
			'label' => 'Add Brand',
			'method' => 'getAddNewUrl',
			'ajax' => true,
			'class'=>'btn btn-success'
		]);
		$this->addButton('applyFilter',[
            'label'=>'Apply Filter',
            'method'=>'getApplyFilterUrl',
            'ajax'=>true,
            'class'=>'btn btn-primary'
        ]);
	}

	public function getEditUrl($row){
		return $this->getUrl()->getUrl('show',null,['brandId'=>$row->brandId]);
	}

	public function getDeleteUrl($row){
		return $this->getUrl()->getUrl('delete',null,['brandId'=>$row->brandId]);	
	}

	public function getChangeStatusUrl($row){
		return $this->getUrl()->getUrl('changeStatus', 'Admin\ProductBrand', ['brandId' => $row->brandId]);
	}

	public function getAddNewUrl(){
		return $this->getUrl()->getUrl('show','Admin\ProductBrand',null,true);
	}

	public function getTitle(){
		return 'Brand Grid';
	}

	public function getApplyFilterUrl(){
        return $this->getUrl()->getUrl('setFilters', 'Admin\ProductBrand');
    }
}