@extends('layouts.app')

@section('content')
<div class="w3-row">
	{{-- left content --}}
	<div class="w3-col m6" style="padding-right: 8px;">
		<ul class="w3-ul w3-card-4">
			<li class="w3-padding-8">
				<span onclick="this.parentElement.style.display='none'"
				class="w3-closebtn w3-padding w3-margin-right w3-medium">&times;</span>
				<img src="img/avatar.png" class="w3-left w3-circle w3-margin-right" style="width:50px">
				<span class="w3-large">Mike</span><br>
				<span>Web Designer</span>
			</li>
			<li class="w3-padding-8">
				<span onclick="this.parentElement.style.display='none'"
				class="w3-closebtn w3-padding w3-margin-right w3-medium">&times;</span>
				<img src="img/avatar.png" class="w3-left w3-circle w3-margin-right" style="width:50px">
				<span class="w3-large">Jill</span><br>
				<span>Support</span>
			</li>
			<li class="w3-padding-8">
				<span onclick="this.parentElement.style.display='none'"
				class="w3-closebtn w3-padding w3-margin-right w3-medium">&times;</span>
				<img src="img/avatar.png" class="w3-left w3-circle w3-margin-right" style="width:50px">
				<span class="w3-large">Jane</span><br>
				<span>Accountant</span>
			</li>
		</ul>
	</div>
	{{-- end left content --}}

	{{-- right content --}}
	<div class="w3-col m6">
		<div action="form.asp" class="w3-card-4">
			<div class="w3-container w3-brown">
				<h2>Input Colors</h2>
			</div>
			<form class="w3-container" action="form.asp">
				<p>
					<label class="w3-label w3-text-brown"><b>First Name</b></label>
					<input class="w3-input w3-border w3-sand" name="first" type="text">
				</p>
				<p>
					<label class="w3-label w3-text-brown"><b>Last Name</b></label>
					<input class="w3-input w3-border w3-sand" name="last" type="text">
				</p>
				<p>
					<button class="w3-btn w3-brown">Register</button>
				</p>
			</form>
		</div>
	</div>
	{{-- end right content --}}
</div>
@stop
