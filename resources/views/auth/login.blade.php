@extends('layouts.app')

@section('styles')
	@include('layouts.styles.bootstrap_css')
@endsection

@section('scripts')
	@include('layouts.functions.bootstrap_js')
@endsection

@section('content')
<div class="" id="admin_page_login">
	<div class="container">
		<div class="row">
			<div class="col-12">
				<div class="adminLoginHeader row">
					<h2 class="text-white col-6">Login</h2>
					
					<div class="col-6 text-right">
						<a href="/register" class="btn btn-lg btn-dark">Register</a>
					</div>
				</div>
			</div>
			<div class="col-12">
				<div class="panel-body p-4 rounded text-light">
					<form class="form-horizontal" method="POST" action="{{ route('login') }}">
						{{ csrf_field() }}

						<div class="form-group{{ $errors->has('username') ? ' has-error' : '' }}">
							<label for="username" class="col-md-4 control-label">Username</label>

							<div class="col-md-8">
								<div class="input-group">
									<span class="oi oi-person input-group-addon bg-white"></span>
									<input id="username" type="text" class="form-control border-left-0" name="username" value="{{ old('username') }}" required autofocus>
								</div>

								@if ($errors->has('username'))
									<span class="help-block">
										<strong>{{ $errors->first('username') }}</strong>
									</span>
								@endif
							</div>
						</div>

						<div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
							<label for="password" class="col-md-4 control-label">Password</label>

							<div class="col-md-8">
								<div class="input-group">
									<span class="oi oi-lock-locked input-group-addon bg-white"></span>
									<input id="password" type="password" class="form-control border-left-0" name="password" required>
								</div>

								@if ($errors->has('password'))
									<span class="help-block">
										<strong>{{ $errors->first('password') }}</strong>
									</span>
								@endif
							</div>
						</div>

						<div class="form-group">
							<div class="col-md-8 col-md-offset-4">
								<div class="checkbox">
									<label>
										<input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> Remember Me
									</label>
								</div>
							</div>
						</div>

						<div class="form-group">
							<div class="col-md-8 col-md-offset-4">
								<button type="submit" class="btn btn-primary">
									Login
								</button>

								<a class="btn btn-link" href="{{ route('password.request') }}">
									Forgot Your Password?
								</a>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection