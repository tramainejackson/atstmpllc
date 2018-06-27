@extends('layouts.app')

@section('content')
	<div class="container-fluid">
		<div class="row">
			<div class="col-12">
				@include('layouts.nav')
			</div>
			<div class="col-8 my-4 mx-auto">
				<div class="userNavLinks d-flex justify-content-around">
					<a href="/documents/create" class="btn col-12">Add A Document</a>
				</div>
			</div>
		</div>
		<div class="row">
			@if($documents->isNotEmpty())
				@php $documents = $documents->groupBy('parent_doc'); @endphp
				<!-- <div class="col-md-8 col-lg-12 col-xl-4 col-12 text-center mb-4 mx-auto">
					<div class="container-fluid">
						<div class="md-form">
							<label for="valueSearch">Search</label>
						</div>
						<div class="input-group mb-3">
							<input type="text" name="search" class="form-control valueSearch" placeholder="documents Search" />
							<div class="input-group-append">
								<span class="oi oi-magnifying-glass input-group-text"></span>
							</div>
						</div>
					</div>
				</div> -->
				<div class="col">
					<div class="container-fluid">
					
						<!-- Display for mobile screen -->
						<div class="row d-sm-none d-flex">
							@foreach($documents->toArray() as $file)
								<div class="col-md-6 col-12 fileList">
									<div class="card mb-3">
										<div class="card-header container-fluid d-sm-flex align-items-center text-theme1 bg-theme2">
											<a class="btn btn-warning d-block d-sm-inline float-sm-right mb-2 mb-sm-2" href="/documents/{{ $file[0]['id'] }}/edit" class="">Edit</a>
											<h1 class="text-center col-sm-8 col-12 mr-auto">{{ $file[0]['title'] }}</h1>
										</div>
									</div>
								</div>
							@endforeach
						</div>
						
						<!-- Display for non-mobile screen -->
						<div class="row d-none d-sm-block">
							@foreach($documents->toArray() as $document)
								<div class="col-12 col-md-12 col-lg-8 col-xl-6 mx-auto fileList">
									<div class="card">
										<div class="card-body">
											<div class="d-flex justify-content-center align-items-center flex-column">
												<h1 class="text-center"><strong><em>{{ $document[0]['title'] }}</em></strong></h1>

												<a class="btn btn-warning" href="/documents/{{ $document[0]['id'] }}/edit">Edit</a>
											</div>
										
											<div class="d-flex justify-content-around align-items-center">
												@foreach($document as $file)
													<div class="">
														<a href="{{ asset('storage/' . str_ireplace('public/', '', $file['name'])) }}" class="btn cyan darken-4 ml-3" download="{{ str_ireplace(' ', '_', $file['title']) }}">View Document {{ $loop->count > 1 ? $loop->iteration : ""}}</a>
													</div>
												@endforeach
											</div>
										</div>
									</div>
								</div>
								@if(!$loop->last)
									<div class="col my-3">
										<h1 class="text-hide" style="border:1px solid #787878 !important">Hidden Text</h1>
									</div>
								@endif
							@endforeach
						</div>
					</div>
				</div>
			@else
				<div class="col">
					<h2 class="text-center">You haven't added any documents yet</h2>
					<h4 class="text-center">Click <a href="/documents/create" class="">here</a> to add your first file/document</h4>
				</div>
			@endif
		</div>
	</div>
@endsection
