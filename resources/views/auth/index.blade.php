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
#loading
{
 text-align:center; 
 background: url('{{ asset('8.gif') }}') no-repeat center; 
 height: 150px;
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
			<div class="row" >
				<div class="col-md-4"></div>
				<div class="col-md-4"></div>
				<div class="col-md-4" style="margin-bottom:20px">
					<select name="brand" id="brand" style="padding:12px">
						<option value="">Sort By : Brands </option>
						<?php
							$brand = DB::table('brands')->where('status', 1)->orderBy('id', 'DESC')->get();
						?>
						@foreach($brand as $ba)
						<option value="{{ $ba->id }}">{{ $ba->brand_name }}</option>
						@endforeach
					</select>
				</div>
			</div>
			<div class="row">
				@include('auth.auth_layout.sidebar')
				
				<div class="col-sm-9 padding-right">
					<div class="features_items"><!--features_items-->
						<h2 class="title text-center">Features Items</h2>
						<?php
							$product = DB::table('products')->where('status', 1)->orderBy('id', 'DESC')->take(6)->get(); 
						?>
						<div class="row">
							<div id="post_data"></div>
						
						</div>
						
					</div><!--features_items-->
					
					<!--category-tab-->
					<!-- <div class="category-tab">
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
					</div> -->
					<!--/category-tab-->
					
					
					
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
$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});
$(document).ready(function(){

filter_data('');

function filter_data(id="")
{	if(id == ""){
	$('#post_data').html('<div id="loading" style="" ></div>');
	}
	// alert(id);
	var minimum_price = $('#hidden_minimum_price').val();
	var maximum_price = $('#hidden_maximum_price').val();
	var brand = get_filter('brand');
	var keyword = $('#search').val();
	// alert(minimum_price);
	$.ajax({
		url:"{{ route('filter.product') }}",
		method:"POST",
		data:{minimum_price:minimum_price, maximum_price:maximum_price, brand:brand,id:id, keyword:keyword},
		success:function(data){
			var json = JSON.parse(data);
			// alert(json.id);
			
			if(json.id)
			{
				$('#load_more_button').remove();
				// alert(json.id);
				$('#post_data').append(json.output);
			}
			else{
				$('#post_data').html(json.output);
			}
			// if(json.id )
		}
	});
}

function get_filter(class_name)
{
	var brand = $("#brand").val();
	return brand;
}

$('#brand').change(function(){
	filter_data();
});
$('#search').keyup(function(){
	filter_data();
});
$('#price_range').slider({
	range:true,
	min:100,
	max:6500,
	values:[100, 6500],
	step:500,
	stop:function(event, ui)
	{
		$('#price_show').html(ui.values[0] + ' - ' + ui.values[1]);
		$('#hidden_minimum_price').val(ui.values[0]);
		$('#hidden_maximum_price').val(ui.values[1]);
		filter_data();
	}
});
$(document).on('click', '#load_more_button', function(){
  var id = $(this).data('id');
  $('#load_more_button').html('<b>Loading...</b>');
  filter_data(id);
 });

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