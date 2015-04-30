<?php namespace App\Http\Controllers\Backend;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

class DashboardController extends BackendController {

	public function index()
	{
		return $this->view('dashboard.index', []);
	}

}
