<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Index - @yield('title')</title>

    @include('auth.auth_layout.link')

    @yield('customcss')
    <style>
        .social-icons ul li a{
            color:white
        }
    </style>
</head><!--/head-->

<body>
    @include('auth.auth_layout.header')

    @yield('content')
    
	@include('auth.auth_layout.footer')
	
    @include('auth.auth_layout.script')
  
    
</body>
</html>