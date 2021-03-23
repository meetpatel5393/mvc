<?php
namespace Block\Admin\Admin;
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
		$filter->setNamespace('Admin');
		$filter->setFilters($filter->adminFilters);
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
        $model = \Mage::getModel('Admin');
        $filterModel = \Mage::getModel('Core\Filter');
        $filterModel->setNamespace('Admin');

        $query = '';
        if(array_key_exists('Admin', $_SESSION)) {
        	$filterModel->setFilters($filterModel->adminFilters);

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
                $query = "SELECT * FROM `admin` WHERE {$query}";
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
		$this->addColumn('adminId', [
			'field'=>'adminId',
			'label'=>'Admin Id',
			'type'=>'number'
		]);
		$this->addColumn('userName', [
			'field'=>'userName',
			'label'=>'User Name',
			'type'=>'text'
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
			'label' => 'Add Admin',
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
		return $this->getUrl()->getUrl('show',null,['adminId'=>$row->adminId]);
	}

	public function getDeleteUrl($row){
		return $this->getUrl()->getUrl('delete',null,['adminId'=>$row->adminId]);	
	}

	public function getChangeStatusUrl($row){
		return $this->getUrl()->getUrl('changeStatus', 'Admin\Admin', ['adminId' => $row->adminId]);
	}

	public function getAddNewUrl(){
		return $this->getUrl()->getUrl('show','Admin\Admin',null,true);
	}

	public function getTitle(){
		return 'Admin Grid';
	}

	public function getApplyFilterUrl(){
        return $this->getUrl()->getUrl('setFilters', 'Admin\Admin');
    }
}