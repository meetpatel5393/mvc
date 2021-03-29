<?php 
namespace Block\Admin\Customer\Group;
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
        $filter->setNamespace('CustomerGroup');
        $filter->setFilters($filter->customerGroupFilters);
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
        $model = \Mage::getModel('Customer\Group');
        $filterModel = \Mage::getModel('Core\Filter');

        $filterModel->setNamespace('CustomerGroup');
        $query = '';
        if(array_key_exists('CustomerGroup', $_SESSION)) {
            $filterModel->setFilters($filterModel->customerGroupFilters);

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
                $query = "SELECT * FROM `customer_group` WHERE {$query}";
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
        $this->addColumn('groupId', [
            'field'=>'groupId',
            'label'=>'Group Id',
            'type'=>'number'
        ]);
        $this->addColumn('name', [
            'field'=>'name',
            'label'=>'Name',
            'type'=>'text'
        ]);
        $this->addColumn('createdDate', [
            'field'=>'createdDate',
            'label'=>'Created Date',
            'type'=>''
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
            'label' => 'Add Group',
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

    public function getDeleteUrl($row){
        return $this->getUrl()->getUrl('delete','Admin\Customer\Group',['groupId'=>$row->groupId]);
    }

    public function getEditUrl($row){
        return $this->getUrl()->getUrl('show','Admin\Customer\Group',['groupId'=>$row->groupId]);
    }

    public function getChangeStatusUrl($row){
		return $this->getUrl()->getUrl('changeStatus', 'Admin\Customer\Group', ['groupId' => $row->groupId]);
	}

    public function getAddNewUrl(){
        return $this->getUrl()->getUrl('show','Admin\Customer\Group',null,true);
    }

    public function getTitle(){
        return 'Customer Group Grid';
    }

    public function getApplyFilterUrl(){
        return $this->getUrl()->getUrl('setFilters', 'Admin\Customer\Group');
    }
}