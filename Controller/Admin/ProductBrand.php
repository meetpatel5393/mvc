<?php
namespace Controller\Admin;
\Mage::loadFileByClassName('Controller\Core\Admin');
class ProductBrand extends \Controller\Core\Admin
{
	public function gridAction(){
		$grid     = \Mage::getBlock('Admin\ProductBrand\Grid')->toHtml();
        $response = [
            'status'  => 'Success',
            'message' => 'Brand Grid',
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

    public function showAction(){
        try {
            $brandId = (int) $this->getRequest()->getGet('brandId');
            $brand = \Mage::getModel('ProductBrand');
            if($brandId){
                $brandData = $brand->load($brandId);
                if(!$brandData) {
                    throw new \Exception("Unable to find data on this id");
                }
            }
            $form     = \Mage::getBlock('Admin\ProductBrand\Edit')->setTableRow($brand)->toHtml();
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

	public function saveAction(){
		try {
			if(!$this->getRequest()->isPost()){
				throw new \Exception("Invalid Request");
			}
            $brandId = (int)$this->getRequest()->getGet('brandId');
			$brand = $this->getRequest()->getPost();
            $brandModel = \Mage::getModel('ProductBrand');
            $brandData = $brandModel->load($brandId);
            $flag = 0;

            if(array_key_exists('file', $_FILES)){
                $randomNumber = rand(10000, 99999999);
                $file_name      = $_FILES['file']['name'];
                $newFileName    = $randomNumber . '_' . $file_name;
            }

            foreach (json_decode($brand['brand']) as $key => $value) {
                $columnName = $value->name;
                $brandModel->$columnName = $value->value;
            }

            if(!$brandData) {
                $brandModel->createdDate = date('Y-m-d H:i:s');
                $brandModel->save();
            }

            if(array_key_exists('file', $_FILES)){
                $brandModel->image = $brandModel->brandId.'_'.$newFileName;
                $flag = 1;
            }

            $brandModel->save();

	        if ($flag == 1) {
                $newFileName    = $brandModel->image;
	            $temp_file_name = $_FILES['file']['tmp_name'];
	            $type           = $_FILES['file']['type'];
	            $destination    = 'Media\Brand\\';
	            if (
	                $type == 'image/jpeg'
	                || $type == 'image/jpg'
	                || $type == 'image/png'
	            ) {
	                move_uploaded_file($temp_file_name, $destination . $newFileName);
	                $this->getMessage()->setSuccess('Image Uploaded Successfully');
	            }
	        }
		} catch (\Exception $e) {
			$this->getMessage()->setFailure($e->getMessage());
		}
		$grid     = \Mage::getBlock('Admin\ProductBrand\Grid')->toHtml();
		$messageHtml = \Mage::getBlock('Admin\Layout\Message')->toHtml();
        $response = [
            'status'  => 'Success',
            'message' => 'Brand Grid',
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

	public function deleteAction(){
		try {
            $brandId = $this->getRequest()->getGet('brandId'); 
            $brandModel = \Mage::getModel('ProductBrand');
            $brandData = $brandModel->load($brandId);
            if(!$brandData) {
                throw new \Exception("unable to find data on this id");
            }
            $imageName = $brandModel->image;
			$path = './Media/Brand/';
            $brandModel->delete();
            if($imageName) {
			     unlink($path.$imageName);
            }
			$this->getMessage()->setSuccess('Data Deleted');
		} catch (\Exception $e) {
			$this->getMessage()->setFailure($e->getMessage());	
		}
		$grid     = \Mage::getBlock('Admin\ProductBrand\Grid')->toHtml();
		$messageHtml = \Mage::getBlock('Admin\Layout\Message')->toHtml();
        $response = [
            'status'  => 'Success',
            'message' => 'Brand Grid',
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

    public function changeStatusAction(){
        try {
            $brandId = $this->getRequest()->getGet('brandId'); 
            $brandModel = \Mage::getModel('ProductBrand');
            if(!$brandModel->load($brandId)){
                throw new \Exception("Invalid productId");
            }
            if($brandModel->status == 0){
                $brandModel->update(['status'=>1]);
                $this->getMessage()->setSuccess('Status Successfully Enabled');
            } else {
                $brandModel->update(['status'=>0]);
                $this->getMessage()->setSuccess('Status Successfully Disabled');
            }
        } catch (\Exception $e) {
            $this->getMessage()->setFailure($e->getMessage());
        }
        $gridHtml = \Mage::getBlock('Admin\ProductBrand\Grid')->toHtml();
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
                    'html'=>$messageHtml
                ]
            ]
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
            $filterModel->setNamespace('ProductBrand');
            $filterModel->setFilters($filters);
            $filterModel->productBrandFilters = $filterModel->getFilters();
        } catch (\Exception $e) {
            $this->getMessage()->setFailure($e->getMessage());
        }
        $this->gridAction();
    }
}