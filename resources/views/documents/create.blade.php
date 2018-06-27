@extends('layouts.app')

@section('content')
	<div class="container-fluid">
		<div class="row">
			<div class="col-12">
				@include('layouts.nav')
			</div>
			<div class="col-8 my-4 mx-auto">
				<div class="userNavLinks d-flex justify-content-around">
					<a href="/documents" class="btn col-12">All Docuemnts</a>
				</div>
			</div>
			<div class="col-12 col-md-10 mx-auto">
				<div class="formDiv">
					<div class="formDivTitle row">
						<h2 class="">Add New Document</h2>
					</div>
					{!! Form::open(['action' => ['DocumentController@store'], 'method' => 'POST', 'files' => true, ]) !!}
						<div class="formDiv">
							<div class="md-form">
								<div class="file-field">
									<div class="btn btn-primary btn-sm float-left">
										<span>Choose files</span>
										<input type="file" name="name[]" multiple>
									</div>
									<div class="file-path-wrapper">
										<input class="file-path validate" type="text" placeholder="Upload your documents">
									</div>
								</div>
								
								@if ($errors->has('name'))
									<span class="text-danger">{{ $errors->first('name') }}</span>
								@endif
							</div>
							<div class="form-group">
								{{ Form::label('title', 'Description', ['class' => 'form-control-label']) }}
								{{ Form::text('title', '', ['class' => 'form-control', 'placeholder' => 'Enter Name Of Documents']) }}
								
								@if ($errors->has('title'))
									<span class="text-danger">Description cannot be empty</span>
								@endif
							</div>
							<div class="form-group">
								{{ Form::submit('Add Files', ['class' => 'btn btn-primary ml-0']) }}
							</div>
						</div>
					{!! Form::close() !!}
				</div>
			</div>
		</div>
	</div>
@endsection
