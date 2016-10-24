function AudioPlayer (options){
	var _self = this;
	this.id = options.div_player[0].id;
	this.skin = options.skin;
	this.div_player = options.div_player;
	this.srcs = options.srcs;
	this.code = options.code;
	var isDragTimeSlider = false;
	var isPlaying = false;
	function BtnToPlay(){
		_self.btn_play.attr('class', 'fa fa-pause');
		_self.btn_play.attr('style', 'font-size: 16.5px;');
	}
	function BtnToPause(){
		_self.btn_play.attr('class', 'fa fa-play');
		_self.btn_play.attr('style', 'font-size: 18px;');
	}
	function GetSecondsFromPerThousand(thousand){
		return parseInt(thousand/1000*_self.audio.duration);
	}
	function SetupOrder(order){
		switch(order){
			case 'asc':{
				_self.orders = [];
				_self.srcs.forEach(function(mp3){
					_self.orders.push(mp3.code);
				});
				break;
			}
			case 'random':{
				break;
			}
		}
	}
	function GetOrderIndex(code){
		var i = 0;
		for (var len = _self.orders.length; i < len; i++) {
			if (code == _self.orders[i]) {
				return i;
			}
		}
		return 0;
	}
	function GetMp3(code){
		for (var i = 0,len = _self.srcs.length; i < len; i++) {
			if (_self.srcs[i].code == code) {
				return _self.srcs[i];
			}
		}
		return undefined;
	}
	function IsLastOrder(code){
		return GetOrderIndex(code) == _self.orders.length - 1;
	}
	function GetNextMp3(code){
		if (IsLastOrder(code)) {
			return GetMp3(_self.orders[0]);
		}
		else{
			return GetMp3(_self.orders[GetOrderIndex(code) + 1]);
		}
	}
	(function(){
		if (_self.skin == 'audio-single') {
			var aud_single = '<div style="width: 100%; min-width: 190px; height: 30px; background-color: #CED7F2; align-items: center; display: flex; border-radius: 5px;padding-left: 10px; padding-right: 12px;">\
				  <div style="align-items: center; display: flex; text-align: center; width: 125px;">\
					<i id="'+_self.id+'play" class="fa fa-play" style="font-size: 18px;"></i>\
					<span id="'+_self.id+'timecurrent" style="margin-left: 8px;">0:00</span><span style="margin-right: 2px; margin-left: 2px;">/</span><span id="'+_self.id+'duration">0:00</span>\
				  </div>\
				  <div style="width: 75%; padding-right: 10px;">\
					<input id="'+_self.id+'time" class="aud-slider" style="width: 100%;" data-slider-id="aud-time-slider" type="text" data-slider-min="0" data-slider-max="1000" data-slider-step="1" data-slider-value="0"/>\
				  </div>\
				  <div class="div-volume" style="align-items: center; display: flex; width: 25%">\
					<i id="'+_self.id+'mute" class="fa fa-volume-down" style="font-size: 25px; margin-right: 5px;"></i>\
					<input id="'+_self.id+'volume" class="aud-slider" style="width: 100%;" data-slider-id="aud-volume-slider" type="text" data-slider-min="0" data-slider-max="100" data-slider-step="1" data-slider-value="100"/>\
				  </div>\
				</div>';
			_self.div_player.html(aud_single);
		}
		_self.div_player.append('<audio id="'+_self.id+'control"></audio>');
		_self.audio = document.getElementById(_self.id+'control');

		SetupOrder('asc');

		_self.time_slider = $('#'+_self.id+'time');
		_self.time_slider.slider({
			formatter: function(value) {
				return TimeStringFromSeconds(GetSecondsFromPerThousand(value));
			}
		});
		_self.time_slider.on('slideStop', function(e) {
			var thousand = e.value;
			var seconds = GetSecondsFromPerThousand(thousand);
			_self.audio.currentTime = seconds;
			isDragTimeSlider = false;
		});
		_self.time_slider.on('slideStart', function(e) {
			isDragTimeSlider = true;
		});
		_self.time_slider.slider("disable");
		_self.volume_slider = $('#'+_self.id+'volume');
		_self.volume_slider.slider({
			formatter: function(value) {
				return value;
			}
		});
		_self.volume_slider.on('change', function(e) {
			_self.audio.volume = e.value.newValue/100;
		});
		_self.btn_play = $('#'+_self.id+'play');
		_self.btn_play.on('click', function() {
			if (_self.btn_play.attr('class')=='fa fa-play') {
				if (_self.played == undefined) {
					_self.play();
				}
				else {
					_self.played(_self);
				}
			}
			else {
				_self.pause();
			}
		});
		_self.btn_mute = $('#'+_self.id+'mute');
		_self.btn_mute.on('click', function() {
			if (_self.audio.volume == 0) {
				_self.volume_slider.slider("enable");
				_self.audio.volume = _self.volume_slider.slider("getValue")/100;
			}
			else {
				_self.volume_slider.slider("disable");
				_self.audio.volume = 0;
			}
		});
	})();

	this.load = function(src){
		_self.audio.src = src;
		_self.audio.load();
	}

	this.play = function(){
		BtnToPlay();
		if (_self.audio.src == undefined || _self.audio.src =="") {
			if (_self.currentCode == undefined) {
				_self.load(_self.srcs[0].src);
				_self.currentCode = _self.srcs[0].code;
			}
			else{
				_self.load(GetMp3(_self.currentCode).src);
			}
			_self.audio.onloadedmetadata = function(){
				$('#'+_self.id+'duration').html(_self.getDurationText());
				_self.time_slider.slider("enable");
				_self.duration = _self.audio.duration;
			};
			_self.audio.ontimeupdate = function(){
				$('#'+_self.id+'timecurrent').html(_self.getCurrentTimeText());
				if (!isDragTimeSlider) {
					_self.time_slider.slider('setValue', parseInt(_self.audio.currentTime/_self.audio.duration*1000));
				}
			}
			_self.audio.onended = function (){
				if (IsLastOrder(_self.currentCode)) {
					_self.stop();
					_self.currentCode = _self.orders[0];
				}
				else {
					var mp3 = GetNextMp3(_self.currentCode);
					_self.load(mp3.src);
					_self.currentCode = mp3.code;
					_self.audio.play();
				}
			}
		}
		if (_self.currentCode != undefined && isPlaying == false) {
			_self.load(GetMp3(_self.currentCode).src);
		}
		_self.audio.play();
		isPlaying = true;
	}

	this.pause = function(){
		BtnToPause();
		_self.audio.pause();
	}

	this.stop = function(){
		isPlaying = false;
		BtnToPause();
		_self.time_slider.slider('setValue', 0);
	}

	function TimeStringFromSeconds(seconds){
		var duration = parseInt(seconds);
		if (duration != NaN) {
			if (duration < 60) {
				return '0:'+Nts(duration);
			}
			else if (duration < 3600) {
				return parseInt(duration/60)+':'+Nts(duration%60);
			}
			else {
				var h = duration/3600>>0;
				var m = duration%3600/60>>0;
				var s = duration%3600%60;
				return h+':'+Nts(m)+':'+Nts(s);
			}
		}
		else {
			return 'NaN';
		}
	}

	this.getDurationText = function(){
		return TimeStringFromSeconds(_self.audio.duration);
	}
	this.getCurrentTimeText = function(){
		return TimeStringFromSeconds(_self.audio.currentTime);
	}
}

function AudioControler(audio_players){
	var _self = this;
	this.audio_players = audio_players;
	function OnePlay(aud){
		audio_players.forEach(function(audio){
			
		});
	}
	audio_players.forEach(function(audio){
		audio.played = function(aud){
			aud.play();
			OnePlay(aud);
		}
	});
}