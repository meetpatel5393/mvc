<?php
namespace Block\Admin\Shipping;
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
        $model = \Mage::getModel('Shipping');
        $filterModel = \Mage::getModel('Core\Filter');

        $filterModel->setNamespace('Shipping');
        $query = '';
        if(array_key_exists('Shipping', $_SESSION)) {
            $filterFields = $filterModel->ShippingGrid;
            if(empty(implode('', array_values($filterFields)))){
                $collection = $model->fetchAll();
            } else {
                foreach ($filterFields as $key => $value) {
                    if($value) {
                        $query.= "$key LIKE '$value%' AND ";
                    }
                }
                $query = "SELECT * FROM `shipping` WHERE {$query}";
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
        $this->addColumn('methodId', [
            'field'=>'methodId',
            'label'=>'Method Id',
            'type'=>'number'
        ]);
        $this->addColumn('name', [
            'field'=>'name',
            'label'=>'Name',
            'type'=>'text'
        ]);
        $this->addColumn('code', [
            'field'=>'code',
            'label'=>'Code',
            'type'=>'number'
        ]);
        $this->addColumn('amount', [
            'field'=>'amount',
            'label'=>'Amount',
            'type'=>'number'
        ]);
        $this->addColumn('description', [
            'field'=>'description',
            'label'=>'Description',
            'type'=>'text'
        ]);
         $this->addColumn('status', [
            'field'=>'status',
            'label'=>'Status',
            'type'=>''
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
    }

    public function prepareButton(){
        $this->addButton('addNew', [
            'label' => 'Add Shipping',
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
        return $this->getUrl()->getUrl('delete','Admin\Shipping',['methodId'=>$row->methodId]);
    }

    public function getEditUrl($row){
        return $this->getUrl()->getUrl('show','Admin\Shipping',['methodId'=>$row->methodId]);
    }

    public function getAddNewUrl(){
        return $this->getUrl()->getUrl('show','Admin\Shipping',null,true);
    }

    public function getTitle(){
        return 'Shipping Grid';
    }

    public function getApplyFilterUrl(){
        return $this->getUrl()->getUrl('setFilters', 'Admin\Shipping');
    }
}