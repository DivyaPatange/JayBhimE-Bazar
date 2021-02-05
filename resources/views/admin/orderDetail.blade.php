@extends('admin.admin_layout.main')
@section('title', 'Order Detail')
@section('page_title', 'Order Detail')
@section('breadcrumb', 'Order Detail')
@section('customcss')

<!-- Data Table Css -->
<link rel="stylesheet" type="text/css" href="{{ asset('bower_components/datatables.net-bs4/css/dataTables.bootstrap4.min.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('assets/pages/data-table/css/buttons.dataTables.min.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('bower_components/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css') }}">
<!-- Tags css -->
<link rel="stylesheet" type="text/css" href="{{ asset('bower_components/bootstrap-tagsinput/css/bootstrap-tagsinput.css') }}" />
<!-- ico font -->
<link rel="stylesheet" type="text/css" href="{{ asset('assets/icon/icofont/css/icofont.css') }}">
<!-- Font Awesome -->
<link rel="stylesheet" type="text/css" href="{{ asset('assets/icon/font-awesome/css/font-awesome.min.css') }}">
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
        <!-- Default table border table start-->
        <div class="card">
            <div class="card-header">
                <h5>{{ $order->order_number }}</h5>
            </div>
            <div class="card-block table-border-style">
            <?php
                    $user = DB::table('users')->where('id', $order->user_id)->first();
                ?>
                <div class="card-body">
                    <p class="card-text"><b>Name :</b> {{ $user->name }}</p>
                    <p class="card-text"><b>Email :</b> {{ $user->email }}</p>
                    <p class="card-text"><b>Address :</b> {{ $user->address }}</p>
                    <p class="card-text"><b>Order Date :</b> {{ $order->created_at }}</p>
                </div>
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Product Name</th>
                                <th>Quantity</th>
                                <th>Size</th>
                                <th>Price</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach($orderItem as $o)
                        <?php
                            $product = DB::table('products')->where('id', $o->product_id)->first();
                        ?>
                        <tr>
                            <td>@if(isset($product) && !empty($product)) {{ $product->product_name }} @endif</td>
                            <td>{{ $o->quantity }}</td>
                            <td>{{ $o->size }}</td>
                            <td><i class="fa fa-inr">&nbsp;</i>{{ $o->price }}</td>
                        </tr>
                        @endforeach
                        </tbody>
                        <tr>
                            <td colspan="3">Total</td>
                            <td><i class="fa fa-inr">&nbsp;</i>{{ $order->grand_total }}</td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
        <!-- Default table border table end-->
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
</script>
@endsection
@endsection

