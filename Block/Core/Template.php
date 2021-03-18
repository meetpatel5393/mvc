<?php
namespace Block\Core;
class Template
{
	protected $template = null;
	protected $message = null;
	protected $request = null;
	protected $url = null;
	protected $children = [];
	protected $id = null;
	protected $tabName = null; //
	public function setTemplate($template){
		$this->template = $template;
		return $this;
	}

	public function getTemplate(){
		return $this->template;
	}

	public function toHtml(){
		ob_start();
		require_once 'View/'.$this->getTemplate();
		$content = ob_get_contents();
		ob_end_clean();
		return $content;
	}

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
	
	public function setUrl(){
		$this->url = \Mage::getModel('Core\Url');
		return $this;
	}

	public function getUrl(){
		if(!$this->url){
			$this->setUrl();
		}
		return $this->url;
	}

	public function getMessage(){
		if(!$this->message){
			$this->setMessage();
		}
		return $this->message;
	}

	public function setId(int $id){
		$this->id = $id;
		return $this;
	}

	public function getId(){
		return $this->id;
	}

	public function setTabName($tabName){ //
		$this->tabName = $tabName;
		return $this;
	}

	public function getTabName(){ //
		return $this->tabName;
	}
	
	public function getChildren(){
		return $this->children;
	}
	
	public function setChildren(array $children = []){
		$this->children = $children;
		return $this;
	}
	
	public function getChild($key){
		if(!array_key_exists($key, $this->children)){
			return null;
		}
		return $this->children[$key];
	}
	
	public function addChild(\Block\Core\Template $child , $key = null){
		if(!$key){
			$key = get_class();
		}
		$this->children[$key] = $child;
		return $this;
	}
	
	public function removeChild($key){
		if(array_key_exists($key, $this->children)){
			unset($this->children[$key]);
		}
		return $this;
	}

	public function baseUrl($subUrl = null){
		return $this->getUrl()->baseUrl($subUrl);
	}

	public function addTab($key, $tab =  []){
		$this->tabs[$key] = $tab;
		return $this;
	}

	public function setDefaultTab($tab){
		$this->defaultTab = $tab;
		return $this;
	}

	public function getDefaultTab(){
		return $this->defaultTab;
	}

	public function setTabs(array $tabs){
		$this->tabs = $tabs;
		return $this;
	}

	public function getTabs(){
		return $this->tabs;
	}

	public function removeTab($key){
		if(!array_key_exists($key, $this->tabs)){
			return null;
		}
		unset($this->tabs[$key]);
		return $this;
	}
}