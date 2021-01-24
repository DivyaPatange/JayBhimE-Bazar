@extends('admin.admin_layout.main')
@section('title', 'Sub-Category')
@section('page_title', 'Sub-Category')
@section('breadcrumb', 'Sub-Category')
@section('customcss')

<!-- Data Table Css -->
<link rel="stylesheet" type="text/css" href="{{ asset('bower_components/datatables.net-bs4/css/dataTables.bootstrap4.min.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('assets/pages/data-table/css/buttons.dataTables.min.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('bower_components/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css') }}">
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
                <h5>Add Category</h5>
                <!--<span>Add class of <code>.form-control</code> with <code>&lt;input&gt;</code> tag</span>-->
            </div>
            <div class="card-block">
                <form class="form-material" method="POST" action="{{ route('admin.sub-categories.store') }}">
                @csrf
                    <div class="form-row">
                        <div class="col-md-6">
                            <div class="form-group form-default ">
                                <select name="category_name" class="form-control @error('category_name') is-invalid @enderror">
                                    <option value="">-Select Category-</option>
                                    @foreach($categories as $c)
                                    <option value="{{ $c->id }}" @if(old('category_name') == $c->id) Selected @endif>{{ $c->category_name }}</option>
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
                                <input type="text" name="sub_category" class="form-control @error('sub_category') is-invalid @enderror" value="{{ old('sub_category') }}">
                                <span class="form-bar"></span>
                                <label class="float-label">Sub-Category</label>
                                @error('sub_category')
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
                <h5>Category List</h5>
            </div>
            <div class="card-block">
                <div class="table-responsive dt-responsive">
                    <table id="dom-jqry" class="table table-striped table-bordered nowrap">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Category</th>
                                <th>Sub-Category</th>
                                <th>Parent Sub-Category</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($subCategories as $key => $s)
                            <tr>
                                <td>{{ ++$key }}</td>
                                <?php
                                    $category = DB::table('categories')->where('id', $s->category_id)->first();
                                    $parentSubCategory = DB::table('sub_categories')->where('id', $s->parent_id)->first();
                                ?>
                                <td>@if(isset($category) && !empty($category)) {{ $category->category_name }} @endif</td>
                                <td>{{ $s->sub_category }}</td>
                                <td>@if(isset($parentSubCategory) && !empty($parentSubCategory)) {{ $parentSubCategory->sub_category }} @endif</td>
                                <td>@if($s->status == 1) Active @else Inactive @endif</td>
                                <td>
                                    <a href="{{ route('admin.sub-categories.edit', $s->id) }}"><button class="btn btn-primary waves-effect waves-light">Edit</button></a>
                                    <a href="javascript:void(0)" onclick="$(this).parent().find('form').submit()"><button class="btn btn-danger waves-effect waves-light">Delete</button></a>
                                    <form action="{{ route('admin.sub-categories.destroy', $s->id) }}" method="post">
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
                                <th>Category</th>
                                <th>Sub-Category</th>
                                <th>Parent Sub-Category</th>
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
<script>
$(document).ready(function(){
    $('#dom-jqry').DataTable({
	});
});
</script>
@endsection
@endsection

