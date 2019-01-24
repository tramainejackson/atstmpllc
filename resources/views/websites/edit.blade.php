@extends('layouts.app')

@section('content')
	
	<div class="container-fluid">
		
		<div class="row">
			<div class="col-12">
				@include('layouts.nav')
			</div>
			
			<div class="col-8 my-4 mx-auto">
				<div class="userNavLinks d-flex flex-column flex-lg-row justify-content-around">
					<a href="/websites" class="btn my-1 col-12 col-lg-6">All Websites</a>
					<a href="/websites/create" class="btn my-1 col-12 col-lg-6">Add New Website</a>
				</div>
			</div>
			
			<div class="col-12 col-lg-10 mx-auto">
				
				<div class="formDiv">
					
					{!! Form::open(['action' => ['WebsiteController@update', $website->id], 'files' => 'true', 'method' => 'PUT']) !!}
						
						<div class="">
							<h2 class="mr-4 d-inline-block">Edit Website</h2>
							<button class="btn btn-mdb-color d-inline sendPaymentReminder">Send Payment Reminder</button>
						</div>
					
						<div class="container-fluid">
							
							<div class="row">
								
								<div class="col-12 col-sm-9">

									<div class="form-group">
										<label class="form-label">Website Name</label>
										<input type="text" name="name" class="form-control" value="{{ $website->name }}" />

										@if($errors->has('name'))
											<span class="help-block text-danger">
												<strong>{{ $errors->first('name') }}</strong>
											</span>
										@endif
									</div>
									
									<div class="form-group">
										<label class="form-label">Website Link</label>
										<input type="text" name="link" class="form-control" value="{{ $website->link }}" placeholder="Enter Website Link" required />

										@if($errors->has('link'))
											<span class="help-block text-danger">
												<strong>{{ $errors->first('link') }}</strong>
											</span>
										@endif
									</div>

									<div class="form-row" id="">

										<div class="form-group col-6">
											<label class="form-label">Website Owner Name</label>
											<input type="text" name="owner" class="form-control" value="{{ $website->owner }}" placeholder="Enter Website Owner Name" required />

											@if($errors->has('owner'))
												<span class="help-block text-danger">
													<strong>{{ $errors->first('owner') }}</strong>
												</span>
											@endif
										</div>

										<div class="form-group col-6">
											<label class="form-label">Website Owner Email</label>
											<input type="email" name="owner_email" class="form-control" value="{{ $website->owner_email }}" placeholder="Enter Website Owner Email" required />

											@if($errors->has('owner_email'))
												<span class="help-block text-danger">
													<strong>{{ $errors->first('owner_email') }}</strong>
												</span>
											@endif
										</div>

									</div>

									<div class="form-row" id="">

										<div class="form-group col-6">
											<label class="form-label">Renew Date</label>
											<input type="date" name="renew_date" class="form-control" value="{{ $website->renew_date }}" placeholder="Enter Renew Date" required />

											@if($errors->has('renew_date'))
												<span class="help-block text-danger">
													<strong>{{ $errors->first('renew_date') }}</strong>
												</span>
											@endif
										</div>

										<div class="form-group col-6">
											<label class="form-label">Last Paid Date</label>
											<input type="date" name="last_paid_date" class="form-control" value="{{ $website->last_paid_date }}" placeholder="Enter Last Paid Date" required />

											@if($errors->has('last_paid_date'))
												<span class="help-block text-danger">
													<strong>{{ $errors->first('last_paid_date') }}</strong>
												</span>
											@endif
										</div>

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
										<button type="submit" class="btn btn-primary">Update Site Info</button>
									</div>
								</div>
								
							</div>
							
						</div>
					
					{!! Form::close() !!}
					
				</div>
				
			</div>
			
		</div>
		
	</div>
@endsection