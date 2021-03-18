<?php 
namespace Controller\Admin;
\Mage::loadFileByClassName('Controller\Core\Admin');
class Cms extends \Controller\Core\Admin
{
    protected $model = null;
    public function setModel()
    {
        $this->model = \Mage::getModel('Cms');
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
    	$grid = \Mage::getBlock('Admin\Cms\Grid')->toHtml();
    	$response = [
    		'status'=>'success',
    		'message'=>'cms grid',
    		'element'=>[
    			[
    				'selector'=>'#contentHtml',
    				'html'=>$grid
    			],
                [
                    'selector'=>'#messageHtml',
                    'html'=>null
                ],
                [
                    'selector'=>'#leftHtml',
                    'html'=>null
                ]
    		]
    	];
    	header('Content-type:application/json; charset=utf-8;');
    	echo json_encode($response);
    }

    public function showAction(){
        try {
            $pageId = (int) $this->getRequest()->getGet('pageId');
            $cms = \Mage::getModel('Cms');
            if($pageId){
                $cmsPage = $cms->load($pageId);
                if(!$cmsPage){
                    throw new \Exception("Unable to find data on this id");
                }
            }
            $edit = \Mage::getBlock('Admin\Cms\Edit')->setTableRow($cms)->toHtml();
            $response = [
                'status'=>'success',
                'message'=>'cms grid',
                'element'=>[
                    [
                        'selector'=>'#contentHtml',
                        'html'=>$edit
                    ],
                    [
                        'selector'=>'#messageHtml',
                        'html'=>null
                    ]
                ]
            ];
            header('Content-type:application/json; charset=utf-8;');
            echo json_encode($response);   
        } catch (\Exception $e) {
             $this->getMessage()->setFailure($e->getMessage());
        }
    }

    public function saveAction(){
        try {
            if(!$this->getRequest()->isPOst()){
                throw new \Exception("Invalid Request");                
            }
            $pageId = (int)$this->getRequest()->getGet('pageId');
            $cmsPage = $this->getRequest()->getPost('cms');
            
            $cmsModel = \Mage::getModel('Cms');
            $cmsPageData = $cmsModel->load($pageId);
            if($cmsPageData){
                $cmsModel->setData($cmsPage);
                $cmsModel->save();
                $this->getMessage()->setSuccess('Page Successfully Updated');
            } else {
                $cmsModel->createdDate = date("Y-m-d H:i:s");
                $cmsModel->setData($cmsPage);
                $cmsModel->save();
                $this->getMessage()->setSuccess('Page Successfully Created');
            }
        } catch (\Exception $e) {
             $this->getMessage()->setFailure($e->getMessage());
        }
        $grid = \Mage::getBlock('Admin\Cms\Grid')->toHtml();
        $messageHtml = \Mage::getBlock('Admin\Layout\Message')->toHtml();
        $response = [
            'status'=>'success',
            'message'=>'cms grid',
            'element'=>[
                [
                    'selector'=>'#contentHtml',
                    'html'=>$grid
                ],
                [
                    'selector'=>'#messageHtml',
                    'html'=>$messageHtml
                ]
            ]
        ];
        header('Content-type:application/json; charset=utf-8;');
        echo json_encode($response);
    }

    public function deleteAction(){
        try {
            $id = (int)$this->getRequest()->getGet('pageId');
            if(!$id){
                throw new \Exception("Invalid Product Id");
            }
            $pageData = $this->getModel()->load($id);
            if(!$pageData) {
                throw new \Exception("Unable to find data on this id.");
            }
            $this->getModel()->delete();
            $this->getMessage()->setSuccess('Page Successfully Deleted');
            
            $gridHtml = \Mage::getBlock('Admin\Cms\Grid')->toHtml();
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
                        'selector'=>'#messageHtml',
                        'html'=> $messageHtml
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