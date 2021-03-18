<?php
namespace Controller\Admin;
\Mage::loadFileByClassName('Controller\Core\Admin');
class Product extends \Controller\Core\Admin {
	protected $model = null;

	public function getModel(){
		if(!$this->model) {
			$this->setModel();
		}
		return $this->model;
	}

	public function setModel(){
		$this->model = \Mage::getModel('Product');
		return $this;
	}

	public function gridAction(){
		$gridHtml = \Mage::getBlock('Admin\Product\Grid')->toHtml();
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
					'html'=>null
				]
			]
		];
		header("Content-type: application/json; charset=utf-8");
		echo json_encode($response);
	}
	
	public function showAction(){
		try {
			$productId = (int)$this->getRequest()->getGet('productId');
			$tabName =  $this->getRequest()->getGet('tab');
			$formHtml = \Mage::getBlock('Admin\Product\Edit')->setId($productId)->setTabName($tabName);
			$formHtml = $formHtml->toHtml();
			$response = [
				'status' => 'success',
				'message' => 'u are execellent',
				'element' => [
					[
						'selector'=>'#contentHtml',
						'html'=> $formHtml
					],
					[
						'selector'=>'#messageHtml',
						'html'=>null
					]
				]
			];
			header("Content-type: application/json; charset=utf-8");
			echo json_encode($response);
		} catch (\Exception $e) {
			echo $e->getMessage();
		}
	}
	
	public function saveAction(){
		try {
				if(!$this->getRequest()->isPost()) {
					throw new \Exception("Invalid Request");
				}
				$productId = (int)$this->getRequest()->getGet('productId');
				$productData = $this->getRequest()->getPost('product');
				$data = $this->getModel()->load($productId);
				if($data) {
					$this->getModel()->updatedDate = date("Y-m-d");
					$this->getModel()->productId = $productId;
					$this->getMessage()->setSuccess('Product Successfully Updated');
				} else {
					$this->getModel()->createdDate = date("Y-m-d");
					$this->getMessage()->setSuccess('Product Successfully Created');
				}
				$this->getModel()->setData($productData);
				$this->getModel()->save();

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
	
	public function deleteAction(){
		try {
			$id = (int)$this->getRequest()->getGet('productId');
			if(!$id){
				throw new \Exception("Invalid Product Id");
			}
			$productData = $this->getModel()->load($id);
			if(!$productData) {
				throw new \Exception("Unable to find data on this id.");
			}
			$this->getModel()->delete();
			$this->getMessage()->setSuccess('Product Successfully Deleted');

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
	
	public function changeStatusAction(){
		try {
			$id = (int)$this->getRequest()->getGet('productId');
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
					'selector'=>'#messageHtml',
					'html'=>$messageHtml
				]
			]
		];
		header("Content-type: application/json; charset=utf-8");
		echo json_encode($response);
	}

	public function saveCategoryAction(){
		try {
			if(!$this->getRequest()->isPost()) {
				throw new \Exception("Invalid Request");
			}
			$productId = (int)$this->getRequest()->getGet('productId');
			$categoryId = (int)$this->getRequest()->getPost('category')['categoryId'];
			$data = $this->getModel()->load($productId);
			if(!$data) {
				throw new \Exception("Unable to fetch data on this id");
			}
			$categoryModel = \Mage::getModel('Category');
			if(!$categoryModel->load($categoryId)) {
				throw new \Exception("Unable to find category on this id");
			}
			$productCategoryModel = \Mage::getModel('Product\ProductCategory');
			$productCategoryModel->load($productId);
			$productCategoryModel->productId = $productId;
			$productCategoryModel->categoryId = $categoryId;
			$productCategoryModel->save();
		} catch (\Exception $e) {
			$this->getMessage()->setFailure($e->getMessage());
		}
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
					'selector'=>'#messageHtml',
					'html'=>$messageHtml
				]
			]
		];
		header("Content-type: application/json; charset=utf-8");
		echo json_encode($response);
	}
}