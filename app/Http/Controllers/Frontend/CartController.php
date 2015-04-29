<?php namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;

use Cart;

class CartController extends FrontendController {

	public function index()
	{
		$data['products'] = Cart::content();
		$data['total'] = Cart::total();
		return $this->view('cart.index', $data);
	}

	public function add()
	{
		Cart::add('293ad', 'Product 1', 1, 500000, array('size' => 'large'));
		return redirect()->route('frontend.cart');
	}

	public function updateAll(Request $request)
	{
		$qtys = $request->input('qtys');
		foreach($qtys as $key => $qty){
			Cart::update($key, $qty);
		}
		return redirect()->route('frontend.cart');
	}

	public function remove($rowId)
	{
		Cart::remove($rowId);
		return redirect()->route('frontend.cart');
	}

	public function destroy()
	{
		Cart::destroy();
		return redirect()->route('frontend.cart');
	}

}
