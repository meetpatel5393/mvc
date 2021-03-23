<?php
namespace Controller\Admin\Category;
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
        $this->model = \Mage::getModel('Category\Media');
        return $this;
    }

    public function uploadAction()
    {
        $action = $this->getRequest()->getPost();

        if ($action['btnAction'] === 'upload' && array_key_exists('file', $_FILES)) {
            $categoryId    = (int) $this->getRequest()->getGet('categoryId');
            $randomNumber = rand(10000, 99999999);

            $file_name      = $_FILES['file']['name'];
            $newFileName    = $randomNumber . '_' . $categoryId . '_' . $file_name;
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

            $categoryImageData = [
                'categoryId' => $categoryId,
                'imageName' => $newFileName,
                'icon'     => 0,
                'base'     => 0,
                'banner'     => 0
            ];
            $this->getModel()->setData($categoryImageData);
            $this->getModel()->saveCategoryImage();
        }

        if ($action['btnAction'] === 'updateMedia') {
            $data = $this->getRequest()->getPost();
            $categoryId    = (int) $this->getRequest()->getGet('categoryId');
            $this->getModel()->categoryId = $categoryId;
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
                    unlink("./Media/Category/$key");
                }
            }
        }
        $gridHtml = \Mage::getBlock('Admin\Category\Grid')->toHtml();
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