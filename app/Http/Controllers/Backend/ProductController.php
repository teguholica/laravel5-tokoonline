<?php namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;

use App\Models\Product;
use App\Models\ProductItem;

class ProductController extends BackendController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		return $this->view('product.index', []);
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return $this->view('product.create', []);
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(Request $request)
	{
		$product = new Product;
		$product->name = $request->input('name');
		$product->price = $request->input('price');
		$product->description = $request->input('description');
		$product->save();

		for($i = 0 ; $i < $request->input('stock') ; $i++){
			$item = new ProductItem;
			$item->code = date('YmdHis').'.'.$i;
			$item = $product->item()->save($item);
		}
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		return $this->view('product.edit', []);
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		//
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}

}
