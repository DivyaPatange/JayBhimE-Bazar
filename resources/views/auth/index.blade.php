@extends('auth.auth_layout.mainlayout')
@section('title', 'Index')
@section('customcss')
<!-- <link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css"> -->
<!-- <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script> -->
<link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">


<style>
.radioBtn .notActive{
    color: #3276b1;
    background-color: #fff;
}

</style>

@endsection
@section('content')
<section id="slider"><!--slider-->
		<div class="container">
			<div class="row">
				<div class="col-sm-12">
					<div id="slider-carousel" class="carousel slide" data-ride="carousel">
						<ol class="carousel-indicators">
							<li data-target="#slider-carousel" data-slide-to="0" class="active"></li>
							<li data-target="#slider-carousel" data-slide-to="1"></li>
							<li data-target="#slider-carousel" data-slide-to="2"></li>
						</ol>
						
						<div class="carousel-inner">
							<div class="item active">
								<div class="col-sm-6">
									<h1><span style="font-family:FontAwesome;">jaibhimbazar</h1>
									<h2>Shopping Online</h2>
									<p>Shopping Becomes More Practical Economicalt</p>
									<button type="button" class="btn btn-default get">Get it now</button>
								</div>
								<div class="col-sm-6">
									<img src="images/home/girl1.jpg" class="girl img-responsive" alt="" />
									<img src="images/home/pricing.png"  class="pricing" alt="" />
								</div>
							</div>
							<div class="item">
								<div class="col-sm-6">
									<h1><span style="font-family:FontAwesome;">jaibhimbazar</h1>
									<h2>Shopping Online</h2>
									<p>Fashion & Lifestyle in India. Buy Shoes, Clothing, Accessories and lifestyle products for women & men. Best Online Fashion Store</p>
									<button type="button" class="btn btn-default get">Get it now</button>
								</div>
								<div class="col-sm-6">
									<img src="images/home/girl2.jpg" class="girl img-responsive" alt="" />
									<img src="images/home/pricing.png"  class="pricing" alt="" />
								</div>
							</div>
							
							<div class="item">
								<div class="col-sm-6">
									<h1><span style="font-family:FontAwesome;">jaibhimbazar</h1>
									<h2>Shopping Online</h2>
									<p>Online Shopping For Women,Men,Kid's Fashion.</p>
									<button type="button" class="btn btn-default get">Get it now</button>
								</div>
								<div class="col-sm-6">
									<img src="images/home/girl3.jpg" class="girl img-responsive" alt="" />
									<img src="images/home/pricing.png" class="pricing" alt="" />
								</div>
							</div>
							
						</div>
						
						<a href="#slider-carousel" class="left control-carousel hidden-xs" data-slide="prev">
							<i class="fa fa-angle-left"></i>
						</a>
						<a href="#slider-carousel" class="right control-carousel hidden-xs" data-slide="next">
							<i class="fa fa-angle-right"></i>
						</a>
					</div>
					
				</div>
			</div>
		</div>
	</section><!--/slider-->
	
	<section>
		<div class="container">
			<div class="row mb-3">
				<div class="col-md-12">
				@if(session()->has('success_msg'))
				<div class="alert alert-success alert-dismissible">
  					<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
					{{ session()->get('success_msg') }}
				</div>
				@endif
				@if(session()->has('alert_msg'))
					<div class="alert alert-warning alert-dismissible">
					<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
						{{ session()->get('alert_msg') }}
					</div>
				@endif
				</div>
			</div>
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
							<p>
  <label for="amount">Price range:
	
	<input type="text" id="amount_start" name="start_price">
  <input type="text" id="amount_end" name="end_price">
  </label>
</p>
 
