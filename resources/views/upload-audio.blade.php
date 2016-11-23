@extends('layouts.app')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/upload-audio.css') }}">
@endpush 

@section('content')
<div id="upload-content">
	<div class="w3-center">
		<br>
		<h3>Tải nhạc lên DaMusic</h3>
		<br>
		<button id="btn-audio-files" class="w3-btn w3-round-large w3-deep-orange">Chọn tệp để tải lên</button>
		<input type="file" id="audio-files" name="audio-files" multiple="" accept=".mp3">
		<div class="w3-panel w3-pale-blue w3-leftbar w3-border-blue">
			<p id="show-files-note">Chú ý: Có thể chọn nhiều tệp với chất lượng khác nhau cho một bài hát.</p>
			<div id="show-files"></div>
		</div>
	</div>

	<div id="audio-info" style="width: 100%; margin: auto; position: relative;">
		<div class="w3-progress-container w3-round-xlarge">
			<div id="progress" class="w3-progressbar w3-red w3-round-xlarge" style="width:0%">
				<div id="progress-text" class="w3-center w3-text-white">0%</div>
			</div>
		</div>
		<br>
		<ul class="w3-navbar w3-leftbar w3-border-teal w3-border-bottom">
			<li><a href="javascript:void(0)" class="tablink w3-hover-shadow" id="tab1" onclick="controller.SwitchTab(event, 'basic-info');">Basic info</a></li>
			<li><a href="javascript:void(0)" class="tablink w3-hover-shadow" onclick="controller.SwitchTab(event, 'meta-data');">Metadata</a></li>
		</ul>
		<div id="basic-info" class="w3-container tab-type w3-row w3-leftbar w3-border-teal">
			<br>
			<div class="w3-col m7">
				<div style="width: 80%;">
					<p>
						<label class="w3-text-blue">Tên bài hát</label>
						<input id="name" class="w3-input w3-my-border w3-round" type="text">
					</p>
					<p>
						<label class="w3-text-blue">Nghệ sĩ thể hiện</label>
						<select id="singers" name="singers" multiple="multiple"></select>
					</p>
					<p>
						<label class="w3-text-blue">Quốc gia</label>
						<select id="nation" name="nation"></select>
					</p>
					<p>
						<label class="w3-text-blue">Thể loại</label>
						<select id="types" name="types" multiple="multiple"></select>
					</p>
				</div>
			</div>
			<div class="w3-col m5">
				<p>
					<label class="w3-text-blue">Lời bài hát</label>
					<textarea id="lyric" class="w3-input w3-border" style="resize:none; height: 200px;"></textarea>
				</p>
			</div>
		</div>

		<div id="meta-data" class="w3-container tab-type w3-row w3-leftbar w3-border-teal">
			<br>
			<div class="w3-col m7">
				<div style="width: 80%;">
					<p>
						<label class="w3-text-blue">Tiêu đề</label>
						<input class="w3-input w3-border" type="text">
					</p>
					<p>
						<label class="w3-text-blue">Nghệ sĩ</label>
						<input class="w3-input w3-border" type="text">
					</p>					
				</div>
			</div>
			<div class="w3-col m5">
				<p>
					<label class="w3-text-blue">Album</label>
					<input class="w3-input w3-border" type="text">
				</p>
				<p>
					<label class="w3-text-blue">Năm phát hành</label>
					<input class="w3-input w3-border" type="text">
				</p>
			</div>
		</div>
		<div id="btn-upload" class="w3-center" style="width: 100%;">
			<button class="w3-btn w3-teal" onclick="controller.UpLoad()">Upload <i class="fa fa-cloud-upload" aria-hidden="true"></i></button>
		</div>
		<br>
	</div>
</div>
@stop

@push('scripts')
<script src="{{ asset('js/upload-audio.controller.js') }}"></script>
<script>
	var controller = new DaMusic.Controller.UploadAudio();
</script>
@endpush