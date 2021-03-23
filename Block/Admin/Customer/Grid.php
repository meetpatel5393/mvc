<?php
namespace Block\Admin\Customer;
\Mage::loadFileByClassName('Block\Core\Grid');
class Grid extends \Block\Core\Grid
{
	public function __construct()
	{
		parent::__construct();
		$this->prepareColumn();
		$this->prepareButton();
		$this->prepareActions();
	}

	public function prepareCollection(){
		$model = \Mage::getModel('Customer');
        $filterModel = \Mage::getModel('Core\Filter');

        $filterModel->setNamespace('Customer');
        $query = '';

        if(array_key_exists('Customer', $_SESSION)) {
            $filterFields = $filterModel->CustomerGrid;
            if(empty(implode('', array_values($filterFields)))){
                $collection = $model->fetchAll();
            } else {
                foreach ($filterFields as $key => $value) {
                    if($value) {
                        $query.= "$key LIKE '$value%' AND ";
                    }
                }
                $query = "SELECT * FROM `customer` WHERE {$query}";
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
		$this->addColumn('customerId',[
			'field'=>'customerId',
			'label'=>'Customer Id',
			'type'=>'text'
		]);
		$this->addColumn('firstName',[
			'field'=>'firstName',
			'label'=>'First Name',
			'type'=>'text'
		]);
		$this->addColumn('lastName',[
			'field'=>'lastName',
			'label'=>'Last Name',
			'type'=>'text'
		]);
		$this->addColumn('email',[
			'field'=>'email',
			'label'=>'Email',
			'type'=>'text'
		]);
		$this->addColumn('status',[
			'field'=>'status',
			'label'=>'Status',
			'type'=>'number'
		]);
		$this->addColumn('createdDate',[
			'field'=>'createdDate',
			'label'=>'Created Date',
			'type'=>'date'
		]);
		$this->addColumn('groupName',[
			'field'=>'name',
			'label'=>'Group Name',
			'type'=>'text'
		]);
		$this->addColumn('zipCode',[
			'field'=>'zipcode',
			'label'=>'Zip Code',
			'type'=>'number'
		]);
		$this->addColumn('action',[
			'field'=>'action',
			'label'=>'action',
			'type'=>''
		]);
	}

	public function prepareButton(){
		$this->addButton('addNewButton',[
			'label'=>'Add Customer',
			'method'=>'getAddNewUrl',
			'ajax'=>true,
			'class'=>'btn btn-success'
		]);
		$this->addButton('applyFilter',[
			'label'=>'Apply Filter',
			'method'=>'getApplyFilterUrl',
			'ajax'=>true,
			'class'=>'btn btn-primary'
		]);
	}
		
	public function prepareActions(){
		$this->addAction('edit',[
			'label'=>'Edit',
			'ajax'=>true,
			'method'=>'getEditUrl'
		]);
		$this->addAction('delete',[
			'label'=>'Delete',
			'ajax'=>true,
			'method'=>'getDeleteUrl'
		]);
		$this->addAction('changeStatus',[
			'label'=>'Enabled',
			'ajax'=>true,
			'method'=>'getChangeStatusUrl'
		]);
	}

	public function getEditUrl($row){
		return $this->getUrl()->getUrl('show','Admin\Customer',['customerId'=>$row->customerId]);
	}

	public function getDeleteUrl($row){
		return $this->getUrl()->getUrl('delete','Admin\Customer',['customerId'=>$row->customerId]);
	}

	public function getChangeStatusUrl($row){
		return $this->getUrl()->getUrl('changeStatus', 'Admin\Customer', ['customerId' => $row->customerId]);
	}

	public function getAddNewUrl(){
		return $this->getUrl()->getUrl('show','Admin\Customer',[],true);
	}

	public function getTitle(){
		return 'Customer Grid';
	}

	public function getApplyFilterUrl(){
		return $this->getUrl()->getUrl('setFilters', 'Admin\Customer');
	}
}