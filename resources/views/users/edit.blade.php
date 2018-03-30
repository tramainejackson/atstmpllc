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
			<div class="userNavLinks d-flex flex-column flex-lg-row justify-content-around">
				<a href="/users" class="btn my-1 col-12 col-lg-6">All Users</a>
				<a href="/users/create" class="btn my-1 col-12 col-lg-6">Add New User</a>
			</div>
		</div>
		<div class="col-12 col-lg-10 mx-auto">
			@if($user->editable == "Y")
				<div class="formDiv">
					{!! Form::open(['action' => ['HomeController@update', $user->id], 'files' => 'true', 'method' => 'PUT']) !!}
						<input hidden type="number" name="id" class="" value="{{ $user->id }}" />
						<div class="">
							<h2 class="">Edit User</h2>
						</div>
						<div class="container-fluid">
							<div class="row">
								<div class="userImgDiv col-12 col-md-3">
									<img src="{{ $user->picture != null ? asset('/storage/images/' . $user->picture) : '/images/emptyface.jpg' }}" class="d-block mx-auto" />
								</div>
								<div class="col-12 col-sm-9">
									<div class="form-group">
										<label class="form-label">Username</label>
										<input type="text" name="username" class="form-control" value="{{ $user->username }}" disabled />
										
										@if($errors->has('username'))
											<span class="help-block text-danger">
												<strong>{{ $errors->first('username') }}</strong>
											</span>
										@endif
									</div>
									<div class="form-group">
										<label class="form-label">Password</label>
										<input type="text" name="password" class="form-control" value="" placeholder="Enter New Password" />
										
										@if($errors->has('password'))
											<span class="help-block text-danger">
												<strong>{{ $errors->first('password') }}</strong>
											</span>
										@endif
									</div>
									<div class="form-group">
										<label class="form-label">Firstname</label>
										<input type="text" name="firstname" class="form-control" value="{{ $user->firstname }}" placeholder="Enter New Firstname" />
										
										@if($errors->has('firstname'))
											<span class="help-block text-danger">
												<strong>{{ $errors->first('firstname') }}</strong>
											</span>
										@endif
									</div>
									<div class="form-group">
										<label class="form-label">Lastname</label>
										<input type="text" name="lastname" class="form-control" value="{{ $user->lastname }}" placeholder="Enter New Lastname" required />
										
										@if($errors->has('lastname'))
											<span class="help-block text-danger">
												<strong>{{ $errors->first('lastname') }}</strong>
											</span>
										@endif
									</div>
									<div class="form-group">
										<label class="form-label">Email</label>
										<input type="email" name="email" class="form-control" value="{{ $user->email }}" placeholder="Enter New Email Address" required />
										
										@if($errors->has('email'))
											<span class="help-block text-danger">
												<strong>{{ $errors->first('email') }}</strong>
											</span>
										@endif
									</div>
									<div class="form-group">
										<label class="form-label">Editable</label>
										<select class="custom-select form-control browser-default" name="editable">
											<option value="Y" selected>Yes</option>
											<option value="N">No</option>
										</select>
									</div>
									<div class="input-group">
										<div class="input-group-prepend">
											<span class="input-group-text">Upload</span>
										</div>
										<div class="custom-file">
											<input type="file" class="btn col-4 custom-file-input" name="picture" id="customFile" />
											<label for="customFile" class="custom-file-label text-left">Change Photo</label>
										</div>
									</div>
									<div class="form-group my-2">
										<input type="submit" class="btn hidden blue-gradient profile_img_submit" name="submit" value="Save New Picture" />
									</div>
									<div class="form-group">
										{{ Form::submit('Update User', ['class' => 'btn btn-outline-success']) }}
									</div>
								</div>
							</div>
						</div>
					{!! Form::close() !!}
					{!! Form::open(['action' => ['HomeController@destroy', 'user' => $user->id], 'files' => 'true', 'method' => 'DELETE']) !!}
						<div class="container-fluid">
							<div class="row">
								<div class="form-group col-12 col-md-9 offset-md-3">
									{{ Form::submit('Delete User', ['class' => 'btn btn-outline-danger']) }}
								</div>
							</div>
						</div>
					{!! Form::close() !!}
				</div>
			@else
				<div class="">
					<h2 class="">This users account is uneditable.</h2>
				</div>
			@endif
		</div>
	</div>
</div>
@endsection