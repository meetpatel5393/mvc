<?php
namespace Controller\Admin;
\Mage::loadFileByClassName('Controller\Core\Admin');
class Admin extends \Controller\Core\Admin
{
    protected $model = null;
    public function setModel()
    {
        $this->model = \Mage::getModel('Admin');
        return $this;
    }

    public function getModel()
    {
        if (!$this->model) {
            $this->setModel();
        }
        return $this->model;
    }

    public function gridAction()
    {
        $grid     = \Mage::getBlock('Admin\Admin\Grid')->toHtml();
        $response = [
            'status'  => 'success',
            'message' => 'Grid of Admin',
            'element' => [
                [
                    'selector' => '#contentHtml',
                    'html'     => $grid,
                ],
                [
                    'selector'=>'#messageHtml',
                    'html'=>null
                ]
            ],
        ];
        header('Content-Type:application/json; charset=utf-8');
        echo json_encode($response);
    }

    public function showAction()
    {
        try {
            $adminId = (int) $this->getRequest()->getGet('adminId');
            $admin = \Mage::getModel('Admin');
            if($adminId){
                $adminData = $admin->load($adminId);
                if(!$adminData) {
                    throw new \Exception("Unable to find data on this id");
                }
            }
            $form     = \Mage::getBlock('Admin\Admin\Edit')->setTableRow($admin)->toHtml();
            $response = [
                'status'  => 'success',
                'message' => 'Admin Form',
                'element' => [
                    [
                        'selector' => '#contentHtml',
                        'html'     => $form,
                    ],
                    [
                        'selector'=>'#messageHtml',
                        'html'=>null
                    ]
                ],
            ];
            header('Content-Type:application/json; charset=utf-8');
            echo json_encode($response);
        } catch (\Exception $e) {
            $this->getMessage()->setFailure($e->getMessage());
        }
    }

    public function saveAction()
    {
        try {
            if (!$this->getRequest()->isPost()) {
                throw new \Exception("Invalid Request");
            }
            $adminData = $this->getRequest()->getPost('admin');
            $adminId   = (int) $this->getRequest()->getGet('adminId');
            $data      = $this->getModel()->load($adminId);
            if ($data) {
                $this->getModel()->adminId = $adminId;
                $this->getMessage()->setSuccess('Admin Successfully Updated');
            } else {
                $this->getModel()->createdDate = date('Y/m/d H:i:s');
                $this->getMessage()->setSuccess('Admin Successfully Created');
            }
            $this->getModel()->setData($adminData);
            $this->getModel()->save();
        } catch (\Exception $e) {
            $this->getMessage()->setFailure($e->getMessage());
        }
        $grid     = \Mage::getBlock('Admin\Admin\Grid')->toHtml();
        $messageHtml = \Mage::getBlock('Admin\Layout\Message')->toHtml();
        $response = [
            'status'  => 'success',
            'message' => 'Grid of Admin',
            'element' => [
                [
                    'selector' => '#contentHtml',
                    'html'     => $grid,
                ],
                [
                    'selector'=>'#messageHtml',
                    'html'=>$messageHtml
                ]
            ],
        ];
        header('Content-Type:application/json; charset=utf-8');
        echo json_encode($response);
    }

    public function deleteAction()
    {
        try {
            $adminId = (int) $this->getRequest()->getGet('adminId');
            if (!$adminId) {
                throw new \Exception("Invalid Id");
            }
            $adminData = $this->getModel()->load($adminId);
            if (!$adminData) {
                throw new \Exception("Unable to find data on this id.");
            }
            $this->getModel()->delete();
            $this->getMessage()->setSuccess('Data Successfully Deleted');
        } catch (\Exception $e) {
            $this->getMessage()->setFailure($e->getMessage());
        }
        $grid     = \Mage::getBlock('Admin\Admin\Grid')->toHtml();
        $messageHtml = \Mage::getBlock('Admin\Layout\Message')->toHtml();
        $response = [
            'status'  => 'success',
            'message' => 'Grid of Admin',
            'element' => [
                [
                    'selector' => '#contentHtml',
                    'html'     => $grid,
                ],
                [
                    'selector'=>'#messageHtml',
                    'html'=>$messageHtml
                ]
            ],
        ];
        header('Content-Type:application/json; charset=utf-8');
        echo json_encode($response);
    }

    public function changeStatusAction(){
        try {
            $id = (int)$this->getRequest()->getGet('adminId');
            if(!$this->getModel()->load($id)){
                throw new \Exception("Invalid productId");
            }
            if($this->getModel()->status == 0){
                $this->getModel()->update(['status'=>1]);
                $this->getMessage()->setSuccess('Status Successfully Enabled');
            } else {
                $this->getModel()->update(['status'=>0]);
                $this->getMessage()->setSuccess('Status Successfully Disabled');
            }
        } catch (\Exception $e) {
            $this->getMessage()->setFailure($e->getMessage());
        }
        $grid     = \Mage::getBlock('Admin\Admin\Grid')->toHtml();
        $messageHtml = \Mage::getBlock('Admin\Layout\Message')->toHtml();
        $response = [
            'status'  => 'success',
            'message' => 'Grid of Admin',
            'element' => [
                [
                    'selector' => '#contentHtml',
                    'html'     => $grid,
                ],
                [
                    'selector'=>'#messageHtml',
                    'html'=>$messageHtml
                ]
            ],
        ];
        header('Content-Type:application/json; charset=utf-8');
        echo json_encode($response);
    }
}
