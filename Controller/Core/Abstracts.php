<?php
namespace Controller\Core;
class Abstracts
{	
	protected $request = null;
	protected $message = null;
	protected $layout = null;
	
	public function setRequest() {
		$this->request = \Mage::getModel('Core\Request');
		return $this;
	}
	
	public function getRequest() {
		if(!$this->request){
			$this->setRequest();
		}
		return $this->request;
	}

	public function getMessage(){
		if(!$this->message){
			$this->setMessage();
		}
		return $this->message;
	}
	
	public function getUrl($actionName=null, $controllerName=null, $params=null, $resetParams=false) {
		$final = $this->getRequest()->getGet();
		if($resetParams == true) {
			$final = [];
		}
		if($actionName == null) {
			$actionName = $this->getRequest()->getGet('a');
		}
		if($controllerName == null) {
			$controllerName = $this->getRequest()->getGet('c');
		}
		$final['a'] = $actionName;
		$final['c'] = $controllerName;
		if(is_array($params)) {
			$final = array_merge($final,$params);
		}
		$query  = http_build_query($final);
		$url = "http://localhost/cybercom1/index.php?{$query}";
		return $url;
	}
	
	public function redirect($actionName=null, $controllerName=null, $params=null, $resetParams=false) {
		$url = $this->getUrl($actionName, $controllerName, $params, $resetParams);
		header("Location:{$url}");
		exit(0);
	}

	public function getLayout(){
		if(!$this->layout){
			$this->setLayout();
		}
		return $this->layout;
	}

	public function renderLayout(){
		echo $this->getLayout()->toHtml();
	}
}