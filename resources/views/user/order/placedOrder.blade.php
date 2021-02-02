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
					<h2 class="title text-center">Placed Order</h2>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="table-responsive">          
                                <table class="table">
                                    <tr>
                                        <th>ID</th>
                                        <th>Order Number</th>
                                        <th>Product Count</th>
                                        <th>Price</th>
                                        <th>Payment Status</th>
                                    </tr>
                                    @foreach($order as $key => $o)
                                        <tr>
                                            <td>{{ ++$key }}</td>
                                            <td><a href="{{ route('order.details', $o->id) }}">{{ $o->order_number }}</a></td>
                                            <td>{{ $o->item_count }}</td>
                                            <td>INR {{ $o->grand_total }}</td>
                                            <?php
                                                $payment = DB::table('payments')->where('order_id', $o->order_number)->first();
                                                // <!-- dd($payment); -->
                                            ?>
                                            <td>@if($payment) {{ $payment->response_message }} 
                                            @else 
                                            <form method="post" action="{{ route('pay', $o->id) }}">
                                            @csrf
                                            <button class="btn btn-info btn-sm">Payment</button>
                                            </form>
                                            @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                </table>
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