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
	
	<!-- Scripts -->
	@yield('scripts')
</head>
<body>
	<div id="app">
		@if(session('status'))
			<h2 class="flashMessage text-center">{{ session('status') }}</h2>
		@endif
		@if(session('error'))
			<h2 class="errorMessage text-center">{{ session('error') }}</h2>
		@endif
		<div class="modal fade loadingSpinner">
			<div class="loader"></div>
			<div class="">
				<p class="text-white d-table mx-auto"></p>
			</div>
		</div>
		<nav class="navbar navbar-inverse navbar-fixed-top adminNavColor">
			<div class="container-fluid">
				<div class="navbar-header">
					<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span> 
					</button>
					<a class="navbar-brand" href="index.php">ATSTMPLLC</a>
				</div>
				<div class="collapse navbar-collapse" id="myNavbar">
					<ul class="nav navbar-nav">
						<li class=""><a href="bank.php">Banks</a></li>
						<li class=""><a href="transactions.php?view_transactions">Transactions</a></li>
						<li class=""><a href="users.php?edit_user">Users</a></li>
					</ul>
					<ul class="nav navbar-nav navbar-right">
						<li class=""><a href="logout.php">Logout <span class="glyphicon glyphicon-off"></span></a></li>
					</ul>
				</div>
			</div>
		</nav>

		<div class="container-fluid">
			<div class="row">
				@yield('content')				
			</div>
		</div>
    </div>

</body>
</html>
