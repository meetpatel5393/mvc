<?php
namespace Controller\Admin;
\Mage::loadFileByClassName('Controller\Core\Customer');
class Customer extends \Controller\Core\Customer
{
    protected $model = null;
    public function getModel()
    {
        if (!$this->model) {
            $this->setModel();
        }
        return $this->model;
    }

    public function setModel()
    {
        $this->model = \Mage::getModel('customer');
        return $this;
    }

    public function gridAction()
    {
        $gridHtml = \Mage::getBlock('Admin\Customer\Grid')->toHtml();
        $response = [
            'status'  => 'success',
            'message' => 'u are execellent',
            'element' => [
                [
                    'selector' => '#contentHtml',
                    'html'     => $gridHtml,
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

    public function showAction()
    {
        $customerId = (int)$this->getRequest()->getGet('customerId');
        $tabName = $this->getRequest()->getGet('tab');
        $formHtml = \Mage::getBlock('Admin\Customer\Edit')->setId($customerId)->setTabName($tabName);
        $formHtml = $formHtml->toHtml();
        $response = [
            'status'  => 'success',
            'message' => 'u are execellent',
            'element' => [
                [
                    'selector' => '#contentHtml',
                    'html'     => $formHtml,
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
            $customerId   = (int) $this->getRequest()->getGet('customerId');
            $customerData = $this->getRequest()->getPost('customer');
            $data = $this->getModel()->load($customerId);
            if ($data) {
                $this->getModel()->updatedDate = date("Y-m-d");
                $this->getModel()->customerId  = $customerId;
                $this->getMessage()->setSuccess('Customer Data Successfully Updated');
            } else {
                $this->getModel()->createdDate = date("Y-m-d");
                $this->getMessage()->setSuccess('Customer Successfully Created');
            }
            $this->getModel()->setData($customerData);
            $this->getModel()->save();

            $gridHtml = \Mage::getBlock('Admin\Customer\Grid')->toHtml();
            $messageHtml = \Mage::getBlock('Customer\Layout\Message')->toHtml();
            $response = [
                'status'  => 'success',
                'message' => 'u are execellent',
                'element' => [
                    [
                        'selector' => '#contentHtml',
                        'html'     => $gridHtml,
                    ],
                    [
                        'selector'=>'#messageHtml',
                        'html'=>$messageHtml
                    ]
                ],
            ];
            header("Content-type: application/json; charset=utf-8");
            echo json_encode($response);
        } catch (\Exception $e) {
            $this->getMessage()->setFailure($e->getMessage());
        }
    }

    public function deleteAction()
    {
        try {
            $id = (int) $this->getRequest()->getGet('customerId');
            if (!$id) {
                throw new \Exception("Invalid Id");
            }
            $customerData = $this->getModel()->load($id);
            if (!$customerData) {
                throw new \Exception("Unable to find data on this id.");
            }
            $this->getModel()->delete();
            $this->getMessage()->setSuccess('Data Successfully Deleted');

            $gridHtml = \Mage::getBlock('Admin\Customer\Grid')->toHtml();
            $messageHtml = \Mage::getBlock('Customer\Layout\Message')->toHtml();
            $response = [
                'status'  => 'success',
                'message' => 'Data Successfully Deleted',
                'element' => [
                    [
                        'selector' => '#contentHtml',
                        'html'     => $gridHtml,
                    ],
                    [
                        'selector'=>'#messageHtml',
                        'html'=>$messageHtml
                    ]
                ],
            ];
            header("Content-type: application/json; charset=utf-8");
            echo json_encode($response);
        } catch (\Exception $e) {
            $this->getMessage()->setFailure($e->getMessage());
        }
    }

    public function saveAddressAction()
    {
        try {
            if (!$this->getRequest()->isPost()) {
                throw new \Exception("Invalid Request");
            }
            $customerId      = (int) $this->getRequest()->getGet('customerId');
            $billingAddress  = $this->getRequest()->getPost('billing');
            $shippingAddress = $this->getRequest()->getPost('shipping');
            $model           = \Mage::getModel('Customer\Address');

            if(
                !$model->fetchAddress('billing',$customerId)->getData()
                && !$model->fetchAddress('shipping',$customerId)->getData()
            ) {
                $model->customerId  = $customerId;
                $model->addressType = 'billing';
                $model->setData($billingAddress);
                $model->saveAddress('insert');

                $model->addressType = 'shipping';
                $model->setData($shippingAddress);
                $model->saveAddress('insert');

                $this->getMessage()->setSuccess('Address Inserted');
            } else {
                $model->addressType = 'billing';
                $model->setData($billingAddress);
                $model->saveAddress('update');

                $model->addressType = 'shipping';
                $model->setData($shippingAddress);
                $model->saveAddress('update');

                $this->getMessage()->setSuccess('Address Updated');
            }

            $gridHtml = \Mage::getBlock('Admin\Customer\Grid')->toHtml();
            $messageHtml = \Mage::getBlock('Customer\Layout\Message')->toHtml();
            $response = [
                'status'  => 'success',
                'message' => 'Data Successfully Deleted',
                'element' => [
                    [
                        'selector' => '#contentHtml',
                        'html'     => $gridHtml,
                    ],
                    [
                        'selector'=>'#messageHtml',
                        'html'=>$messageHtml
                    ]
                ],
            ];
            header("Content-type: application/json; charset=utf-8");
            echo json_encode($response);
        } catch (\Exception $e) {
            $this->getMessage()->setFailure($e->getMessage());
        }
    }

     public function changeStatusAction(){
        try {
            $id = (int)$this->getRequest()->getGet('customerId');
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
        } catch (Exception $e) {
            $this->getMessage()->setFailure($e->getMessage());
        }
        $gridHtml = \Mage::getBlock('Admin\Customer\Grid')->toHtml();
        $messageHtml = \Mage::getBlock('Customer\Layout\Message')->toHtml();

        $response = [
            'status'  => 'success',
            'message' => 'u are execellent',
            'element' => [
                [
                    'selector' => '#contentHtml',
                    'html'     => $gridHtml,
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
            $filterModel->setNamespace('Customer');
            $filterModel->setFilters($filters);
            $filterModel->customerFilters = $filterModel->getFilters(); 
        } catch (\Exception $e) {
            $this->getMessage()->setFailure($e->getMessage());
        }
        $this->gridAction();
    }
}