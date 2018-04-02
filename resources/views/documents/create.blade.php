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
							<div class="form-group">
								<div class="input-group mb-3">
									<div class="input-group-prepend">
										<span class="input-group-text">Upload</span>
									</div>
									<div class="custom-file">
										{{ Form::file('name[]', ['class' => 'custom-file-input', 'multiple' => 'true']) }}
										{{ Form::label('name', 'Add Files', ['class' => 'custom-file-label']) }}
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
