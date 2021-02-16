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
        <p>{{ $user->name }} user is registered successfully.</p>
        <table class="table">
			<tr>
				<th>Name</th>
				<td>{{ $user->name }}</td>
			</tr>
        	<tr>
        		<th>Email</th>
        		<td>{{ $user->email }}</td>
        	</tr>
        	<tr>
        		<th>Mobile No.</th>
        		<td>{{ $user->mobile_no }}</td>
        	</tr>
        	<tr>
        		<th>Address</th>
        		<td>{{ $user->address }}</td>
        	</tr>
        	<tr>
        		<th>City</th>
        		<td>{{ $user->city }}</td>
        	</tr>
        	<tr>
        		<th>Country</th>
        		<td>{{ $user->country }}</td>
        	</tr>
        	<tr>
        		<th>Pincode</th>
        		<td>{{ $user->pincode }}</td>
        	</tr>
        </table>
        <p>Thanking You!!</p>
    </div>
</body>
</html>