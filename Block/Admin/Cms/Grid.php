<?php
namespace Block\Admin\Cms;
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
        $model = \Mage::getModel('Cms');
        $filterModel = \Mage::getModel('Core\Filter');

        $filterModel->setNamespace('Cms');
        $query = '';

        if(array_key_exists('Cms', $_SESSION)) {
            $filterFields = $filterModel->CmsGrid;
            if(empty(implode('', array_values($filterFields)))){
                $collection = $model->fetchAll();
            } else {
                foreach ($filterFields as $key => $value) {
                    if($value) {
                        $query.= "$key LIKE '$value%' AND ";
                    }
                }
                $query = "SELECT * FROM `cms_page` WHERE {$query}";
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
        $this->addColumn('pageId', [
            'field'=>'pageId',
            'label'=>'Page Id',
            'type'=>'number'
        ]);
        $this->addColumn('identifier', [
            'field'=>'identifier',
            'label'=>'Identifier',
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
    }

    public function prepareButton(){
        $this->addButton('addNew', [
            'label' => 'Add Page',
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
        return $this->getUrl()->getUrl('delete', 'Admin\Cms', ['pageId' => $row->pageId]);  
    }

    public function getEditUrl($row){
        return $this->getUrl()->getUrl('show', 'Admin\Cms', ['pageId' => $row->pageId]);
    }

    public function getAddNewUrl(){
        return $this->getUrl()->getUrl('show', 'Admin\Cms', [], true);
    }

    public function getTitle(){
        return 'CMS Grid';
    }

    public function getApplyFilterUrl(){
        return $this->getUrl()->getUrl('setFilters', 'Admin\Cms');
    }
}