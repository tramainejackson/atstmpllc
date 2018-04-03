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
						<h2 class="white-text col-6 wow fadeInDown" data-wow-delay="0.5s">Reset Password</h2>
						
						<div class="col-6 text-right">
							<a href="/login"  class="btn btn-lg btn-dark wow fadeInDown" data-wow-delay="0.5s">Login</a>
							<a href="/register"  class="btn btn-lg btn-dark wow fadeInRight" data-wow-delay="0.7s">Register</a>
						</div>
					</div>
				</div>
				<div class="col-12 wow fadeInRight" data-wow-delay="0.5s">
					<div class="panel-body p-4 rounded text-light">
						<form class="form-horizontal" method="POST"  action="{{ route('password.request') }}">
							{{ csrf_field() }}

							<input type="hidden" name="token" value="{{ $token }}">

							<div class="md-form{{ $errors->has('email') ? ' has-error' : '' }}">

								<i class="fa fa-envelope prefix grey-text"></i>
									
								<input id="email" type="email" class="form-control white-text" name="email" value="{{ $email or old('email') }}" required autofocus>

								@if ($errors->has('email'))
									<span class="help-block text-warning">
										<strong>{{ $errors->first('email') }}</strong>
									</span>
								@endif

								<label for="email" class="col-md-4 white-text">E-Mail Address</label>
							</div>

							<div class="md-form{{ $errors->has('password') ? ' has-error' : '' }}">
								
								<i class="fa fa-lock prefix grey-text"></i>

								<input id="password" type="password" class="form-control white-text" name="password" required>

								@if ($errors->has('password'))
									<span class="help-block text-warning">
										<strong>{{ $errors->first('password') }}</strong>
									</span>
								@endif

								<label for="password" class="col-md-4 white-text">Password</label>
							</div>

							<div class="md-form{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
								
								<i class="fa fa-exclamation-triangle prefix grey-text"></i>

								<input id="password-confirm" type="password" class="form-control white-text" name="password_confirmation" required>

								@if ($errors->has('password_confirmation'))
									<span class="help-block text-warning">
										<strong>{{ $errors->first('password_confirmation') }}</strong>
									</span>
								@endif

								<label for="password-confirm" class="col-md-4 white-text">Confirm Password</label>
							</div>
	
							<div class="md-form">
								<div class="col-md-6 col-md-offset-4">
									<button type="submit" class="btn rgba-blue-strong ml-0">Reset Password</button>
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