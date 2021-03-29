<?php
spl_autoload_register(__NAMESPACE__.'\Mage::loadFileByClassName');
class Mage {
	public static function init() {
		\Controller\Core\Front::init();
	}
	public static function loadFileByClassName($classname){
		$classname = ucwords(str_replace('\\', ' ', $classname));
		$classname = str_replace(' ', '/', $classname).'.php';
		require_once $classname;
	}
	public static function getModel($className){
		$className = self::prepareClassName($className,'Model');
		self::loadFileByClassName($className);
		return new $className();
	}
	public static function getBlock($className, $ton = false){
		if(!$ton){
			$className = self::prepareClassName($className,'Block');
			self::loadFileByClassName($className);
			return new $className();
		}
		$value = self::getRegistry($classname);
		if($value){
			return $value;
		}
		$className = self::prepareClassName($className,'Block');
		self::loadFileByClassName($className);
		$value = new $className(); 
		self::setRegistry($classname, $value);
		return $value;
	}
	public function getController($className){
		self::loadFileByClassName($className);
		return new $className();	
	}
	public static function getBaseDir($subUrl = null){
		return getcwd().DIRECTORY_SEPARATOR.$subUrl;
	}

	public static function prepareClassName($controllerName, $namespace){
		$className = $namespace.'_'.$controllerName;
		$className = str_replace('_', ' ', $className);
		$className = ucwords($className);
		$className = str_replace(' ', '\\', $className);
		return $className;
	}

	public static function setRegistry($classname, $value){
		$GLOBALS[$classname] = $value;
		return $this;
	}

	public static function getRegistry($classname){
		if(!$GLOBALS[$classname]){
			return null;
		}
		return $GLOBALS[$classname];
	}
}
Mage::init();