<?php 
namespace Block\Admin\Attribute;
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
		$filter->setNamespace('Attribute');
		$filter->setFilters($filter->attributeFilters);
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
        $model = \Mage::getModel('Attribute');
        $filterModel = \Mage::getModel('Core\Filter');
        $filterModel->setNamespace('Attribute');

        $query = '';
        if(array_key_exists('Attribute', $_SESSION)) {
        	$filterModel->setFilters($filterModel->attributeFilters);


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
                $query = "SELECT * FROM `attribute` WHERE {$query}";
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
		$this->addColumn('attributeId', [
			'field'=>'attributeId',
			'label'=>'Attribute Id',
			'type'=>'number'
		]);
		$this->addColumn('entityTypeId', [
			'field'=>'entityTypeId',
			'label'=>'Entity Type Id',
			'type'=>'number'
		]);
		$this->addColumn('name', [
			'field'=>'name',
			'label'=>'Name',
			'type'=>'text'
		]);
		$this->addColumn('inputType', [
			'field'=>'inputType',
			'label'=>'Input Type',
			'type'=>'text'
		]);
		$this->addColumn('backendType', [
			'field'=>'backendType',
			'label'=>'Backend Type',
			'type'=>'text'
		]);
		$this->addColumn('action', [
			'field'=>'action',
			'label'=>'Action',
			'type'=>''
		]);
	}

	public function prepareActions(){
		$this->addAction('addOption', [
			'label'=>'Add Option',
			'method'=>'addOptionUrl',
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
			'label' => 'Add Attribute',
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
		return $this->getUrl()->getUrl('delete','Admin\Attribute',['attributeId'=>$row->attributeId]);	
	}

	public function addOptionUrl($row){
		return $this->getUrl()->getUrl('show', 'Admin\Attribute\Option', ['attributeId' => $row->attributeId]);
	}

	public function getAddNewUrl(){
		return $this->getUrl()->getUrl('show','Admin\Attribute',null,true);
	}

	public function getTitle(){
		return 'Attribute Grid';
	}

	public function getApplyFilterUrl(){
        return $this->getUrl()->getUrl('setFilters', 'Admin\Attribute');
    }
}