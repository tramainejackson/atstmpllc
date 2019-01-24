@extends('layouts.app')

@section('content')

	<div class="container-fluid">

		<div class="row">

			<div class="col-12">
				@include('layouts.nav')
			</div>

			<div class="col-8 my-4 mx-auto">
				<div class="userNavLinks d-flex justify-content-around">
					<a href="/websites/create" class="btn col-12">Add New Website</a>
				</div>
			</div>

			<div class="col-12 col-xl-10 mx-auto">

				<div class="row">

					@foreach($websites as $website)

						<div class="col-12 col-sm-6 col-md-4 col-xl-4 my-2">
							<!-- Card Cascade -->
							<div class="card card-cascade">

								<!-- Card image -->
								<div class="view view-cascade gradient-card-header blue-gradient">

									<!-- Title -->
									<h2 class="card-header-title mb-3">{{ $website->name }}</h2>
									
									<!-- Subtitle -->
									<p class="card-header-subtitle mb-0">{{ $website->owner }}</p>

								</div>

								<!-- Card content -->
								<div class="card-body card-body-cascade">

									<div class="nameHeader text-center">
										<h2 class="coolText1 mb-4"><a href="{{ $website->link }}" class="btn btn-link" target="_blank">{{ $website->link }}</a></h2>
									</div>

								</div>

								<div class="grey lighten-5 text-center">
									<a href='/websites/{{ $website->id }}/edit' class="btn orange darken-1">Edit</a>
								</div>
								<!-- Card content -->

							</div>
							<!-- Card Wider -->

						</div>

					@endforeach

				</div>

			</div>

		</div>

	</div>

@endsection