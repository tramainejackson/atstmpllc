<nav class="navbar navbar-expand-lg navbar-fixed-top adminNavColor">
	<div class="container-fluid">
		<div class="navbar-header d-flex align-items-center">
			<button type="button" class="btn navbar-toggle d-inline-block d-lg-none unique-color-dark" data-toggle="collapse" data-target="#myNavbar">
				<i class="fa fa-bars" aria-hidden="true"></i>
			</button>
			<a class="navbar-brand" href="/home">{{ Auth::user()->company->company_name }}</a>
		</div>
		<div class="collapse navbar-collapse" id="myNavbar">
			<ul class="navbar-nav mr-auto">
				<li class="navLinks"><a href="/bank">Banks</a></li>
				<li class="navLinks"><a href="/transactions">Transactions</a></li>
				<li class="navLinks"><a href="/documents">Documents</a></li>
				<li class="navLinks"><a href="/users">Users</a></li>
			</ul>
			<ul class="navbar-nav flex-row align-items-stretch justify-content-center d-inline-flex pl-2">
				<li class="navLinks logOutLink p-1">
					<a href="{{ route('logout') }}" class="navi_option" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><span>Logout</span></a>
			
					<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
						{{ csrf_field() }}
					</form>
				</li>
				<li class="logOutLink p-1">
					<a href="{{ route('logout') }}" class="navi_option" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><i class="fa fa-sign-out" aria-hidden="true"></i></a>
				</li>
			</ul>
		</div>
	</div>
</nav>