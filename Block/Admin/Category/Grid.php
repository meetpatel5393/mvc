<?php
namespace Block\Admin\Category;
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
		$filter->setNamespace('Category');
		$filter->setFilters($filter->categoryFilters);
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
        $model = \Mage::getModel('Category');
        $filterModel = \Mage::getModel('Core\Filter');
        $filterModel->setNamespace('Category');    

        $query = '';
        if(array_key_exists('Category', $_SESSION)) {
           $filterModel->setFilters($filterModel->categoryFilters);
        	
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
                $query = "SELECT * FROM `category` WHERE {$query}";
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
		$this->addColumn('categoryId', [
			'field'=>'categoryId',
			'label'=>'Category Id',
			'type'=>'number'
		]);
		$this->addColumn('name', [
			'field'=>'name',
			'label'=>'Name',
			'type'=>'text'
		]);
		$this->addColumn('parentId', [
			'field'=>'parentId',
			'label'=>'Parent Id',
			'type'=>'number'
		]);
		$this->addColumn('status', [
			'field'=>'status',
			'label'=>'Status',
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
			'label' => 'Add Category',
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
		return $this->getUrl()->getUrl('show','Admin\Category',['categoryId'=>$row->categoryId]);
	}

	public function getDeleteUrl($row){
		return $this->getUrl()->getUrl('delete','Admin\Category',['categoryId'=>$row->categoryId]);
	}

	public function getChangeStatusUrl($row){
		return $this->getUrl()->getUrl('changeStatus', 'Admin\Category', ['categoryId' => $row->categoryId]);
	}

	public function getAddNewUrl(){
		return $this->getUrl()->getUrl('show','Admin\Category',[],true);
	}

	public function getTitle(){
		return 'Category Grid';
	}

	public function getPath($path){
		return \Mage::getModel('Category')->getPath($path);
	}

	public function getApplyFilterUrl(){
		return $this->getUrl()->getUrl('setFilters', 'Admin\Category');
	}
}