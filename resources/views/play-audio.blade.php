@extends('layouts.app')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/switch.css') }}">
<link rel="stylesheet" href="{{ asset('css/play-audio.css') }}">
@endpush 

@section('content')

<div class="w3-row">
	<div class="w3-col m8" style="padding-right:10px;">
		<div class="well well-sm">
		<div>
			<span id="audio-name" class="font-3"></span>
			<span> - </span>
			<span id='singers-name' class="font-3 font-small"></span>
		</div>
		<div class="play-music">
			<div id="audio-player" style="width:100%;"></div>
		</div>
		<div class="w3-row">
			<div class="w3-col m6">
				<div>
					<span class="w3-opacity">Thể loại: </span><span id="audio-type"></span>
				</div>
				<div>
					<span class="w3-opacity">Sáng tác: </span><span id="audio-composer"></span>
				</div>
			</div>
			<div class="w3-col m6">
				<div class="w3-right" style="width: 250px;">
					<div class="w3-left-align">
						<span class="w3-opacity">Quốc gia: </span><span id="audio-nation"></span>
					</div>
				</div>
				<div class="w3-right" style="width: 250px;">
					<div class="w3-left-align">
						<span class="w3-opacity">Người tạo: </span><span id="audio-user-upload" style="margin-right:10px;"></span>
					</div>
				</div>				
			</div>
			<div class="w3-col m12 margin-top-10 w3-display-container">
				<button id="btn-like" class="w3-btn w3-gray w3-round"><i class="fa fa-heart-o" aria-hidden="true"></i> Thích</button>
				<button class="w3-btn w3-blue w3-round"><i class="fa fa-plus" aria-hidden="true"></i> Thêm vào</button>
				<button class="w3-btn w3-teal w3-round"><i class="fa fa-download" aria-hidden="true"></i> Tải về</button>
				<span class="w3-right">
					<i class="fa fa-headphones" aria-hidden="true" style="font-size:24px;"></i> <span id="audio_views" style="font-size:24px;">0</span>
				</span>
			</div>
			<div class="w3-col m12 item-gray">
				<div class="w3-row">
					<div class="w3-col m6">
						<h3><b>Lời bài hát</b></h3>
						<div>Đóng góp: <span id="audio-lyric-user"></span></div>
					</div>
					<div class="w3-col m6">
						<div id="audio-lyric-page" class="w3-right"></div>
					</div>
					<div class="w3-col m12">
						<div id="audio-lyric"></div>
					</div>
				</div>
			</div>
		</div>
		</div>
	</div>
	<div class="w3-col m4">
		<div class="well well-sm">
			<div style="position:relative">
				<div style="font-size:18px;">GỢI Ý</div>
				<div class="top-right">
					<label class="switch w3-tooltip">
						<span style="position:absolute;top:30px;width:100px;" class="w3-text w3-tag">Tự động chuyển bài</span>
						<input id="auto-next" title="Tự động chuyển bài" checked type="checkbox">
						<div class="slider round"></div>
					</label>
				</div>
				<div id="hint-container"></div>
			</div>
		</div>
	</div>
</div>

@stop

@push('scripts')
<script src="{{ asset('js/play-audio.controller.js') }}"></script>
<script>
	var playAudioController;
	$(function(){
		var audio_code = '{{ $code }}';
		var controller = new DaMusic.Controller.PlayAudio();
		playAudioController = controller;
		controller.getAudioInfo(audio_code,function(){

		});
	});
	
</script>
@endpush