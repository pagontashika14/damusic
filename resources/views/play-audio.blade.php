@extends('layouts.app')

@push('styles')
{{-- <link rel="stylesheet" href="{{ asset('css/upload-audio.css') }}"> --}}
@endpush 

@section('content')
{{ $code }}
@stop

@push('scripts')
{{-- <script src="{{ asset('js/upload-audio.controller.js') }}"></script> --}}
<script>
	console.log('{{ $code }}');
</script>
@endpush