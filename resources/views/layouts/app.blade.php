<!DOCTYPE html>
<html>
<title>Nghe nhạc trực tuyến</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="{{ asset('css/w3/w3.css') }}">
{{-- <link rel="stylesheet" href="http://www.w3schools.com/lib/w3-theme-blue-grey.css"> --}}
<link rel="stylesheet" type="text/css" href="{{ asset('css/w3/w3-theme-blue-grey.css') }}">
<link rel='stylesheet' href='{{ asset('css/font/font-open-sans.css') }}'>
<link rel="stylesheet" href="{{ asset('font-awesome-4.7.0/css/font-awesome.min.css') }}">
<style>
	html,body,h1,h2,h3,h4,h5 {font-family: "Open Sans", sans-serif}
</style>
<link rel="stylesheet" type="text/css" href="{{ asset('css/app.css') }}">
@stack('styles')
<body class="w3-theme-l5">
	@include('layouts.navbar')
	<!-- Page Container -->
	<div class="w3-container w3-content" style="max-width:1400px;margin-top:80px;">    
		<!-- The Grid -->
		<div style="max-width: 980px; min-height: 85vh; margin: auto;">
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

</body>
</html> 
