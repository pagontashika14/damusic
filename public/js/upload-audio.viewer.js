function openTab(evt, tabName) {
	var clas = " w3-teal";
	var i, x, tablinks;
	x = document.getElementsByClassName("tab-type");
	for (i = 0; i < x.length; i++) {
		x[i].style.display = "none";
	}
	tablinks = document.getElementsByClassName("tablink");
	for (i = 0; i < x.length; i++) {
		tablinks[i].className = tablinks[i].className.replace(clas, "");
	}
	document.getElementById(tabName).style.display = "block";
	evt.currentTarget.className += clas;
}
$('#basic-info').css("display","block");
$('#tab1').addClass('w3-teal');


$(document).ready(function() {
	$("#nghe-si").select2({
		ajax: {
			url:  '/api/search/singer',
			delay: 250,
			data: function (params) {
				console.log(1);
				var query = {
					search: params.term
				}
				return query;
			},
			processResults: function (data, params) {
				return {
					results: data,
				};
			},
		},
		minimumInputLength: 1,
	});
});

$('#btn-audio-files').on('click',function(){
	$('#audio-files').click();
});

$('#audio-files').change(function(event) {
	var audioFiles = $('#audio-files')[0].files;
	audioFiles
});