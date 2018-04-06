<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Jackson Rental Homes Contact</title>
	
	<style>
		*, ::after, ::before {
			box-sizing: border-box;
		}

		.container {
			width: 100%;
			padding-right: 15px;
			padding-left: 15px;
			margin-right: auto;
			margin-left: auto;
			background-color: white;
		}
		
		body {
			min-height: 100vh;
			background-color: gray;
		}
		
		div#app {
			min-height: 100vh;
		}

		.ml-auto, .mx-auto {
			margin-left: auto!important;
		}
		
		.mr-auto, .mx-auto {
			margin-right: auto!important;
		}

		.align-items-center {
			-webkit-box-align: center!important;
			-ms-flex-align: center!important;
			align-items: center!important;
		}

		.justify-content-center {
			-webkit-box-pack: center!important;
			-ms-flex-pack: center!important;
			justify-content: center!important;
		}
		
		.row {
			display: -webkit-box;
			display: -ms-flexbox;
			display: flex;
			-ms-flex-wrap: wrap;
			flex-wrap: wrap;
			margin-right: -15px;
			margin-left: -15px;
		}

		.col-12 {
			-webkit-box-flex: 0;
			-ms-flex: 0 0 100%;
			flex: 0 0 100%;
			max-width: 100%;
		}
		
		.col, .col-1, .col-10, .col-11, .col-12, .col-2, .col-3, .col-4, .col-5, .col-6, .col-7, .col-8, .col-9, .col-auto, .col-lg, .col-lg-1, .col-lg-10, .col-lg-11, .col-lg-12, .col-lg-2, .col-lg-3, .col-lg-4, .col-lg-5, .col-lg-6, .col-lg-7, .col-lg-8, .col-lg-9, .col-lg-auto, .col-md, .col-md-1, .col-md-10, .col-md-11, .col-md-12, .col-md-2, .col-md-3, .col-md-4, .col-md-5, .col-md-6, .col-md-7, .col-md-8, .col-md-9, .col-md-auto, .col-sm, .col-sm-1, .col-sm-10, .col-sm-11, .col-sm-12, .col-sm-2, .col-sm-3, .col-sm-4, .col-sm-5, .col-sm-6, .col-sm-7, .col-sm-8, .col-sm-9, .col-sm-auto, .col-xl, .col-xl-1, .col-xl-10, .col-xl-11, .col-xl-12, .col-xl-2, .col-xl-3, .col-xl-4, .col-xl-5, .col-xl-6, .col-xl-7, .col-xl-8, .col-xl-9, .col-xl-auto {
			position: relative;
			width: 100%;
			min-height: 1px;
			padding-right: 15px;
			padding-left: 15px;
		}
		
		.flex-column {
			-webkit-box-orient: vertical!important;
			-webkit-box-direction: normal!important;
			-ms-flex-direction: column!important;
			flex-direction: column!important;
		}

		.d-flex {
			display: -webkit-box!important;
			display: -ms-flexbox!important;
			display: flex!important;
		}
		
		.separator {
			padding: 20px;
			width: 100%;
			background-color: #5b955a;
		}
		
		.mb-3 {
			margin-bottom: 10px;
		}
		
		@media (min-width: 576px) {
			.container {
				max-width: 540px;
			}
		}
		
		@media (min-width: 768px) {
			.container {
				max-width: 720px;
			}
			
			.ml-md-auto, .mx-md-auto {
				margin-left: auto!important;
			}
			
			.mb-3 {
				margin-bottom: 0px;
			}
			
			.mr-md-0, .mx-md-0 {
				margin-right: 0!important;
			}
		}
		
		@media (min-width: 992px) {
			.container {
				max-width: 960px;
			}
			
			.col-lg-6 {
				-webkit-box-flex: 0;
				-ms-flex: 0 0 50%;
				flex: 0 0 50%;
				max-width: 50%;
			}
		}
		
		@media (min-width: 1200px) {
			.container {
				max-width: 1140px;
			}
		}
		
		@media (min-width: 1400px) {
            p, h3 {
                font-size: 150%;
            }
        }
		
	</style>
</head>
<body>
    <div id="app" class="container white">
		<div class="row">
			<div class="col-lg-6 col-12" style="padding: 20px 20px;">
				<h2 class="">ATSTMP<span><b>LLC</b></span></h2>
			</div>
			<div class="col-lg-6 col-12 d-flex flex-column">
				@if(isset($guest))
					<h2 class="">Thanks for reaching out to us. We did receive your message. Below is the message that we received from you. We will respond as soon as possible.</h2>
				@endif
				<h3 class="ml-md-auto mr-auto mr-md-0">New Message</h3>
				<div class="ml-md-auto mb-3 mr-auto mr-md-0">
					<a href="https://atstmpllc.com/login" class="" target="_blank">Login</a> |
					<a href="https://atstmpllc.com/register" class="" target="_blank">Register</a> |
					<a href="https://atstmpllc.com/about_us" class="" target="_blank">About Us</a>
				</div>
			</div>
			<div class="separator"></div>
			<div class="col-12">
				<h3 class="" style="padding: 10px 0px;"><u>New Message:</u></h3>
				<p style="padding: 0px 35px 15px;">{{ $body }}</p>
				<p style="padding: 0px 35px 15px;">Thanks you, <br/><br/>Have a nice day</p>
			</div>
			<footer style="border-bottom:1px solid gray; text-align: center; background: #5b955a; color: whitesmoke; padding: 35px; width:100% !important;">
				<h3 class="">Email: atstmpllc@gmail.com</h3>
				<h4 style="">2017 {{ config('app.name') }}. All rights reserved.</h4>
			</footer>
		</div>
	</div>
</body>