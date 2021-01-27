@extends('admin.admin_layout.main')
@section('title', 'Product')
@section('page_title', 'Product')
@section('breadcrumb', 'Product')
@section('customcss')

<!-- Data Table Css -->
<link rel="stylesheet" type="text/css" href="{{ asset('bower_components/datatables.net-bs4/css/dataTables.bootstrap4.min.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('bower_components/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css') }}">
<!-- Tags css -->
<link rel="stylesheet" type="text/css" href="{{ asset('bower_components/bootstrap-tagsinput/css/bootstrap-tagsinput.css') }}" />
<!-- jquery file upload Frame work -->
<link href="{{ asset('assets/pages/jquery.filer/css/jquery.filer.css') }}" type="text/css" rel="stylesheet" />
<link href="{{ asset('assets/pages/jquery.filer/css/themes/jquery.filer-dragdropbox-theme.css') }}" type="text/css" rel="stylesheet" />
<style>
.jFiler-input-dragDrop{
    width:100%;
}
</style>
@endsection
@section('content')
<div class="row">
    <div class="col-md-12">
        @if ($message = Session::get('success'))
		<div class="alert alert-success alert-block mt-3">
			<button type="button" class="close" data-dismiss="alert">×</button>	
				<strong><i class="fa fa-check text-white">&nbsp;</i>{{ $message }}</strong>
		</div>
		@endif
		@if ($message = Session::get('danger'))
		<div class="alert alert-danger alert-block mt-3">
			<button type="button" class="close" data-dismiss="alert">×</button>	
				<strong>{{ $message }}</strong>
		</div>
		@endif
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h5>Add Product</h5>
                <!--<span>Add class of <code>.form-control</code> with <code>&lt;input&gt;</code> tag</span>-->
            </div>
            <div class="card-block">
                <form class="form-material" method="POST" action="{{ route('admin.product.store') }}" enctype="multipart/form-data">
                @csrf
                    <div class="form-row">
                        <div class="col-md-6">
                            <div class="form-group form-default ">
                                <select name="category_name" class="form-control @error('category_name') is-invalid @enderror" id="category_name">
                                    <option value="">-Select Category-</option>
                                    @foreach($categories as $c)
                                    <option value="{{ $c->id }}">{{ $c->category_name }}</option>
                                    @endforeach
                                </select>
                                <span class="form-bar"></span>
                                <label class="float-label">Category Name</label>
                                @error('category_name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group form-default ">
                                <select name="parent_sub_category" class="form-control @error('parent_sub_category') is-invalid @enderror" id="parent_sub_category">
                                </select>
                                <span class="form-bar"></span>
                                <label class="float-label">Parent Sub-Category</label>
                                @error('parent_sub_category')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group form-default ">
                                <select name="sub_category" class="form-control @error('sub_category') is-invalid @enderror" id="sub_category">
                                    
                                </select>
                                <span class="form-bar"></span>
                                <label class="float-label">Sub-Category</label>
                                @error('sub_category')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div id="childSubCategory"></div>
                        <div class="col-md-6">
                            <div class="form-group form-default">
                                <select name="brand_name" class="form-control @error('brand_name') is-invalid @enderror" id="brand_name">

                                </select>
                                <span class="form-bar"></span>
                                <label class="float-label">Brand Name</label>
                                @error('product_name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group form-default">
                                <input type="text" name="product_name" class="form-control @error('product_name') is-invalid @enderror" value="{{ old('product_name') }}">
                                <span class="form-bar"></span>
                                <label class="float-label">Product Name</label>
                                @error('product_name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group form-default">
                                <input type="text" name="product_description" class="form-control @error('product_description') is-invalid @enderror" value="{{ old('product_description') }}">
                                <span class="form-bar"></span>
                                <label class="float-label">Product Description</label>
                                @error('product_description')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        
                        <div class="col-md-6">
                            <div class="form-group form-default">
                                <input type="number" name="cost_price" class="form-control @error('cost_price') is-invalid @enderror" value="{{ old('cost_price') }}">
                                <span class="form-bar"></span>
                                <label class="float-label">Cost Price</label>
                                @error('cost_price')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group form-default">
                                <input type="number" name="selling_price" class="form-control @error('selling_price') is-invalid @enderror" value="{{ old('selling_price') }}">
                                <span class="form-bar"></span>
                                <label class="float-label">Selling Price</label>
                                @error('selling_price')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group form-default ">
                                <label class="">Size</label>
                            <div class="tags_add">
                                <input type="text" class="form-control" data-role="tagsinput" name="size" value="{{ old('size') }}">
                            </div>
                                @error('size')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-block">
                                    <div class="sub-title">Product Image</div>
                                    <input type="file" name="product_img[]" id="filer_input" multiple="multiple">
                                </div>
                                @error('product_img')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group form-default">
                                <select name="status" class="form-control @error('status') is-invalid @enderror">
                                    <option value="">-Select Status-</option>
                                    <option value="1" @if(old('status') == "1") Selected @endif>In-Stock</option>
                                    <option value="0" @if(old('status') == "0") Selected @endif>Out-of-Stock</option>
                                </select>
                                <span class="form-bar"></span>
                                <label class="float-label">Status</label>
                                @error('status')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="form-group form-default">
                        <button class="btn btn-success waves-effect waves-light">Submit</button>
                    </div>
                </form>
            </div>
        </div>
        
    </div>
</div>


@section('customjs')



<!-- jquery file upload js -->
<script src="{{ asset('assets/pages/jquery.filer/js/jquery.filer.min.js') }}"></script>
<script src="{{ asset('assets/pages/filer/custom-filer.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/pages/filer/jquery.fileuploads.init.js') }}" type="text/javascript"></script>

<!-- Tags js -->
<script type="text/javascript" src="{{ asset('bower_components/bootstrap-tagsinput/js/bootstrap-tagsinput.js') }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/typeahead.js/0.10.4/typeahead.bundle.min.js"></script>
<script>
$(document).ready(function(){
    $('#dom-jqry').DataTable({
	});
});
</script>
<script type=text/javascript>
  $('#category_name').change(function(){
  var categoryID = $(this).val();  
//   alert(categoryID);
  if(categoryID){
    $.ajax({
      type:"GET",
      url:"{{url('/admin/get-subcategory-list')}}?category_id="+categoryID,
      success:function(res){        
      if(res){
        $("#parent_sub_category").empty();
        $("#parent_sub_category").append('<option value="">-Select Sub-Category-</option>');
        $.each(res,function(key,value){
          $("#parent_sub_category").append('<option value="'+key+'">'+value+'</option>');
        });
      
      }else{
        $("#parent_sub_category").empty();
      }
      }
    });
  }else{
    $("#parent_sub_category").empty();
  }   
  });


  $('#parent_sub_category').change(function(){
  var parent_sub_categoryID = $(this).val();  
//   alert(categoryID);
  if(parent_sub_categoryID){
    $.ajax({
      type:"GET",
      url:"{{url('/admin/get-parentSubCategory-list')}}?parent_sub_category_id="+parent_sub_categoryID,
      success:function(res){        
        if(res.subCategory){
        $("#sub_category").empty();
        $("#sub_category").append('<option value="">-Select Sub-Category-</option>');
        $.each(res.subCategory,function(key,value){
          $("#sub_category").append('<option value="'+key+'">'+value+'</option>');
        });
      
      }else{
        $("#sub_category").empty();
      }
      if(res.brand){
        $("#brand_name").empty();
        $("#brand_name").append('<option value="">-Select Brand-</option>');
        $.each(res.brand,function(key,value){
          $("#brand_name").append('<option value="'+key+'">'+value+'</option>');
        });
      
      }else{
        $("#brand_name").empty();
      }
      }
    });
  } 
  else{
    $("#sub_category").empty();
  }   
  });



  $('#sub_category').change(function(){
  var sub_categoryID = $(this).val();  
//   alert(categoryID);
  if(sub_categoryID){
    $.ajax({
      type:"GET",
      url:"{{url('/admin/get-childSubCategory-list')}}?sub_category_id="+sub_categoryID,
      success:function(res){     
          console.log(res != '');   
      if(res != ''){
          $('#childSubCategory').addClass('col-md-6');
        $("#childSubCategory").html(res);
        }
        else{
            $('#childSubCategory').hide();
        }
      }
    });
  }  
  });
</script>
@endsection
@endsection

