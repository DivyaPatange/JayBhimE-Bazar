@extends('auth.auth_layout.mainlayout')
@section('title', 'Success')
@section('customcss')

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
        <div class="row">
            <div class="col-sm-3">
                @include('user.sidebar')
            </div>
				
            <div class="col-sm-9 padding-right">
                <div class="row">
                    <div class="col-sm-6" style="margin:auto">
                        <div class="product-image-wrapper">
                            <div class="single-products">
                                <div class="productinfo text-center">
                                    <img src="{{ asset('icons8-checked-48.png') }}" width="90px" alt="" />
                                    <h6 class="card-title">Transaction is Successfully Done!</h6>
                                </div>
                                
                            </div>
                        </div>
                    </div>
                </div>
            </div>
		</div>
	</div>
</section>

@endsection
@section('customjs')

@endsection