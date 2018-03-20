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
						<h2 class="text-white col-6 wow fadeInDown" data-wow-delay="0.5s" style="visibility:none;">Register</h2>
						<div class="col-6 text-right">
							<a href="/login" class="btn btn-lg btn-dark wow fadeInDown" data-wow-delay="0.5s" style="visibility:none;">Login</a>
						</div>
					</div>
				</div>
				<div class="col-12 wow fadeInRight" data-wow-delay="0.5s" style="visibility:none;">
					<div class="panel-body p-4 rounded text-light">
						<form class="form-horizontal" method="POST" action="{{ route('register') }}">
							{{ csrf_field() }}

							<div class="form-group{{ $errors->has('company') ? ' has-error' : '' }}">
								<label for="company" class="control-label">Company/Business Name</label>

								<div class="">
									<input id="company" type="text" class="form-control" name="company" value="{{ old('company') }}" required autofocus>

									@if ($errors->has('company'))
										<span class="help-block">
											<strong>{{ $errors->first('company') }}</strong>
										</span>
									@endif
								</div>
							</div>
							
							<div class="form-row mb-3">
								<div class="col{{ $errors->has('firstname') ? ' has-error' : '' }}">
									<label for="firstname" class="control-label">First Name</label>

									<div class="">
										<input id="" type="text" class="form-control" name="firstname" value="{{ old('firstname') }}" required autofocus>

										@if ($errors->has('firstname'))
											<span class="help-block text-warning">
												<strong>{{ $errors->first('firstname') }}</strong>
											</span>
										@endif
									</div>
								</div>
								
								<div class="col{{ $errors->has('lastname') ? ' has-error' : '' }}">
									<label for="lastname" class="control-label">Last Name</label>

									<div class="">
										<input id="lastname" type="text" class="form-control" name="lastname" value="{{ old('lastname') }}" required autofocus>

										@if ($errors->has('lastname'))
											<span class="help-block text-warning">
												<strong>{{ $errors->first('lastname') }}</strong>
											</span>
										@endif
									</div>
								</div>
							</div>
							
							<div class="form-group{{ $errors->has('username') ? ' has-error' : '' }}">
								<label for="username" class="control-label">Username</label>

								<div class="">
									<input id="username" type="text" class="form-control" name="username" value="{{ old('username') }}" required autofocus>

									@if ($errors->has('username'))
										<span class="help-block text-warning">
											<strong>{{ $errors->first('username') }}</strong>
										</span>
									@endif
								</div>
							</div>

							<div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
								<label for="email" class="control-label">E-Mail Address</label>

								<div class="">
									<input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required>

									@if ($errors->has('email'))
										<span class="help-block text-warning">
											<strong>{{ $errors->first('email') }}</strong>
										</span>
									@endif
								</div>
							</div>

							<div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
								<label for="password" class="control-label">Password</label>

								<div class="">
									<input id="password" type="password" class="form-control" name="password" required>

									@if ($errors->has('password'))
										<span class="help-block text-warning">
											<strong>{{ $errors->first('password') }}</strong>
										</span>
									@endif
								</div>
							</div>

							<div class="form-group">
								<label for="password-confirm" class="control-label">Confirm Password</label>

								<div class="">
									<input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
								</div>
							</div>

							<div class="form-group">
								<div class="">
									<button type="submit" class="btn btn-primary">
										Register
									</button>
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
