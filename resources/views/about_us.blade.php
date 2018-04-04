@extends('layouts.app')

@section('styles')
	@include('layouts.styles.bootstrap_css')
	<style>
        .top-nav-collapse {
            background-color: #3f51b5!important;
        }
        .navbar:not(.top-nav-collapse) {
            background: transparent!important;
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

@section('scripts')
	@include('layouts.functions.bootstrap_js')
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
		<div class="view jarallax" data-jarallax='{"speed": 0.2}' style="background-image: url(https://mdbootstrap.com/img/Photos/Others/img%20%2844%29.jpg); height: 1109px;">
			<div class="full-bg-img">
			  <div class="mask rgba-white-light">
				<div class="container flex-center text-center">
				  <div class="row mt-5">
					<div class="col-md-12 wow fadeIn mb-3">
					  <h1 class="display-1 mb-2 wow fadeInDown" data-wow-delay="0.3s">ATSTPM<a class="indigo-text font-weight-bold">LLC</a></h1>
					  <h5 class="text-uppercase mb-3 mt-1 font-weight-bold wow fadeIn" data-wow-delay="0.4s">Anthony and Tramaine Several Trendy Metropolitan Places</h5>
					  <a class="btn btn-light-blue btn-lg wow fadeIn" data-wow-delay="0.4s">About Us</a>
					</div>
				  </div>
				</div>
			  </div>
			</div>
		</div>

		<div class="container" id="about_us">

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

		<div class="view jarallax" data-jarallax='{"speed": 0.2}' style="background-image: url(https://mdbootstrap.com/img/Photos/Others/food2.jpg);">
		  <div class="full-bg-img">
			<div class="mask rgba-pink-slight"></div>
		  </div>
		</div>

		<div class="view jarallax" data-jarallax='{"speed": 0.2}' style="background-image: url(https://mdbootstrap.com/img/Photos/Others/background.jpg);">
		  <div class="full-bg-img">
			<div class="mask rgba-purple-slight">
			  <div class="container">
				  <div class="d-flex align-items-center d-flex justify-content-center" style="height: 700px">
					  <div class="row mt-5">
						  <div class="col-md-12 wow fadeIn mb-3">
							  <div class="intro-info-content text-center">
								  <h1 class="display-1 white-text mb-2 wow fadeInDown" data-wow-delay="0.3s">Welcome on my page!</h1>
								  <h4 class="mb-3 mt-1 white-text font-weight-bold wow fadeIn" data-wow-delay="0.4s">Lorem ipsum dolor sit amet</h4>
								  <a class="btn btn-pink wow fadeIn" data-wow-delay="0.4s">Read more</a>
							  </div>
						  </div>
					  </div>
				  </div>
			  </div>
			</div>
		  </div>
		</div>

		<div class="container">

		  <!--Grid row-->
		  <div class="row">

			  <!--Grid column-->
			  <div class="col-md-12 text-center my-3">

				  <h1 class="font-weight-bold pink-text mb-3">Lorem ipsum dolor sit amet, consectetur quis elit.</h1>
				  <p align="justify">Lorem ipsum dolor sit amet, consectetur quis elit. Perspiciatis commodi porro, cumque provident rem corporis odit, ut quas dolores maxime nesciunt possimus quis, soluta velit debitis amet, veritatis cupiditate reprehenderit.Lorem ipsum dolor sit amet, consectetur quis elit. Perspiciatis commodi porro, cumque provident rem corporis odit, ut quas dolores maxime nesciunt possimus quis, soluta velit debitis amet, veritatis cupiditate reprehenderit.Lorem ipsum dolor sit amet, consectetur quis elit. Perspiciatis commodi porro, cumque provident rem corporis odit, ut quas dolores maxime nesciunt possimus quis, soluta velit debitis amet, veritatis cupiditate reprehenderit.Lorem ipsum dolor sit amet, consectetur quis elit. Perspiciatis commodi porro, cumque provident rem corporis odit, ut quas dolores maxime nesciunt possimus quis, soluta velit debitis amet, veritatis cupiditate reprehenderit.Lorem ipsum dolor sit amet, consectetur quis elit. Perspiciatis commodi porro, cumque provident rem corporis odit, ut quas dolores maxime nesciunt possimus quis, soluta velit debitis amet, veritatis cupiditate reprehenderit.Lorem ipsum dolor sit amet, consectetur quis elit. Perspiciatis commodi porro, cumque provident rem corporis odit, ut quas dolores maxime nesciunt possimus quis, soluta velit debitis amet, veritatis cupiditate reprehenderit.Lorem ipsum dolor sit amet, consectetur quis elit. Perspiciatis commodi porro, cumque provident rem corporis odit, ut quas dolores maxime nesciunt possimus quis, soluta velit debitis amet, veritatis cupiditate reprehenderit.Lorem ipsum dolor sit amet, consectetur quis elit. Perspiciatis commodi porro, cumque provident rem corporis odit, ut quas dolores maxime nesciunt possimus quis, soluta velit debitis amet, veritatis cupiditate reprehenderit.</p>

			  </div>
			  <!--Grid column-->

		  </div>
		  <!--Grid row-->

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
							<p class="grey-text">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quod eos id officiis hic tenetur.</p>

							<!-- Facebook -->
							<a class="p-2 m-2 fa-lg fb-ic"><i class="fa fa-facebook"> </i></a>
							<!-- Twitter -->
							<a class="p-2 m-2 fa-lg tw-ic"><i class="fa fa-twitter"> </i></a>
							<!-- Dribbble -->
							<a class="p-2 m-2 fa-lg dribbble-ic"><i class="fa fa-dribbble"> </i></a>
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
							<h4><strong>Anthony Ohghogho</strong></h4>
						   <h6 class="font-weight-bold grey-text mb-4">Database Administrator</h6>
							<p class="grey-text">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quod eos id officiis hic tenetur.</p>

							<!-- Facebook -->
							<a class="p-2 m-2 fa-lg fb-ic"><i class="fa fa-facebook"> </i></a>
							<!-- YouTube -->
							<a class="p-2 m-2 fa-lg yt-ic"><i class="fa fa-youtube"> </i></a>
							<!-- Instagram -->
							<a class="p-2 m-2 fa-lg ins-ic"><i class="fa fa-instagram"> </i></a>
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
						<i class="fa fa-home fa-4x pink-text" aria-hidden="true"></i>
						<h4 class="font-weight-bold my-4">Houses</h4>
						<p class="grey-text">One of our favorite go to people for anything house related is Lorenzo Jackson. He does it all and knows it all when it comes to this real estate game. Don't believe me? Check him out!</p>
						<a href="http://jacksonrentalhomesllc.com" class="btn btn-lg pink">Website</a>
					</div>
					<!-- Grid column -->

					<!-- Grid column -->
					<div class="col-md-4 mb-4">
						<i class="fa fa-4x fa-pencil cyan-text"></i>
						<h4 class="font-weight-bold my-4">Design</h4>
						<p class="grey-text">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Reprehenderit maiores nam, aperiam minima assumenda deleniti hic.</p>
					</div>
					<!-- Grid column -->

					<!-- Grid column -->
					<div class="col-md-4 mb-4">
						<i class="fa fa-4x fa-plane indigo-text"></i>
						<h4 class="font-weight-bold my-4">Travel</h4>
						<p class="grey-text">Got places you need to get to, check with Debbie and Rhonda. They'll get you where you need to go for the best price. They also have group trips if your looking to meet new people and have a good time</p>
						<a href="http://eastcoast2westcoast.com" class="btn btn-lg indigo">Website</a>
					</div>
					<!-- Grid column -->

				</div>
				<!-- Grid row -->

			</section>
			<!-- Section: Features v.1 -->

			<hr class="my-5">

			<!-- Section: Gallery -->
			<section id="gallery" class="section wow fadeIn" data-wow-delay="0.3s" style="visibility: visible; animation-name: fadeIn; animation-delay: 0.3s;">

				<!-- Section heading -->
				<h1 class="section-heading h1 pt-4">Our work</h1>
				<!-- Section description -->
				<p class="section-description">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam.</p>

				<div class="row pb-4">
					<div class="col-md-12">

						<div id="mdb-lightbox-ui"><!-- Root element of PhotoSwipe. Must have class pswp. -->
							<div class="pswp" tabindex="-1" role="dialog" aria-hidden="true">

								<!-- Background of PhotoSwipe. 
											 It's a separate element, as animating opacity is faster than rgba(). -->
								<div class="pswp__bg"></div>

								<!-- Slides wrapper with overflow:hidden. -->
								<div class="pswp__scroll-wrap">

									<!-- Container that holds slides. PhotoSwipe keeps only 3 slides in DOM to save memory. -->
									<!-- don't modify these 3 pswp__item elements, data is added later on. -->
									<div class="pswp__container">
										<div class="pswp__item"></div>
										<div class="pswp__item"></div>
										<div class="pswp__item"></div>
									</div>

									<!-- Default (PhotoSwipeUI_Default) interface on top of sliding area. Can be changed. -->
									<div class="pswp__ui pswp__ui--hidden">

										<div class="pswp__top-bar">

											<!--  Controls are self-explanatory. Order can be changed. -->

											<div class="pswp__counter"></div>

											<button class="pswp__button pswp__button--close" title="Close (Esc)"></button>

											<!--<button class="pswp__button pswp__button--share" title="Share"></button>-->

											<button class="pswp__button pswp__button--fs" title="Toggle fullscreen"></button>

											<button class="pswp__button pswp__button--zoom" title="Zoom in/out"></button>

											<!-- Preloader demo http://codepen.io/dimsemenov/pen/yyBWoR -->
											<!-- element will get class pswp__preloader--active when preloader is running -->
											<div class="pswp__preloader">
												<div class="pswp__preloader__icn">
													<div class="pswp__preloader__cut">
														<div class="pswp__preloader__donut"></div>
													</div>
												</div>
											</div>
										</div>

										<!--
												<div class="pswp__share-modal pswp__share-modal--hidden pswp__single-tap">
													<div class="pswp__share-tooltip"></div> 
												</div>
												-->

										<button class="pswp__button pswp__button--arrow--left" title="Previous (arrow left)">
										</button>

										<button class="pswp__button pswp__button--arrow--right" title="Next (arrow right)">
										</button>

										<div class="pswp__caption">
											<div class="pswp__caption__center"></div>
										</div>

									</div>

								</div>

							</div>
						</div>

						<div class="mdb-lightbox" data-pswp-uid="1">

							<figure class="col-md-4">
								<a href="https://mdbootstrap.com/img/Photos/Horizontal/Work/12-col/img%20(43).jpg" data-size="1600x1067">
									<img src="https://mdbootstrap.com/img/Photos/Horizontal/Work/12-col/img%20(43).jpg" class="img-fluid z-depth-1">
								</a>
							</figure>

							<figure class="col-md-4">
								<a href="https://mdbootstrap.com/img/Photos/Horizontal/Work/12-col/img%20(41).jpg" data-size="1600x1067">
									<img src="https://mdbootstrap.com/img/Photos/Horizontal/Work/6-col/img%20(41).jpg" class="img-fluid z-depth-1">
								</a>
							</figure>

							<figure class="col-md-4">
								<a href="https://mdbootstrap.com/img/Photos/Horizontal/Work/12-col/img%20(40).jpg" data-size="1600x1067">
									<img src="https://mdbootstrap.com/img/Photos/Horizontal/Work/6-col/img%20(40).jpg" class="img-fluid z-depth-1">
								</a>
							</figure>

							<figure class="col-md-4">
								<a href="https://mdbootstrap.com/img/Photos/Horizontal/Work/12-col/img%20(14).jpg" data-size="1600x1067">
									<img src="https://mdbootstrap.com/img/Photos/Horizontal/Work/12-col/img%20(14).jpg" class="img-fluid z-depth-1">
								</a>
							</figure>

							<figure class="col-md-4">
								<a href="https://mdbootstrap.com/img/Photos/Horizontal/Work/12-col/img%20(42).jpg" data-size="1600x1067">
									<img src="https://mdbootstrap.com/img/Photos/Horizontal/Work/6-col/img%20(42).jpg" class="img-fluid z-depth-1">
								</a>
							</figure>

							<figure class="col-md-4">
								<a href="https://mdbootstrap.com/img/Photos/Horizontal/People/12-col/img%20(132).jpg" data-size="1600x1067">
									<img src="https://mdbootstrap.com/img/Photos/Horizontal/People/12-col/img%20(132).jpg" class="img-fluid z-depth-1">
								</a>
							</figure>
							
						</div>
					</div>
				</div>

			</section>
			<!-- /Section: Gallery -->

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
						{!! Form::open(['action' => ['TransactionController@store'], 'files' => true, 'method' => 'POST']) !!}

							<!-- Grid row -->
							<div class="row">

								<!-- Grid column -->
								<div class="col-md-6">
									<div class="md-form">
										<div class="md-form">
											<input type="text" id="contact-name" class="form-control">
											<label for="contact-name" class="">Your name</label>
										</div>
									</div>
								</div>
								<!-- Grid column -->

								<!-- Grid column -->
								<div class="col-md-6">
									<div class="md-form">
										<div class="md-form">
											<input type="text" id="contact-email" class="form-control">
											<label for="contact-email" class="">Your email</label>
										</div>
									</div>
								</div>
								<!-- Grid column -->

							</div>
							<!-- Grid row -->

							<!-- Grid row -->
							<div class="row">
								<div class="col-md-12">
									<div class="md-form">
										<input type="text" id="contact-Subject" class="form-control">
										<label for="contact-Subject" class="">Subject</label>
									</div>
								</div>
							</div>
							<!-- Grid row -->

							<!-- Grid row -->
							<div class="row mb-4">

								<!-- Grid column -->
								<div class="col-md-12">

									<div class="md-form">
										<textarea type="text" id="contact-message" class="md-textarea form-control" rows="3"></textarea>
										<label for="contact-message">Your message</label>
									</div>

								</div>
							</div>
							<!-- Grid row -->

						{!! Form::close() !!}

						<div class="text-center text-md-left mb-4">
							<a class="btn btn-light-blue waves-effect waves-light">Send</a>
						</div>
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
