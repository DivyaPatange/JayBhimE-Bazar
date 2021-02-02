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
					<h2 class="title text-center"> Order Details</h2>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="table-responsive">          
                                <table class="table">
                                <tr>
                                    <th>Order Number</th>
                                    <th>Product Count</th>
                                    <th>Total</th>
                                </tr>
                                <tr>
                                    <td>{{ $order->order_number }}</td>
                                    <td>{{ $order->item_count }}</td>
                                    <td>INR {{ $order->grand_total }}</td>
                                </tr>
                                <tr>
                                </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <h2 class="title text-center">Product Details</h2>
                            <div class="table-responsive">
                            <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Product Name</th>
                                    <th scope="col">Quantity</th>
                                    <th>Size</th>
                                    <th scope="col">Price</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($orderItems as $key => $o)
                                <?php
                                    $product = DB::table('products')->where('id', $o->product_id)->first();
                                ?>
                                <tr>
                                    <td>{{ ++$key }}</td>
                                    <td>@if(isset($product) && !empty($product)) {{ $product->product_name }} @endif</td>
                                    <td>{{ $o->quantity }}</td>
                                    <td>{{ $o->size }}</td>
                                    <td><i class="fa fa-rupee">&nbsp;</i>@if(isset($product) && !empty($product)) {{ $product->selling_price }} @endif</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <?php
                            $payment = DB::table('payments')->where('order_id', $order->order_number)->first();
                            // dd(!empty($payment));
                        ?>
                        @if($payment != "null")
                        <div class="col-md-12">
                            <form method="post" action="{{ route('pay', $order->id) }}">
                            @csrf
                            <button class="btn btn-success" style="margin-bottom:20px">Proceed to Pay</button>
                            </form>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
		</div>
	</div>
</section>

@endsection
@section('customjs')

@endsection