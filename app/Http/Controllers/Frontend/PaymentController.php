<?php namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;

use Cart;

class PaymentController extends FrontendController {

	public function finish(Request $request)
	{
		Cart::destroy();
		$data['orderId'] = $request->input('order_id');
		return $this->view('payment.finish', $data);
	}

	public function unfinish()
	{
		return "unfinish";
	}

	public function error()
	{
		return "error";
	}

}
