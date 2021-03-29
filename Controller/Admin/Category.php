<?php
namespace Controller\Admin;
\Mage::loadFileByClassName('Controller\Core\Admin');
class Category extends \Controller\Core\Admin
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
        $this->model = \Mage::getModel('Category');
        return $this;
    }

    public function gridAction()
    {
        $gridHtml = \Mage::getBlock('Admin\Category\Grid')->toHtml();
        $response = [
            'status'  => 'success',
            'message' => 'u are execellent',
            'element' => [
                [
                    'selector' => '#contentHtml',
                    'html'     => $gridHtml
                ],
                [
                    'selector'=>'#messageHtml',
                    'html'=>null
                ]
            ]
        ];
        header("Content-type: application/json; charset=utf-8");
        echo json_encode($response);
    }

    public function showAction()
    {
        try {
            $categoryId = (int) $this->getRequest()->getGet('categoryId');
            $categoryModel = $this->getModel();
            if($categoryId){
                $categoryData = $categoryModel->load($categoryId);
                if(!$categoryData){
                    throw new \Exception("unable to find data on this id");                 
                }
            }
            $tabName = $this->getRequest()->getGet('tab');

            $formHtml = \Mage::getBlock('Admin\Category\Edit')->setId($categoryId)->setTabName($tabName);
            $formHtml  = $formHtml->toHtml();
        } catch (Exception $e) {
            $this->getMessage()->setFailure($e->getMessage());
        }
        $response = [
            'status'  => 'success',
            'message' => 'u are execellent',
            'element' => [
                [
                    'selector' => '#contentHtml',
                    'html'     => $formHtml
                ],
                [
                    'selector'=>'#messageHtml',
                    'html'=>null
                ]
            ]
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
            $categoryData   = $this->getRequest()->getPost('category');
            $categoriesData = $this->getModel()->getCategoriesData();
            $categoryId     = $this->getRequest()->getGet('categoryId');
            $data           = $this->getModel()->load($categoryId);

            if ($data) {
                if(array_key_exists('parentId', $categoryData)) {
                    $parentId = $categoryData['parentId'];
                    foreach ($categoriesData as $key => $value) {
                        $categoriesData[$key] = $value->getData();
                    }
                    foreach ($categoriesData as $key => $value) {
                        if ($value['categoryId'] == $parentId) {
                            $parentPath = $value['path'];
                        }
                    }
                    $oldPath                      = $data->getData()['path'];
                    $newPath                      = $parentPath . '=' . $categoryId;
                    $this->getModel()->path       = $newPath;
                    $this->getModel()->categoryId = $categoryId;
                    $this->getModel()->setData($categoryData);
                    $this->getModel()->updatePaths($categoryId, $newPath, $oldPath);
                    $this->getModel()->save();
                    $this->getMessage()->setSuccess('Category Successfully Updated.');
                }
                if (!array_key_exists('parentId', $categoryData)) {
                    $this->getModel()->parentId = 0;
                    $this->getModel()->setData($categoryData);
                    $this->getModel()->save();
                    $this->getMessage()->setSuccess('Category Successfully Updated.');
                }
            } else {
                if (!array_key_exists('parentId', $categoryData)) {
                    $this->getModel()->parentId = 0;
                    $parentPath                 = null;
                }
                if (array_key_exists('parentId', $categoryData)) {
                    foreach ($categoriesData as $key => $value) {
                        if ($value->categoryId == $categoryData['parentId']) {
                            $parentPath = $value->path;
                        }
                    }
                }
                $this->getModel()->setData($categoryData);
                $returnId = $this->getModel()->save();

                if (!$parentPath) {
                    $this->getModel()->path = $returnId;
                } else {
                    $this->getModel()->path = $parentPath . '=' . $returnId;
                }
                $this->getModel()->save();
                $this->getMessage()->setSuccess('Category Successfully Created.');
            }
        } catch (\Exception $e) {
            $this->getMessage()->setFailure($e->getMessage());
        }
        $gridHtml = \Mage::getBlock('Admin\Category\Grid')->toHtml();
        $messageHtml = \Mage::getBlock('Admin\Layout\Message')->toHtml();
        $response = [
            'status'  => 'success',
            'message' => 'u are execellent',
            'element' => [
                [
                    'selector' => '#contentHtml',
                    'html'     => $gridHtml
                ],
                [
                    'selector'=>'#messageHtml',
                    'html'=>$messageHtml
                ]
            ]
        ];
        header("Content-type: application/json; charset=utf-8");
        echo json_encode($response);
    }

    public function deleteAction()
    {
        try {
            $categoryId   = $this->getRequest()->getGet('categoryId');
            $categoryData = $this->getModel()->load($categoryId);
            if (!$categoryData) {
                throw new \Exception("Unable to fetch data on this id.");
            }
            //$categoriesData = $this->getModel()->getCategoriesData();
            $parentId       = $categoryData->getData()['parentId'];
            $oldPath        = $categoryData->getData()['path'];
            $this->getModel()->updateChildPaths($categoryId, $parentId, $oldPath);
            if ($this->getModel()->delete()) {
                $this->getMessage()->setSuccess('Category Successfully Deleted.');
            }

            $gridHtml = \Mage::getBlock('Admin\Category\Grid')->toHtml();
            $messageHtml = \Mage::getBlock('Admin\Layout\Message')->toHtml();
            $response = [
                'status'  => 'success',
                'message' => 'u are execellent',
                'element' => [
                    [
                        'selector' => '#contentHtml',
                        'html'     => $gridHtml
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

    public function changeStatusAction(){
        try {
            $id = (int)$this->getRequest()->getGet('categoryId');
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
        $gridHtml = \Mage::getBlock('Admin\Category\Grid')->toHtml();
        $messageHtml = \Mage::getBlock('Admin\Layout\Message')->toHtml();
        $response = [
            'status'  => 'success',
            'message' => 'u are execellent',
            'element' => [
                [
                    'selector' => '#contentHtml',
                    'html'     => $gridHtml
                ],
                [
                    'selector'=>'#messageHtml',
                    'html'=>$messageHtml
                ]
            ]
        ];
        header("Content-type: application/json; charset=utf-8");
        echo json_encode($response);
    }

    public function pagerAction(){
        $pagerController = \Mage::getController('Controller\Core\Pager');
        $pagerController->setTotalRecord(80);
        $pagerController->setRecordPerPage(10);
        $pagerController->setCurrentPage(10);

        $pagerController->calculate();
        echo '<pre>';
        print_r($pagerController);
    }

    public function setFiltersAction(){
        try {
            if (!$this->getRequest()->isPost()) {
                throw new \Exception("Invalid Request");
            }            
            $filters = $this->getRequest()->getPost('filter');
            $filterModel = \Mage::getModel('Core\Filter');
            $filterModel->setNamespace('Category');
            $filterModel->setFilters($filters);
            $filterModel->categoryFilters = $filterModel->getFilters();
        } catch (\Exception $e) {
            $this->getMessage()->setFailure($e->getMessage());
        }
        $this->gridAction();
    }
}