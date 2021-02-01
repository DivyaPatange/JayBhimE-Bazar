@extends('auth.auth_layout.mainlayout')
@section('title', 'Index')
@section('customcss')
<style>
.radioBtn .notActive{
    color: #3276b1;
    background-color: #fff;
}
</style>
@endsection
@section('content')
    
	<section id="cart_items">
		<div class="container">
			<div class="breadcrumbs">
				<ol class="breadcrumb">
				  <li><a href="#">Home</a></li>
				  <li class="active">Shopping Cart</li>
				</ol>
			</div>
			@if(\Cart::getTotalQuantity()>0)
				<h4>{{ \Cart::getTotalQuantity()}} Product(s) In Your Cart</h4><br>
			@else
				<h4>No Product(s) In Your Cart. <a href="{{ url('/') }}" class="btn btn-dark">Continue Shopping</a></h4><br>
				
			@endif
			<div class="table-responsive cart_info">
				<table class="table table-condensed">
					<thead>
						<tr class="cart_menu">
							<td class="image" width="25%">Item</td>
							<td class="description">Product Name</td>
							<td width="15%">Size</td>
							<td class="quantity" width="15%">Quantity</td>
							<td class="price">Price</td>
							<td class="total">Sub-Total</td>
							<td>Remove</td>
						</tr>
					</thead>
					<tbody>
					@if(\Cart::getTotalQuantity()>0)
						@foreach($cartCollection as $item)
						<tr>
							<td class="cart_product" width="">
								<img src="/productImg/{{ $item->attributes->image }}" alt="" width="57%">
							</td>
							<td class="description">{{ $item->name }}</td>
							<form action="{{ route('cart.update') }}" method="POST">
							{{ csrf_field() }}
							<?php
								$product = DB::table('products')->where('id', $item->id)->where('status', 1)->first();
								$explodeSize = explode(",", $product->size);
							?>
							<td>
								<input type="hidden" name="image" id="image" value="{{ $item->attributes->image }}">
								<div class="input-group" style="margin:auto">
									<div id="" class="btn-group radioBtn">
									@for($i=0; $i< count($explodeSize); $i++)
										<a class="btn btn-primary btn-sm @if($item->attributes->size == $explodeSize[$i]) active @else notActive @endif" data-toggle="size{{ $product->id }}" data-title="{{ $explodeSize[$i] }}" value="{{ $explodeSize[$i] }}" style="margin-bottom:5px">{{ $explodeSize[$i] }}</a>
									@endfor
									</div>
									<input type="hidden" name="size" id="size{{ $product->id }}">
								</div>
							</td>
							<td class="cart_quantity">
								<div class="cart_quantity_button">
									<input type="hidden" value="{{ $item->id}}" id="id" name="id">
									<input class="cart_quantity_input" type="number" name="quantity" value="{{ $item->quantity }}" id="quantity" name="quantity" style="width:40%">
									<button class="btn btn-secondary btn-sm" style="margin-right: 25px;"><i class="fa fa-edit"></i></button>
								</div>
							</td>
							</form>
							
							<td class="cart_price">
								<p><i class="fa fa-inr">&nbsp;</i>{{ $item->price }}</p>
							</td>
							<td class="cart_price">
								<p><i class="fa fa-inr">&nbsp;</i>{{ \Cart::get($item->id)->getPriceSum() }}</p>
							</td>
							<td class="cart_delete">
								<form action="{{ route('cart.remove') }}" method="POST">
                                    {{ csrf_field() }}
                                    <input type="hidden" value="{{ $item->id }}" id="id" name="id">
									<button class="cart_quantity_delete"><i class="fa fa-times"></i></button>
								</form>
							</td>
						</tr>
						@endforeach
						<tr>
							<td colspan="4"><h4 class="text-center">Total</h4></td>
							<td colspan="2"><h4 class="text-center"><i class="fa fa-rupee">&nbsp;</i>{{ \Cart::getTotal() }}</h4></td>
						</tr>
					@else
						<tr>
							<td colspan="7">No Products in your cart.</td>
						</tr>
					@endif
					</tbody>
				</table>
			</div>
			<div class="row">
				<div class="col-md-12">
					<a href="{{ url('/') }}" class="btn btn-dark" style="margin-bottom:20px;">Continue Shopping</a>
                    <a href="@auth {{ url('/orders') }} @else {{ url('/login') }} @endauth" class="btn btn-success mb-3" style="margin-bottom:20px;">Proceed To Checkout</a>
					<form action="{{ route('cart.clear') }}" method="POST" style="display:inline">
                        {{ csrf_field() }}
                        <button class="btn" style="margin-bottom:20px; background-color:black; color:white">Clear Cart</button>
                    </form>
				</div>
			</div>
		</div>
	</section> <!--/#cart_items-->

	<!-- <section id="do_action">
		<div class="container">
			<div class="heading">
				<h3>What would you like to do next?</h3>
				<p>Choose if you have a discount code or reward points you want to use or would like to estimate your delivery cost.</p>
			</div>
			<div class="row">
				<div class="col-sm-6">
					<div class="chose_area">
						<ul class="user_option">
							<li>
								<input type="checkbox">
								<label>Use Coupon Code</label>
							</li>
							<li>
								<input type="checkbox">
								<label>Use Gift Voucher</label>
							</li>
							<li>
								<input type="checkbox">
								<label>Estimate Shipping & Taxes</label>
							</li>
						</ul>
						<ul class="user_info">
							<li class="single_field">
								<label>Country:</label>
								<select>
									<option>United States</option>
									<option>Bangladesh</option>
									<option>UK</option>
									<option>India</option>
									<option>Pakistan</option>
									<option>Ucrane</option>
									<option>Canada</option>
									<option>Dubai</option>
								</select>
								
							</li>
							<li class="single_field">
								<label>Region / State:</label>
								<select>
									<option>Select</option>
									<option>Dhaka</option>
									<option>London</option>
									<option>Dillih</option>
									<option>Lahore</option>
									<option>Alaska</option>
									<option>Canada</option>
									<option>Dubai</option>
								</select>
							
							</li>
							<li class="single_field zip-field">
								<label>Zip Code:</label>
								<input type="text">
							</li>
						</ul>
						<a class="btn btn-default update" href="">Get Quotes</a>
						<a class="btn btn-default check_out" href="">Continue</a>
					</div>
				</div>
				<div class="col-sm-6">
					<div class="total_area">
						<ul>
							<li>Cart Sub Total <span>$59</span></li>
							<li>Eco Tax <span>$2</span></li>
							<li>Shipping Cost <span>Free</span></li>
							<li>Total <span>$61</span></li>
						</ul>
							<a class="btn btn-default update" href="">Update</a>
							<a class="btn btn-default check_out" href="">Check Out</a>
					</div>
				</div>
			</div>
		</div>
	</section> -->
	<!--/#do_action-->
@endsection
@section('customjs')
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
<script>
$('.radioBtn a').on('click', function(){
    var sel = $(this).data('title');
    var tog = $(this).data('toggle');
	// alert(tog);
    $('#'+tog).prop('value', sel);
    
    $('a[data-toggle="'+tog+'"]').not('[data-title="'+sel+'"]').removeClass('active').addClass('notActive');
    $('a[data-toggle="'+tog+'"][data-title="'+sel+'"]').removeClass('notActive').addClass('active');
})
</script>
@endsection