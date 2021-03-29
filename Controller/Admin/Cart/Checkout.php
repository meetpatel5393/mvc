<?php
namespace Controller\Admin\Cart;
class Checkout extends \Controller\Core\Admin
{
	public function getCart() {
		$session = \Mage::getModel('Admin\Session');
		$cart = \Mage::getModel('Cart');		
		$customerId = $session->customerId;
		if(!$customerId) {
			return false;
		}

		if($customerId) {
			$query = "SELECT * FROM `cart` WHERE customerId = {$customerId}";
			$cart->fetchRow($query);
			$this->cart = $cart;
			return $this->cart;
		}
	}

	public function saveBillingAddressAction(){
		try {
			$cartBillingAddress = $this->getRequest()->getPost('billing');
			$saveInAddressBookFlag = $this->getRequest()->getPost('addressBookFlagBilling');
			
			$cartAddressModel = \Mage::getModel('Cart\Address');
			foreach ($cartBillingAddress as $cartAddressId => $cartAddress) {
				$cartAddress = $cartAddress;
				$cartAddressId = $cartAddressId;
			}
			$cartAddressModel->setData($cartAddress);
			$cartAddressModel->cartAddressId = $cartAddressId;
			$cartAddressModel->save();

			if($saveInAddressBookFlag == 'on') {
				$customerAddressModel = \Mage::getModel('Customer\Address');
				$customerAddressModel->addressId = $cartAddressModel->addressId;
				$customerAddressModel->setData($cartAddress);
				$customerAddressModel->save();
			}
			$this->getMessage()->setSuccess('Address saved');
		} catch (\Exception $e) {
			$this->getMessage()->setFailure($e->getMessage());
		}
		$cart = \Mage::getBlock('Admin\Cart\Edit\Checkout')->toHtml();
		$messageHtml = \Mage::getBlock('Admin\Layout\Message')->toHtml();
		$response = [
			'status'=>'success',
			'message'=>'cart page',
			'element'=>[
				[
					'selector'=>'#contentHtml',
					'html'=>$cart
				],
				[
                    'selector'=>'#messageHtml',
                    'html'=>$messageHtml
                ]
			]
		];
        header('Content-Type:application/json; charset=utf-8');
        echo json_encode($response);
	}

	public function saveShippingAddressAction(){
		try {
			$cartShippingAddress = $this->getRequest()->getPost('shipping');
			$saveInAddressBookFlag = $this->getRequest()->getPost('addressBookFlagShipping');
			$sameAsBillingFlag = $this->getRequest()->getPost('sameAsBillingFlag');
			$cartAddressModel = \Mage::getModel('Cart\Address');

			foreach ($cartShippingAddress as $cartAddressId => $cartAddress) {
				$cartAddress = $cartAddress;
				$cartAddressId = $cartAddressId;
			}
			$cartAddressModel->setData($cartAddress);
			$cartAddressModel->cartAddressId = $cartAddressId;
			$cartAddressModel->save();

			if($saveInAddressBookFlag == 'on') {
				$customerAddressModel = \Mage::getModel('Customer\Address');
				$customerAddressModel->addressId = $cartAddressModel->addressId;
				$customerAddressModel->setData($cartAddress);
				$customerAddressModel->save();
			}

			if($sameAsBillingFlag == 'on') {
				$cartAddressModel->sameAsBilling = 1;
				$cartAddressModel->save();
			}
			if($sameAsBillingFlag == null) 
			{
				$cartAddressModel->sameAsBilling = 0;
				$cartAddressModel->save();
			}
			$this->getMessage()->setSuccess('Address saved');
		} catch (\Exception $e) {
			$this->getMessage()->setFailure($e->getMessage());
		}
		$cart = \Mage::getBlock('Admin\Cart\Edit\Checkout')->toHtml();
		$messageHtml = \Mage::getBlock('Admin\Layout\Message')->toHtml();
		$response = [
			'status'=>'success',
			'message'=>'cart page',
			'element'=>[
				[
					'selector'=>'#contentHtml',
					'html'=>$cart
				],
				[
                    'selector'=>'#messageHtml',
                    'html'=>$messageHtml
                ]
			]
		];
        header('Content-Type:application/json; charset=utf-8');
        echo json_encode($response);
	}

	public function savePaymentAction() {
		try {
			$paymentMethodId = (int)$this->getRequest()->getPost('paymentMethod');
			$paymentModel = \Mage::getModel('Payment');

			if(!$paymentMethodId) {
				throw new \Exception("Please select payment method.");
			}
			if(!$paymentModel->load($paymentMethodId)) {
				throw new Exception("Invalid payment method.");
			}

			$cart = $this->getCart();
			$cart->paymentMethodId = $paymentMethodId;
			$cart->save();
			$this->getMessage()->setSuccess('Payment method selected');
		} catch (\Exception $e) {
			$this->getMessage()->setFailure($e->getMessage());
		}
		$cart = \Mage::getBlock('Admin\Cart\Edit\Checkout')->toHtml();
		$messageHtml = \Mage::getBlock('Admin\Layout\Message')->toHtml();
		$response = [
			'status'=>'success',
			'message'=>'cart page',
			'element'=>[
				[
					'selector'=>'#contentHtml',
					'html'=>$cart
				],
				[
                    'selector'=>'#messageHtml',
                    'html'=>$messageHtml
                ]
			]
		];
        header('Content-Type:application/json; charset=utf-8');
        echo json_encode($response);
	}

	public function saveShippingAction() {
		try {
			$shippingMethodId = (int)$this->getRequest()->getPost('shippingMethod');
			$shippingModel = \Mage::getModel('shipping');

			if(!$shippingMethodId) {
				throw new \Exception("Please select shipping method.");
			}
			if(!$shippingModel->load($shippingMethodId)) {
				throw new \Exception("Invalid shipping method.");
			}

			$cart = $this->getCart();
			$cart->shippingMethodId = $shippingMethodId;
			$cart->shippingAmount = $shippingModel->amount;
			$cart->save();
			$this->getMessage()->setSuccess('shipping method selected');
		} catch (\Exception $e) {
			$this->getMessage()->setFailure($e->getMessage());
		}
		$cart = \Mage::getBlock('Admin\Cart\Edit\Checkout')->toHtml();
		$messageHtml = \Mage::getBlock('Admin\Layout\Message')->toHtml();
		$response = [
			'status'=>'success',
			'message'=>'cart page',
			'element'=>[
				[
					'selector'=>'#contentHtml',
					'html'=>$cart
				],
				[
                    'selector'=>'#messageHtml',
                    'html'=>$messageHtml
                ]
			]
		];
        header('Content-Type:application/json; charset=utf-8');
        echo json_encode($response);
	}
}