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
				<div class="panel panel-default">
					<div class="adminLoginHeader">
						<h2>Register</h2>
					</div>

					<div class="panel-body">
						<form class="form-horizontal text-white" method="POST" action="{{ route('register') }}">
							{{ csrf_field() }}

							<div class="form-group{{ $errors->has('company') ? ' has-error' : '' }}">
								<label for="company" class="col-md-4 control-label">Company/Business Name</label>

								<div class="col-md-6">
									<input id="company" type="text" class="form-control" name="company" value="{{ old('company') }}" required autofocus>

									@if ($errors->has('company'))
										<span class="help-block">
											<strong>{{ $errors->first('company') }}</strong>
										</span>
									@endif
								</div>
							</div>
							
							<div class="form-group{{ $errors->has('firstname') ? ' has-error' : '' }}">
								<label for="firstname" class="col-md-4 control-label">First Name</label>

								<div class="col-md-6">
									<input id="" type="text" class="form-control" name="firstname" value="{{ old('firstname') }}" required autofocus>

									@if ($errors->has('firstname'))
										<span class="help-block">
											<strong>{{ $errors->first('firstname') }}</strong>
										</span>
									@endif
								</div>
							</div>
							
							<div class="form-group{{ $errors->has('lastname') ? ' has-error' : '' }}">
								<label for="lastname" class="col-md-4 control-label">Last Name</label>

								<div class="col-md-6">
									<input id="lastname" type="text" class="form-control" name="lastname" value="{{ old('lastname') }}" required autofocus>

									@if ($errors->has('lastname'))
										<span class="help-block">
											<strong>{{ $errors->first('lastname') }}</strong>
										</span>
									@endif
								</div>
							</div>
							
							<div class="form-group{{ $errors->has('username') ? ' has-error' : '' }}">
								<label for="username" class="col-md-4 control-label">Username</label>

								<div class="col-md-6">
									<input id="username" type="text" class="form-control" name="username" value="{{ old('username') }}" required autofocus>

									@if ($errors->has('username'))
										<span class="help-block">
											<strong>{{ $errors->first('username') }}</strong>
										</span>
									@endif
								</div>
							</div>

							<div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
								<label for="email" class="col-md-4 control-label">E-Mail Address</label>

								<div class="col-md-6">
									<input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required>

									@if ($errors->has('email'))
										<span class="help-block">
											<strong>{{ $errors->first('email') }}</strong>
										</span>
									@endif
								</div>
							</div>

							<div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
								<label for="password" class="col-md-4 control-label">Password</label>

								<div class="col-md-6">
									<input id="password" type="password" class="form-control" name="password" required>

									@if ($errors->has('password'))
										<span class="help-block">
											<strong>{{ $errors->first('password') }}</strong>
										</span>
									@endif
								</div>
							</div>

							<div class="form-group">
								<label for="password-confirm" class="col-md-4 control-label">Confirm Password</label>

								<div class="col-md-6">
									<input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
								</div>
							</div>

							<div class="form-group">
								<div class="col-md-6">
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
