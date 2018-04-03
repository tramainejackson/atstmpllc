@extends('layouts.app')

@section('styles')
	@include('layouts.styles.bootstrap_css')
@endsection

@section('scripts')
	@include('layouts.functions.bootstrap_js')
	<script>
		$('.flashMessage, footer').css({display: 'none'});
	</script>
@endsection

@section('content')
<div class="view" id="admin_page_login">
	<!-- Mask & flexbox options-->
    <div class="mask d-flex justify-content-center align-items-center">
		<div class="container">
			<div class="row">
				<div class="col-12">
					<div class="adminLoginHeader row">
						<h2 class="text-white col-6 wow fadeInDown" data-wow-delay="0.5s">Reset Password</h2>
						
						<div class="col-6 text-right">
							<a href="/login" class="btn btn-lg btn-dark wow fadeInDown" data-wow-delay="0.5s">Login</a>
							<a href="/register"  class="btn btn-lg btn-dark wow fadeInRight" data-wow-delay="0.7s">Register</a>
						</div>
					</div>
				</div>
				<div class="col-12 wow fadeInRight" data-wow-delay="0.5s">
					<div class="panel-body p-4 rounded text-light">
						<div class="panel panel-default">
							@if (session('status'))
								<div class="alert alert-success">
									{{ session('status') }}
								</div>
							@endif

							<form class="form-horizontal" method="POST" action="{{ route('password.email') }}">
								{{ csrf_field() }}

								<div class="md-form{{ $errors->has('email') ? ' has-error' : '' }}">
									<label for="email" class="col-md-4 active white-text">E-Mail Address</label>

									<div class="col-md-6">
										<input id="email" type="email" class="form-control white-text" name="email" value="{{ old('email') }}" required />

										@if ($errors->has('email'))
											<span class="help-block text-warning">
												<strong>{{ $errors->first('email') }}</strong>
											</span>
										@endif
									</div>
								</div>

								<div class="md-form">
									<div class="">
										<button type="submit" class="btn rgba-blue-strong ml-0">Send Password Reset Link</button>
									</div>
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
