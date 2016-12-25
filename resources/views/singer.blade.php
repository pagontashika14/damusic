@extends('layouts.app')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/singer.css') }}">
@endpush 

@section('content')
	<div class="w3-row">
        <div class="col-md-2">
            <div>
                <img id='image' src="/api/image/index/124794cb4fbbca1a578d2d474998096a" alt="singer" style="width:100%;">
            </div>
        </div>
        <div class="col-md-5">
            <div>
                <label>Nghệ danh:</label> <span id="stage-name"></span>
            </div>
            <div>
                <label>Tên thật:</label> <span id="name"></span>
            </div>
        </div>
        <div class="col-md-5">
            <div>
                <label>Ngày sinh:</label> <span id="birthday"></span>
            </div>
            <div>
                <label>Quốc gia:</label> <span id="nation"></span>
            </div>
        </div>
        <br><br><br>
        <p id="description"></p>
	</div>
@stop

@push('scripts')
<script src="{{ asset('js/singer.controller.js') }}"></script>
<script>
	var singerController;
    var SINGER_ID = "{{$id}}";
	$(function(){
		var controller = new DaMusic.Controller.Singer();
		singerController = controller;
	});
	
</script>
@endpush