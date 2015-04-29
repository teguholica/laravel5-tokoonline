<?php namespace App\Http\Controllers\Frontend;

require_once(dirname(__FILE__) . '/../../../../Vendor/Veritrans/Veritrans-php/Veritrans.php');

use Cart;

class CheckoutController extends FrontendController {

	public function index()
	{
		\Veritrans_Config::$serverKey = '597bed2a-b11c-4976-ba85-743f54fadaec';
		\Veritrans_Config::$isProduction = false;
		\Veritrans_Config::$isSanitized = false;

		// Populate customer's billing address
		$billing_address = array(
		    'first_name'   => "Andri",
		    'last_name'    => "Setiawan",
		    'address'      => "Karet Belakang 15A, Setiabudi.",
		    'city'         => "Jakarta",
		    'postal_code'  => "51161",
		    'phone'        => "081322311801",
		    'country_code' => 'IDN'
		  );

		// Populate customer's shipping address
		$shipping_address = array(
		    'first_name'   => "John",
		    'last_name'    => "Watson",
		    'address'      => "Bakerstreet 221B.",
		    'city'         => "Jakarta",
		    'postal_code'  => "51162",
		    'phone'        => "081322311801",
		    'country_code' => 'IDN'
		  );

		// Populate customer's info
		$customer_details = array(
		    'first_name'       => "Anita",
		    'last_name'        => "Sari",
		    'email'            => "teguholica@gmail.com",
		    'phone'            => "089671639390",
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
