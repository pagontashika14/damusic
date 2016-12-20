@extends('layouts.app')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/home.css') }}">
@endpush 

@section('content')
	<div class="w3-row">
		<div class="w3-col m8">
			<div class="w3-row" style="padding-right:10px;">
				<div class="w3-col m12">
					<div class="well well-sm">
						<div id="my-banner"></div>
					</div>
					<div class="well well-sm">
						<div style="font-size:18px;">BẢNG XẾP HẠNG VIỆT NAM</div>
						<div id="vietnam-top"></div>
					</div>
					<div class="well well-sm">
						<div style="font-size:18px;">BẢNG XẾP HẠNG HÀN QUỐC</div>
						<div id="korea-top"></div>
					</div>
					<div class="well well-sm">
						<div style="font-size:18px;">BẢNG XẾP HẠNG ÂU MỸ</div>
						<div id="us-top"></div>
					</div>
				</div>
			</div>
		</div>
		<div class="w3-col m4">
			<div class="well well-sm">
				<div style="font-size:18px;">CÓ THỂ BẠN MUỐN NGHE</div>
				<div id="old-container"></div>
			</div>
			<div class="well well-sm">
				<div style="font-size:18px">TOP TRONG THÁNG</div>
				<div id="top-of-month"></div>
			</div>
			
		</div>
	</div>
@stop

@push('scripts')
<script src="{{ asset('js/home.controller.js') }}"></script>
<script>
	var homeController;
	$(function(){
		var controller = new DaMusic.Controller.Home();
		homeController = controller;
	});
	
</script>
@endpush