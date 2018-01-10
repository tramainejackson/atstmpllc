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
					<form class="form-horizontal" method="POST"  action="{{ route('password.request') }}">
						{{ csrf_field() }}

						 <input type="hidden" name="token" value="{{ $token }}">

                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label for="email" class="col-md-4 control-label">E-Mail Address</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control" name="email" value="{{ $email or old('email') }}" required autofocus>

                                @if ($errors->has('email'))
                                    <span class="help-block text-warning">
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
                                    <span class="help-block text-warning">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
                            <label for="password-confirm" class="col-md-4 control-label">Confirm Password</label>
                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>

                                @if ($errors->has('password_confirmation'))
                                    <span class="help-block text-warning">
                                        <strong>{{ $errors->first('password_confirmation') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    Reset Password
                                </button>
                            </div>
                        </div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection