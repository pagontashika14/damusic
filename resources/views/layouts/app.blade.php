<!DOCTYPE html>
<html>
<title>Nghe nhạc trực tuyến</title>
<meta name="viewport" content="width=device-width, initial-scale=1">

<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="/bootstrap-3.3.7-dist/css/bootstrap.min.css">

<link rel="stylesheet" href="/css/w3/w3.css">
<link rel="stylesheet" type="text/css" href="/css/w3/w3-theme-blue-grey.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Miriam+Libre:400,700|Source+Sans+Pro:200,400,700,600,400italic,700italic">

<link rel="stylesheet" href="/font-awesome-4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" type="text/css" href="/select2-4.0.3/dist/css/select2.min.css">
<link rel="stylesheet" type="text/css" href="/css/pagination.css">

<link rel="stylesheet" type="text/css" href="/ion.rangeSlider-2.1.4/css/ion.rangeSlider.css">
<link rel="stylesheet" type="text/css" href="/ion.rangeSlider-2.1.4/css/ion.rangeSlider.skinHTML5.css">
<link rel="stylesheet" type="text/css" href="/tooltipster/css/tooltipster.bundle.min.css">
<link rel="stylesheet" type="text/css" href="/tooltipster/css/tooltipster-sideTip-punk.min.css">
<link rel="stylesheet" type="text/css" href="/dat-audio-player/style.css">


<link rel="stylesheet" type="text/css" href="/css/app.css">
@stack('styles')
<body class="w3-theme-l5">
	@include('layouts.navbar')
	<!-- Page Container -->
	<div id="audio-search-bar" class="search-bar w3-card-4">
		<div class="search-content w3-display-container">
			<i id="icon-search" class="fa fa-search icon-search w3-display-left" aria-hidden="true" style="font-size:30px;"></i>
			<input id="audio-search-input" class="search-input w3-display-right" type="text">
			<i id="icon-go" class="fa fa-arrow-circle-right w3-display-left icon-go" aria-hidden="true" style="font-size:30px;"></i>
		</div>
	</div>
	<div id="dimmer"></div>
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
@include('general.create-image-modal')
@include('general.create-singer-modal')
@include('general.create-type-modal')
@include('general.create-playlist-modal')
<iframe id="i-download" style="display:none;"></iframe>
<!-- Footer -->
<!--<footer class="w3-container w3-theme-d3 w3-padding-16">
	
	<h5>About me</h5>
</footer>

<footer class="w3-container w3-theme-d5">
	<p>Designed and Developed by Dương Tuấn Đạt, 2016</p>
</footer>-->
<script src="/js/jquery-3.1.1.min.js"></script>
<script src="/bootstrap-3.3.7-dist/js/bootstrap.min.js"></script>
<script src="/select2-4.0.3/dist/js/select2.full.js"></script>
<script src="/js/pagination.js"></script>
<script src="/js/notify.min.js"></script>
<script src="/js/underscore-min.js"></script>
<script src="/slim-scroll/jquery.slimscroll.min.js"></script>
<script src="/ion.rangeSlider-2.1.4/js/ion-rangeSlider/ion.rangeSlider.min.js"></script>
<script src="/tooltipster/js/tooltipster.bundle.min.js"></script>
<script src="/dat-audio-player/dat-audio-player.js"></script>
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

	function Download(url) {
		// document.getElementById('i-download').filename = 'abc.mp3';
		// document.getElementById('i-download').src = url;
		
	};
</script>

<script src="/js/app.js"></script>
<script>
	var appController = new DaMusic.Controller.App();
</script>
@stack('scripts')

</body>
</html> 
