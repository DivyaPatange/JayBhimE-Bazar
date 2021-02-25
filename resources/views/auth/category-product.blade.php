@extends('auth.auth_layout.mainlayout')
@section('title', 'Index')
@section('customcss')
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
			<?php
				$parentSubC = DB::table('sub_categories')->where('parent_id', $subCategory->id)->where('status', 1)->orderBy('id', 'DESC')->get();
			?>
			@if(count($parentSubC) > 0)
			<div class="row" >
				<div class="col-md-4"></div>
				<div class="col-md-4"></div>
				<div class="col-md-4" style="margin-bottom:20px">
					<select name="brand" id="brand" style="padding:12px">
						<option value="">Sort By : Category </option>
						
						@foreach($parentSubC as $ba)
						<option value="{{ $ba->id }}">{{ $ba->sub_category }}</option>
						@endforeach
					</select>
				</div>
			</div>
			@endif
			<div class="row">
				@include('auth.auth_layout.sidebar')
				
				<div class="col-sm-9 padding-right">
					<div class="features_items"><!--features_items-->
						<h2 class="title text-center">{{ $subCategory->category_name }}</h2>
						<?php
							if($subCategory->status == 1){
								// dd($subCategory);
								$subCategories = DB::table('sub_categories')->where('parent_id', $subCategory->id)->where('status', 1)->get();
							}
							// dd($subCategories);
						?>
						
						<div class="row">
							<div id="post_data"></div>
						</div>
						
					</div><!--features_items-->
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
		url:"{{ route('filter.category-product', $subCategory->id) }}",
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
@endsection