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
					<h2 class="col-6 text-light">Reset Password</h2>
					
					<div class="col-6 text-right">
						<a href="/login" class="btn btn-lg btn-dark">Login</a>
						<a href="/register" class="btn btn-lg btn-dark">Register</a>
					</div>
				</div>
			</div>
			<div class="col-12">
				<div class="panel-body p-4 rounded text-light">
					<div class="panel panel-default">
						@if (session('status'))
							<div class="alert alert-success">
								{{ session('status') }}
							</div>
						@endif

						<form class="form-horizontal" method="POST" action="{{ route('password.email') }}">
							{{ csrf_field() }}

							<div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
								<label for="email" class="col-md-4 control-label">E-Mail Address</label>

								<div class="col-md-6">
									<input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required>

									@if ($errors->has('email'))
										<span class="help-block text-warning">
											<strong>{{ $errors->first('email') }}</strong>
										</span>
									@endif
								</div>
							</div>

							<div class="form-group">
								<div class="col-md-6 col-md-offset-4">
									<button type="submit" class="btn btn-primary">
										Send Password Reset Link
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
