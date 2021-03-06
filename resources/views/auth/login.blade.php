<!DOCTYPE html>
<html lang="en">

<head> 
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="csrf-token" content="{{ csrf_token() }}">
	<!-- Primary Meta Tags -->
	<title>R.I.S Admin - Login</title>
    
    <link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=DM+Sans&display=swap" rel="stylesheet">
	
	{{-- <link rel="stylesheet" href="{{ asset('css/app.css') }}"> --}}

	<!-- Scripts -->
	{{-- <script src="{{ asset('js/app.js') }}" defer></script> --}}

	<style>

		body{
			padding: 0px;
			margin: 0px;
			background-color:#443768;
		}
		#container{
			font-family: 'DM Sans', sans-serif;
			border-radius: 15px;
			background-color: #fff;
			color: #ffffff;
			width:320px;
			height: 600px;
			top:50%;
			left:50%;
			transform: translate(-50%, -50%);
			position: absolute;
			box-sizing: content-box;
			padding: 50px;
		}
		.paddlock{	
			border-radius: 25px;
			width:100px;
			height:100px;
			top:-45px;
			left: calc(50% - 45px);
			position: absolute;
		}

		h1{
			padding: 20px 0 20px;
			margin: 0px;
			text-align: center;
			font-size:35px;
			color: #000;
			font-weight: bold;
			margin-bottom: 30px;

		}
		label{
			margin:  0px;
			padding: 0px;
			font-weight: 300;
			color: #9FA2B4;
			font-family: 'DM Sans', sans-serif;

		}
		#container input{
			width:100%;
			margin-bottom: 20px;
			color: #000;
		}
		#container input[type="text"], input[type="password"]{
			border:none;
			border-bottom: 1px solid #000;
			outline:none;
			color: #000000;
			background:transparent;
			height:40px;
			font-size:16px;
			font-family: 'DM Sans', sans-serif;
		}
		#container input[type="submit"]{
			width:100%;
			border:none;
			outline: none;
			height:50px;
			font-size:18px;
			background-color: #DC3545;
			color: #fff;
			border-radius: 5px;
			font-family: 'DM Sans', sans-serif;
			font-weight: bold;
		}
		#container input[type="submit"]:hover{
			opacity: 0.8;
			background-color: #443768;
			color: #fff;	
			font-family: 'DM Sans', sans-serif;
		}
		#container a{
			text-decoration: none;
			color: #999;
			font-size:18px;
			line-height: 35px
		}
		#container a:hover{
			opacity: 0.8;
			color:blue;
		}
			.aligncenter {
			text-align: center;
		}

		/* additional styles */
		.font-medium {
			font-weight: 500;
		}
		.text-red-600 {
			--tw-text-opacity: 1;
			color: rgb(220 38 38 / var(--tw-text-opacity));
		}
		.text-sm {
			font-size: 0.875rem;
			line-height: 1.25rem;
		}
		.list-disc {
			list-style-type: disc;
		}
		.list-inside {
			list-style-position: inside;
		}
		.mt-3 {
			margin-top: 0.75rem;
		}
		ol, ul, menu {
			list-style: none;
			margin: 0;
			padding: 0;
		}
		.mb-4 {
			margin-bottom: .5rem;
		}
	</style>
</head>

<body>
	<div id="container">
		<p class="aligncenter">
			<img src="{{asset('img/logo.png')}}" height="80px" alt="centered image" />
		</p>
		<h1>Admin Login</h1>
		
		<!-- Session Status -->
        <x-auth-session-status class="mb-4" :status="session('status')" />

        <!-- Validation Errors -->
        <x-auth-validation-errors class="mb-4" :errors="$errors" />
		
		<form method="post" action="{{ route('login') }}">
			@csrf
			<label for="login">EMAIL/USERNAME/ADMISSION NO :</label></br><input type="text" name="login" :value="old('login')" required autofocus/></br></br>
			<label for="password">PASSWORD:</label></br><input type="password" name="password"  required autocomplete="current-password"></br></br>
			<input type="submit" name="" value="Log In"></br>

		</form>
	</div>
</body>
</html>