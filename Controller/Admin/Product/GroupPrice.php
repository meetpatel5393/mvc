<?php 
namespace Controller\Admin\Product;
\Mage::loadFileByClassName('Controller\Core\Admin');
class GroupPrice extends \Controller\Core\Admin
{
	public function saveAction(){
		try {
			if(!$this->getRequest()->isPost()) {
				throw new Exception("Invalid Request");
			}
			$model = \Mage::getModel('Product');
			$productId = (int)$this->getRequest()->getGet('productId');
			$groupPriceData = $this->getRequest()->getPost('groupsPrice');
			$data = $model->load($productId);
			if($data){				
				$groupPriceModel = \Mage::getModel('Product\GroupPrice');
				if(array_key_exists('exits', $groupPriceData)) {
					foreach ($groupPriceData['exits'] as $groupId => $groupPrice) {
						$groupPriceModel->fetchGroupPriceData($productId,$groupId);
						$groupPriceModel->groupPrice = $groupPrice;
						$groupPriceModel->save();
					}
				}
				if(array_key_exists('new', $groupPriceData)) {
					foreach ($groupPriceData['new'] as $groupId => $groupPrice) {
						$groupPriceModel = \Mage::getModel('Product\GroupPrice');
						$groupPriceModel->productId = $productId;
						$groupPriceModel->groupId = $groupId;
						$groupPriceModel->groupPrice = $groupPrice;
						$saved = $groupPriceModel->save();
					}
				}
			}
		} catch (Exception $e) {
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