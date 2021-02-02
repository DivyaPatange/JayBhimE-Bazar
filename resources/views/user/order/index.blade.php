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
                <div class="blog-post-area">
					<h2 class="title text-center">Order Details</h2>
                    <div class="single-blog-post">
                        @if(\Cart::getTotalQuantity()>0)
                        <h3>{{ \Cart::getTotalQuantity()}} Product(s) In Your Cart</h3>
                        @else
                        <h3>No Product(s) In Your Cart &nbsp; <a href="{{ url('/') }}">Continue Shopping</a></h3>
                        @endif
                        
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card">
                            @if(count($cartCollection)>0)
                                <div class="card-body">
                                    <div class="row">
                                        @foreach($cartCollection as $item)
                                        <div class="col-sm-4">
                                                <div class="product-image-wrapper">
                                                    <div class="single-products">
                                                            <div class="productinfo text-center">
                                                            
                                                                <img src="/productImg/{{ $item->attributes->image }}" alt="" />
                                                                <p>{{ $item->name }}</p>
                                                                <p><b>Quantity: </b> {{ $item->quantity }}</p>
                                                                @if($item->attributes->size != null)
                                                                <p><b>Size: </b> {{ $item->attributes->size }}</p>
                                                                @endif
                                                                <h2>Price : <i class="fa fa-inr">&nbsp;</i>{{ $item->price }}</h2>
                                                                <p><b>Sub Total: </b><i class="fa fa-rupee">&nbsp;</i>{{ \Cart::get($item->id)->getPriceSum() }}</p>
                                                            </div>
                                                    </div>
                                                    <!-- <div class="choose">
                                                        <ul class="nav nav-pills nav-justified">
                                                            <li><a href="#"><i class="fa fa-plus-square"></i>Add to wishlist</a></li>
                                                            <li><a href="#"><i class="fa fa-plus-square"></i>Add to compare</a></li>
                                                        </ul>
                                                    </div> -->
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                                <div class="card-footer" style="display:flex">
                                @if(count($cartCollection)>0)
                                    <form action="{{ route('checkout.place.order') }}" method="POST">
                                        @csrf
                                        <button class="btn btn-success" style="margin-bottom:20px">Placed Order</button>
                                    </form>
                                <a href="{{ url('/') }}"><button class="btn btn-danger" style="margin-left:20px; margin-bottom:20px">Continue Shopping</button></a>
                                @endif
                                </div>
                            @endif
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