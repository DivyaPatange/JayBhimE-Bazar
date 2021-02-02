@extends('auth.auth_layout.mainlayout')
@section('title', 'Index')
@section('customcss')

@endsection
@section('content')
<section id="form"><!--form-->
		<div class="container">
			<div class="row">
				<div class="col-sm-4 col-sm-offset-1">
					<div class="login-form"><!--login form-->
						<h2>Login to your account</h2>
						<form action="{{ route('login') }}" method="POST">
						@csrf
							<input type="email" placeholder="Email Address" name="email" value="{{ old('email') }}"/>
							@error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong class="text-danger">{{ $message }}</strong>
                                </span>
                            @enderror
							<input type="password" placeholder="Enter Password" name="password">
							@error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong class="text-danger">{{ $message }}</strong>
                                </span>
                            @enderror
							<button type="submit" class="btn btn-default">Login</button>
						</form>
					</div><!--/login form-->
				</div>
				<div class="col-sm-1">
					<h2 class="or">OR</h2>
				</div>
				<div class="col-sm-4">
					<div class="signup-form"><!--sign up form-->
						<h2>New User Signup!</h2>
						<form action="{{ route('register') }}" method="POST">
						@csrf
							<input type="text" placeholder="Name" name="name" value="{{ old('name') }}"/>
							@error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong class="text-danger">{{ $message }}</strong>
                                </span>
                            @enderror
							<input type="email" placeholder="Email Address" name="email" value="{{ old('email') }}"/>
							@error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong class="text-danger">{{ $message }}</strong>
                                </span>
                            @enderror
							<input type="number" placeholder="Enter Mobile No." name="mobile_no" value="{{ old('mobile_no') }}">
							@error('mobile_no')
                                <span class="invalid-feedback" role="alert">
                                    <strong class="text-danger">{{ $message }}</strong>
                                </span>
                            @enderror
							<textarea name="address" id="" placeholder="Enter Address" style="margin-bottom:10px">{{ old('address') }}</textarea>
							@error('address')
                                <span class="invalid-feedback" role="alert">
                                    <strong class="text-danger">{{ $message }}</strong>
                                </span>
                            @enderror
							<input type="text" placeholder="Enter City" name="city" value="{{ old('city') }}">
							@error('city')
                                <span class="invalid-feedback" role="alert">
                                    <strong class="text-danger">{{ $message }}</strong>
                                </span>
                            @enderror
							<input type="text" placeholder="Enter Country" name="country" value="{{ old('country') }}">
							@error('country')
                                <span class="invalid-feedback" role="alert">
                                    <strong class="text-danger">{{ $message }}</strong>
                                </span>
                            @enderror
							<input type="number" placeholder="Enter Pincode" name="pincode" value="{{ old('pincode') }}">
							@error('pincode')
                                <span class="invalid-feedback" role="alert">
                                    <strong class="text-danger">{{ $message }}</strong>
                                </span>
                            @enderror
							<input type="password" placeholder="Password" name="password" value="{{ old('password') }}"/>
							@error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong class="text-danger">{{ $message }}</strong>
                                </span>
                            @enderror
							<input type="password" placeholder="Confirm Password" name="password_confirmation">
							<button type="submit" class="btn btn-default">Signup</button>
						</form>
					</div><!--/sign up form-->
				</div>
			</div>
		</div>
	</section><!--/form-->
@endsection
@section('customjs')

@endsection