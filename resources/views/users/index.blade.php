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
				<a href="/users/create" class="btn col-12">Add New User</a>
			</div>
		</div>
		<div class="col-12 col-xl-10 mx-auto">
			<div class="row">
				@foreach($users as $user)
					@php
						$last_login = new Carbon\Carbon($user->last_login != null ? $user->last_login : $user->created_at);
					@endphp
					<div class="col-12 col-sm-6 col-md-4 col-xl-4 my-2">
						<!-- Card Wider -->
						<div class="card card-cascade wider">
							<!-- Card image -->
							<div class="view overlay">
								<img src="{{ $user->picture != null ? asset('/storage/images/' . $user->picture) : '/images/emptyface.jpg' }}" class="img-fluid imgPreview mx-auto" alt="Profile Photo" />
							</div>
							<!-- /Card image -->
						
							<!-- Card content -->
							<div class="card-body">
								<div class="nameHeader text-center">
									<h2 class="coolText1 mb-4">{{ $user->full_name() }}</h2>
								</div>
								<div class="userAccountInfo">
									<p class="" data-toggle="tooltip" data-placement="top" title="Last Log In"><i class="fa fa-clock-o" aria-hidden="true"></i>&nbsp;{{ $last_login->toFormattedDateString() }}</p>
									<p class="" data-toggle="tooltip" data-placement="top" title="Username"><i class="fa fa-user-circle" aria-hidden="true"></i>&nbsp;{{ $user->username }}</p>
									<p class="text-truncate" data-toggle="tooltip" data-placement="top" title="Email Address"><i class="fa fa-envelope" aria-hidden="true"></i>&nbsp;{{ $user->email }}</p>
								</div>
							</div>
							
							<div class="grey lighten-5 text-center" style="margin-left: 4%; margin-right: 4%;">
								<a href='/users/{{ $user->id }}/edit' class="btn btn-warning d-block" {{ $user->editable == 'Y' ? '' : 'disabled' }}>Edit</a>
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