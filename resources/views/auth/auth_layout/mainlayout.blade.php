<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Index - @yield('title')</title>

    @include('auth.auth_layout.link')

    <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
    @yield('customcss')
    <style>
        .social-icons ul li a{
            color:white
        }
        
        .menu-large {
            position: static !important;
        }
        .ui-slider .ui-slider-handle
        {
            border-radius: 50%;
        }
        .ui-state-default, .ui-widget-content .ui-state-default, .ui-widget-header .ui-state-default, .ui-button, html .ui-button.ui-state-disabled:hover, html .ui-button.ui-state-disabled:active
        {

            background-color: #484a8d;
            border-radius:50%
        }
    </style>
    
<script>
	// Dropdown Menu Fade    
jQuery(document).ready(function () {
    $(".dropdown").hover(

    function () {
        $('.dropdown-menu', this).stop().fadeIn("fast");
    },

    function () {
        $('.dropdown-menu', this).stop().fadeOut("fast");
    });
});
</script>
</head><!--/head-->

<body>
    @include('auth.auth_layout.header')

    @yield('content')
    
	@include('auth.auth_layout.footer')
	
    @include('auth.auth_layout.script')
  @yield('customjs')
    
</body>
</html>