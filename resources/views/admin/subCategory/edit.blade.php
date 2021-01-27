@extends('admin.admin_layout.main')
@section('title', 'Sub-Category')
@section('page_title', 'Sub-Category')
@section('breadcrumb', 'Sub-Category')
@section('customcss')

<!-- Data Table Css -->
<link rel="stylesheet" type="text/css" href="{{ asset('bower_components/datatables.net-bs4/css/dataTables.bootstrap4.min.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('assets/pages/data-table/css/buttons.dataTables.min.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('bower_components/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css') }}">
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script>
<script>
$(function(){
$('#Yes').click(function() {
    $("#parent_sub_category").attr('disabled', true);
})
$('#No').click(function() {
    $("#parent_sub_category").removeAttr('disabled', false);
})
});
</script>
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
                <form class="form-material" method="POST" action="{{ route('admin.sub-categories.update', $subCategory->id) }}">
                @csrf
                @method('PUT')
                    <div class="form-row">
                        <div class="col-md-6">
                            <div class="form-group form-default ">
                                <select name="category_name" class="form-control @error('category_name') is-invalid @enderror">
                                    <option value="">-Select Category-</option>
                                    @foreach($categories as $c)
                                    <option value="{{ $c->id }}" @if($subCategory->category_id == $c->id) Selected @endif>{{ $c->category_name }}</option>
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
                                <input type="text" name="sub_category" class="form-control @error('sub_category') is-invalid @enderror" value="{{ $subCategory->sub_category }}">
                                <span class="form-bar"></span>
                                <label class="float-label">Sub-Category</label>
                                @error('sub_category')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group form-default ">
                                <label class="">Parent</label>
                                <div class="form-check-inline">
                                    <label class="form-check-label">
                                        <input type="radio" id="Yes" class="form-check-input @error('parent_status') is-invalid @enderror" name="parent_status" value="Yes" @if($subCategory->parent_id == 0) Checked @endif>Yes
                                    </label>
                                </div>
                                <div class="form-check-inline">
                                    <label class="form-check-label">
                                        <input type="radio" id="No" class="form-check-input @error('parent_status') is-invalid @enderror" name="parent_status" value="No" @if($subCategory->parent_id != 0) Checked @endif>No
                                    </label>
                                </div>        
                                @error('parent_status')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group form-default ">
                                <select name="parent_sub_category" id="parent_sub_category" class="form-control @error('parent_sub_category') is-invalid @enderror" @if($subCategory->parent_id == 0) disabled @endif>
                                    @foreach($parentSubCategory as $ps)
                                    <option value="{{ $ps->id }}" @if($subCategory->parent_id == $ps->id) Selected @endif>{{ $ps->sub_category }}</option>
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
                        <div class="col-md-4">
                            <div class="form-group form-default">
                                <select name="status" class="form-control @error('status') is-invalid @enderror">
                                    <option value="">-Select Status-</option>
                                    <option value="1" @if($subCategory->status == 1) Selected @endif>Active</option>
                                    <option value="0" @if($subCategory->status == 0) Selected @endif>Inactive</option>
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

@endsection
@endsection

