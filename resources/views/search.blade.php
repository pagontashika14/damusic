@extends('layouts.app')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/search.css') }}">
@endpush 

@section('content')
	<div class="w3-row">
        <div class"w3-col m12">
            <span style="font-size:24px;">TÌM KIẾM</span>
        </div>
		<div class="w3-col m12">
            <input id="input-search" class="w3-input my-input" type="text" style="width:100%" placeholder="Nội dung tìm kiếm...">
        </div>
        <div class="w3-col m6">
            <div id="search-audio-container"></div>
        </div>
        <div class="w3-col m6">
            <div id="search-singer-container"></div>
        </div>
	</div>
@stop

@push('scripts')
<script src="{{ asset('js/search.controller.js') }}"></script>
<script>
	var searchController;
    var SEARCH_TEXT = "{{$text}}";
	$(function(){
		var controller = new DaMusic.Controller.Search();
		searchController = controller;
	});
	
</script>
@endpush