<?php
namespace Model;
\Mage::loadFileByClassName('Model\Core\Table');
class Cms extends \Model\Core\Table
{
	public const STATUS_ENABLED = 1;
	public const STATUS_DISABLED = 0;
	public $arrayOfStatus = [
		self::STATUS_ENABLED => 'Enabled',
		self::STATUS_DISABLED => 'Disabled'
	];
	
	public function __construct(){
		$this->setTableName('cms_page');
		$this->setPrimaryKey('pageId');
	}
	
	public function getArrayOfStatus(){
		return $this->arrayOfStatus;
	}
}