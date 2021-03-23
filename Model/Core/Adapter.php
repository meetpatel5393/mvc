<?php 
namespace Model\Core;
class Adapter
{
	public $config = [
		'serverName' => 'localhost',
		'userName' => 'root',
		'password' => '',
		'databaseName' => 'cybercom1'
	];
	private $connect = null;
	public function connection() {
		$connect = new \mysqli(
			$this->config['serverName'],
			$this->config['userName'],
			$this->config['password'],
			$this->config['databaseName']
		);
		$this->setConnect($connect);
	}
	
	public function setConnect(\mysqli $connect) {
		$this->connect = $connect;
		return $this;
	}
	
	public function getConnect() {
		return $this->connect;
	}
	
	public function isConnected() {
		if(!$this->connect) {
			return false;
		}
		return true;
	}
	
	public function insert($query)
    {
    	try {
    		 if (!$this->isConnected()) {
	            $this->connection();
	        }
	        $result = $this->getConnect()->query($query);
	        if (!$result) {
	            return false;
	        }
	        return $this->getConnect()->insert_id;
    	} catch (Exception $e) {
    		
    	}
    }
	
	public function update($query) {
		try {
			 if(!$this->isConnected()) {
	            $this->connection();
	        }
	        if(!$this->getConnect()->query($query)) {
	            return false;
	        }
	        return true;
		} catch (Exception $e) {
			
		}
    }
    
    public function fetchAll($query)
    {
    	try {
    		 if (!$this->isConnected()) {
	            $this->connection();
	        }
	        $result = $this->getConnect()->query($query);
	        $rows = $result->fetch_all(MYSQLI_ASSOC);
	        if (!$rows) {
	            return false;
	        }
	        return $rows;
    	} catch (Exception $e) {
    		
    	}
    }
    
    public function fetchRow($query){
    	try {
    		 if (!$this->isConnected()) {
	            $this->connection();
	        }
	        $result = $this->getConnect()->query($query);
	        $row = $result->fetch_assoc();	
	        if (!$row) {
	            return false;
	        }
	        return $row;
    	} catch (Exception $e) {
    		
    	}
    }
    
    public function delete($query) {
    	try {
    		if(!$this->isConnected()) {
				$this->connection();
			}
			return $this->getConnect()->query($query);
    	} catch (Exception $e) {
    		
    	}
    }

    public function fetchPairs($query){
    	if(!$this->isConnected()){
    		$this->connection();
    	}
    	$result = $this->getConnect()->query($query);
    	$rows = $result->fetch_all();
    	if(!$rows){
    		return $rows;
    	}
    	$column = array_column($rows, 0);
    	$values = array_column($rows, 1);
    	return array_combine($column, $values);
    }

    public function executeQuery($query){
    	if(!$this->isConnected()){
    		$this->connection();
    	}
    	return $this->getConnect()->query($query);
    }

    public function fetchOne($query){
    	if(!$this->isConnected()){
    		$this->connection();
    	}
    	$result = $this->getConnect()->query($query);
    	return $result->num_rows;
    }

    public function multiQuery($query){
    	if(!$this->isConnected()){
    		$this->connection();
    	}
    	return $this->getConnect()->multi_query($query);
    }
}