@extends('layouts.app')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/user.css') }}">
@endpush 

@section('content')
	<div class="w3-row">
        <div class="col-md-2">
            <div>
                <img src="/img/icon2.png" alt="user" style="width:100%;">
            </div>
        </div>
        <div class="col-md-5">
            <div>
                <label>Email:</label> <span id="user-email"></span>
            </div>
            <div>
                <label>Tên:</label> <span id="user-name"></span>
            </div>
        </div>
        <div class="col-md-5">
            <div>
                <label>Chức:</label> <span id="user-role"></span>
            </div>
        </div>
        <div class="col-md-12">
            <hr>
        </div>
        <div class="col-md-12">
            Playlist của bạn:
        </div>
        <div class="col-md-12">
            <div id="playlist-container"></div>
        </div>
	</div>
@stop

@push('scripts')
<script src="{{ asset('js/user.controller.js') }}"></script>
<script>
	var userController;
	$(function(){
		var controller = new DaMusic.Controller.User();
		userController = controller;
	});
	
</script>
@endpush