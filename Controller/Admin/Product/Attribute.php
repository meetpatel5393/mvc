<?php
namespace Controller\Admin\Product;
\Mage::loadFileByClassName('Controller\Core\Admin');
class Attribute extends \Controller\Core\Admin
{
    public function saveAction(){
        try {
            if(!$this->getRequest()->isPost()) {
                throw new \Exception("Invalid Request");
            }
            $productId = (int)$this->getRequest()->getGet('productId');
            $attributeData = $this->getRequest()->getPost('attribute');
            $productModel = \Mage::getModel('Product');

            $data = $productModel->load($productId);
            if($data) {
                $productModel->updatedDate = date("Y-m-d");
                $productModel->productId = $productId;
                $this->getMessage()->setSuccess('Attribute Successfully Updated');
            }
            $productModel->setData($attributeData);
            $productModel->save();

            $gridHtml = \Mage::getBlock('Admin\Product\Grid')->toHtml();
            $messageHtml = \Mage::getBlock('Admin\Layout\Message')->toHtml();
            $response = [
                'status' => 'success',
                'message' => 'u are execellent',
                'element' => [
                    [
                        'selector'=>'#contentHtml',
                        'html'=> $gridHtml
                    ],
                    [
                        'selector'=>'#leftHtml',
                        'html'=>null
                    ],
                    [
                        'selector'=>'#messageHtml',
                        'html'=>$messageHtml
                    ]
                ]
            ];
            header("Content-type: application/json; charset=utf-8");
            echo json_encode($response);
        } catch (\Exception $e) {
            $this->getMessage()->setFailure($e->getMessage());
        }
    }
}