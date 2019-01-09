@extends('layouts.app')

@section('content')
	<!--Navigation & Intro-->
	<header>

		<!-- Navbar -->
		<nav class="navbar navbar-expand-lg navbar-dark fixed-top scrolling-navbar top-nav-collapse">
			<div class="container smooth-scroll">
				<!--Brand Link-->
				<a class="navbar-brand" href="https://atstmpllc.com" target="_blank"><strong>ATSTMPLLC</strong></a>
				<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent-7" aria-controls="navbarSupportedContent-7" aria-expanded="false" aria-label="Toggle navigation">
					<span class="navbar-toggler-icon"></span>
				</button>
				<div class="collapse navbar-collapse" id="navbarSupportedContent-7">
					<ul class="navbar-nav mr-auto">
						<li class="nav-item active">
							<a class="nav-link waves-effect waves-light" href="#home">Home <span class="sr-only">(current)</span></a>
						</li>
						<li class="nav-item">
							<a class="nav-link waves-effect waves-light" href="#about_us" data-offset="60">About Us</a>
						</li>
						<li class="nav-item">
							<a class="nav-link waves-effect waves-light" href="#team" data-offset="60">Team</a>
						</li>
						<li class="nav-item">
							<a class="nav-link waves-effect waves-light" href="#affiliations" data-offset="60">Affiliations</a>
						</li>
						<li class="nav-item">
							<a class="nav-link waves-effect waves-light" href="#contact" data-offset="60">Contact</a>
						</li>
					</ul>
				</div>
			</div>
		</nav>

		<!-- Intro Section -->
		<div id="home" class="view jarallax" data-jarallax="{&quot;speed&quot;: 0.2}" style="background-image: none; background-repeat: no-repeat; background-size: cover; background-position: center center; z-index: 0;" data-jarallax-original-styles="background-image: url('https://mdbootstrap.com/img/Photos/Others/forest1.jpg'); background-repeat: no-repeat; background-size: cover; background-position: center center;">
			<div class="mask rgba-white-strong">
				<div class="container h-100 d-flex justify-content-center align-items-center">
					<div class="row smooth-scroll">
						<div class="col-md-12 pt-3">
							<div class="white-text text-center pt-5">
								<h1 class="display-2 mb-4 dark-grey-text wow fadeIn" style="visibility: visible; animation-name: fadeIn;">Tramaine<strong>Jackson</strong></h1>
								<h5 class="text-uppercase font-weight-bold wow fadeIn" data-wow-delay="0.4s" style="visibility: visible; animation-name: fadeIn; animation-delay: 0.4s;"><mark>Web developer</mark></h5>
								<a href="#about" class="btn btn-floating btn-large wow fadeIn waves-effect waves-light" data-wow-delay="0.4s" data-offset="100" style="visibility: visible; animation-name: fadeIn; animation-delay: 0.4s;"><i class="fas fa-angle-down" aria-hidden="true"></i></a>
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
		<div class="container">

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
		<div class="container-fluid" style="background-color: #f3f3f5;">
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
								<p class="font-weight-bold ml-1 dark-grey-text mb-2">August, 2018 - Present ()</p>
								<p class="mb-0 ml-1 light-grey-text">Working with the great company called Xenial, Inc. We build Digital Menu Boards for restaurants. So when you get something to eat from fast food restaurants, and you see the animated menus, you'll know who made them.</p>
							</blockquote>

							<blockquote class="blockquote bq-warning mt-1 mb-4">
								<div class="row"> <i class="fas fa-briefcase fa-x mb-1 mr-3 ml-3 dark-grey-text" aria-hidden="true"></i>
									<h5 class="font-weight-bold mb-3">Freelance PHP developer</h5> </div>
								<p class="font-weight-bold ml-1 dark-grey-text mb-2">November 2013 - Present ()</p>
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

		<!-- Third container -->
		<div class="container">

			<!-- Section About -->
			<section class="section feature-box my-5 pb-5">

				<!-- Section title -->
				<h2 class="text-center text-uppercase my-5 pt-5 wow fadeIn" data-wow-delay="0.2s" style="visibility: visible; animation-name: fadeIn; animation-delay: 0.2s;">Process of <strong>creating</strong></h2>
				<p class="text-center w-responsive mx-auto wow fadeIn my-5" data-wow-delay="0.2s" style="visibility: visible; animation-name: fadeIn; animation-delay: 0.2s;"> Lorem ipsum dolor sit amet, consectetur adipisicing elit. Laborum quas, eos officia maiores ipsam ipsum dolores reiciendis ad voluptas, animi obcaecati adipisci sapiente mollitia.</p>

				<!-- Nav tabs -->
				<ul class="nav md-tabs nav-justified blue" role="tablist">
					<li class="nav-item">
						<a class="nav-link active show" data-toggle="tab" href="#panel1" role="tab" aria-selected="true">01. Research</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" data-toggle="tab" href="#panel2" role="tab" aria-selected="false">02. Design</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" data-toggle="tab" href="#panel3" role="tab" aria-selected="false">03. Development</a>
					</li>
				</ul>
				<!-- Tab panels -->
				<div class="tab-content card">
					<!--Panel 1-->
					<div class="tab-pane fade in active show" id="panel1" role="tabpanel">
						<br>
						<div class="row mt-2">
							<div class="col-2 text-center"> <i class="fas fa-search fa-3x mb-1 grey-text" aria-hidden="true"></i> </div>
							<div class="col-9 mb-2">
								<p class="dark-grey-text">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Nihil odit magnam minima, soluta doloribus reiciendis molestiae placeat unde eos molestias. Quisquam aperiam, pariatur. Tempora, placeat ratione porro voluptate odit minima.</p>
							</div>
						</div>
					</div>
					<!--/.Panel 1-->

					<!--Panel 2-->
					<div class="tab-pane fade" id="panel2" role="tabpanel">
						<br>
						<div class="row mt-2">
							<div class="col-2 text-center"> <i class="fas fa-pencil-alt fa-3x mb-1 grey-text" aria-hidden="true"></i> </div>
							<div class="col-9 mb-2">
								<p class="dark-grey-text">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Nihil odit magnam minima, soluta doloribus reiciendis molestiae placeat unde eos molestias. Quisquam aperiam, pariatur. Tempora, placeat ratione porro voluptate odit minima. Lorem ipsum dolor sit amet, consectetur adipisicing elit.</p>
							</div>
						</div>
					</div>
					<!--/.Panel 2-->

					<!--Panel 3-->
					<div class="tab-pane fade" id="panel3" role="tabpanel">
						<br>
						<div class="row mt-2">
							<div class="col-2 text-center"> <i class="fas fa-codefa-3x mb-1 grey-text" aria-hidden="true"></i> </div>
							<div class="col-9 mb-2">
								<p class="dark-grey-text">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Nihil odit magnam minima, soluta doloribus reiciendis molestiae placeat unde eos molestias. Quisquam aperiam, pariatur. Tempora, placeat ratione porro voluptate odit minima. Lorem ipsum dolor sit amet, consectetur adipisicing elit.</p>
							</div>
						</div>
					</div>
					<!--/.Panel 3-->
				</div>
				<!-- /.Tab panels -->
			</section>
			<!-- /.Section -->

		</div>
		<!-- /.Third container -->

		<!-- Streak -->
		<div class="streak streak-photo streak-md" style="background-image:url('https://mdbootstrap.com/img/Photos/Horizontal/Work/12-col/img%20%2811%29.jpg')">
			<div class="mask flex-center rgba-indigo-strong">
				<div class="white-text smooth-scroll mx-4">
					<h2 class="h2-responsive wow fadeIn mb-5" style="visibility: visible; animation-name: fadeIn;"><i class="fas fa-quote-left" aria-hidden="true"></i> Design is not just what it looks like and feels like. Design is how it works. <i class="fas fa-quote-right" aria-hidden="true"></i></h2>
					<h5 class="text-center font-italic wow fadeIn" data-wow-delay="0.2s" style="visibility: visible; animation-name: fadeIn; animation-delay: 0.2s;">~ Steve Jobs</h5>
				</div>
			</div>
		</div>
		<!-- /.Streak -->

		<!-- Fourth container -->
		<div class="container">

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

							<div class="col-4" id="">
								<h2>Eastcoast</h2>
							</div>

							<div class="col-4" id="">
								<h2>ToTheRec</h2>
							</div>

							<div class="col-4" id="">
								<h2>RentalHomes</h2>
							</div>

							<div class="col-4" id="">
								<h2>JGReunion</h2>
							</div>

							<div class="col-4" id="">
								<h2>Spades</h2>
							</div>

							<div class="col-4" id="">
								<h2>Wedding</h2>
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
		<!-- /.Fourth container -->

		<!-- Contact form -->
		<div id="contact" class="container">

			<!-- Section: Contact v.2 -->
			<section id="contact" class="section pb-5 wow fadeIn" data-wow-delay="0.3s" style="visibility: visible; animation-name: fadeIn; animation-delay: 0.3s;">

				<!-- Section heading -->
				<h2 class="section-heading h1 pt-4">Contact us</h2>
				<!-- Section description -->
				<p class="section-description">Just like Insomnia Cookie, we stay open late. Drop us a line anytime, we'll get back to you as soon as possible&nbsp;<i class="fa fa-smile-o" aria-hidden="true"></i></p>

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
											<input type="text" id="contact-name" class="form-control" name="message_name" value="{{ old('message_name') }}" {{ $errors->any() ? 'autofocus' : '' }}>
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
											<input type="text" id="contact-email" class="form-control" name="message_email" value="{{ old('message_email') }}">
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
										<input type="text" id="contact-Subject" class="form-control" name="message_subject" value="{{ old('message_subject') }}">
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
										<textarea type="text" name="message_body" id="contact-message" class="md-textarea form-control" rows="3">{{ old('message_body') }}</textarea>
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

		<div class="streak1">
			<div class="flex-center">
				<ul class="list-unstyled">
					<li><h2 class="h2-responsive mt-5 wow fadeIn" style="visibility: visible; animation-name: fadeIn;">Want an outstanding project?</h2></li>
					<li><h5 class="h5-responsive wow fadeIn" data-wow-delay="0.2s" style="visibility: visible; animation-name: fadeIn; animation-delay: 0.2s;">Just send me a message!</h5></li>
				</ul>
			</div>
		</div>

		<!-- /.Customers carousel -->

	</main>
	<!--/Main layout-->
@endsection
