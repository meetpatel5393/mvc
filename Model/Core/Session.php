<?php 
namespace Model\Core;
class Session
{
	protected $namespace;
	public function __construct(){
		$this->start();
	}
	
	public function setNameSpace($namespace) {
		$this->namespace = $namespace;
		return $this;
	}
	
	public function getNameSpace() {
		return $this->namespace;
	}
	
	public function start() {
		if(session_status() == PHP_SESSION_NONE){
			session_start();
		}
		return $this;
	}
	
	public function destroy() {
		session_destroy();
	}
	
	public function getId() {
		return session_id();
	}
	
	public function regenerateId() {
		return session_regenerate_id();
	}
	
	public function __unset($key) {
		if(array_key_exists($key, $_SESSION[$this->getNameSpace()])){
			unset($_SESSION[$this->getNameSpace()][$key]);
		}
		return $this;
	}
	
	public function __set($key, $value) {
		$_SESSION[$this->getNameSpace()][$key] = $value;
		return $this;
	}
	
	public function __get($key) {
		if(array_key_exists($this->getNameSpace(), $_SESSION)) {
			if(array_key_exists($key, $_SESSION[$this->getNameSpace()])) {
				return $_SESSION[$this->getNameSpace()][$key];
			}
		}
		return null;
	}
}