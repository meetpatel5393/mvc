<?php 
namespace Model\Core;
class Url
{
	protected $request = null;
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
		$url = "http://localhost/mvc/index.php?{$query}";
		return $url;
	}
	
	public function baseUrl($subUrl = null){
		$url = "http://localhost/mvc/";
		if($subUrl){
			$url .= $subUrl;
		}
		return $url;
	}
}

?>