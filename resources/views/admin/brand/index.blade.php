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
                <h5>Add Brand</h5>
                <!--<span>Add class of <code>.form-control</code> with <code>&lt;input&gt;</code> tag</span>-->
            </div>
            <div class="card-block">
                <form class="form-material" method="POST" action="{{ route('admin.brand.store') }}">
                @csrf
                    <div class="form-row">
                        <div class="col-md-6">
                            <div class="form-group form-default ">
                                <select name="parent_sub_category" class="form-control @error('parent_sub_category') is-invalid @enderror" id="parent_sub_category">
                                    <option value="">-Choose-</option>
                                    @foreach($subCategories as $s)
                                    <option value="{{ $s->id }}" @if(old('parent_sub_category') == $s->id) Selected @endif>{{ $s->sub_category }}</option>
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
                        <div id="childSubCategory" ></div>
                        <div class="col-md-6">
                            <div class="form-group form-default ">
                                <label class="">Brand Name</label>
                            <div class="tags_add">
                                <input type="text" class="form-control" data-role="tagsinput" name="brand_name" value="{{ old('brand_name') }}">
                            </div>
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
                                    <option value="1" @if(old('status') == 1) Selected @endif>Active</option>
                                    <option value="0" @if(old('status') == 0) Selected @endif>Inactive</option>
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
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h5>Brand List</h5>
            </div>
            <div class="card-block">
                <div class="table-responsive dt-responsive">
                    <table id="dom-jqry" class="table table-striped table-bordered nowrap">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Parent Sub-Category</th>
                                <th>Sub-Category</th>
                                <th>Child Sub-Category</th>
                                <th>Brand Name</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                           @foreach($brand as $key=>$b) 
                            <td>{{ ++$key }}</td>
                            <?php
                                $parentSubCategory = DB::table('sub_categories')->where('id', $b->parent_sub_category)->where('status', 1)->first();
                                $subCategory = DB::table('sub_categories')->where('id', $b->sub_category)->where('status', 1)->first();
                                $childSubCategory = DB::table('sub_categories')->where('id', $b->child_sub_category)->where('status', 1)->first();
                            ?>
                            <td>
                                @if(isset($parentSubCategory) && !empty($parentSubCategory)) {{ $parentSubCategory->sub_category }} @else -- @endif
                            </td>
                            <td>
                                @if(isset($subCategory) && !empty($subCategory)) {{ $subCategory->sub_category }} @else -- @endif
                            </td>
                            <td>
                                @if(isset($childSubCategory) && !empty($childSubCategory)) {{ $childSubCategory->sub_category }} @else -- @endif
                            </td>
                            <td>{{ $b->brand_name }}</td>
                            <td>@if($b->status == 1) Active @else Inactive @endif</td>
                            <td>
                            <a href="{{ route('admin.brand.edit', $b->id) }}"><button class="btn btn-primary waves-effect waves-light">Edit</button></a>
                                    <a href="javascript:void(0)" onclick="$(this).parent().find('form').submit()"><button class="btn btn-danger waves-effect waves-light">Delete</button></a>
                                    <form action="{{ route('admin.brand.destroy', $b->id) }}" method="post">
                                        @method('DELETE')
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                        </form>
                            </td>
                            </tr>
                           @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <th>#</th>
                                <th>Parent Sub-Category</th>
                                <th>Sub-Category</th>
                                <th>Child Sub-Category</th>
                                <th>Brand Name</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
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

