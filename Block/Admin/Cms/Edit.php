<?php
namespace Block\Admin\Cms;
\Mage::loadFileByClassName('Block\Core\Edit');
class Edit extends \Block\Core\Edit
{
    public function __construct()
    {
        $this->setTemplate('Admin/Cms/edit.php');
    }

    public function getArrayOfStatus(){
    	return \Mage::getModel('Cms')->getArrayOfStatus();
    }
}
