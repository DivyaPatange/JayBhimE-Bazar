@extends('admin.admin_layout.main')
@section('title', 'Product List')
@section('page_title', 'Product List')
@section('breadcrumb', 'Product List')
@section('customcss')

<!-- Data Table Css -->
<link rel="stylesheet" type="text/css" href="{{ asset('bower_components/datatables.net-bs4/css/dataTables.bootstrap4.min.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('bower_components/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css') }}">

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
        <a href="{{ route('admin.product.create') }}"><button type="button" class="btn btn-primary waves-effect waves-light f-left mb-3 d-inline-block md-trigger" data-modal="modal-13"> <i class="icofont icofont-plus m-r-5"></i> Add Product</button></a>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h5>Product List</h5>
            </div>
            <div class="card-block">
                <div class="table-responsive dt-responsive">
                    <table id="dom-jqry" class="table table-striped table-bordered nowrap">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Product Name</th>
                                <th>Product Description</th>
                                <th>Product Image</th>
                                <th>Selling Price</th>
                                <th>Cost Price</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($products as $key=>$p)
                            <tr>
                                <td>{{ ++$key }}</td>
                                <td>{{ $p->product_name }}</td>
                                <td>{{ $p->product_description }}</td>
                                <?php
                                    $explodeProduct = explode(",", $p->product_img);
                                    // dd($explodeProduct[0]);
                                ?>
                                <td>
                                    <img src="{{  URL::asset('ProductImg/' . $explodeProduct[0]) }}" alt="" width="25%">
                                </td>
                                <td>{{ $p->selling_price }}</td>
                                <td>{{ $p->cost_price }}</td>
                                <td>@if($p->status == 1) In-Stock @else Out-of-Stock @endif</td>
                                <td>
                                    <a href="{{ route('admin.product.edit', $p->id) }}"><button class="btn btn-primary waves-effect waves-light">Edit</button></a>
                                    <a href="javascript:void(0)" onclick="$(this).parent().find('form').submit()"><button class="btn btn-danger waves-effect waves-light">Delete</button></a>
                                    <form action="{{ route('admin.product.destroy', $p->id) }}" method="post">
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
                                <th>Product Name</th>
                                <th>Product Description</th>
                                <th>Product Image</th>
                                <th>Selling Price</th>
                                <th>Cost Price</th>
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



<!-- jquery file upload js -->
<script src="{{ asset('assets/pages/jquery.filer/js/jquery.filer.min.js') }}"></script>
<script src="{{ asset('assets/pages/filer/custom-filer.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/pages/filer/jquery.fileuploads.init.js') }}" type="text/javascript"></script>
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
  }else{
    $("#sub_category").empty();
  }   
  });


  $('#sub_category').change(function(){
  var sub_categoryID = $(this).val();  
//   alert(categoryID);
  if(sub_categoryID){
    $.ajax({
      type:"GET",
      url:"{{url('/admin/get-parentSubCategory-list')}}?sub_category_id="+sub_categoryID,
      success:function(res){        
      if(res){
          $('#parentSubCategory').addClass('col-md-6');
        $("#parentSubCategory").html(res);
        
      
      }
      }
    });
  }  
  });
</script>
@endsection
@endsection

