<?php 
namespace Model\Core;
class Request
{
	public function getPost($key = null, $optional = null) {
		try {
			if(!$key) {
				return $_POST;
			}
			if(!array_key_exists($key, $_POST)) {
				return $optional;
			}
			return $_POST[$key];
		} catch (Exception $e) {
			
		}
	}
	
	public function getGet($key = null, $optional = null) {
		try {
			if(!$key) {
				return $_GET;
			}
			if(!array_key_exists($key, $_GET)) {
				return $optional;
			}
			return $_GET[$key];
		} catch (Exception $e) {
			
		}
	}
	
	public function isPost() {
		if($_SERVER['REQUEST_METHOD'] != 'POST') {
			return false;
		}
		return true;
	}
	
	public function getActionName(){
		return $this->getGet('a','index');
	}
	
	public function getControllerName(){
		return $this->getGet('c','home');
	}
}
?>