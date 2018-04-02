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
		</div>

		<div class="col-8 my-4 mx-auto">
			@php $document->name = explode('; ', $document->name); @endphp
			<div class="userNavLinks d-flex justify-content-around">
				<div class="userNavLinks d-flex justify-content-around">
					<a href="/documents/create" class="btn col-5 col-lg-6">Add New Files</a>
					<a href="/documents" class="btn col-5 col-lg-6">All Files</a>
					<a class="btn col-5 col-lg-6 red darken-2" href="#delete_modal" type="button" data-toggle="modal" data-target="#delete_modal">Delete Document</a>
				</div>
			</div>
		</div>
		<div class="col-12 col-md-10 mx-auto">
			<div class="formDiv">
				<div class="formDivTitle row">
					<h2 class="">Add New Document</h2>
				</div>
				{!! Form::model($document, ['action' => ['DocumentController@update', $document->id], 'method' => 'PATCH']) !!}
					<div class="formDiv">
						<div class="form-group">
							{{ Form::label('title', 'File Description', ['class' => 'form-control-label']) }}
							<input type="text" name="title" class="form-control" value="{{ $document->title }}" />
							
							@if ($errors->has('title'))
								<span class="text-danger">Title cannot be empty</span>
							@endif
						</div>
						
						<div class="mb-2">
							<h3 class="text-left text-muted"><u>Documents</u></h3>
							@if($document->group_files) 
								@foreach($document->group_files as $document)
									<div class="">
										<a href="{{ asset(str_ireplace('public', 'storage', $document->name)) }}" class="btn cyan darken-4 ml-3" download="{{ str_ireplace(' ', '_', $document->title) }}">View Document {{ $loop->count > 1 ? $loop->iteration : ""}}</a>
									</div>
								@endforeach
							@else
								<div class="">
									<a href="{{ asset(str_ireplace('public', 'storage', $document->name)) }}" class="btn cyan darken-4 ml-3" download="{{ str_ireplace(' ', '_', $document->title) }}">View Document {{ $loop->count > 1 ? $loop->iteration : ""}}</a>
								</div>
							@endif
						</div>
						<div class="form-group ml-2">
							{{ Form::submit('Update', ['class' => 'btn btn-primary mt-4']) }}
						</div>
					</div>
				{!! Form::close() !!}
			</div>
		</div>

		<div class="modal fade" id="delete_modal" role="dialog" aria-hidden="true" tabindex="1">
			<div class="modal-dialog" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="exampleModalLabel">Confirm Delete</h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<div class="modal-body text-dark">
						<div class="">
							<p class="ml-2 text-muted"><u>File Name</u></p>
							<p class="ml-4">{{ $document->title }}</p>
						</div>
						{!! Form::model($document, ['action' => ['DocumentController@destroy', $document->id], 'method' => 'DELETE']) !!}
							<div class="form-group">
								{{ Form::submit('Delete', ['class' => 'form-control btn btn-danger']) }}
								<button class="btn btn-warning form-control cancelBtn" type="button">Cancel</button>
							</div>
						{!! Form::close() !!}
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection
