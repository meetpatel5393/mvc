<?php
namespace Block\Admin\Admin;
\Mage::loadFileByClassName('Block\Core\Edit');
class Edit extends \Block\Core\Edit
{
    protected $adminData = null;
    public function __construct()
    {
        parent::__construct();
        $this->setTemplate('Admin/Admin/edit.php');
    }

    public function getArrayOfStatus()
    {
        $model = \Mage::getModel('Admin');
        return $model->getArrayOfStatus();
    }
}
