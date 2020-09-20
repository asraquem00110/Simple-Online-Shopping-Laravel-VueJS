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

	<link rel="stylesheet" type="text/css" href="{{ asset('ashop/css/fontawesome/css/all.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset('ashop/css/main.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset('ashop/css/admin/main.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset('ashop/css/admin/dashboard.css') }}">

	<script defer src="{{ asset('ashop/css/fontawesome/js/all.js') }}"></script>

	<script src="{{ asset('js/admin.js') }}" defer></script>

</head>
<body>

<style type="text/css">
		#logindiv {
			position: absolute;
			top: 50%;
			left: 50%;
			transform: translate(-50%,-50%);
			height: 60%;
			width: 60%;
			background: black;
			border-radius: 20px;
		}

		#systemname {
		
			background: #3071A9;
			border-top-left-radius: 20px;
			border-bottom-left-radius: 20px;
		}

		#logindetails{
			
			background: #F1F1F1;
			border-top-right-radius: 20px;
			border-bottom-right-radius: 20px;
		}

		.grid-container{
			grid-gap: 0;
		}


</style>

<div id="logindiv" class="grid-container">

	<div id="systemname" class="grid-col-6">


	</div>


	<div id="logindetails" class="grid-col-6">
		<div id="app">
			<router-view name="LoginComponent"></router-view>
			<router-view></router-view>
		</div>

	</div>

</div>







</body>
</html>