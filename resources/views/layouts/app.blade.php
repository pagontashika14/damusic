<!DOCTYPE html>
<html>
<title>Nghe nhạc trực tuyến</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
{{-- <link rel="stylesheet" type="text/css" href="{{ asset('mdl/material.min.css') }}"> --}}
{{-- <link rel="stylesheet" type="text/css" href="{{ asset('semantic/semantic.min.css') }}"> --}}
<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="{{ asset('bootstrap-3.3.7-dist/css/bootstrap.min.css') }}">

<link rel="stylesheet" href="{{ asset('css/w3/w3.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('css/w3/w3-theme-blue-grey.css') }}">
{{-- <link rel='stylesheet' href='{{ asset('css/font/font-open-sans.css') }}'> --}}
<link rel="stylesheet" href="{{ asset('font-awesome-4.7.0/css/font-awesome.min.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('select2-4.0.3/dist/css/select2.min.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('css/pagination.css') }}">
{{-- <link rel="stylesheet" type="text/css" href="{{ asset('ion.rangeSlider-2.1.4/css/normalize.css') }}"> --}}
<link rel="stylesheet" type="text/css" href="{{ asset('ion.rangeSlider-2.1.4/css/ion.rangeSlider.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('ion.rangeSlider-2.1.4/css/ion.rangeSlider.skinHTML5.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('tooltipster/css/tooltipster.bundle.min.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('tooltipster/css/tooltipster-sideTip-punk.min.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('dat-audio-player/style.css') }}">
{{-- <script src="{{ asset('mdl/material.min.js') }}"></script> --}}
<script src="{{ asset('js/underscore-min.js') }}"></script>
<script src="{{ asset('js/jquery-3.1.1.min.js',env('HTTPS_ASSET')) }}"></script>
<script src="{{ asset('bootstrap-3.3.7-dist/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('select2-4.0.3/dist/js/select2.full.js') }}"></script>
<script src="{{ asset('js/pagination.js') }}"></script>
{{-- <script src="{{ asset('semantic/semantic.min.js') }}"></script> --}}
{{-- <style>
	html,body,h1,h2,h3,h4,h5 {font-family: "Open Sans", sans-serif}
</style> --}}
<link rel="stylesheet" type="text/css" href="{{ asset('css/app.css') }}">
@stack('styles')
<body class="w3-theme-l5">
	@include('layouts.navbar')
	<!-- Page Container -->
	<div class="w3-container w3-content" style="width:100%;margin-top:50px;">
		<!-- The Grid -->
		<div id="the-grid" style="background-color: white; padding: 15px;">
			@yield('content')
		</div>

		<!-- End Grid -->
	</div>
	<!-- End Page Container -->
</div>
<br>

<!-- Footer -->
<footer class="w3-container w3-theme-d3 w3-padding-16">
	<h5>Footer</h5>
</footer>

<footer class="w3-container w3-theme-d5">
	<p>Powered by <a href="http://www.w3schools.com/w3css/default.asp" target="_blank">w3.css</a></p>
</footer>
{{-- <script src="{{ asset('js/jquery-3.1.1.min.js',env('HTTPS_ASSET')) }}"></script> --}}
<script>
// Accordion
function myFunction(id) {
	var x = document.getElementById(id);
	if (x.className.indexOf("w3-show") == -1) {
		x.className += " w3-show";
		x.previousElementSibling.className += " w3-theme-d1";
	} else { 
		x.className = x.className.replace("w3-show", "");
		x.previousElementSibling.className = 
		x.previousElementSibling.className.replace(" w3-theme-d1", "");
	}
}

// Used to toggle the menu on smaller screens when clicking on the menu button
function openNav() {
	var x = document.getElementById("navDemo");
	if (x.className.indexOf("w3-show") == -1) {
		x.className += " w3-show";
	} else { 
		x.className = x.className.replace(" w3-show", "");
	}
}

function uniqueId(name = '') {
	return name + (new Date().getTime()) + Math.round(Math.random() * 1000);
}
</script>
<script src="{{ asset('slim-scroll/jquery.slimscroll.min.js') }}"></script>
<script src="{{ asset('ion.rangeSlider-2.1.4/js/ion-rangeSlider/ion.rangeSlider.min.js') }}"></script>
<script src="{{ asset('tooltipster/js/tooltipster.bundle.min.js') }}"></script>
<script src="{{ asset('dat-audio-player/dat-audio-player.js') }}"></script>
<script src="{{ asset('js/app.js') }}"></script>
@stack('scripts')

</body>
</html> 
