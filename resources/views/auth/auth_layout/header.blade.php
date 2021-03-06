<header id="header"><!--header-->
		<div class="header_top"><!--header_top-->
			<div class="container">
				<div class="row">
					<div class="col-sm-6">
						<div class="contactinfo">
							<ul class="nav nav-pills">
								<li><a href=""><i class="fa fa-phone"></i> +2 95 01 88 821</a></li>
								<li><a href=""><i class="fa fa-envelope"></i> info@domain.com</a></li>
							</ul>
						</div>
					</div>
					<div class="col-sm-6">
						<div class="social-icons pull-right">
							<ul class="nav navbar-nav">
								<li><a href=""><i class="fa fa-facebook"></i></a></li>
								<li><a href=""><i class="fa fa-twitter"></i></a></li>
								<li><a href=""><i class="fa fa-linkedin"></i></a></li>
								<li><a href=""><i class="fa fa-dribbble"></i></a></li>
								<li><a href=""><i class="fa fa-google-plus"></i></a></li>
							</ul>
						</div>
					</div>
				</div>
			</div>
		</div><!--/header_top-->
		
		<div class="header-middle"><!--header-middle-->
			<div class="container">
				<div class="row">
					<div class="col-md-4 clearfix">
						<div class="logo pull-left">
							<a href="{{ url('/') }}">
								<img src="{{ asset('images/home/jaibhimebazar Logo.png') }}" alt="" style="width:100px" />
							</a>
						</div>
					</div>
					<div class="col-md-8 clearfix">
						<div class="shop-menu clearfix pull-right">
							<ul class="nav navbar-nav">
								<li><a href=""><i class="fa fa-user"></i> Account</a></li>
								<li><a href=""><i class="fa fa-star"></i> Wishlist</a></li>
								<li><a href=" {{ url('checkout') }}"><i class="fa fa-crosshairs"></i> Checkout</a></li>
								<li><a href="{{ url('cart') }}"><i class="fa fa-shopping-cart"></i><sup>{{ \Cart::getTotalQuantity()}}</sup> &nbsp;Cart</a></li>
								@if (Route::has('login'))
									@auth
									<li><a href="{{ url('/home') }}"><i class="fa fa-user"></i> Home</a></li>
									<li><a href="{{ route('logout') }}" onclick="event.preventDefault();
                        				document.getElementById('logout-form').submit();" > Logout</a></li>
									<form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
									@else
									<li><a href="{{ url('login') }}"><i class="fa fa-lock"></i> Login</a></li>
									@endauth
        						@endif
							</ul>
						</div>
					</div>
				</div>
			</div>
		</div><!--/header-middle-->
	
		<div class="header-bottom"><!--header-bottom-->
			<div class="container">
				<div class="row">
					<div class="col-sm-9">
						<div class="navbar-header">
							<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
								<span class="sr-only">Toggle navigation</span>
								<span class="icon-bar"></span>
								<span class="icon-bar"></span>
								<span class="icon-bar"></span>
							</button>
						</div>
						<div class="mainmenu pull-left">
							<ul class="nav navbar-nav collapse navbar-collapse">
								<li><a href="{{ url('/') }}">Home</a></li>
								<li class="dropdown"><a href="#">Shop<i class="fa fa-angle-down"></i></a>
                                    <ul role="menu" class="sub-menu">
                                        <li><a href="{{ url('shop') }}">Products</a></li>
										<li><a href="{{ url('product_detail') }}" class="active">Product Details</a></li> 
										<li><a href="{{ url('checkout') }}">Checkout</a></li> 
										<li><a href="{{ url('cart') }}">Cart</a></li> 
										<li><a href="{{ url('login') }}">Login</a></li> 
                                    </ul>
                                </li> 
								<?php 
									$category = DB::table('categories')->where('category_name', 'Clothes')->first();
									// dd($category);
									$subCategory1 = DB::table('sub_categories')->where('category_id', $category->id)->where('parent_id', 0)->where('status', 1)->get();
									// dd($subCategory);
								?>
								@foreach($subCategory1 as $sub)
								<li class="dropdown menu-large ">	<a href="# " class="dropdown-toggle " data-toggle="dropdown ">{{ $sub->sub_category }} <i class="fa fa-angle-down"></i></a>
									<?php
										$subCategory2 = DB::table('sub_categories')->where('parent_id', $sub->id)->where('status', 1)->get();
										// dd($subCategory2);
									?>
									<ul class="dropdown-menu megamenu row ">
										@foreach($subCategory2 as $sub2)
										<li class="col-sm-6" style="padding:0px">
											<ul>
												<li><a href="{{ route('subCategory.product', $sub2->id) }}">{{ $sub2->sub_category }}</a>

												</li>
												
											</ul>
										</li>
										@endforeach
									</ul>
								</li>
								@endforeach
								<!-- <li class="dropdown"><a href="#">Blog<i class="fa fa-angle-down"></i></a>
                                    <ul role="menu" class="sub-menu">
                                        <li><a href="{{ url('blog') }}">Blog List</a></li>
                                    </ul>
                                </li>  -->
								<li><a href="{{ url('contact') }}">Contact</a></li>
							</ul>
						</div>
					</div>
					<div class="col-sm-3">
						<div class="search_box pull-right">
							<input type="text" placeholder="Search" id="search"/>
						</div>
					</div>
				</div>
			</div>
		</div><!--/header-bottom-->
	</header><!--/header-->