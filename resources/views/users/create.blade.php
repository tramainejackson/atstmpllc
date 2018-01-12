@extends('layouts.app')

@section('styles')
	@include('layouts.styles.bootstrap_css')
@endsection

@section('scripts')
	@include('layouts.functions.bootstrap_js')
@endsection

@section('content')
<div class="container-fluid">
	<div class="row">
		<div class="col-12">
			@include('layouts.nav')
		</div>
		<div class="col-8 my-4 mx-auto">
			<div class="userNavLinks d-flex justify-content-around">
				<a href="/users" class="btn col-12 col-sm-3">All Users</a>
			</div>
		</div>
		<div class="col-12 col-sm-8 mx-auto">
			<div class="formDiv">
				{!! Form::open(['action' => ['HomeController@store'], 'files' => true, 'method' => 'POST']) !!}
					<div class="formDivTitle row">
						<h2 class="">Create New User</h2>
					</div>
					<div class="form-row">
						<div class="col-12 col-sm-6">
							<label class="form-label">First Name</label>
							<input type="text" name="firstname" class="form-control" placeholder="Enter First Name" value="{{ old('firstname') }}" required autofocus />
							
							@if($errors->has('firstname'))
								<span class="help-block text-danger">
									<strong>{{ $errors->first('firstname') }}</strong>
								</span>
							@endif
						</div>
						<div class="col-12 col-sm-6">
							<label class="form-label">Last Name</label>
							<input type="text" name="lastname" class="form-control" placeholder="Enter Last Name" value="{{ old('lastname') }}" required />
							
							@if ($errors->has('lastname'))
								<span class="help-block text-danger">
									<strong>{{ $errors->first('lastname') }}</strong>
								</span>
							@endif
						</div>
					</div>
					<div class="form-group">
						<label class="form-label">Email Address</label>
						<input type="email" name="email" class="form-control" placeholder="Enter Email Address" value="{{ old('email') }}" required />

						@if ($errors->has('email'))
							<span class="help-block text-danger">
								<strong>{{ $errors->first('email') }}</strong>
							</span>
						@endif
					</div>
					<div class="form-group">
						<label class="form-label">Username</label>
						<input type="text" name="username" class="form-control" placeholder="Enter Username" value="{{ old('username') }}" required />
						
						@if ($errors->has('username'))
							<span class="help-block text-danger">
								<strong>{{ $errors->first('username') }}</strong>
							</span>
						@endif
					</div>
					<div class="form-group">
						<label class="form-label">Password</label>
						<input type="text" name="password" class="form-control" placeholder="Enter Password" value="{{ old('password') }}" required />

						@if ($errors->has('password'))
							<span class="help-block text-danger">
								<strong>{{ $errors->first('password') }}</strong>
							</span>
						@endif
					</div>
					<div class="form-group">
						<label class="form-label">Is Account Editable</label>
						<select class="custom-select form-control" name="editable">
							<option value="Y" selected>Yes</option>
							<option value="N">No</option>
						</select>
					</div>
					<div class="form-group">
						<label class="form-label">Picture</label>
						{{ Form::file('picture', ['class' => 'form-control', 'id' => 'customFile']) }}
					</div>
					<div class="form-group">
						{{ Form::submit('Create New User', ['class' => 'btn btn-lg btn-primary']) }}
					</div>
				{!! Form::close() !!}
			</div>
		</div>
	</div>
</div>
@endsection