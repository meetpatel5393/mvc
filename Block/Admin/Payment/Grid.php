<?php 
namespace Block\Admin\Payment;
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
        $filter->setNamespace('Payment');
        $filter->setFilters($filter->paymentFilters);
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
        $model = \Mage::getModel('Payment');
        $filterModel = \Mage::getModel('Core\Filter');
        $filterModel->setNamespace('Payment');

        $query = '';
        if(array_key_exists('Payment', $_SESSION)) {
           $filterModel->setFilters($filterModel->paymentFilters);

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
                $query = "SELECT * FROM `payment` WHERE {$query}";
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
            'label'=>'Payment Name',
            'type'=>'text'
        ]);
        $this->addColumn('code', [
            'field'=>'code',
            'label'=>'Code',
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
            'label' => 'Pay',
            'method' => 'getAddNewUrl',
            'ajax' => true,
            'class'=>'btn btn-success'
        ]);
        $this->addButton('applyFilter',[
            'label'=>'Apply Filter',
            'ajax'=>true,
            'method'=>'getApplyFilterUrl',
            'class'=>'btn btn-primary'
        ]);
    }

    public function getDeleteUrl($row){
        return $this->getUrl()->getUrl('delete','Admin\Payment',['methodId'=>$row->methodId]);
    }

    public function getEditUrl($row){
        return $this->getUrl()->getUrl('show','Admin\Payment',['methodId'=>$row->methodId]);
    }

    public function getAddNewUrl(){
        return $this->getUrl()->getUrl('show','Admin\Payment',null,true);
    }

    public function getTitle(){
        return 'Payment Grid';
    }

    public function getApplyFilterUrl(){
        return $this->getUrl()->getUrl('setFilters', 'Admin\Payment');
    }
}