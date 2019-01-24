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
				<li class="nav-item">
					<a href="/bank" class="nav-link">Banks</a>
				</li>
				<li class="nav-item">
					<a href="/transactions" class="nav-link">Transactions</a>
				</li>
				<li class="nav-item">
					<a href="/documents" class="nav-link">Documents</a>
				</li>
				<li class="nav-item">
					<a href="/users" class="nav-link">Users</a>
				</li>

				@if(Auth::user()->username == 'tramjack')
					<li class="nav-item">
						<a href="/websites" class="nav-link">Websites</a>
					</li>
				@endif
			</ul>
			<ul class="navbar-nav flex-row align-items-stretch justify-content-center d-inline-flex">
				<li class="nav-item logOutLink">
					<a href="{{ route('logout') }}" class="nav-link navi_option" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><span>Logout</span></a>
			
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