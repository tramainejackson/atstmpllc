@extends('layouts.app')

@section('styles')
	@include('layouts.styles.bootstrap_css')
@endsection

@section('scripts')
	@include('layouts.functions.bootstrap_js')
@endsection

@section('content')
<div class="view" id="admin_page_login">
	<!-- Mask & flexbox options-->
    <div class="mask d-flex justify-content-center align-items-center">
		<div class="container">
			<div class="row">
				<div class="col-12">
					<div class="adminLoginHeader row">
						<h2 class="white-text col-6 wow fadeInDown" data-wow-delay="0.5s" style="visibility:none;">Login</h2>
						
						<div class="col-6 text-right">
							<a href="/register" class="btn btn-lg btn-dark wow fadeInDown" data-wow-delay="0.5s" style="visibility:none;">Register</a>
						</div>
					</div>
				</div>
				<div class="col-12 wow fadeInRight" data-wow-delay="0.5s" style="visibility:none;">
					<div class="panel-body p-4 rounded text-light">
						<form class="form-horizontal" method="POST" action="{{ route('login') }}">
							{{ csrf_field() }}

							<div class="md-form{{ $errors->has('username') ? ' has-error' : '' }}">
								<div class="col-md-8">
									<i class="fa fa-user prefix white-text"></i>
									
									<input id="username" type="text" class="form-control white-text" name="username" value="{{ old('username') }}" placeholder="Enter Username" required autofocus>
									
									<label for="username" class="col-md-4 white-text">Username</label>

									@if ($errors->has('username'))
										<span class="help-block animated flash">
											<strong>**{{ $errors->first('username') }}**</strong>
										</span>
									@endif
								</div>
							</div>

							<div class="md-form{{ $errors->has('password') ? ' has-error' : '' }}">
								<div class="col-md-8">
									<i class="fa fa-lock prefix white-text"></i>
									
									<input id="password" type="password" class="form-control white-text" name="password"  placeholder="Enter Password" required>
									
									<label for="password" class="col-md-4 white-text">Password</label>

									@if ($errors->has('password'))
										<span class="help-block">
											<strong>{{ $errors->first('password') }}</strong>
										</span>
									@endif
								</div>
							</div>

							<!-- Remember me link not workging -->
							<!-- <div class="form-group">
								<div class="col-md-8 col-md-offset-4">
									<div class="checkbox">
										<label>
											<input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> Remember Me
										</label>
									</div>
								</div>
							</div> -->

							<div class="form-group">
								<div class="col-md-8 col-md-offset-4">
									<button type="submit" class="btn rgba-blue-strong">
										Login
									</button>

									<a class="btn rgba-blue-strong" href="{{ route('password.request') }}">
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
</div>
@endsection