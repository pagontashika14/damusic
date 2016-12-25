@extends('layouts.app')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/switch.css') }}">
<link rel="stylesheet" href="{{ asset('css/playlist.css') }}">
@endpush 

@section('content')

<div class="w3-row">
	<div class="w3-col m8" style="padding-right:10px;">
		<div class="well well-sm">
			<div>
				<span id="playlist-name" class="font-3"></span>
				<span> - </span>
				<span id='user-name' class="font-3 font-small"></span>
			</div>
			<div class="play-music">
				<div id="audio-player" style="width:100%;"></div>
			</div>
			<!--<div class="w3-row">
				<div class="w3-col m12 margin-top-10 w3-display-container">
					<button id="btn-like" class="w3-btn w3-gray w3-round"><i class="fa fa-heart-o" aria-hidden="true"></i> Thích</button>
					<button class="w3-btn w3-blue w3-round"><i class="fa fa-plus" aria-hidden="true"></i> Thêm vào</button>
					<button class="w3-btn w3-teal w3-round"><i class="fa fa-download" aria-hidden="true"></i> Tải về</button>
				</div>
			</div>-->
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
<script src="{{ asset('js/playlist.controller.js') }}"></script>
<script>
	var playlistController;
	$(function(){
		var playlist_code = '{{ $code }}';
		var controller = new DaMusic.Controller.Playlist();
		playlistController = controller;
		controller.getPlaylistInfo(playlist_code,function(){

		});
	});
	
</script>
@endpush