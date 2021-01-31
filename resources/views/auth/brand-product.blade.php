@extends('auth.auth_layout.mainlayout')
@section('title', 'Index')
@section('customcss')

@endsection
@section('content')
<section>
		<div class="container">
			<div class="row">
				<div class="col-sm-3">
					<div class="left-sidebar">
						<h2>Category</h2>
						<div class="panel-group category-products" id="accordian"><!--category-productsr-->
								<?php
									$categories = DB::table('categories')->where('status', 1)->get();
								?>
							@foreach($categories as $c)
									<?php
										$subCategories = DB::table('sub_categories')->where('category_id', $c->id)->where('parent_id', 0)->where('status', 1)->get();
									?>
									@if(count($subCategories) > 0)
									
								<div class="panel panel-default">
									<div class="panel-heading">
										<h4 class="panel-title">
											<a data-toggle="collapse" data-parent="#accordian" href="#product{{ $c->id }}">
												<span class="badge pull-right"><i class="fa fa-plus"></i></span>
												{{ $c->category_name }}
											</a>
										</h4>
									</div>
									
									<div id="product{{ $c->id }}" class="panel-collapse collapse">
										<div class="panel-body">
											<ul>
												@foreach($subCategories as $s)
												<li><a href="{{ route('single.category.product', $s->id) }}">{{ $s->sub_category }} </a></li>
												@endforeach
											</ul>
										</div>
									</div>
								</div>
								@else
								<div class="panel panel-default">
									<div class="panel-heading">
										<h4 class="panel-title"><a href="{{ route('single.product', $c->id) }}">{{ $c->category_name }}</a></h4>
									</div>
								</div>
								@endif
							@endforeach
							<!-- <div class="panel panel-default">
								<div class="panel-heading">
									<h4 class="panel-title">
										<a data-toggle="collapse" data-parent="#accordian" href="#mens">
											<span class="badge pull-right"><i class="fa fa-plus"></i></span>
											Mens
										</a>
									</h4>
								</div>
								<div id="mens" class="panel-collapse collapse">
									<div class="panel-body">
										<ul>
											<li><a href="#">Fendi</a></li>
											<li><a href="#">Guess</a></li>
											<li><a href="#">Valentino</a></li>
											<li><a href="#">Dior</a></li>
											<li><a href="#">Versace</a></li>
											<li><a href="#">Armani</a></li>
											<li><a href="#">Prada</a></li>
											<li><a href="#">Dolce and Gabbana</a></li>
											<li><a href="#">Chanel</a></li>
											<li><a href="#">Gucci</a></li>
										</ul>
									</div>
								</div>
							</div>
							
							<div class="panel panel-default">
								<div class="panel-heading">
									<h4 class="panel-title">
										<a data-toggle="collapse" data-parent="#accordian" href="#womens">
											<span class="badge pull-right"><i class="fa fa-plus"></i></span>
											Womens
										</a>
									</h4>
								</div>
								<div id="womens" class="panel-collapse collapse">
									<div class="panel-body">
										<ul>
											<li><a href="#">Fendi</a></li>
											<li><a href="#">Guess</a></li>
											<li><a href="#">Valentino</a></li>
											<li><a href="#">Dior</a></li>
											<li><a href="#">Versace</a></li>
										</ul>
									</div>
								</div>
							</div>
							<div class="panel panel-default">
								<div class="panel-heading">
									<h4 class="panel-title"><a href="#">Kids</a></h4>
								</div>
							</div>
							<div class="panel panel-default">
								<div class="panel-heading">
									<h4 class="panel-title"><a href="#">Fashion</a></h4>
								</div>
							</div>
							<div class="panel panel-default">
								<div class="panel-heading">
									<h4 class="panel-title"><a href="#">Households</a></h4>
								</div>
							</div>
							<div class="panel panel-default">
								<div class="panel-heading">
									<h4 class="panel-title"><a href="#">Interiors</a></h4>
								</div>
							</div>
							<div class="panel panel-default">
								<div class="panel-heading">
									<h4 class="panel-title"><a href="#">Clothing</a></h4>
								</div>
							</div>
							<div class="panel panel-default">
								<div class="panel-heading">
									<h4 class="panel-title"><a href="#">Bags</a></h4>
								</div>
							</div>
							<div class="panel panel-default">
								<div class="panel-heading">
									<h4 class="panel-title"><a href="#">Shoes</a></h4>
								</div>
							</div> -->
						</div><!--/category-products-->
					
						<div class="brands_products"><!--brands_products-->
							<h2>Brands</h2>
							<div class="brands-name">
								<ul class="nav nav-pills nav-stacked">
								<marquee scrollamount="2" width="100%" direction="down" height="250px" onmouseover="this.stop();"
           onmouseout="this.start();">
								<?php
									$brand = DB::table('brands')->where('status', 1)->orderBy('id', 'DESC')->get();
								?>
									@foreach($brand as $b)
									<li style="padding: 10px 0px; border-bottom: 1px solid #f0f0f0;"><a href="{{ route('getProductByBrand', $b->id) }}"> {{ $b->brand_name }}</a></li>
									@endforeach		
								</marquee>
								</ul>
							</div>
						</div><!--/brands_products-->
						
						<div class="price-range"><!--price-range-->
							<h2>Price Range</h2>
							<div class="well">
								 <input type="text" class="span2" value="" data-slider-min="0" data-slider-max="600" data-slider-step="5" data-slider-value="[250,450]" id="sl2" ><br />
								 <b>$ 0</b> <b class="pull-right">$ 600</b>
							</div>
						</div><!--/price-range-->
						
						<div class="shipping text-center"><!--shipping-->
							<img src="images/home/shipping.jpg" alt="" />
						</div><!--/shipping-->
						
					</div>
				</div>
				
				<div class="col-sm-9 padding-right">
					<div class="features_items"><!--features_items-->
						<h2 class="title text-center">Features Items</h2>
						
						<div class="row">
						@foreach($products as $p)
						<div class="col-sm-3">
							<div class="product-image-wrapper">
								<div class="single-products">
								<?php
									$explodeImage = explode(",", $p->product_img);
								?>
										<div class="productinfo text-center">
											<img src="{{  URL::asset('ProductImg/' . $explodeImage[0]) }}" alt="" class="img-fluid" />
											<h2><i class="fa fa-inr">&nbsp;</i>{{ $p->selling_price }} - <del><i class="fa fa-inr">&nbsp;</i>{{ $p->cost_price }}</del></h2>
											<p><b>Size : </b>{{ $p->size }}</p>
											<p>{{ $p->product_name }}</p>
											<form action="{{ route('cart.store') }}" method="POST">
												{{ csrf_field() }}
												<input type="hidden" value="{{ $p->id }}" id="id" name="id">
												<input type="hidden" value="{{ $p->product_name }}" id="name" name="name">
												<input type="hidden" value="{{ $p->selling_price }}" id="price" name="price">
												<input type="hidden" value="{{ $explodeImage[0] }}" id="img" name="img">
												<input type="hidden" value="1" id="quantity" name="quantity">
												<button class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</button>
											</form>
										</div>
										<div class="product-overlay">
											<div class="overlay-content">
												<h2><i class="fa fa-inr">&nbsp;</i>{{ $p->selling_price }} - <del><i class="fa fa-inr">&nbsp;</i>{{ $p->cost_price }}</del></h2>
												<p><b>Size : </b>{{ $p->size }}</p>
												<p>{{ $p->product_name }}</p>
												<form action="{{ route('cart.store') }}" method="POST">
												{{ csrf_field() }}
												<input type="hidden" value="{{ $p->id }}" id="id" name="id">
												<input type="hidden" value="{{ $p->product_name }}" id="name" name="name">
												<input type="hidden" value="{{ $p->selling_price }}" id="price" name="price">
												<input type="hidden" value="{{ $explodeImage[0] }}" id="img" name="img">
												<input type="hidden" value="1" id="quantity" name="quantity">
												<button class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</button>
												</form>
											</div>
										</div>
								</div>
								<!-- <div class="choose">
									<ul class="nav nav-pills nav-justified">
										<li><a href="#"><i class="fa fa-plus-square"></i>Add to wishlist</a></li>
										<li><a href="#"><i class="fa fa-plus-square"></i>Add to compare</a></li>
									</ul>
								</div> -->
							</div>
						</div>
						@endforeach
						</div>
						
						
					</div><!--features_items-->
				</div>
			</div>
		</div>
	</section>
@endsection
@section('customjs')

@endsection