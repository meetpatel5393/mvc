<?php 
namespace Controller\Admin;
\Mage::loadFileByClassName('Controller\Core\Admin');
class Attribute extends \Controller\Core\Admin
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
        $this->model = \Mage::getModel('Attribute');
        return $this;
    }

	public function gridAction(){
		$grid = \Mage::getBlock('Admin\Attribute\Grid')->toHtml();
		$response = [
			'status'=>'success',
			'message'=>'Attribute Grid',
			'element'=>[
				[
					'selector'=>'#contentHtml',
					'html'=>$grid
				],
				[
					'selector'=>'#leftHtml',
					'html'=>null
				],
				[
					'selector'=>'#messageHtml',
					'html'=>null
				]
			]
		];
		header('Content-type:application/json; charset=utf-8');
		echo json_encode($response);
	}

	public function showAction(){
		try {
			$attributeId = (int)$this->getRequest()->getGet('attributeId');
			$attributeModel = \Mage::getModel('Attribute');
			if($attributeId) {
				$attributeData = $attributeModel->load($attributeId);
				if(!$attributeData) {
					throw new \Exception("Unable to find data on this id.");
				}
			}
			$edit = \Mage::getBlock('Admin\Attribute\Edit')->setTableRow($attributeModel)->toHtml();
		} catch (\Exception $e) {
			$this->getMessage()->setFailure($e->getMessage());
		}
		$response = [
			'status'=>'success',
			'message'=>'Attribute Grid',
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
		header('Content-type:application/json; charset=utf-8');
		echo json_encode($response);
	}

	public function saveAction(){
		try {
			if(!$this->getRequest()->isPost()){
				throw new \Exception("Invalid Request");
			}
			$attribute = $this->getRequest()->getPost('attribute');
			$this->getModel()->setData($attribute);
			if($this->getModel()->makeColumn()){
				$this->getModel()->save();
				$this->getMessage()->setSuccess('Attribute Successfully Created');
			} else {
				$this->getMessage()->setFailure('Error In Attribute Creation');
			}
		} catch (\Exception $e) {
			$this->getMessage()->setFailure($e->getMessage());
		}
		$grid = \Mage::getBlock('Admin\Attribute\Grid')->toHtml();
		$messageHtml = \Mage::getBlock('Admin\Layout\Message')->toHtml();
		$response = [
			'status'=>'success',
			'message'=>'Attribute Grid',
			'element'=>[
				[
					'selector'=>'#contentHtml',
					'html'=>$grid
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
		header('Content-type:application/json; charset=utf-8');
		echo json_encode($response);
	}

	public function deleteAction(){
		try {
			$attributeId = (int)$this->getRequest()->getGet('attributeId');
			if(!$attributeId){
				throw new \Exception("Invalid Product Id");
			}
			$attribute = $this->getModel()->load($attributeId);
			if(!$attribute) {
				throw new \Exception("Unable to find data on this id.");
			}
			if($this->getModel()->deleteColumn()){
				$this->getModel()->delete();
				$this->getMessage()->setSuccess('Attribute Successfully Deleted');
			} else {
				$this->getMessage()->setSuccess('Error In Attribute Delete');
			}
		} catch (\Exception $e) {
			$this->getMessage()->setFailure($e);
		}
		$grid = \Mage::getBlock('Admin\Attribute\Grid')->toHtml();
		$messageHtml = \Mage::getBlock('Admin\Layout\Message')->toHtml();
		$response = [
			'status'=>'success',
			'message'=>'Attribute Grid',
			'element'=>[
				[
					'selector'=>'#contentHtml',
					'html'=>$grid
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
            $filterModel->setNamespace('Attribute');
            $filterModel->setFilters($filters);
            $filterModel->attributeFilters = $filterModel->getFilters();
        } catch (\Exception $e) {
            $this->getMessage()->setFailure($e->getMessage());
        }
        $this->gridAction();
    }
}