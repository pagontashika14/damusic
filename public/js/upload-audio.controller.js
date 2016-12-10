var DaMusic = DaMusic || {};
DaMusic.Controller = DaMusic.Controller || {};

(function(Controller){
	Controller.UploadAudio = function(){
		var self = this;
		$('#audio-info').hide();
		$('#basic-info').css("display","block");
		$('#tab1').addClass('w3-teal');
		$(document).ready(function() {
			$("#singers").select2({
				ajax: {
					url:  '/api/singer/search',
					delay: 250,
					data: function (params) {
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
				placeholder: 'Tìm kiếm...',
				allowClear: true
			});
			$("#composer").select2({
				ajax: {
					url:  '/api/singer/search',
					delay: 250,
					data: function (params) {
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
				placeholder: 'Tìm kiếm...',
				allowClear: true
			});
			$("#nation").select2({
				ajax: {
					url:  '/api/nation/search',
					processResults: function (data, params) {
						var results = [];
						data.forEach(function(e){
							results.push({id:e.id,text:e.name});
						});
						return {
							results: results,
						};
					},
					cache: true
				},
				placeholder: 'Chọn quốc gia',
			});
			$("#types").select2({
				ajax: {
					url:  '/api/type/search',
					processResults: function (data, params) {
						var results = [];
						data.forEach(function(e){
							results.push({id:e.id,text:e.name});
						});
						return {
							results: results,
						};
					},
					cache: true
				},
				placeholder: 'Tìm kiếm...',
				allowClear: true
			});
		});
		$('#btn-audio-files').on('click',function(){
			$('#audio-files').click();
		});
		$('#audio-files').change(function(event) {
			self.audioFiles = $('#audio-files')[0].files;
			self.ShowFilesNameToDiv();
		});
		self.progressPercent = 0;
	}

	Controller.UploadAudio.prototype.SwitchTab = function(evt, tabName) {
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

	Controller.UploadAudio.prototype.ShowFilesNameToDiv = function(){
		var self = this;
		$('#show-files').html('');
		if (self.audioFiles.length > 0) {
			$('#show-files-note').hide();
			$('#audio-info').show();
			for (var i = 0,len = self.audioFiles.length; i < len; i++) {
				$('#show-files').append('<p>'+self.audioFiles[i].name+' ~ '+(self.audioFiles[i].size/1024/1024).toFixed(2)+' MB</p>');
			}
		} else {
			$('#show-files-note').show();
			$('#audio-info').hide();
		}
	}

	Controller.UploadAudio.prototype.SetPercentOfProgress = function(percent){
		var self = this;
		percent = percent.toFixed(1);
		$('#progress').attr('style', 'width: ' + percent + '%;');
		$('#progress-text').html(percent+'%');
		self.progressPercent = percent;
	}

	Controller.UploadAudio.prototype.UpLoad = function(){
		var self = this;
		function progress(e){
			if(e.lengthComputable){
				var max = e.total;
				var current = e.loaded;
				var percentage = (current * 100)/max;
				self.SetPercentOfProgress(percentage);
				if(percentage >= 100)
				{
					console.log('done');
				}
			}
		}
		if (self.audioFiles.length > 0) {
			var data = new FormData();
			for (var i = 0,len = self.audioFiles.length; i < len; i++) {
				data.append('audio[]',self.audioFiles[i]);
			}
			data.append('name',$('#name').val());
			data.append('nation_id',$('#nation').val());
			$('#singers').val().forEach(function(singerId){
				data.append('singers[]',singerId);
			});
			$('#types').val().forEach(function(typeId){
				data.append('types[]',typeId);
			});
			data.append('lyric',$('#lyric').val());
			data.append('user_id',sessionStorage.user_id);
			data.append('composer_id',$('#composer').val());
			$.ajax({
				url: '/api/audio/upload',
				method: 'POST',
				data: data,
				xhr: function() {
					var myXhr = $.ajaxSettings.xhr();
					if(myXhr.upload){
						myXhr.upload.addEventListener('progress',progress, false);
					}
					return myXhr;
				},
				cache:false,
				contentType: false,
				processData: false,
				success: function(results){
					
					console.log(results);
				},
				error: function(error){
					console.log('--error--');
					console.log(error);
					var data = error.responseText;
					myWindow = window.open("data:text/html," + encodeURIComponent(data),
					                       "_blank", "width=200,height=100");
					myWindow.focus();
				}
			});

		}
	}

})(DaMusic.Controller)