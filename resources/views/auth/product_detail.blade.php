@extends('auth.auth_layout.mainlayout')
@section('title', 'Index')
@section('customcss')
<style>
.radioBtn .notActive{
    color: #3276b1;
    background-color: #fff;
}


.modal-dialog {width:600px;}
.thumbnail {margin-bottom:6px;}
</style>
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
												<li><a href="#">{{ $s->sub_category }} </a></li>
												@endforeach
											</ul>
										</div>
									</div>
								</div>
								@else
								<div class="panel panel-default">
									<div class="panel-heading">
										<h4 class="panel-title"><a href="#">{{ $c->category_name }}</a></h4>
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
									<li><a href=""> <span class="pull-right">(50)</span>Acne</a></li>
									<li><a href=""> <span class="pull-right">(56)</span>Grüne Erde</a></li>
									<li><a href=""> <span class="pull-right">(27)</span>Albiro</a></li>
									<li><a href=""> <span class="pull-right">(32)</span>Ronhill</a></li>
									<li><a href=""> <span class="pull-right">(5)</span>Oddmolly</a></li>
									<li><a href=""> <span class="pull-right">(9)</span>Boudestijn</a></li>
									<li><a href=""> <span class="pull-right">(4)</span>Rösch creative culture</a></li>
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
					<div class="product-details"><!--product-details-->
						<div class="col-sm-5">
							<div class="view-product">
							<?php 
								$explodeImg = explode(",", $product->product_img);
								$exSize = explode(",", $product->size);
							?>
								<img src="{{ URL::asset('productImg/'. $explodeImg[0]) }}" alt="" />
							</div>
							<div id="similar-product" class="carousel slide" data-ride="carousel">
								
								  <!-- Wrapper for slides -->
								<div class="carousel-inner">
									<div class="item active">
										@for($i=0; $i < count($explodeImg); $i++)
										<div style="display:inline">
										<a href="#" title="{{ $product->product_name }}"><img src="{{ URL::asset('productImg/'.$explodeImg[$i]) }}" class="thumbnail img-responsive"></a>
										</div>
										@endfor
									</div>
								</div>
							</div>
							<div id="myModal" class="modal fade" tabindex="-1" role="dialog">
								<div class="modal-dialog">
									<div class="modal-content">
										<div class="modal-header">
											<button type="button" class="close" data-dismiss="modal">×</button>
											<h3 class="modal-title">Heading</h3>
										</div>
										<div class="modal-body">
											
										</div>
										<div class="modal-footer">
											<button class="btn btn-default" data-dismiss="modal">Close</button>
										</div>
									</div>
								</div>
							</div>
						</div>
						
						<div class="col-sm-7">
							<div class="product-information"><!--/product-information-->
								<img src="images/product-details/new.jpg" class="newarrival" alt="" />
								<h2>{{ $product->product_name }}</h2>
								<img src="images/product-details/rating.png" alt="" />
								<span>
									<span>INR <i class="fa fa-inr"></i>{{ $product->selling_price }}</span>
									<form action="{{ route('cart.store') }}" method="POST">
												{{ csrf_field() }}
												@if($product->size)
												<label>Size:</label>
												<div class="input-group" style="">
													<div id="" class="btn-group radioBtn">
													@for($i=0; $i< count($exSize); $i++)
														<a class="btn btn-primary btn-large @if($i == 0) active @else notActive @endif" data-toggle="size{{ $product->id }}" data-title="{{ $exSize[$i] }}" value="{{ $exSize[$i] }}" style="margin-bottom:5px">{{ $exSize[$i] }}</a>
													@endfor
													</div>
													<input type="hidden" name="size" id="size{{ $product->id }}" value="{{ $exSize[0] }}">
												</div>
												@endif
												<input type="hidden" value="{{ $product->id }}" id="id" name="id">
												<input type="hidden" value="{{ $product->product_name }}" id="name" name="name">
												<input type="hidden" value="{{ $product->selling_price }}" id="price" name="price">
												<input type="hidden" value="{{ $explodeImg[0] }}" id="img" name="img">
												<input type="hidden" value="1" id="quantity" name="quantity">
									<button type="submit" class="btn btn-fefault cart add-to-cart" style="margin-left:0px; margin-top:20px">
										<i class="fa fa-shopping-cart"></i>
										Add to cart
									</button>
											</form>
								</span>
								<p><b>Availability:</b> @if($product->status == 1) In-Stock @else Out of stock @endif</p>
								<?php  
									$brand = DB::table('brands')->where('id', $product->brand_name)->first();
								?>
								<p><b>Brand:</b> @if(!empty($brand)) {{ $brand->brand_name }} @endif</p>
								<p><b>Description:</b> {{ $product->product_description }}</p>
								<a href=""><img src="images/product-details/share.png" class="share img-responsive"  alt="" /></a>
							</div><!--/product-information-->
						</div>
					</div><!--/product-details-->
					
					
				</div>
			</div>
		</div>
	</section>
@endsection
@section('customjs')
<script>
$('.thumbnail').click(function(){
  	$('.modal-body').empty();
  	var title = $(this).parent('a').attr("title");
  	$('.modal-title').html(title);
  	$($(this).parents('div').html()).appendTo('.modal-body');
  	$('#myModal').modal({show:true});
});
</script>
@endsection