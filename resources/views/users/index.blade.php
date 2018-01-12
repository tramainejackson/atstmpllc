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
				<a href="/users/create" class="btn col-12 col-sm-3">Add New User</a>
			</div>
		</div>
		<div class="col-12 col-xl-8 mx-auto">
			<div class="row">
				<div class="col-12">
					<h2 class="mb-4 text-muted">{{ $active_user->company->company_name }} Users</h2>
				</div>
				@foreach($users as $user)
					@if($user->editable == "Y")
						<div class="col-12 my-3 col-xl-4">
							<div class="card">
								@if($user->picture != null)
									<img src="{{ asset('/storage/images/' . $user->picture) }}" class="img-card-top" />
								@else
									<img src="../images/emptyface.jpg" class="img-card-top" />
								@endif
								<div class="card-body">
									<div class="d-flex">
										<span class="oi oi-person" style="line-height: 1.5;"></span>
										<span class="text-truncate">&nbsp;{{ $user_name }}</span>
									</div>
									<div class="d-flex">
										<span class="oi oi-envelope-closed" style="line-height: 1.5;"></span>
										<span class="text-truncate">&nbsp;{{ $user->email }}</span>
									</div>
								</div>
								<div class="card-footer">
									<a href='/users/{{ $user->id }}/edit' class="btn btn-warning d-block" {{ $user->editable == 'Y' ? '' : 'disabled' }}>Edit</a>
								</div>
							</div>
						</div>
					@endif
				@endforeach
			</div>
		</div>
	</div>
</div>
@endsection