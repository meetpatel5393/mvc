<?php 
namespace Controller\Admin;
class Cart extends \Controller\Core\Admin
{	
	protected $cart = null;
	protected $cartId = null;

	public function indexAction(){
		$cart = \Mage::getBlock('Admin\Cart\Edit')->toHtml();
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
                    'html'=>null
                ]
			]
		];
        header('Content-Type:application/json; charset=utf-8');
        echo json_encode($response);
	}

	public function selectCustomerAction(){
		try {
			$customerId = (int)$this->getRequest()->getPost('customer');

			if(!$customerId) {
				throw new \Exception("Select customer");
			}

			if($customerId) {
				$cart = $this->getCart($customerId);
			}
		} catch (\Exception $e) {
			$this->getMessage()->setFailure($e->getMessage());	
		}
		$cart = \Mage::getBlock('Admin\Cart\Edit')->toHtml();
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

	public function getCart($customerId = null){
		
		$session = \Mage::getModel('Admin\Session');
		$cart = \Mage::getModel('Cart');


		if(!$customerId) {
			$customerId = $session->customerId;
		}

		if($customerId) {
			$session->customerId = $customerId;
			$query = "SELECT * FROM `cart` WHERE customerId = {$customerId}";

			if(!$cart->fetchRow($query)) {
				$cart->createdDate = date('Y-m-d H:i:s');
				$cart->customerId = $customerId;
				$cart->save();
				$this->cart = $cart;
				return $this->cart;
			}
			$this->cart = $cart;
			return $this->cart;
		}
	}

	public function addToCartAction()
	{
		try {
			$productId = $this->getRequest()->getGet('productId');
			$product = \Mage::getModel('Product')->load($productId);
			if(!$product) {
				throw new \Exception("Invalid product id.");
			}
			if(!$this->getCart()){
				throw new \Exception("Select customer and create cart first");
			}

			$cartItems = $this->getCart()->getItems()->getData();
			$flag = 0;
			foreach ($cartItems as $cartItem) {
				if($cartItem->productId == $productId) {
					$flag = 1;
					$this->getMessage()->setFailure('Product already added.');
				}
			}

			if($flag == 0) {
				$cartId = $this->getCart()->cartId;
				$cartItem = \Mage::getModel('Cart\Item');
				$cartItem->cartId = $cartId;
				$cartItem->productId = $productId;
				$cartItem->createdDate = date('Y-m-d H:i:s');
				$cartItem->basePrice = $product->price;
				$cartItem->price = $product->price - $product->discount;
				$cartItem->discount = $product->discount;
				$cartItem->save();

				$this->getMessage()->setSuccess('Product successfully added.');
			}
		} catch (\Exception $e) {
			$this->getMessage()->setFailure($e->getMessage());
		}
		$cart = \Mage::getBlock('Admin\Cart\Edit')->toHtml();
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

	public function removeFromCartAction(){
		try {
			$cartItemId = $this->getRequest()->getGet('cartItemId');
			$cartItem = \Mage::getModel('Cart\Item');
			if(!$cartItem->load($cartItemId)) {
				throw new Exception("Invalid cart item.");
			}
			$cartItem->delete();
			$this->getMessage()->setSuccess('Item removed from cart.');
		} catch (\Exception $e) {
			$this->getMessage()->setFailure($e->getMessage());
		}
		$cart = \Mage::getBlock('Admin\Cart\Edit')->toHtml();
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

	public function updateCartAction(){
		try {
			$quantitys = $this->getRequest()->getPost('quantity');
			$items = $this->getCart()->getItems()->getData();

			if(count($items) == 0)
			{
				$this->getMessage()->setFailure('Cart has no items');
			} 
			else
			{
				foreach ($items as $item) {
					foreach ($quantitys as $cartItemId => $quantity) {
						if($item->cartItemId == $cartItemId) {
							$itemObj = \Mage::getModel('Cart\Item')->load($cartItemId);
							$product = $itemObj->getProduct();

							$itemObj->quantity = $quantity;
							$itemObj->price = ($quantity * $product->price) - ($quantity * $product->discount);
							$itemObj->discount = $quantity * $product->discount;
							$itemObj->save();
						}
					}
				}
				$this->getMessage()->setSuccess('Cart updated.');
			}
		} catch (\Exception $e) {
			$this->getMessage()->setFailure($e->getMessage());	
		}
		$cart = \Mage::getBlock('Admin\Cart\Edit')->toHtml();
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
	
	public function checkoutAction() {
		try {
			$items = $this->getCart()->getItems()->getData();
			if(count($items) == 0)
			{
				$this->getMessage()->setFailure('Cart has no items');
				$checkout = \Mage::getBlock('Admin\Cart\Edit')->toHtml();
			} else {
				$checkout = \Mage::getBlock('Admin\Cart\Edit\Checkout')->toHtml();
			}
		} catch (\Exception $e) {
			$this->getMessage()->setFailure($e->getMessage());	
		}
		$messageHtml = \Mage::getBlock('Admin\Layout\Message')->toHtml();
		$response = [
			'status'=>'success',
			'message'=>'cart page',
			'element'=>[
				[
					'selector'=>'#contentHtml',
					'html'=>$checkout
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