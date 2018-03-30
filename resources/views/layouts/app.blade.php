<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name') }}</title>

    <!-- Styles -->
	<link href="https://fonts.googleapis.com/css?family=Felipa" rel="stylesheet">
    @yield('styles')
	
	@if(substr_count(request()->server('HTTP_USER_AGENT'), 'rv:') > 0)
		<link href="/css/myIEcss.css" rel="stylesheet">
	@endif
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
	
	<!-- Scripts -->
	@yield('scripts')
</body>
</html>
