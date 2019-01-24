@extends('layouts.app')

@section('addt_scripts')
	<script type="text/javascript">
        // Data Picker Initialization
        $('.datepicker').pickadate();
	</script>
@endsection

@section('content')

	<div class="container-fluid">

		<div class="row">
			<div class="col-12">
				@include('layouts.nav')
			</div>

			<div class="col-8 my-4 mx-auto">
				<div class="userNavLinks d-flex justify-content-around">
					<a href="/websites" class="btn col-12">All Websites</a>
				</div>
			</div>

			<div class="col-12 col-lg-8 mx-auto">
				<div class="formDiv">

					{!! Form::open(['action' => ['WebsiteController@store'], 'files' => true, 'method' => 'POST']) !!}

						<div class="formDivTitle row">
							<h2 class="">Create New Website</h2>
						</div>

						<div class="form-group">
							<label class="form-label">Website Name</label>
							<input type="text" name="name" class="form-control" placeholder="Enter Website Name" value="{{ old('name') }}" required autofocus />

							@if($errors->has('name'))
								<span class="help-block text-danger">
									<strong>{{ $errors->first('name') }}</strong>
								</span>
							@endif
						</div>

						<div class="form-group">
							<label class="form-label">Website Link</label>
							<input type="text" name="link" class="form-control" placeholder="Enter Website Link" value="{{ old('link') }}" required />

							@if ($errors->has('link'))
								<span class="help-block text-danger">
									<strong>{{ $errors->first('link') }}</strong>
								</span>
							@endif
						</div>

						<div class="form-group">
							<label class="form-label">Website Owner Name</label>
							<input type="text" name="owner" class="form-control" placeholder="Enter Owner Name" value="{{ old('owner') }}" required />

							@if ($errors->has('owner'))
								<span class="help-block text-danger">
									<strong>{{ $errors->first('owner') }}</strong>
								</span>
							@endif
						</div>

						<div class="form-group">
							<label class="form-label">Website Owner Email</label>
							<input type="email" name="owner_email" class="form-control" placeholder="Enter Owner Email" value="{{ old('owner_email') }}" required />

							@if ($errors->has('owner_email'))
								<span class="help-block text-danger">
									<strong>{{ $errors->first('owner_email') }}</strong>
								</span>
							@endif
						</div>

						<div class="form-group">
							<label class="form-label">Renew Date</label>
							<input type="date" name="renew_date" class="form-control" placeholder="Select Renew Date" value="{{ old('renew_date') }}" required />

							@if ($errors->has('renew_date'))
								<span class="help-block text-danger">
									<strong>{{ $errors->first('renew_date') }}</strong>
								</span>
							@endif
						</div>

						<div class="">
							<label class="form-label">Logo</label>
						</div>

						<div class="form-group">
							<div class="input-group">
								<div class="input-group-prepend">
									<span class="input-group-text">Upload</span>
								</div>
								<div class="custom-file">
									<input type="file" class="btn col-4 custom-file-input" name="picture" id="customFile" />
									<label for="customFile" class="custom-file-label text-left">Change Photo</label>
								</div>
							</div>
						</div>

						<div class="form-group">
							<button type="submit" class="btn btn-primary ml-0">Create New Site</button>
						</div>
					{!! Form::close() !!}

				</div>

			</div>

		</div>

	</div>

@endsection