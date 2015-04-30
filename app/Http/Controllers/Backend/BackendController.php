<?php namespace App\Http\Controllers\Backend;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class BackendController extends Controller {

	public function view($layout, $data){
		return view('backend.'.$layout, $data);
	}

}
