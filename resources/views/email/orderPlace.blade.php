<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
</head>
<body>
    <div>
        <p>Dear Admin,</p>
        <?php 
            $user = DB::table('users')->where('id', $user_id)->first();
            $orderItem = DB::table('order_items')->where('order_id', $id)->get();
        ?>
        <p>Order is placed successfully. Order Details are -</p>
        <p><b>Order Number :</b> {{ $order_number }}</p>
        <p><b>Total :</b> {{ $grand_total }}</p>
        <p><b>Name :</b> {{ $name }}</p>
        <p><b>Address :</b> {{ $address }}</p>
        <br>
        <p>Product Details :-</p>
        <table class="table">
			<tr>
				<th>Product Name</th>
				<th>Quantity </th>
				<th>Price</th>
				<th>Size</th>
			</tr>
			@foreach($orderItem as $o)
			<?php 
			    $products = DB::table('products')->where('id', $o->product_id)->first();
			    $explodeImg = explode(",", $products->product_img);
			?>
        	<tr>
                <td>@if(isset($products) && !empty($products)) {{ $products->product_name }} @endif</td>
                <td>{{ $o->quantity }}</td>
                <td>{{ $o->size }}</td>
                <td><i class="fa fa-inr">&nbsp;</i>{{ $o->price }}</td>
        	</tr>
        	@endforeach
        </table>
        <p>Thanking You!!</p>
    </div>
</body>
</html>