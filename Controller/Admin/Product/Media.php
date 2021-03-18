<?php
namespace Controller\Admin\Product;
\Mage::loadFileByClassName('Controller\Core\Admin');
class Media extends \Controller\Core\Admin
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
        $this->model = \Mage::getModel('Product\Media');
        return $this;
    }

    public function uploadAction()
    {
        $action = $this->getRequest()->getPost();

        if ($action['btnAction'] === 'upload' && array_key_exists('file', $_FILES)) {
            $productId    = (int) $this->getRequest()->getGet('productId');
            $randomNumber = rand(10000, 99999999);

            $file_name      = $_FILES['file']['name'];
            $newFileName    = $randomNumber . '_' . $productId . '_' . $file_name;
            $temp_file_name = $_FILES['file']['tmp_name'];
            $type           = $_FILES['file']['type'];
            $destination    = $this->getModel()->getImagePath();
            if (
                $type == 'image/jpeg'
                || $type == 'image/jpg'
                || $type == 'image/png'
            ) {
                move_uploaded_file($temp_file_name, $destination . $newFileName);
            }

            $productImageData = [
                'productId' => $productId,
                'imageName' => $newFileName,
                'label'     => 0,
                'small'     => 0,
                'thumb'     => 0,
                'base'      => 0,
                'gallery'   => 0,
            ];
            $this->getModel()->setData($productImageData);
            $this->getModel()->saveProductImage();
        }

        if ($action['btnAction'] === 'updateMedia') {
            $data = $this->getRequest()->getPost();
            $this->getModel()->setData($data);
            $this->getModel()->updateMedia();
        }

        if ($action['btnAction'] === 'removeMedia') {
            $data   = $this->getRequest()->getPost();
            if(array_key_exists('remove', $data)) {
                 $remove = $data['remove'];
                $this->getModel()->setData($remove);
                $this->getModel()->removeMedia();
                foreach ($remove as $key => $value) {
                    unlink("./Image/Product/$key");
                }
            }
        }
        $gridHtml = \Mage::getBlock('Admin\Product\Grid')->toHtml();
        $response = [
            'status'  => 'success',
            'message' => 'on load',
            'element' => [
                [
                    'selector' => '#contentHtml',
                    'html'     => $gridHtml,
                ]
            ]
        ];
        header("Content-type: application/json; charset=utf-8");
        echo json_encode($response);
    }
}