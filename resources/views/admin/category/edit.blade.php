@extends('admin.admin_layout.main')
@section('title', 'Category')
@section('page_title', 'Category')
@section('breadcrumb', 'Category')
@section('customcss')


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
                <h5>Edit Category</h5>
                <!--<span>Add class of <code>.form-control</code> with <code>&lt;input&gt;</code> tag</span>-->
            </div>
            <div class="card-block">
                <form class="form-material" method="POST" action="{{ route('admin.categories.update', $category->id) }}">
                @csrf
                @method('PUT')
                    <div class="form-row">
                        <div class="col-md-6">
                            <div class="form-group form-default ">
                                <input type="text" name="category_name" class="form-control @error('category_name') is-invalid @enderror" value="{{ $category->category_name }}">
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
                            <div class="form-group form-default">
                                <select name="status" class="form-control @error('status') is-invalid @enderror">
                                    <option value="">-Select Status-</option>
                                    <option value="1" @if($category->status == 1) Selected @endif>Active</option>
                                    <option value="0" @if($category->status == 0) Selected @endif>Inactive</option>
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

