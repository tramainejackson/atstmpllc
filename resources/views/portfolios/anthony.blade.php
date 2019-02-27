@extends('layouts.app')

@section('addt_styles')
	<style>
		.top-nav-collapse {
			background-color: #3f51b5!important;
		}

		.top-nav-collapse a {
			color: #fff !important;
		}

		.navbar:not(.top-nav-collapse) {
			background: transparent!important;
		}

		.navbar:not(.top-nav-collapse) a {
			color: black !important;
		}

		@media (max-width: 768px) {
			.navbar:not(.top-nav-collapse) {
				background: #3f51b5!important;
			}
		}
		h5 {
			letter-spacing: 3px;
		}
		@media (max-width: 740px) {
			.full-height,
			.full-height body,
			.full-height header,
			.full-height header .view {
				height: 700px;
			}
		}
	</style>
@endsection

@section('content')
	<!--Navigation & Intro-->
	<header>

		<!-- Navbar -->
		<nav class="navbar navbar-expand-lg navbar-dark fixed-top scrolling-navbar top-nav-collapse">
			<div class="container smooth-scroll">
				<!--Brand Link-->
				<a class="navbar-brand" href="{{ route('about_us') }}" target="_blank"><strong>ATSTMPLLC</strong></a>
				<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent-7" aria-controls="navbarSupportedContent-7" aria-expanded="false" aria-label="Toggle navigation">
					<span class="navbar-toggler-icon"></span>
				</button>
				<div class="collapse navbar-collapse" id="navbarSupportedContent-7">
					<ul class="navbar-nav mr-auto">
						<li class="nav-item">
							<a class="nav-link waves-effect waves-light" href="#about_me_portfolio" data-offset="60">About Me</a>
						</li>
						<li class="nav-item">
							<a class="nav-link waves-effect waves-light" href="#experience_portfolio" data-offset="60">Experience</a>
						</li>
						<li class="nav-item">
							<a class="nav-link waves-effect waves-light" href="#projects_portfolio" data-offset="60">Projects</a>
						</li>
						<li class="nav-item">
							<a class="nav-link waves-effect waves-light" href="#contact" data-offset="60">Contact</a>
						</li>
					</ul>
				</div>
			</div>
		</nav>

		<!-- Intro Section -->
		<div id="" class="view" style="min-height: 100vh; background-image: url('https://mdbootstrap.com/img/Photos/Others/architecture.jpg'); background-repeat: no-repeat; background-size: cover; background-position: center center;">
			<div class="mask rgba-white-strong d-flex justify-content-center align-items-center">
				<div class="container">
					<div class="row smooth-scroll">
						<div class="col-md-12 pt-3">
							<div class="white-text text-center pt-5">
								<h1 class="display-1 mb-4 dark-grey-text wow fadeInUpBig d-none d-md-block" data-wow-delay="0.6s">Anthony<strong>Oghogho</strong></h1>
								<h1 class="display-1 dark-grey-text wow fadeInUpBig d-md-none mb-0" data-wow-delay="0.6s">Anthony</h1>
								<h1 class="display-1 mb-4 dark-grey-text wow fadeInUpBig d-md-none mt-0" data-wow-delay="0.6s"><strong>Oghogho</strong></h1>
								<h5 class="text-uppercase font-weight-bold wow fadeInUp" data-wow-delay="0.s"><mark>IT Consultant</mark></h5>
								<a href="#about" class="btn btn-floating btn-large blue wow fadeInDown waves-effect waves-light" data-wow-delay="0.6s" data-offset="100"><i class="fas fa-angle-down" aria-hidden="true"></i></a>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>

	</header>
	<!--/Navigation & Intro-->

	<!--Main layout-->
	<main>

		<!-- First container -->
		<div class="container" id="about_me_portfolio">

			<!-- Section About -->
			<section id="about" class="section feature-box mb-5">

				<!-- Section title -->
				<h2 class="text-center text-uppercase my-5 pt-5 wow fadeIn" data-wow-delay="0.2s" style="visibility: visible; animation-name: fadeIn; animation-delay: 0.2s;">About <strong>me</strong></h2>

				<p class="text-center w-responsive mx-auto wow fadeIn my-5" data-wow-delay="0.2s" style="visibility: visible; animation-name: fadeIn; animation-delay: 0.2s;">IT Consultant with over 10 years of successful experience. I specialize in technical support, customer service management, problem solving and am currently perusing Android Application Development certification. I also enjoy riding motorcycles and can never pass up the opportunity to travel.</p>

				<!-- First row -->
				<div class="row features-big text-center wow fadeIn" data-wow-delay="0.4s" style="visibility: visible; animation-name: fadeIn; animation-delay: 0.4s;">

					<!-- First column -->
					<div class="col-md-4 mb-5">

						<!--Panel-->
						<div class="card card-body hoverable">
							<i class="fas fa-tasks dark-grey- fa-3x mb-4" aria-hidden="true"></i>
							<h5 class="font-weight-bold text-uppercase mb-4">Program Manager</h5>
							<p class="dark-grey-text">Its not just about what you want but what you need.</p>
						</div>
						<!--/.Panel-->

					</div>
					<!-- /First column -->

					<!-- Second column -->
					<div class="col-md-4 mb-5">

						<!--Panel-->
						<div class="card card-body yellow hoverable">
							<i class="fas fa-database dark-grey-text fa-3x mb-4" aria-hidden="true"></i>
							<h5 class="font-weight-bold text-uppercase mb-4">Database Admin</h5>
							<p class="dark-grey-text">Oracle Enterprise Business Suite is where it all began.</p>
						</div>
						<!--/.Panel-->

					</div>
					<!-- /.Second column -->

					<!-- Third column -->
					<div class="col-md-4 mb-5">

						<!--Panel-->
						<div class="card card-body hoverable">
							<i class="fab fa-android dark-grey-text fa-3x mb-4" aria-hidden="true"></i>
							<h5 class="font-weight-bold text-uppercase mb-4">Android Developer</h5>
							<p class="dark-grey-text">It's just the beginning. Stay calm, IOS is on the horizon.</p>
						</div>
						<!--/.Panel-->

					</div>
					<!-- /.Third column -->

				</div>
				<!-- /.First row -->

			</section>
			<!-- /.Second section -->

		</div>
		<!-- /.First container -->

		<!--Second container-->
		<div class="container-fluid" style="background-color: #f3f3f5;" id="experience_portfolio">
			<div class="container py-4 pt-4">

				<!-- Second section -->
				<section id="skills">

					<!-- First row -->
					<div class="row py-5">

						<!--First column-->
						<div class="col-12 mb-3 wow fadeIn" data-wow-delay="0.4s" style="visibility: visible; animation-name: fadeIn; animation-delay: 0.4s;">

							<!--Section heading-->
							<div class="d-flex justify-content-start">
								<h4 class="text-center text-uppercase mb-5 pb-3 mt-4 wow fadeIn" data-wow-delay="0.2s" style="visibility: visible; animation-name: fadeIn; animation-delay: 0.2s;">My <strong>experience</strong></h4>
							</div>

							<!--Work Experience 1-->
							<blockquote class="blockquote bq-warning mb-4">
								<div class="row"> <i class="fas fa-briefcase fa-x mb-1 mr-3 ml-3 dark-grey-text" aria-hidden="true"></i>
									<h5 class="font-weight-bold mb-3">Program/Data Management</h5>
								</div>

								<p class="font-weight-bold ml-1 dark-grey-text mb-0 pb-0">Potomac Wave Consulting</p>
								<p class="font-weight-bold ml-1 dark-grey-text mt-0 pt-0 mb-2">October 2017 - Present</p>
								<p class="mb-0 ml-1 light-grey-text">supporting United States Citizenship and Immigration Service (USCIS) supporting the agencies effort to transition from a paper to electronic processing immigration system (ELIS).</p>
							</blockquote>
							<!--Work Experience 1-->

							<!--Work Experience 2-->
							<blockquote class="blockquote bq-warning mt-1 mb-4">
								<div class="row"> <i class="fas fa-briefcase fa-x mb-1 mr-3 ml-3 dark-grey-text" aria-hidden="true"></i>
									<h5 class="font-weight-bold mb-3">Oracle Database Administrator</h5>
								</div>

								<p class="font-weight-bold ml-1 dark-grey-text mb-0 pb-0">Deloitte Consulting LLC</p>
								<p class="font-weight-bold ml-1 dark-grey-text mt-0 pt-0 mb-2">September 2014 - September 2017</p>
								<p class="mb-0 ml-1 light-grey-text">Provided Database Administration operations and maintenance for Defense Information Systems Agency	(DISA) Oracle E-Business Suite (EBS) Release 12.1.3.</p>
							</blockquote>
							<!--Work Experience 2-->

							<!--Work Experience 3-->
							<blockquote class="blockquote bq-warning mt-1 mb-4">
								<div class="row"> <i class="fas fa-briefcase fa-x mb-1 mr-3 ml-3 dark-grey-text" aria-hidden="true"></i>
									<h5 class="font-weight-bold mb-3">Tier 3 Halpdesk/Technical Support</h5>
								</div>

								<p class="font-weight-bold ml-1 dark-grey-text mb-0 pb-0">British Embassy</p>
								<p class="font-weight-bold ml-1 dark-grey-text mt-0 pt-0 mb-2">June 2012 - October 2103</p>
								<p class="mb-0 ml-1 light-grey-text">Served as liaison between British Defense Staff (BDS) and Oracle Database Administrator by troubleshooting	user issues in Oracle E-Business Suite Release 11i, gathering functional requirements, documenting customizations, and reporting findings.</p>
							</blockquote>
							<!--Work Experience 3-->

						</div>
						<!--/First column-->

					</div>
					<!--/First row-->

				</section>
				<!-- /.Second section -->

			</div>
		</div>
		<!--/Second container-->

		<!-- Third container -->
		<div class="container" id="projects_portfolio">

			<!-- Fourth section -->
			<section id="works" class="section mb-5">

				<!-- Section title -->
				<h2 class="text-center text-uppercase my-5 pt-5 wow fadeIn" data-wow-delay="0.2s" style="visibility: visible; animation-name: fadeIn; animation-delay: 0.2s;">There's more to me than just brains. Want to see more?</h2>

				<!-- See More Button -->
				<div class="d-flex justify-content-center" id="">
					<button class="wow fadeIn my-5 btn-floating btn-lg purple-gradient" style="visibility: visible; animation-name: fadeIn;" type="button" data-toggle="collapse" data-target="#collapseExample"
							aria-expanded="false" aria-controls="collapseExample"><i class="fas fa-info"></i></button>
				</div>
				<!-- See More Button -->

				<!-- First row -->
				<div class="row collapse" id="collapseExample">

					<!-- First column -->
					<div class="col-md-12 mb-5">

						<!-- Section description -->
						<h3 class="text-center w-responsive mx-auto wow fadeIn my-5" style="visibility: visible; animation-name: fadeIn;">DIY.</h3>

						<div class="" id="">
							<p>Before</p>
							<img src="/images/bathroom_before1.jpg" class="img-fluid z-depth-2 mb-3" alt="Responsive image">
							<img src="/images/bathroom_before2.jpg" class="img-fluid z-depth-2 mb-3" alt="Responsive image">
						</div>

						<div class="" id="">
							<p>After</p>
							<img src="/images/bathroom_after1.jpg" class="img-fluid z-depth-2 mb-3" alt="Responsive image">
							<img src="/images/bathroom_after2.jpg" class="img-fluid z-depth-2 mb-3" alt="Responsive image">
							<img src="/images/bathroom_after3.jpg" class="img-fluid z-depth-2 mb-3" alt="Responsive image">
						</div>
					</div>
					<!-- /.First column -->

				</div>
				<!-- /.First row -->

			</section>
			<!-- /.Fourth section -->

			<hr>

		</div>
		<!-- /.Third container -->

		<!-- Contact form -->
		<div id="contact" class="container">

			<div class="streak1">
				<div class="flex-center">
					<ul class="list-unstyled">
						<li><h2 class="h2-responsive mt-5 wow fadeIn" style="visibility: visible; animation-name: fadeIn;">Want an outstanding project?</h2></li>
						<li><h5 class="h5-responsive wow fadeIn" data-wow-delay="0.2s" style="visibility: visible; animation-name: fadeIn; animation-delay: 0.2s;">Just send me a message!</h5></li>
					</ul>
				</div>
			</div>

			<!-- Section: Contact v.2 -->
			<section id="contact" class="section pb-5 wow fadeIn" data-wow-delay="0.3s" style="visibility: visible; animation-name: fadeIn; animation-delay: 0.3s;">

				<!-- Section heading -->
				<h2 class="section-heading h1 pt-4">Contact Me</h2>

				<div class="row">

					<!-- Grid column -->
					<div class="col-md-8 col-xl-9">

						{!! Form::open(['action' => ['HomeController@message'], 'method' => 'POST']) !!}

							<!-- Grid row -->
							<div class="row">

								<!-- Grid column -->
								<div class="col-md-6">
									<div class="md-form">
										<div class="md-form">
											<input type="text" id="contact-name" class="form-control" name="message_name" value="{{ old('message_name') }}" {{ $errors->any() ? 'autofocus' : '' }} required>
											<label for="contact-name" class="">Your name</label>
										</div>
									</div>

									@if($errors->has('message_name'))
										<div class="red-text">
											<span class="">{{ $errors->first('message_name') }}</span>
										</div>
									@endif
								</div>
								<!-- Grid column -->

								<!-- Grid column -->
								<div class="col-md-6">
									<div class="md-form">
										<div class="md-form">
											<input type="text" id="contact-email" class="form-control" name="message_email" value="{{ old('message_email') }}" required>
											<label for="contact-email" class="">Your email</label>
										</div>
									</div>

									@if($errors->has('message_email'))
										<div class="red-text">
											<span class="">{{ $errors->first('message_email') }}</span>
										</div>
									@endif
								</div>
								<!-- Grid column -->

							</div>
							<!-- Grid row -->

							<!-- Grid row -->
							<div class="row">
								<div class="col-md-12">
									<div class="md-form">
										<input type="text" id="contact-Subject" class="form-control" name="message_subject" value="{{ old('message_subject') }}" required>
										<label for="contact-Subject" class="">Subject</label>
									</div>

									@if($errors->has('message_subject'))
										<div class="red-text">
											<span class="">{{ $errors->first('message_subject') }}</span>
										</div>
									@endif
								</div>
							</div>
							<!-- Grid row -->

							<!-- Grid row -->
							<div class="row mb-4">

								<!-- Grid column -->
								<div class="col-md-12">
									<div class="md-form">
										<textarea type="text" name="message_body" id="contact-message" class="md-textarea form-control" rows="3" required>{{ old('message_body') }}</textarea>
										<label for="contact-message">Your message</label>
									</div>

									@if($errors->has('message_body'))
										<div class="red-text">
											<span class="">{{ $errors->first('message_body') }}</span>
										</div>
									@endif
								</div>
							</div>
							<!-- Grid row -->

							<div class="text-center text-md-left mb-4">
								<button type="submit" class="btn btn-light-blue waves-effect waves-light">Send</button>
							</div>

						{!! Form::close() !!}

					</div>
					<!-- Grid column -->

					<!-- Grid column -->
					<div class="col-md-4 col-xl-3">
						<ul class="contact-icons">
							<li><i class="fa fa-map-marker fa-2x"></i>
								<p>Philadelphia, PA 19140, USA</p>
							</li>

							<li><i class="fa fa-phone fa-2x"></i>
								<p>+ 1 267 879 4089</p>
							</li>

							<li><i class="fa fa-envelope fa-2x"></i>
								<p>atstmpllc@gmail.com</p>
							</li>
						</ul>
					</div>
					<!-- Grid column -->
				</div>

			</section>
			<!-- Section: Contact v.2 -->

		</div>
		<!-- Contact form -->

	</main>
	<!--/Main layout-->
@endsection
