<?php
namespace Controller\Admin;
\Mage::loadFileByClassName('Controller\Core\Admin');
class Payment extends \Controller\Core\Admin
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
        $this->model = \Mage::getModel('Payment');
        return $this;
    }

    public function gridAction()
    {
        $grid     = \Mage::getBlock('Admin\Payment\Grid')->toHtml();
        $response = [
            'status'  => 'Success',
            'message' => 'Payment Grid',
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
        header('Content-type:application/json; charset=utf-8');
        echo json_encode($response);
    }

    public function showAction()
    {
        try {
            $methodId = (int)$this->getRequest()->getGet('methodId');
            $payment = \Mage::getModel('Payment');
            if($methodId){
                $paymentData = $payment->load($methodId);
                if(!$paymentData){
                    throw new \Exception("unable to find data on this id");
                }
            }
            $form     = \Mage::getBlock('Admin\Payment\Edit')->setTableRow($payment)->toHtml();
            $response = [
                'status'  => 'Success',
                'message' => 'Payment Form',
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
            header('Content-type:application/json; charset=utf-8');
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
            $methodId    = (int) $this->getRequest()->getGet('methodId');
            $paymentData = $this->getRequest()->getPost('payment');
            $data        = $this->getModel()->load($methodId);
            if ($data) {
                $this->getModel()->methodId = $methodId;
                $this->getMessage()->setSuccess('Payment Data Successfully Updated');
            } else {
                $this->getModel()->createdDate = date("Y-m-d H:i:s");
                $this->getModel()->status      = 'Paid';
                $this->getModel()->code        = str_shuffle('PAYMENTDONE');
                $this->getMessage()->setSuccess('Payment Accepted');
            }
            $this->getModel()->setData($paymentData);
            $this->getModel()->save();
        } catch (\Exception $e) {
            $this->getMessage()->setFailure($e->getMessage());
        }
        $grid     = \Mage::getBlock('Admin\Payment\Grid')->toHtml();
        $messageHtml = \Mage::getBlock('Admin\Layout\Message')->toHtml();
        $response = [
            'status'  => 'Success',
            'message' => 'Payment Grid',
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
        header('Content-type:application/json; charset=utf-8');
        echo json_encode($response);
    }

    public function deleteAction()
    {
        try {
            $id = $this->getRequest()->getGet('methodId');
            if (!$id) {
                throw new \Exception("Invalid Id");
            }
            $paymentData = $this->getModel()->load($id);
            if (!$paymentData) {
                throw new \Exception("Unable to find data on this id.");
            }
            $this->getModel()->delete();
            $this->getMessage()->setSuccess('Data Successfully Deleted');
        } catch (\Exception $e) {
            $this->getMessage()->setFailure($e->getMessage());
        }
        $grid     = \Mage::getBlock('Admin\Payment\Grid')->toHtml();
        $messageHtml = \Mage::getBlock('Admin\Layout\Message')->toHtml();
        $response = [
            'status'  => 'Success',
            'message' => 'Payment Grid',
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
        header('Content-type:application/json; charset=utf-8');
        echo json_encode($response);
    }

    public function setFiltersAction(){
        try {
            if (!$this->getRequest()->isPost()) {
                throw new \Exception("Invalid Request");
            }
            $filters = $this->getRequest()->getPost('filter');
            $filterModel = \Mage::getModel('Core\Filter');
            $filterModel->setNamespace('Payment');
            $filterModel->setFilters($filters);
            $filterModel->paymentFilters = $filterModel->getFilters();
        } catch (\Exception $e) {
            $this->getMessage()->setFailure($e->getMessage());
        }
        $this->gridAction();
    }
}