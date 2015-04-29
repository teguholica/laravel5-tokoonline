<form action="{{ route('frontend.cart.updateAll') }}" method="post">
<input type="hidden" name="_token" value="{{ csrf_token() }}">
<table>
	@forelse($products as $product)
	<tr>
		<td>{{ $product->name }}</td>
		<td><input type="text" name="qtys[{{ $product->rowid }}]" value="{{ $product->qty }}"></td>
		<td>{{ $product->price }}</td>
		<td>
			<a href="{{ route('frontend.cart.remove', $product->rowid) }}">Hapus</a>
		</td>
	</tr>
	@empty
	<tr>
		<td colspan="2">Tidak ada produk yang dibeli</td>
	</tr>
	@endforelse
	<tr>
		<td>Total</td>
		<td>{{ $total }}</td>
	</tr>
</table>
<button type="submit">Update</button>
<a href="{{ route('frontend.checkout') }}">Bayar</a>
<a href="{{ route('frontend.cart.destroy') }}">Hapus Semua</a>
</form>