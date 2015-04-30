<?php namespace App\Http\Controllers\Frontend;

require_once(dirname(__FILE__) . '/../../../../Vendor/Veritrans/Veritrans-php/Veritrans.php');

use Illuminate\Http\Request;

use Cart;
use hok00age\RajaOngkir;

class CheckoutController extends FrontendController {

	public function index()
	{
		$rajaOngkir = new RajaOngkir("d17256b1d6cb5da9539a286c4e0d6183");
		$data['products'] = Cart::content();
		$data['total'] = Cart::total();
		$data['province'] = $rajaOngkir->getProvince()->body->rajaongkir->results;
		$data['city'] = $rajaOngkir->getCity()->body->rajaongkir->results;
		return $this->view('checkout.index', $data);
	}

	public function pay(Request $request)
	{
		\Veritrans_Config::$serverKey = '597bed2a-b11c-4976-ba85-743f54fadaec';
		\Veritrans_Config::$isProduction = false;
		\Veritrans_Config::$isSanitized = false;

		// Populate customer's billing address
		$billing_address = array(
		    'first_name'   => $request->input('billingFirstName'),
		    'last_name'    => $request->input('billingLastName'),
		    'address'      => $request->input('billingAddress'),
		    'city'         => $request->input('billingCity'),
		    'postal_code'  => $request->input('billingPostalCode'),
		    'phone'        => $request->input('billingPhone'),
		    'country_code' => 'IDN'
		  );

		// Populate customer's shipping address
		$shipping_address = array(
		    'first_name'   => $request->input('shipmentFirstName'),
		    'last_name'    => $request->input('shipmentLastName'),
		    'address'      => $request->input('shipmentAddress'),
		    'city'         => $request->input('shipmentCity'),
		    'postal_code'  => $request->input('shipmentPostalCode'),
		    'phone'        => $request->input('shipmentPhone'),
		    'country_code' => 'IDN'
		  );

		// Populate customer's info
		$customer_details = array(
		    'first_name'       => $request->input('customerFirstName'),
		    'last_name'        => $request->input('customerLastName'),
		    'email'            => $request->input('customerEmail'),
		    'phone'            => $request->input('customerPhone'),
		    'billing_address'  => $billing_address,
		    'shipping_address' => $shipping_address
		  );

		//Detail Items
		$detailItems = [];
		foreach(Cart::content() as $item){
			$detailItems[] = [
				'id' => $item->id,
				'price' => $item->price,
				'quantity' => $item->qty,
				'name' => $item->name
			];
		}

		$params = array(
			'customer_details' => $customer_details,
			'item_details' => $detailItems,
		    'transaction_details' => array(
		      'order_id' => rand(),
		      'gross_amount' => Cart::total(),
		    ),
		    'vtweb' => array(
		    	'enabled_payments' => array($request->input('payment')),
		    	'credit_card_3d_secure' => true,
				'finish_redirect_url' => route('frontend.payment.finish'),
				'unfinish_redirect_url' => route('frontend.payment.unFinish'),
				'error_redirect_url' => route('frontend.payment.error')
		    )
		);

		try {
		  // Redirect to Veritrans VTWeb page
		  return redirect(\Veritrans_Vtweb::getRedirectionUrl($params));
		}
		catch (Exception $e) {
		  echo $e->getMessage();
		}
	}

}
