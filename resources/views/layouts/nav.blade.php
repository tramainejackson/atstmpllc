<nav class="navbar navbar-expand-lg navbar-fixed-top adminNavColor">
	<div class="container-fluid">
		<div class="navbar-header">
			<button type="button" class="navbar-toggle d-inline-block d-lg-none rounded" data-toggle="collapse" data-target="#myNavbar">
				<span class="oi oi-menu"></span>
			</button>
			<a class="navbar-brand" href="/home">{{ Auth::user()->company->company_name }}</a>
		</div>
		<div class="collapse navbar-collapse" id="myNavbar">
			<ul class="navbar-nav mr-auto">
				<li class="navLinks"><a href="/bank">Banks</a></li>
				<li class="navLinks"><a href="/transactions">Transactions</a></li>
				<li class="navLinks"><a href="/users">Users</a></li>
			</ul>
			<ul class="navbar-nav">
				<li class="navLinks">
					<a href="{{ route('logout') }}" class="navi_option" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><span>Logout</span></a>
			
					<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
						{{ csrf_field() }}
					</form>
				</li>
				<li class="">
					<a href="{{ route('logout') }}" class="navi_option" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><span class="oi oi-account-logout"></span></a>
				</li>
			</ul>
		</div>
	</div>
</nav>