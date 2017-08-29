@extends('layouts.app')
@section('topMenu')
@parent
  @section('homeLink')
      <li class="hidden-sm hidden-xs pull-right" style="margin-left: 10px"><a href="{{ url('/') }}" class="link-light">Home</a></li>
  @endsection
  @section('topMenuItems')
  @endsection
@endsection
@section('content')
<!-- main-container start -->
<!-- ================ -->
<section class="main-container">

<div class="container">
<div class="row">

	<!-- main start -->
	<!-- ================ -->
	<div class="main col-md-12">

		<!-- page-title start -->
		<!-- ================ -->
		<h1 class="page-title">Shopping Cart</h1>
		<div class="separator-2"></div>
		<!-- page-title end -->

		<table class="table cart table-hover table-colored">
			<thead>
				<tr>
					<th>Product </th>
					<th> </th>
					<th></th>
					<th>Remove </th>
					<th class="amount">Price </th>
				</tr>
			</thead>
			<tbody>
				<tr class="remove-data">
					<td class="product"><a href="shop-product.html">Product Title 1</a> <small>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quas inventore modi.</small></td>
					<td class="quantity"></td>
					<td class="amount"></td>
					<td class="remove"><a class="btn btn-remove btn-sm btn-default">Remove</a></td>
					<td class="amount">$99.50 </td>

				</tr>
				<tr class="remove-data">
					<td class="product"><a href="shop-product.html">Product Title 2</a> <small>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quas inventore modi.</small></td>
					<td class="quantity"></td>
					<td class="amount"></td>
					<td class="remove"><a class="btn btn-remove btn-sm btn-default">Remove</a></td>
					<td class="amount">$399.50 </td>

				</tr>
				<tr>
					<td class="total-quantity" colspan="4">Total Price</td>
					<td class="total-amount">$1997.00</td>
				</tr>
			</tbody>
		</table>
		<div class="text-right">
			<a href="shop-checkout.html" class="btn btn-group btn-default">Checkout</a>
		</div>

	</div>
	<!-- main end -->

</div>
</div>
</section>
<!-- main-container end -->
@endsection