<div id="slider-range"></div>
<button type="button" id="filterPrice">Filter</button>
						</div><!--/price-range-->
						<div class="shipping text-center"><!--shipping-->
							<img src="images/home/shipping.jpg" alt="" />
						</div><!--/shipping-->
					
					</div>
				</div>
				
				<div class="col-sm-9 padding-right">
					<div class="features_items"><!--features_items-->
						<h2 class="title text-center">Features Items</h2>
						<?php
							$product = DB::table('products')->where('status', 1)->orderBy('id', 'DESC')->take(6)->get(); 
						?>
						<div class="row">
							{{ csrf_field() }}
							<div id="post_data"></div>
						
						</div>
						
					</div><!--features_items-->
					
					<div class="category-tab"><!--category-tab-->
						<div class="col-sm-12">
							<ul class="nav nav-tabs">
							    <?php
							        $subCategory = DB::table('sub_categories')->where('parent_id', 0)->where('status', 1)->get()
							    ?>
								@foreach($subCategory as $key=>$sb)
								<li class="@if($key == 0) active @endif"><a href="#tab{{ $sb->id }}" data-toggle="tab">{{ $sb->sub_category }}</a></li>
								@endforeach
							</ul>
						</div>
						<div class="tab-content">
							@foreach($subCategory as $key=>$sb)
							<div class="tab-pane fade @if($key == 0) active @endif in" id="tab{{ $sb->id }}" >
								<?php
									$tabproduct = DB::table('products')->where('parent_sub_category', $sb->id)->where('status', 1)->orderBy('id', 'DESC')->limit(4)->get();
								?>
								@foreach($tabproduct as $tp)
								<div class="col-sm-3">
									<div class="product-image-wrapper">
										<div class="single-products">
											<div class="productinfo text-center">
											    <?php
											        $explodeImg = explode(",", $tp->product_img);
											        $exSize = explode(",", $tp->size);
											    ?>
												<img src="{{  URL::asset('ProductImg/' . $explodeImg[0]) }}" alt="" />
												<h2><i class="fa fa-inr">&nbsp;</i>{{ $tp->selling_price }} - <del><i class="fa fa-inr">&nbsp;</i>{{ $tp->cost_price }}</del></h2>
												<p>{{ $tp->product_name }}</p>
												<form action="{{ route('cart.store') }}" method="POST">
													{{ csrf_field() }}
													<p style="margin-bottom:0px">Size</p>
													<div class="input-group" style="margin:auto">
														<div id="" class="btn-group radioBtn">
														@for($i=0; $i< count($exSize); $i++)
															<a class="btn btn-primary btn-sm @if($i == 0) active @else notActive @endif" data-toggle="size{{ $tp->id }}" data-title="{{ $exSize[$i] }}" value="{{ $exSize[$i] }}" style="margin-bottom:5px">{{ $exSize[$i] }}</a>
														@endfor
														</div>
														<input type="hidden" name="size" id="size{{ $tp->id }}" value="{{ $exSize[0] }}">
													</div>
													<input type="hidden" value="{{ $tp->id }}" id="id" name="id">
													<input type="hidden" value="{{ $tp->product_name }}" id="name" name="name">
													<input type="hidden" value="{{ $tp->selling_price }}" id="price" name="price">
													<input type="hidden" value="{{ $explodeImg[0] }}" id="img" name="img">
                                        			<input type="hidden" value="1" id="quantity" name="quantity">
													<button class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</button>
												</form>
											</div>
											
										</div>
									</div>
								</div>
								@endforeach
							</div>
							@endforeach
							
						</div>
					</div><!--/category-tab-->
					
					
					
				</div>
			</div>
		</div>
	</section>
	
@endsection
@section('customjs')
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
<script>
$(document).on('click', '.radioBtn a', function(){
    var sel = $(this).data('title');
    var tog = $(this).data('toggle');
	// alert(tog);
    $('#'+tog).prop('value', sel);
    
    $('a[data-toggle="'+tog+'"]').not('[data-title="'+sel+'"]').removeClass('active').addClass('notActive');
    $('a[data-toggle="'+tog+'"][data-title="'+sel+'"]').removeClass('notActive').addClass('active');
})
</script>

<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script>
$(document).ready(function(){
 
 var _token = $('input[name="_token"]').val();

 load_data('', _token, '', '');

 function load_data(id="", _token, start="", end="")
 {
	//  var start = start;
	// alert(start);
  $.ajax({
   url:"{{ route('loadmore.load_data') }}",
   method:"POST",
   data:{id:id, _token:_token, start:start, end:end},
   success:function(data)
   {
	//    if(data.start){
	// document.getElementById("post_data").innerHTML = "";
	//    }
    $('#load_more_button').remove();
    $('#post_data').append(data);
   }
  })
 }

 $(document).on('click', '#load_more_button', function(){
  var id = $(this).data('id');
  $('#load_more_button').html('<b>Loading...</b>');
  load_data(id, _token);
 });
 $( "#slider-range" ).slider({
	range: true,
	min: 0,
	max: 5000,
	values: [ 700, 3000 ],
	slide: function( event, ui ) {
	$( "#amount_start" ).val(ui.values[ 0 ]);
	$( "#amount_end" ).val(ui.values[ 1 ]);
	}
});
	$(document).on('click', '#filterPrice', function(){
	  var start = $('#amount_start').val();
	  var end = $('#amount_end').val();
	  load_data('', _token, start, end);
  })

});

</script>
  <script>
//   $( function() {
//     $( "#slider-range" ).slider({
//       range: true,
//       min: 0,
//       max: 500,
//       values: [ 75, 300 ],
//       slide: function( event, ui ) {
//         $( "#amount_start" ).val( "₹" + ui.values[ 0 ]);
// 		$( "#amount_end" ).val( "₹" + ui.values[ 1 ]);
//       }
//     });
//   } );
//   function send()
//   {
// 	  var start = $('#amount_start').val();
// 	  var end = $('#amount_end').val();
// 	  $.ajax({
// 		  method: "GET",
// 		  url: "{{ url('/load_price-product') }}",
// 		  data: "start="+start+"&end="+end,
// 		  success:function(data)
// 		{
// 			$('#load_more_button').remove();
// 			$('#post_data').append(data);
// 		}
// 	  })
//   }
  </script>
@endsection