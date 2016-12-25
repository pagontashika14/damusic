<!-- Navbar -->
<div class="w3-top">
	<ul class="w3-navbar w3-theme-d2 w3-left-align w3-large">
		<li class="w3-hide-medium w3-hide-large w3-opennav w3-right">
			<a class="w3-padding-large w3-hover-white w3-large w3-theme-d2" href="javascript:void(0);" onclick="openNav()"><i class="fa fa-bars"></i></a>
		</li>
		<li>
			<a href="/" class="w3-padding-large w3-theme-d4"><i class="fa fa-home w3-margin-right"></i>Damusic</a>
		</li>
		<li class="w3-hide-small">
			<a href="/user" class="w3-padding-large w3-hover-white" title="Cá nhân">
				<i class="fa fa-user"></i>
			</a>
		</li>
		<li class="w3-hide-small w3-dropdown-hover role-mode" style="display: none">
			<a class="w3-padding-large w3-hover-white" title="Quản trị"><i class="fa fa-user-secret"></i></a>
			<div class="w3-dropdown-content w3-white w3-card-4">
				<a href="/upload-audio">Upload Nhạc</a>
				<a onclick="appController.showImageModal()">Upload Ảnh</a>
				<a onclick="appController.showSingerModal()">Tạo mới nghệ sĩ</a>
				<a onclick="appController.showTypeModal()">Tạo mới thể loại</a>
			</div>
		</li>
		<li class="w3-hide-small user-mode" style="display: none;cursor:pointer">
			<a onclick="appController.showPlaylistModal()" class="w3-padding-large w3-hover-white" title="Tạo mới playlist">
				<i class="fa fa-puzzle-piece" aria-hidden="true"></i>
			</a>
		</li>
		<!--<li class="w3-hide-small w3-dropdown-hover">
			<a href="#" class="w3-padding-large w3-hover-white" title="Notifications"><i class="fa fa-bell"></i><span class="w3-badge w3-right w3-small w3-green">3</span></a>     
			<div class="w3-dropdown-content w3-white w3-card-4">
				<a href="#">One new friend request</a>
				<a href="#">John Doe posted on your wall</a>
				<a href="#">Jane likes your post</a>
			</div>
		</li>-->
		<li class="w3-hide-small w3-right">
			<a id="navbar-user" href="/login" class="w3-padding-large w3-hover-white" title="Login"><img src="/img/avatar.png" class="w3-circle" style="height:25px;width:25px;" alt="Avatar">
				<span id="navbar-username">Guest</span>
			</a>
		</li>
	</ul>
</div>

<!-- Navbar on small screens -->
<div id="navDemo" class="w3-hide w3-hide-large w3-hide-medium w3-top" style="margin-top:51px">
	<ul class="w3-navbar w3-left-align w3-large w3-theme">
		<li><a class="w3-padding-large" href="#">Nhạc cá nhân</a></li>
		<li><a class="w3-padding-large" href="#">Link 2</a></li>
		<li><a class="w3-padding-large" href="#">Link 3</a></li>
		<li><a class="w3-padding-large" href="#">My Profile</a></li>
	</ul>
</div>