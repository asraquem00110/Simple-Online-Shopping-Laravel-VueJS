<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Online Shopping">
    <meta name="author" content="asraquem">
    <meta name="keyword" content="Dashboard,Shopping,Management">
	 <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    
	<link rel="stylesheet" type="text/css" href="{{ asset('ashop/css/main.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset('ashop/css/products.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('ashop/css/cart.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset('ashop/css/fontawesome/css/all.css') }}">

	<script defer src="{{ asset('ashop/css/fontawesome/js/all.js') }}"></script>
    <script src="https://www.paypalobjects.com/api/checkout.js"></script>
    

	 <script src="{{ asset('js/app.js') }}" defer></script>

</head>
<body>

<div id="app">
    
        <router-view name="IndexComponent"></router-view>
        <router-view></router-view>
</div>

</body>
</html>