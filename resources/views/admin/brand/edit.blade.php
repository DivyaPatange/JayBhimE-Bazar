@extends('admin.admin_layout.main')
@section('title', 'Brand')
@section('page_title', 'Brand')
@section('breadcrumb', 'Brand')
@section('customcss')

<!-- Data Table Css -->
<link rel="stylesheet" type="text/css" href="{{ asset('bower_components/datatables.net-bs4/css/dataTables.bootstrap4.min.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('assets/pages/data-table/css/buttons.dataTables.min.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('bower_components/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css') }}">
<!-- Tags css -->
<link rel="stylesheet" type="text/css" href="{{ asset('bower_components/bootstrap-tagsinput/css/bootstrap-tagsinput.css') }}" />
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
                <h5>Edit Brand</h5>
                <!--<span>Add class of <code>.form-control</code> with <code>&lt;input&gt;</code> tag</span>-->
            </div>
            <div class="card-block">
                <form class="form-material" method="POST" action="{{ route('admin.brand.update', $brand->id) }}">
                @csrf
                @method('PUT')
                    <div class="form-row">
                        <div class="col-md-6">
                            <div class="form-group form-default ">
                                <select name="parent_sub_category" class="form-control @error('parent_sub_category') is-invalid @enderror" id="parent_sub_category">
                                    <option value="">-Choose-</option>
                                    @foreach($subCategories as $s)
                                    <option value="{{ $s->id }}" @if($brand->parent_sub_category == $s->id) Selected @endif>{{ $s->sub_category }}</option>
                                    @endforeach
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
                                    @foreach($subCategory as $sc)
                                    <option value="{{ $sc->id }}" @if($sc->id == $brand->sub_category) Selected @endif>{{ $sc->sub_category }}</option>
                                    @endforeach
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
                        @if($brand->child_sub_category != null)
                        <div id="childSubCategory" class="col-md-6">
                            <div class="form-group form-default ">
                                <select name="child_sub_category" class="form-control @error('child_sub_category') is-invalid @enderror" id="child_sub_category">
                                    @foreach($childSubCategory as $cs)
                                    <option value="{{ $cs->id }}" @if($cs->id == $brand->child_sub_category) Selected @endif>{{ $cs->sub_category }}</option>
                                    @endforeach
                                </select>
                                <span class="form-bar"></span>
                                <label class="float-label">Child Sub-Category</label>
                            </div>
                        </div>

                        @else
                        <div id="childSubCategory" ></div>
                        @endif
                        <div class="col-md-6">
                            <div class="form-group form-default ">
                                <input type="text" name="brand_name" class="form-control @error('status') is-invalid @enderror" value="{{ $brand->brand_name }}">
                                <span class="form-bar"></span>
                                <label class="float-label">Brand Name</label>
                                @error('brand_name')
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
                                    <option value="1" @if($brand->status == 1) Selected @endif>Active</option>
                                    <option value="0" @if($brand->status == 0) Selected @endif>Inactive</option>
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
                        <button class="btn btn-success waves-effect waves-light">Update</button>
                    </div>
                </form>
            </div>
        </div>
        
    </div>
</div>

@section('customjs')
<!-- data-table js -->
<script src="{{ asset('bower_components/datatables.net/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('bower_components/datatables.net-buttons/js/dataTables.buttons.min.js') }}"></script>
<script src="{{ asset('assets/pages/data-table/js/jszip.min.js') }}"></script>
<script src="{{ asset('assets/pages/data-table/js/pdfmake.min.js') }}"></script>
<script src="{{ asset('assets/pages/data-table/js/vfs_fonts.js') }}"></script>
<script src="{{ asset('bower_components/datatables.net-buttons/js/buttons.print.min.js') }}"></script>
<script src="{{ asset('bower_components/datatables.net-buttons/js/buttons.html5.min.js') }}"></script>
<script src="{{ asset('bower_components/datatables.net-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ asset('bower_components/datatables.net-responsive/js/dataTables.responsive.min.js') }}"></script>
<script src="{{ asset('bower_components/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js') }}"></script>
<!-- Tags js -->
<script type="text/javascript" src="{{ asset('bower_components/bootstrap-tagsinput/js/bootstrap-tagsinput.js') }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/typeahead.js/0.10.4/typeahead.bundle.min.js"></script>
<script>
$(document).ready(function(){
    $('#dom-jqry').DataTable({
	});
});


$('#parent_sub_category').change(function(){
  var parent_sub_categoryID = $(this).val();  
//   alert(categoryID);
  if(parent_sub_categoryID){
    $.ajax({
      type:"GET",
      url:"{{url('/admin/get-brandSubCategory-list')}}?parent_sub_category_id="+parent_sub_categoryID,
      success:function(res){        
        if(res){
        $("#sub_category").empty();
        $("#sub_category").append('<option value="">-Select Sub-Category-</option>');
        $.each(res,function(key,value){
          $("#sub_category").append('<option value="'+key+'">'+value+'</option>');
        });
      
      }else{
        $("#sub_category").empty();
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

