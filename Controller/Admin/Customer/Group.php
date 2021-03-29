<?php
namespace Controller\Admin\Customer;
\Mage::loadFileByClassName('Controller\Core\Admin');
class Group extends \Controller\Core\Admin
{
    public function gridAction()
    {
        $grid     = \Mage::getBlock('Admin\Customer\Group\Grid')->toHtml();
        $response = [
            'status'  => 'success',
            'message' => 'Customer Group Grid',
            'element' => [
                [
                    'selector' => '#contentHtml',
                    'html'     => $grid,
                ],
                [
                    'selector'=>'#messageHtml',
                    'html'=>null
                ],
                [
                    'selector'=>'#leftHtml',
                    'html'=>null
                ]
            ],
        ];
        header("Content-type: application/json; charset=utf-8");
        echo json_encode($response);
    }

    public function showAction()
    {
        $groupId = (int) $this->getRequest()->getGet('groupId');
        $customerGroup = \Mage::getModel('Customer\Group');
        if($groupId){
            $customerGroup->load($groupId);
        }
        
        $form     = \Mage::getBlock('Admin\Customer\Group\Edit')->setTableRow($customerGroup);
        $form = $form->toHtml();
        $response = [
            'status'  => 'success',
            'message' => 'Customer Group Form',
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
        header("Content-type: application/json; charset=utf-8");
        echo json_encode($response);
    }

    public function saveAction()
    {
        try {
            if (!$this->getRequest()->isPost()) {
                throw new \Exception("Invalid Request");
            }
            $groupModel    = \Mage::getModel('Customer\Group');
            $groupId       = (int) $this->getRequest()->getGet('groupId');
            $customerGroup = $this->getRequest()->getPost('group');
            $data          = $groupModel->load($groupId);
            if ($data) {
                $groupModel->groupId = $groupId;
                $this->getMessage()->setSuccess('Customer Group Successfully Updated');
            } else {
                $groupModel->createdDate = date("Y-m-d H:i:S");
                $this->getMessage()->setSuccess('Customer Group Successfully Created');
            }
            $groupModel->setData($customerGroup);
            $groupModel->save();

        } catch (\Exception $e) {
            $this->getMessage()->setFailure($e->getMessage());
        }
        $grid     = \Mage::getBlock('Admin\Customer\Group\Grid')->toHtml();
        $messageHtml = \Mage::getBlock('Admin\Layout\Message')->toHtml();
        $response = [
            'status'  => 'success',
            'message' => 'Customer Group Grid',
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
        header("Content-type: application/json; charset=utf-8");
        echo json_encode($response);
    }

    public function deleteAction()
    {
        try {
            $id = (int) $this->getRequest()->getGet('groupId');
            if (!$id) {
                throw new \Exception("Invalid Id");
            }
            $groupModel        = \Mage::getModel('Customer\Group');
            $customerGroupData = $groupModel->load($id);
            if (!$customerGroupData) {
                throw new \Exception("Unable to find data on this id.");
            }
            $groupModel->delete();
            $this->getMessage()->setSuccess('Data Successfully Deleted');
        } catch (\Exception $e) {
            $this->getMessage()->setFailure($e->getMessage());
        }
        $grid     = \Mage::getBlock('Admin\Customer\Group\Grid')->toHtml();
        $messageHtml = \Mage::getBlock('Admin\Layout\Message')->toHtml();
        $response = [
            'status'  => 'success',
            'message' => 'Customer Group Grid',
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
        header("Content-type: application/json; charset=utf-8");
        echo json_encode($response);
    }

    public function changeStatusAction(){
        try {
            $model = \Mage::getModel('Customer\Group');
            $id = (int)$this->getRequest()->getGet('groupId');
            if(!$model->load($id)){
                throw new \Exception("Invalid productId");
            }
            if($model->status == 0){
                $model->update(['status'=>1]);
                $this->getMessage()->setSuccess('Status Successfully Enabled');
            } else {
                $model->update(['status'=>0]);
                $this->getMessage()->setSuccess('Status Successfully Disabled');
            }
        } catch (\Exception $e) {
            $this->getMessage()->setFailure($e->getMessage());
        }
        $grid     = \Mage::getBlock('Admin\Customer\Group\Grid')->toHtml();
        $messageHtml = \Mage::getBlock('Admin\Layout\Message')->toHtml();
        $response = [
            'status'  => 'success',
            'message' => 'Customer Group Grid',
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
        header("Content-type: application/json; charset=utf-8");
        echo json_encode($response);
    }

     public function setFiltersAction(){
        try {
            if (!$this->getRequest()->isPost()) {
                throw new \Exception("Invalid Request");
            }
            $filters = $this->getRequest()->getPost('filter');
            $filterModel = \Mage::getModel('Core\Filter');
            $filterModel->setNamespace('CustomerGroup');
            $filterModel->setFilters($filters);
            $filterModel->customerGroupFilters = $filterModel->getFilters();
        } catch (\Exception $e) {
            $this->getMessage()->setFailure($e->getMessage());
        }
        $this->gridAction();
    }
}
