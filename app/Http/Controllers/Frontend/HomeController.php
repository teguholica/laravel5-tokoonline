<?php namespace App\Http\Controllers\Frontend;

class HomeController extends FrontendController {

	public function index()
	{
		return $this->view('home.index', []);
	}

}
