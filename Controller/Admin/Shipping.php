<?php
namespace Controller\Admin;
\Mage::loadFileByClassName('Controller\Core\Admin');
class Shipping extends \Controller\Core\Admin
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
        $this->model = \Mage::getModel('Shipping');
        return $this;
    }

    public function gridAction()
    {
        $grid     = \Mage::getBlock('Admin\Shipping\Grid')->toHtml();
        $response = [
            'status'  => 'success',
            'message' => 'Shipping Grid',
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
        header("Content-type: application/json; charset=utf-8");
        echo json_encode($response);
    }

    public function showAction()
    {
        try {
            $methodId = (int)$this->getRequest()->getGet('methodId');
            $shipping = \Mage::getModel('Shipping');
            if($methodId){
                $shippingData = $shipping->load($methodId);
                if(!$shippingData){
                    throw new \Exception("unable to find data on this id");
                }
            }
            $form     = \Mage::getBlock('Admin\Shipping\Edit')->setTableRow($shipping)->toHtml();
        } catch (\Exception $e) {
             $this->getMessage()->setFailure($e->getMessage());
        }
        $response = [
            'status'  => 'success',
            'message' => 'Shipping Form',
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
            $shippingData = $this->getRequest()->getPost('shipping');
            $methodId     = (int) $this->getRequest()->getGet('methodId');
            $data         = $this->getModel()->load($methodId);
            if ($data) {
                $this->getModel()->methodId = $methodId;
                $this->getMessage()->setSuccess('Shipping Data Successfully Updated');
            } else {
                $this->getModel()->createdDate = date("Y-m-d");
                $this->getModel()->code        = str_shuffle('SHIPPINGPROCCESS');
                $this->getModel()->status      = 'shipped';
                $this->getMessage()->setSuccess('Shipping Successfully Created');
            }
            $this->getModel()->setData($shippingData);
            $this->getModel()->save();
        } catch (\Exception $e) {
            $this->getMessage()->setFailure($e->getMessage());
        }
        $grid     = \Mage::getBlock('Admin\Shipping\Grid')->toHtml();
        $messageHtml = \Mage::getBlock('Admin\Layout\Message')->toHtml();
        $response = [
            'status'  => 'success',
            'message' => 'Shipping Grid',
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
            $methodId = $this->getRequest()->getGet('methodId');
            if (!$methodId) {
                throw new \Exception("Invalid Method Id");
            }
            $shipping = $this->getModel()->load($methodId);
            if (!$shipping) {
                throw new \Exception("Unable to find data on this id.");
            }
            $this->getModel()->delete($methodId);
            $this->getMessage()->setSuccess('Data Successfully Deleted');
        } catch (Exception $e) {
            $this->getMessage()->setFailure($e->getMessage());
        }
        $grid     = \Mage::getBlock('Admin\Shipping\Grid')->toHtml();
        $messageHtml = \Mage::getBlock('Admin\Layout\Message')->toHtml();
        $response = [
            'status'  => 'success',
            'message' => 'Shipping Grid',
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
            $filter = $this->getRequest()->getPost('filter');
            $filterModel = \Mage::getModel('Core\Filter');
            $filterModel->setNamespace('Shipping');
            $filterModel->ShippingGrid = $filter;
        } catch (\Exception $e) {
            $this->getMessage()->setFailure($e->getMessage());
        }
        $this->gridAction();
    }
}
