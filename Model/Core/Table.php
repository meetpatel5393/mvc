<?php
namespace Model\Core;
\Mage::loadFileByClassName('Model\Core\Adapter');
class Table
{
	protected $primaryKey = null;
	protected $tableName = null;
	protected $data = [];
	protected $adapter = null;
	
	public function getPrimaryKey(){
		return $this->primaryKey;
	}
	
	public function setPrimaryKey($primaryKey){
		$this->primaryKey = $primaryKey;
		return $this;
	}
	
	public function getTableName(){
		return $this->tableName;
	}
	
	public function setTableName($tableName){
		$this->tableName = $tableName;
		return $this;
	}
	
	public function getAdapter() {
		if(!$this->adapter) {
			$this->setAdapter();
		}
		return $this->adapter;
	}
	
	public function setAdapter() {
		$this->adapter = new \Model\Core\Adapter();
		return $this;
	}
	
	public function __set($key, $value){
		$this->data[$key] = $value;
		return $this;
	}
	
	public function __get($key){
		if(!array_key_exists($key,$this->data)) {
			return null;
		}
		return $this->data[$key];
	}
	
	public function setData(array $data){
		$this->data = array_merge($this->data,$data);
		return $this;
	}
	
	public function getData(){
		return $this->data;
	}
	
	public function save(){
		if(!array_key_exists($this->getPrimaryKey(), $this->data)) {
			$sql = "INSERT INTO `{$this->getTableName()}` (`".implode('`, `', array_keys($this->data))."`)  VALUES ('".implode('\',\'', array_values($this->data))."');";
			$returnId = $this->getAdapter()->insert($sql);
			$this->load($returnId);
			return $returnId;
		}
		$param = null;
		foreach ($this->data as $key => $value) {
			if($key != $this->getPrimaryKey()) {
				$param.= "`{$key}` = '{$value}',";
			}
		}
		$param = rtrim($param,",");
		$sql = "UPDATE `{$this->getTableName()}` SET {$param} WHERE {$this->getPrimaryKey()}={$this->data[$this->getPrimaryKey()]}";
		$this->getAdapter()->update($sql);
		$this->load($this->getData()[$this->getPrimaryKey()]);
		return true;
	}
	
	public function load($id){
		if(!$id) {
			return false;
		}
		$sql = "SELECT * FROM `{$this->getTableName()}` WHERE {$this->getPrimaryKey()}='{$id}'";
		return $this->fetchRow($sql);
	}
	
	public function fetchRow($query) {
		$row = $this->getAdapter()->fetchRow($query);
		if(!$row) {
			return null;
		}
		$this->data = $row;
		return $this;
	}
	
	public function delete(){
		$id = $this->getData()[$this->getPrimaryKey()];
		$sql = "DELETE FROM `{$this->getTableName()}` 
				WHERE `{$this->getPrimaryKey()}`={$id}";
		return $this->getAdapter()->delete($sql);
	}
	
	public function fetchAll($sql = null) {
		if(!$sql){
			$sql = "SELECT * FROM `{$this->getTableName()}`";
		}
		$arrayOfObject = [];
		$array = $this->getAdapter()->fetchAll($sql);
		if($array) {
			foreach ($array as $key => $value) {
				$key = new $this;
				$arrayOfObject[] = $key->setData($value);
			}
		}
		$collection = \Mage::getModel(str_replace('Model\\', '', get_called_class()).'\Collection');
		$collection->setData($arrayOfObject);
		return $collection;
	}
	
	public function update(array $params = null , $query = null){
		$sql = null;

		if($params){
			$param = null;
			foreach ($params as $key => $value) {
				$param.= "`{$key}` = '{$value}',";
			}
			$param = rtrim($param,",");
			$sql = "UPDATE `{$this->getTableName()}` SET {$param} WHERE {$this->getPrimaryKey()}={$this->data[$this->getPrimaryKey()]}";	
		}

		if($query){
			$sql = $query;
		}
		
		if($sql){
			$this->getAdapter()->update($sql);
		}
	}
}