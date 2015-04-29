<?php namespace App\Http\Controllers\Frontend;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class FrontendController extends Controller {

	public function view($layout, $data){
		return view('frontend.'.$layout, $data);
	}

}
