<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

	<!-- Favicon -->
	<link rel="shortcut icon" href="/favicon_atstmpllc.ico" type="image/x-icon">
	<link rel="icon" href="/favicon_atstmpllc.ico" type="image/x-icon">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name') }}</title>

    <!-- Styles -->
	<link href="https://fonts.googleapis.com/css?family=Felipa" rel="stylesheet">
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">

	<!-- Bootstrap core CSS -->
	<link href="/css/bootstrap.min.css" rel="stylesheet">

	<!-- Material Design Bootstrap -->
	<link href="/css/mdb.min.css" rel="stylesheet">

	<!-- Custom CSS -->
	<link href="/css/atstmpllc.css" rel="stylesheet">
	
	@if(substr_count(request()->server('HTTP_USER_AGENT'), 'rv:') > 0)
		<link href="/css/myIEcss.css" rel="stylesheet">
	@endif
	
	@yield('addt_styles')
</head>
<body>
	<div id="app">
		@if(session('status'))
			<div id="return_messages" class="wow rotateInDownLeft" data-wow-delay="0.7s">
				<ul class="flashMessage text-center">{!! session('status') !!}</ul>
			</div>
		@endif
		<div class="modal fade loadingSpinner">
			<div class="loader"></div>
			<div class="">
				<p class="text-white d-table mx-auto"></p>
			</div>
		</div>

		@yield('content')
		
		@include('footer')
    </div>
	
	<!-- SCRIPTS -->
	<!-- JQuery -->
	<script type="text/javascript" src="/js/jquery-3.3.1.min.js"></script>
	<!-- Bootstrap tooltips -->
	<script type="text/javascript" src="/js/popper.min.js"></script>
	<!-- Bootstrap core JavaScript -->
	<script type="text/javascript" src="/js/bootstrap.min.js"></script>
	<!-- MDB core JavaScript -->
	<script type="text/javascript" src="/js/mdb.min.js"></script>

	<!-- Custom JS -->
	<script src="/js/atstmpllc.js"></script>
	
	@yield('addt_scripts')
</body>
</html>
