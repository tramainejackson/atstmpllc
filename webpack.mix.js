let mix = require('laravel-mix');

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel application. By default, we are compiling the Sass
 | file for the application as well as bundling up all the JS files.
 |
 */

mix.js([
		'resources/assets/js/app.js',
		'node_modules/jquery/dist/jquery.min.js',
		'node_modules/jquery-datetimepicker/build/jquery.datetimepicker.full.min.js',
		'node_modules/lightgallery.js/dist/js/lightgallery.min.js',
		'node_modules/magnific-popup/dist/jquery.magnific-popup.min.js',
		'node_modules/bootstrap/dist/js/bootstrap.js',
		'node_modules/mdbootstrap/js/mdb.min.js',
	   ], 'public/js')
	.js('node_modules/jquery/dist/jquery.min.js', 'public/js')
	.js('node_modules/materialize-css/dist/js/materialize.js', 'public/js')
	.styles([
		'node_modules/mdbootstrap/css/bootstrap.min.css',
		'node_modules/mdbootstrap/css/mdb.min.css',
	], 'public/css/mdb/all.css')
	.sass('resources/assets/sass/app.scss', 'public/css')
	.sass('node_modules/mdbootstrap/scss/mdb.scss', 'public/css/mdb')
	.sass('node_modules/materialize-css/sass/materialize.scss', 'public/css');
