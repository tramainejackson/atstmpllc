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
	<!--/Main Navigation-->
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
		<div class="view jarallax" data-jarallax='{"speed": 0.2}' style="background-image: url({{ asset('/images/mdb_template_image.jpg') }}); height: 1109px;">
			<div class="full-bg-img">
				<div class="mask rgba-white-light">
					<div class="container flex-center text-center">
						<div class="row mt-md-5">
							<div class="col-md-12 wow fadeIn mb-3 smooth-scroll">
								<h1 class="display-1 mb-2 wow fadeInDown" data-wow-delay="0.3s">ATSTPM<a class="indigo-text font-weight-bold">LLC</a></h1>
								<h5 class="text-uppercase mb-3 mt-1 font-weight-bold wow fadeIn" data-wow-delay="0.4s">Anthony and Tramaine Several Trendy Metropolitan Places</h5>
								<a href="#about_us" class="btn btn-light-blue btn-lg wow fadeIn" data-wow-delay="0.4s" data-offset="50">About Us</a>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>

		<div class="container my-4" id="about_us">

		  <!--Grid row-->
		  <div class="row">

			  <!--Grid column-->
			  <div class="col-md-12 text-center mb-3">

				  <h1 class="font-weight-bold light-blue-text my-3">What we do! And how we do it!</h1>
				  <p align="justify">First thing we always get asked is where we came up with the name of our LLC. It all started some years ago when we were still wet behind the ears trying to figure life out. We bought a property and decided that was the path that we were going to take in life. We're going to buy houses, fix them up and rent them out. He's (Anthony) from Maryland, and I'm (Tramaine) from Philly. We had plans on buying any and everything up and down I95. Things didn't happen that way, but we were too ambitious to just sit on cheeks and let life pass us by. So on to the next hustle! With both of us being in the IT field, we decided to do some IT ish. I decided to teach myself how to design and build websites, he learned how to build and maintain databases. Boom! Second hustle established. What's next for us? We can't give it all away just yet but check back soon.</p>

			  </div>
			  <!--Grid column-->

		  </div>
		  <!--Grid row-->

		</div>

		<div class="view jarallax" data-jarallax='{"speed": 0.2}' style="background-image: url({{ asset('/images/anthony_motocycle.jpg') }});">
		  <div class="full-bg-img">
			<div class="mask rgba-grey-slight"></div>
		  </div>
		</div>

		<div class="view jarallax" data-jarallax='{"speed": 0.2}' style="background-image: url({{ asset('/images/elegant_bgrd.jpg') }});">
			<div class="full-bg-img">
				<div class="mask rgba-green-light">
					<div class="container">
						<div class="d-flex align-items-center d-flex justify-content-center" style="height: 700px">
							<div class="row mt-5">
								<div class="col-md-12 wow fadeIn mb-3">
									<div class="intro-info-content text-center smooth-scroll">
										<h1 class="display-1 white-text mb-2 wow fadeInDown" data-wow-delay="0.3s">Welcome on our page!</h1>
										<h4 class="mb-3 mt-1 white-text font-weight-bold wow fadeIn" data-wow-delay="0.4s">We trust the process</h4>
										<a href="#atstmpllc_desc" class="btn btn-orange wow fadeIn" data-wow-delay="0.4s">Read more</a>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>

		<div class="container p-5" id="atstmpllc_desc">

			<!--Grid row-->
			<div class="row">

				<!--Grid column-->
				<div class="col-md-12 text-center my-3">

					<h1 class="font-weight-bold deep-orange-text mb-3">Everybody could use a little help managing their business.</h1>
					<p align="justify">As we started to grow our endevors, I decided that we needed a way to manage our transactions, and receipts and account and all that other good stuff that comes along with management. We could have easily purchased some software that everything we needed it to do and tons of stuff we didn't need it to do. So we decided to come up with something simple and quick and our own since we both are in the IT field and love the challenge of a new project. Now we can manage the small business that we have that's tailored to our basic needs. That's what this site is all about. Register an account <i class="fa fa-long-arrow-right orange-text" aria-hidden="true"></i> add your users <i class="fa fa-long-arrow-right yellow-text" aria-hidden="true"></i> add your accounts <i class="fa fa-long-arrow-right green-text" aria-hidden="true"></i> and manage the small transactions that you encounter. Easy peasy lemon squeezy. Make a simple life simpler. If you want to give it a go, click <a href="http://atstmpllc.com/register" class="">here</a> and register an account. And like I mentioned, we're always up for a challenge so if you think of something we could add to make it better, let us know.</p>

				</div>
				<!--Grid column-->
			</div>
			<!--Grid row-->
		
			<hr class="my-5">
		
		</div>

	</header>
	<!--/Main Navigation-->
	
	<!--Main Content-->
	<main>
		<div class="container">

			<!-- Section: Team v.3 -->
			<section id="team" class="section team-section pb-4 wow fadeIn" data-wow-delay="0.3s" style="visibility: visible; animation-name: fadeIn; animation-delay: 0.3s;">

				<!-- Section heading -->
				<h2 class="section-heading h1 pt-5">Our amazing team</h2>
				<!-- Section description -->
				<p class="section-description"><i class="fa fa-quote-left fa-2x blue-text" aria-hidden="true"></i>&nbsp;He told me it's not many of us. I told him less is more it's plenty of us&nbsp;<i class="fa fa-quote-right fa-2x blue-text" aria-hidden="true"></i></p>

				<!-- Grid row -->
				<div class="row mb-lg-4 text-center text-md-left">

					<!-- Grid column -->
					<div class="col-lg-6 col-md-12 mb-4">

						<div class="col-md-6 float-left">
							<div class="avatar mx-auto">
								<img src="{{ asset('/images/anthony_o.jpg') }}" class="z-depth-1" alt="Anthony avatar image">
							</div>
						</div>

						<div class="col-md-6 float-right">
							<h4><strong>Tramaine Jackson</strong></h4>
							<h6 class="font-weight-bold grey-text mb-4">Web Designer</h6>
							<p class="grey-text">I woke up one day and said I want to change my profession. And that's what I did! I taught myself how to design websites. Now I design and host websites on my own private server. How bout them apples</p>

							<!-- LinkedIn -->
							<a class="p-2 m-2 fa-lg li-ic"><i class="fab fa-linkedin"></i></a>
							<!-- Github -->
							<a class="p-2 m-2 fa-lg git-ic"><i class="fab fa-github"></i></a>
							<!-- PayPal -->
							<a class="p-2 m-2 fa-lg orange-text"><i class="fas fa-basketball-ball"></i></a>
						</div>

					</div>
					<!-- Grid column -->

					<!-- Grid column -->
					<div class="col-lg-6 col-md-12 mb-4">

						<div class="col-md-6 float-left">
							<div class="avatar mx-auto">
								<img src="{{ asset('/images/anthony_o.jpg') }}" class="z-depth-1" alt="Second sample avatar image">
							</div>
						</div>

						<div class="col-md-6 float-right">
							<h4><strong>Anthony Oghogho</strong></h4>
						   <h6 class="font-weight-bold grey-text mb-4">Database Administrator</h6>
							<p class="grey-text">I'm just dope!</p>

							<!-- Facebook -->
							<a class="p-2 m-2 fa-lg fb-ic"><i class="fab fa-facebook"></i></a>
							<!-- YouTube -->
							<a class="p-2 m-2 fa-lg yt-ic"><i class="fab fa-youtube"></i></a>
							<!-- Instagram -->
							<a class="p-2 m-2 fa-lg ins-ic"><i class="fab fa-instagram"></i></a>
						</div>

					</div>
					<!-- Grid column -->

				</div>
				<!-- Grid row -->

			</section>
			<!-- Section: Team v.3 -->

			<hr class="my-5">

			<!-- Section: Affiliations v.1 -->
			<section id="affiliations" class="text-center wow fadeIn" data-wow-delay="0.3s" style="visibility: visible; animation-name: fadeIn; animation-delay: 0.3s;">

				<!-- Section heading -->
				<h1 class="section-heading h1 py-5">We Know The Plug&nbsp;<i class="fa fa-plug" aria-hidden="true"></i></h1>
				<!-- Section description -->
				<p class="section-description lead grey-text">Through all of our endevors we've met some amazing people on the way. So as the kids would say, we got the plug. Check out some of the people we may be affiliated with.</p>

				<!-- Grid row -->
				<div class="row">

					<!-- Grid column -->
					<div class="col-md-4 mb-4">
						<div class="row">
							<div class="col-12">
								<i class="fas fa-4x fa-home pink-text"></i>
							</div>
							<div class="col-12">
								<h4 class="font-weight-bold my-4">Houses</h4>
							</div>
							<div class="col-12 order-4 order-md-3">
								<p class="grey-text">One of our favorite go to people for anything house related is Lorenzo Jackson. He does it all and knows it all when it comes to this real estate game. Don't believe me? Check him out!</p>
							</div>
							<div class="col-12 order-3 order-md-4">
								<a href="http://jacksonrentalhomesllc.com" class="btn btn-lg pink">Website</a>
							</div>
						</div>
					</div>
					<!-- Grid column -->

					<!-- Grid column -->
					<div class="col-md-4 mb-4">
						<div class="row">
							<div class="col-12">
								<i class="fab fa-4x fa-sketch cyan-text"></i>
							</div>
							<div class="col-12">
								<h4 class="font-weight-bold my-4">Design</h4>
							</div>
							<div class="col-12 order-4 order-md-3">
								<p class="grey-text">This one belongs to yours truly. I'm a web developer with about 4+ years of experience. You need something built with your personal touch on it? Let me know and I'll get it going for you.</p>
							</div>
							<div class="col-12 order-3 order-md-4">
								<a href="{{ route('portfolio') }}" class="btn btn-lg cyan">Potfolio</a>
							</div>
						</div>
					</div>
					<!-- Grid column -->

					<!-- Grid column -->
					<div class="col-md-4 mb-4">
						<div class="row">
							<div class="col-12">
								<i class="fas fa-4x fa-plane indigo-text"></i>
							</div>
							<div class="col-12">
								<h4 class="font-weight-bold my-4">Travel</h4>
							</div>
							<div class="col-12 order-4 order-md-3">
								<p class="grey-text">Got places you need to get to, check with Debbie and Rhonda. They'll get you where you need to go for the best price. They also have group trips if your looking to meet new people and have a good time</p>
							</div>
							<div class="col-12 order-3 order-md-4">
								<a href="http://eastcoast2westcoast.com" class="btn btn-lg indigo">Website</a>
							</div>
						</div>
					</div>
					<!-- Grid column -->

				</div>
				<!-- Grid row -->

			</section>
			<!-- Section: Features v.1 -->

			<hr class="my-5">

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
	</main>
	<!--/Main Content-->
@endsection
