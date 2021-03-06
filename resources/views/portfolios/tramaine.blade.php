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
								<h1 class="display-1 mb-4 dark-grey-text wow fadeInUpBig d-none d-md-block" data-wow-delay="0.6s">Tramaine<strong>Jackson</strong></h1>
								<h1 class="display-1 dark-grey-text wow fadeInUpBig d-md-none mb-0" data-wow-delay="0.6s">Tramaine</h1>
								<h1 class="display-1 mb-4 dark-grey-text wow fadeInUpBig d-md-none mt-0" data-wow-delay="0.6s"><strong>Jackson</strong></h1>
								<h5 class="text-uppercase font-weight-bold wow fadeInUp" data-wow-delay="0.s"><mark>Web developer</mark></h5>
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

				<p class="text-center w-responsive mx-auto wow fadeIn my-5" data-wow-delay="0.2s" style="visibility: visible; animation-name: fadeIn; animation-delay: 0.2s;">Self taught web developer from South West Philadelphia. Started looking for a new hobby around 2013 and found out I'm actually a nerd during my quest. Developing to me is an unique puzzle with unlimited pieces.</p>

				<!-- First row -->
				<div class="row features-big text-center wow fadeIn" data-wow-delay="0.4s" style="visibility: visible; animation-name: fadeIn; animation-delay: 0.4s;">

					<!-- First column -->
					<div class="col-md-4 mb-5">

						<!--Panel-->
						<div class="card card-body hoverable">
							<i class="fas fa-laptop dark-grey- fa-3x mb-4" aria-hidden="true"></i>
							<h5 class="font-weight-bold text-uppercase mb-4">Freelancer</h5>
							<p class="dark-grey-text">No project is too big or too small. Let me know what you need.</p>
						</div>
						<!--/.Panel-->

					</div>
					<!-- /First column -->

					<!-- Second column -->
					<div class="col-md-4 mb-5">

						<!--Panel-->
						<div class="card card-body yellow hoverable">
							<i class="fas fa-code dark-grey-text fa-3x mb-4" aria-hidden="true"></i>
							<h5 class="font-weight-bold text-uppercase mb-4">Developer</h5>
							<p class="dark-grey-text">PHP is my preferred language but I speak fluent Python and ASP.</p>
						</div>
						<!--/.Panel-->

					</div>
					<!-- /.Second column -->

					<!-- Third column -->
					<div class="col-md-4 mb-5">

						<!--Panel-->
						<div class="card card-body hoverable">
							<i class="fas fa-pencil-alt dark-grey-text fa-3x mb-4" aria-hidden="true"></i>
							<h5 class="font-weight-bold text-uppercase mb-4">Designer</h5>
							<p class="dark-grey-text">If you have the vision, I can make it come alive for you.</p>
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
						<div class="col-lg-6 col-md-12 mb-3 wow fadeIn" data-wow-delay="0.4s" style="visibility: visible; animation-name: fadeIn; animation-delay: 0.4s;">

							<!--Section heading-->
							<div class="d-flex justify-content-start">
								<h4 class="text-center text-uppercase mb-5 pb-3 mt-4 wow fadeIn" data-wow-delay="0.2s" style="visibility: visible; animation-name: fadeIn; animation-delay: 0.2s;">My <strong>experience</strong></h4>
							</div>

							<!--Description-->
							<blockquote class="blockquote bq-warning mb-4">
								<div class="row"> <i class="fas fa-briefcase fa-x mb-1 mr-3 ml-3 dark-grey-text" aria-hidden="true"></i>
									<h5 class="font-weight-bold mb-3">DMB developer</h5>
								</div>
								<p class="font-weight-bold ml-1 dark-grey-text mb-2">August 2018 - Present ({{ $dmbDevTime }})</p>
								<p class="mb-0 ml-1 light-grey-text">Working with the great company called Xenial, Inc. We build Digital Menu Boards for restaurants. So when you get something to eat from fast food restaurants, and you see the animated menus, you'll know who made them.</p>
							</blockquote>

							<blockquote class="blockquote bq-warning mt-1 mb-4">
								<div class="row"> <i class="fas fa-briefcase fa-x mb-1 mr-3 ml-3 dark-grey-text" aria-hidden="true"></i>
									<h5 class="font-weight-bold mb-3">Freelance PHP developer</h5> </div>
								<p class="font-weight-bold ml-1 dark-grey-text mb-2">November 2013 - Present ({{ $freelanceDevTime }})</p>
								<p class="mb-0 ml-1 light-grey-text">I've been developing websites with PHP since 2013. All of my applications are built on top of the Laravel MVC with the Material Design Bootstrap framework. I also manage all of the application on my Virtual Private Servers running Linux.</p>
							</blockquote>

						</div>
						<!--/First column-->

						<!--Second column-->
						<div class="col-lg-5 offset-lg-1 col-md-12 mb-4 wow fadeIn" data-wow-delay="0.4s" style="visibility: visible; animation-name: fadeIn; animation-delay: 0.4s;">

							<!--Second heading-->
							<div class="d-flex justify-content-start">
								<h4 class="text-center text-uppercase mb-5 pb-3 mt-4 wow fadeIn" data-wow-delay="0.2s" style="visibility: visible; animation-name: fadeIn; animation-delay: 0.2s;">Development <strong>Skills</strong></h4>
							</div>

							<!--Description-->
							<p class="black-text text-uppercase font-weight-bold" align="justify">JavaScript/Jquery</p>
							<div class="md-progress">
								<div class="progress-bar" role="progressbar" style="width: 80%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
							</div>

							<p class="black-text text-uppercase font-weight-bold pt-3" align="justify">SQL</p>
							<div class="md-progress">
								<div class="progress-bar" role="progressbar" style="width: 70%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
							</div>

							<p class="black-text text-uppercase font-weight-bold pt-3" align="justify">HTML5</p>
							<div class="md-progress">
								<div class="progress-bar" role="progressbar" style="width: 75%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
							</div>

							<p class="black-text text-uppercase font-weight-bold pt-3" align="justify">Linux</p>
							<div class="md-progress">
								<div class="progress-bar" role="progressbar" style="width: 55%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
							</div>

							<p class="black-text text-uppercase font-weight-bold pt-3" align="justify">PHP</p>
							<div class="md-progress">
								<div class="progress-bar" role="progressbar" style="width: 90%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
							</div>

							<p class="black-text text-uppercase font-weight-bold pt-3" align="justify">Photoshop (Adobe Suites)</p>
							<div class="md-progress">
								<div class="progress-bar" role="progressbar" style="width: 70%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
							</div>

						</div>
						<!--/Second column-->

					</div>
					<!--/First row-->

				</section>
				<!-- /.Second section -->

			</div>
		</div>
		<!--/Second container-->

		<!-- Streak -->
		<div class="streak streak-photo streak-md" style="background-image:url('https://mdbootstrap.com/img/Photos/Horizontal/Work/12-col/img%20%2811%29.jpg')">
			<div class="mask flex-center rgba-indigo-strong">
				<div class="white-text smooth-scroll mx-4">
					<h2 class="h2-responsive wow fadeIn mb-5" data-wow-delay="0.3s"><i class="fas fa-quote-left" aria-hidden="true"></i> The best way to predict the future is to invent it. <i class="fas fa-quote-right" aria-hidden="true"></i></h2>
					<h5 class="text-center font-italic wow fadeIn" data-wow-delay="0.4s">~ Alan Kay</h5>
				</div>
			</div>
		</div>
		<!-- /.Streak -->

		<!-- Third container -->
		<div class="container" id="projects_portfolio">

			<!-- Fourth section -->
			<section id="works" class="section mb-5">

				<!-- Section title -->
				<h2 class="text-center text-uppercase my-5 pt-5 wow fadeIn" data-wow-delay="0.2s" style="visibility: visible; animation-name: fadeIn; animation-delay: 0.2s;">My <strong>projects</strong></h2>

				<!-- Section description -->
				<p class="text-center w-responsive mx-auto wow fadeIn my-5" style="visibility: visible; animation-name: fadeIn;">With multiple projects currently active, take a look at the projects that are completed.</p>

				<!-- First row -->
				<div class="row wow fadeIn" data-wow-delay="0.4s" style="visibility: visible; animation-name: fadeIn; animation-delay: 0.4s;">

					<!-- First column -->
					<div class="col-md-12 mb-5">

						<div class="row" id="">

							<div class="col-12 col-lg-6 my-2" id="">
								<!-- Card -->
								<div class="card card-image" style="background-image: url({{ asset('storage/images/eastcoast2westcoast.jpeg') }});">

									<!-- Content -->
									<div class="text-white text-center d-flex align-items-center rgba-black-strong py-5 px-4">
										<div>
											<h3 class="card-title pt-2"><strong>Travel</strong></h3>
											<p>From here, to there, and all around the world. We love to travel and have no limitations on where
												we are willing to go. Starting in the US and finishing in the Caribbean, we love to explore the world
												together.</p>
											<a href="http://eastcoast2westcoast.com/" target="_blank" class="btn btn-pink"><i class="fas fa-clone left"></i> View project</a>
										</div>
									</div>

								</div>
								<!-- Card -->
							</div>

							<div class="col-12 col-lg-6 my-2" id="">
								<!-- Card -->
								<div class="card card-image" style="background-image: url({{ asset('storage/images/jgreunion.jpeg') }});">

									<!-- Content -->
									<div class="text-white text-center d-flex align-items-center rgba-black-strong py-5 px-4">
										<div>
											<h3 class="card-title pt-2"><strong>Reunions</strong></h3>
											<p>Hey cousin! Its a family reunion! Who doesn't love a good family gathering with
												games and bar-b-que. Keep up with the Jackson's and the Green's and their
												semi-annual reunions.</p>
											<a href="http://jgreunion.com/" target="_blank" class="btn btn-pink"><i class="fas fa-clone left"></i> View project</a>
										</div>
									</div>

								</div>
								<!-- Card -->
							</div>

							<div class="col-12 col-lg-6 my-2" id="">
								<!-- Card -->
								<div class="card card-image" style="background-image: url({{ asset('storage/images/ttr.png') }});">

									<!-- Content -->
									<div class="text-white text-center d-flex align-items-center rgba-black-strong py-5 px-4">
										<div>
											<h3 class="card-title pt-2"><strong>Sports</strong></h3>
											<p>Ball is life! Some people know what that means and some just think they know.
												You can find out where all the courts are in Philly and even let everybody know
												the best places to go to play. See you on the court.</p>
											<a href="https://totherec.com/" target="_blank" class="btn btn-pink"><i class="fas fa-clone left"></i> View project</a>
										</div>
									</div>

								</div>
								<!-- Card -->
							</div>

							<div class="col-12 col-lg-6 my-2" id="">
								<!-- Card -->
								<div class="card card-image" style="background-image: url({{ asset('storage/images/rental_homes.jpeg') }});">

									<!-- Content -->
									<div class="text-white text-center d-flex align-items-center rgba-black-strong py-5 px-4">
										<div>
											<h3 class="card-title pt-2"><strong>Rental Homes</strong></h3>
											<p>Jackson Rental Homes has some of the hottest and most affordable houses in the Philadelphia
												area. Top to bottom renovations with the coolest new features and concepts on the housing scene.
												Definently a must see!</p>
											<a href="https://jacksonrentalhomesllc.com/" target="_blank" class="btn btn-pink"><i class="fas fa-clone left"></i> View project</a>
										</div>
									</div>

								</div>
								<!-- Card -->
							</div>

							<div class="col-12 col-lg-6 my-2" id="">
								<!-- Card -->
								<div class="card card-image" style="background-image: url({{ asset('storage/images/spades_flyer.jpg') }});">

									<!-- Content -->
									<div class="text-white text-center d-flex align-items-center rgba-black-strong py-5 px-4">
										<div>
											<h3 class="card-title pt-2"><strong>Recreational</strong></h3>
											<p>Spades? Did somebody say Spades? The March Madness style Spades Tournament being hosted
												in the Philadelphia area with huge payouts. You've heard it before, you can't win
												if you don't play.</p>
											<a href="https://tournament.atstmpllc.com/" target="_blank" class="btn btn-pink"><i class="fas fa-clone left"></i> View project</a>
										</div>
									</div>

								</div>
								<!-- Card -->
							</div>

							<div class="col-12 col-lg-6 my-2" id="">
								<!-- Card -->
								<div class="card card-image" style="background-image: url({{ asset('storage/images/engagement2.jpg') }});">

									<!-- Content -->
									<div class="text-white text-center d-flex align-items-center rgba-black-strong py-5 px-4">
										<div>
											<h3 class="card-title pt-2"><strong>Holy Matrimony</strong></h3>
											<p>Love is in the air! My personal website for my wife and I. The journey started years ago
												and we have the privilege of being able to share what we have with our friends and
												family.</p>
											<a href="http://journey2jackson.com/" target="_blank" class="btn btn-pink"><i class="fas fa-clone left"></i> View project</a>
										</div>
									</div>

								</div>
								<!-- Card -->
							</div>

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
