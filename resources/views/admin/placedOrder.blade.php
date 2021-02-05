@extends('admin.admin_layout.main')
@section('title', 'Placed Order')
@section('page_title', 'Placed Order')
@section('breadcrumb', 'Placed Order')
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
        <div class="card">
            <div class="card-header">
                <h5>Placed Order List</h5>
            </div>
            <div class="card-block">
                <div class="table-responsive dt-responsive">
                    <table id="dom-jqry" class="table table-striped table-bordered nowrap">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Order Number</th>
                                <th>Username</th>
                                <th>Price</th>
                                <th>Payment Status</th>
                                <th>View Details</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach($order as $key=>$o)
                            <tr>
                                <td>{{ $key++ }}</td>
                                <td>{{ $o->order_number }}</td>
                                <?php
                                    $user = DB::table('users')->where('id', $o->user_id)->first();
                                ?>
                                <td>@if(isset($user) && !empty($user)){{ $user->name }} @endif</td>
                                <td><i class="fa fa-inr">&nbsp;</i>{{ $o->grand_total }}</td>
                                <?php
                                    $payment = DB::table('payments')->where('order_id', $o->order_number)->first();
                                ?>
                                <td>@if(isset($payment) && !empty($payment)) Paid @else Not Paid @endif</td>
                                <td>
                                    <a href="{{ route('admin.orderDetails', $o->id) }}"><button class="btn waves-effect waves-light btn-primary btn-outline-primary"><i class="icofont icofont-eye-alt"></i>View</button></a>
                                </td>
                                
                            </tr>
                        @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <th>#</th>
                                <th>Order Number</th>
                                <th>Username</th>
                                <th>Price</th>
                                <th>Payment Status</th>
                                <th>View Details</th>
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

