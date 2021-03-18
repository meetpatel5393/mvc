<?php
namespace Controller\Admin\Attribute;
\Mage::loadFileByClassName('Controller\Core\Admin');
class Option extends \Controller\Core\Admin
{
	public function showAction() {
		try {
			$attributeId = (int)$this->getRequest()->getGet('attributeId');
			if(!$attributeId){
				throw new \Exception("Invalid Product Id");
			}
			$attributeModel = \Mage::getModel('Attribute');
			$attributeData = $attributeModel->load($attributeId);
			if(!$attributeData) {
				throw new \Exception("Unable to find data on this id.");
			}
			$option = \Mage::getBlock('Admin\Attribute\Edit\Option');
			$option->setTableRow($attributeData);
			$option = $option->toHtml();
		} catch (\Exception $e) {
			$this->getMessage()->setFailure($e);
		}
		$response = [
			'status'=>'success',
			'message'=>'Attribute Option Form',
			'element'=>[
				[
					'selector'=>'#contentHtml',
					'html'=>$option
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
			$attributeId = (int)$this->getRequest()->getGet('attributeId');
			$optionData = $this->getRequest()->getPost();

			$attributeModel = \Mage::getModel('Attribute');
			$attributeData = $attributeModel->load($attributeId);
			if(!$attributeData) {
				throw new \Exception("Unable to find data on this id.");
			}

			$optionModel = \Mage::getModel('Attribute\Option');
			if(array_key_exists('exits', $optionData)) {
				$optionIds = implode(',', array_keys($optionData['exits']));
				$optionModel->deleteOption($optionIds,$attributeId);
				foreach ($optionData['exits'] as $optionId => $option) {
					$optionModel->load($optionId);
					$optionModel->setData($option);
					$optionModel->save();
				}
			} else {
				$optionModel->deleteOption(0,$attributeId);
			}

			if(array_key_exists('new', $optionData)) {
				foreach ($optionData['new']['name'] as $key => $value) {
					$optionModel = \Mage::getModel('Attribute\Option');
					$optionModel->attributeId = $attributeId;
					$optionModel->name = $optionData['new']['name'][$key];
					$optionModel->sortOrder = $optionData['new']['sortOrder'][$key];
					$optionModel->save();
				}
			}
			$this->getMessage()->setSuccess('Option Updated');
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
					'selector'=>'#messageHtml',
					'html'=>$messageHtml
				]
			]
		];
		header('Content-type:application/json; charset=utf-8');
		echo json_encode($response);
	}
}