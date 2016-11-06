<!DOCTYPE html>
<html>
<title>Nghe nhạc trực tuyến</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
{{-- <link rel="stylesheet" type="text/css" href="{{ asset('mdl/material.min.css') }}"> --}}
<link rel="stylesheet" href="{{ asset('css/w3/w3.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('css/w3/w3-theme-blue-grey.css') }}">
<link rel='stylesheet' href='{{ asset('css/font/font-open-sans.css') }}'>
<link rel="stylesheet" href="{{ asset('font-awesome-4.7.0/css/font-awesome.min.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('select2-4.0.3/dist/css/select2.min.css') }}">
{{-- <script src="{{ asset('mdl/material.min.js') }}"></script> --}}
<script src="{{ asset('js/jquery-3.1.1.min.js',env('HTTPS_ASSET')) }}"></script>
<script src="{{ asset('select2-4.0.3/dist/js/select2.full.js') }}"></script>
<!--<style>
	html,body,h1,h2,h3,h4,h5 {font-family: "Open Sans", sans-serif}
</style>-->
<link rel="stylesheet" type="text/css" href="{{ asset('css/app.css') }}">
@stack('styles')
<body class="w3-theme-l5">
	@include('layouts.navbar')
	<!-- Page Container -->
	<div class="w3-container w3-content" style="width:100%;margin-top:50px;">
		<!-- The Grid -->
		<div id="the-grid">
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
</script>

@stack('scripts')

</body>
</html> 
