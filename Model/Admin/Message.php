<?php 
namespace Model\Admin;
\Mage::loadFileByClassName('Model\Admin\Session');
\Mage::loadFileByClassName('Model\Core\Message\Trait');
class Message extends \Model\Admin\Session
{
	use \Model\Core\Message\Message;
	public function __construct(){
		parent::__construct();
	}
}