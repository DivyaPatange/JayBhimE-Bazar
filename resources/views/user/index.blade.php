@extends('auth.auth_layout.mainlayout')
@section('title', 'Dashboard')
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
                <div class="features_items"><!--features_items-->
                    <h2 class="title text-center">Welcome {{ Auth::user()->name }}</h2>
                    
                    
                </div><!--features_items-->
            </div>
		</div>
	</div>
</section>

@endsection
@section('customjs')

@endsection