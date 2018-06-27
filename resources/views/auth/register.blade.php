@extends('layouts.app')

@section('styles')
	@include('layouts.styles.bootstrap_css')
	<style>
		* {
			color: whitesmoke !important;
		}
	</style>
@endsection

@section('scripts')
	@include('layouts.functions.bootstrap_js')
	<script>
		$('footer').removeClass('mt-4');
	</script>
@endsection

@section('content')
<div class="" id="admin_page_login">
	<!-- Mask & flexbox options-->
    <div class="pt-5">
		<div class="container">
			<div class="row">
				<div class="col-12">
					<div class="adminLoginHeader row">
						<h2 class="text-white col-6 wow fadeInDown" data-wow-delay="0.5s">Register</h2>
						
						<div class="col-6 text-right">
							<a href="/login" class="btn btn-lg btn-dark wow fadeInDown" data-wow-delay="0.5s">Login</a>
						</div>
					</div>
				</div>
				<div class="col-12 wow fadeInRight" data-wow-delay="0.5s">
					<div class="panel-body p-4 mb-5 rounded text-light">
						<form class="form-horizontal registerForm" method="POST" action="{{ route('register') }}">
							{{ csrf_field() }}

							<div class="md-form{{ $errors->has('company') ? ' has-error' : '' }}">
								<label for="company" class="">Company/Business Name</label>

								<input id="company" type="text" class="form-control" name="company" value="{{ old('company') }}" required autofocus>

								@if ($errors->has('company'))
									<span class="help-block">
										<strong>{{ $errors->first('company') }}</strong>
									</span>
								@endif
							</div>
							
							<div class="form-row mb-3">
								<div class="col{{ $errors->has('firstname') ? ' has-error' : '' }}">
									<div class="md-form">
										<input id="" type="text" class="form-control" name="firstname" value="{{ old('firstname') }}" required>

										@if ($errors->has('firstname'))
											<span class="help-block text-warning">
												<strong>{{ $errors->first('firstname') }}</strong>
											</span>
										@endif
										<label for="firstname" class="">First Name</label>
									</div>
								</div>
								
								<div class="col{{ $errors->has('lastname') ? ' has-error' : '' }}">
									<div class="md-form">
										<input id="lastname" type="text" class="form-control" name="lastname" value="{{ old('lastname') }}" required>

										@if ($errors->has('lastname'))
											<span class="help-block text-warning">
												<strong>{{ $errors->first('lastname') }}</strong>
											</span>
										@endif
										<label for="lastname" class="">Last Name</label>
									</div>
								</div>
							</div>
							
							<div class="md-form{{ $errors->has('username') ? ' has-error' : '' }}">
								<input id="username" type="text" class="form-control" name="username" value="{{ old('username') }}" required>

								@if ($errors->has('username'))
									<span class="help-block text-warning">
										<strong>{{ $errors->first('username') }}</strong>
									</span>
								@endif
								
								<label for="username" class="">Username</label>
							</div>

							<div class="md-form{{ $errors->has('email') ? ' has-error' : '' }}">
								<input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required>

								@if ($errors->has('email'))
									<span class="help-block text-warning">
										<strong>{{ $errors->first('email') }}</strong>
									</span>
								@endif
								
								<label for="email" class="">E-Mail Address</label>
							</div>

							<div class="md-form{{ $errors->has('password') ? ' has-error' : '' }}">
								<input id="password" type="password" class="form-control" name="password" required>

								@if ($errors->has('password'))
									<span class="help-block text-warning">
										<strong>{{ $errors->first('password') }}</strong>
									</span>
								@endif

								<label for="password" class="">Password</label>
							</div>

							<div class="md-form">
								<input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
								
								<label for="password-confirm" class="">Confirm Password</label>
							</div>

							<div class="md-form">
								<div class="">
									<button type="submit" class="btn rgba-blue-strong ml-0">Register</button>
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
