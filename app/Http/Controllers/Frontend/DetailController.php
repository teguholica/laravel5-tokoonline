<?php namespace App\Http\Controllers\Frontend;

class DetailController extends FrontendController {

	public function index()
	{
		return $this->view('detail.index', []);
	}

}
