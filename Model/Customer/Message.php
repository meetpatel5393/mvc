<?php 
namespace Model\Customer;
\Mage::loadFileByClassName('Model\Customer\Session');
\Mage::loadFileByClassName('Model\Core\Message\Trait');
class Message extends \Model\Customer\Session
{
	use \Model\Core\Message\Message;
	public function __construct(){
		parent::__construct();
	}
}