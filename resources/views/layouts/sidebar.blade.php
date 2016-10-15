<aside class="main-sidebar">

	<!-- sidebar: style can be found in sidebar.less -->
	<section class="sidebar">
		<!-- Sidebar user panel (optional) -->
		<div class="user-panel">
			<div class="pull-left image">
				<img src="{{ asset('admin-lte/dist/img/avatar.png',env('HTTPS_ASSET')) }}" class="img-circle" alt="User Image">
			</div>
			<div class="pull-left info">
				<p>Khách vãng lai</p>
				<!-- Status -->
				<a href="#"><i class="fa fa-circle text-success"></i> Online</a>
			</div>
		</div>

		<!-- search form (Optional) -->
		<form action="#" method="get" class="sidebar-form">
			<div class="input-group">
				<input type="text" name="q" class="form-control" placeholder="Search...">
				<span class="input-group-btn">
					<button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
					</button>
				</span>
			</div>
		</form>
		<!-- /.search form -->

		<!-- Sidebar Menu -->
		<ul class="sidebar-menu">
			<li class="header">ALBUM NHẠC</li>
			<!-- Optionally, you can add icons to the links -->
			<li>
				<a href="#">
					<i class="fa fa-user"></i>
						<span>Nhạc cá nhân</span>
						<span class="pull-right-container">
							<i class="fa fa-angle-left pull-right"></i>
						</span>
				</a>
				<ul class="treeview-menu">
					<li><a href="#"><i class="fa fa-circle-o"></i> Playlist Của Tôi</a></li>
					<li><a href="#"><i class="fa fa-circle-o"></i> Yêu Thích</a></li>
					<li><a href="#"><i class="fa fa-circle-o"></i> Lịch Sử</a></li>
				</ul>
			</li>
			<li>
				<a href="#">
					<i class="fa fa-star"></i>
					<span>Việt Nam</span>
					<span class="pull-right-container">
						<i class="fa fa-angle-left pull-right"></i>
					</span>
				</a>
				<ul class="treeview-menu">
					<li><a href="#"><i class="fa fa-circle-o"></i> Ballad</a></li>
					<li><a href="#"><i class="fa fa-circle-o"></i> Nhạc trẻ</a></li>
					<li><a href="#"><i class="fa fa-circle-o"></i> Nhạc trữ tình</a></li>
				</ul>
			</li>
			<li>
				<a href="#">
					<i class="fa fa-globe"></i>
					<span>Nhạc quốc tế</span>
					<span class="pull-right-container">
						<i class="fa fa-angle-left pull-right"></i>
					</span>
				</a>
				<ul class="treeview-menu">
					<li><a href="#"><i class="fa fa-circle-o"></i> Hàn Quốc</a></li>
					<li><a href="#"><i class="fa fa-circle-o"></i> Âu Mỹ</a></li>
					<li><a href="#"><i class="fa fa-circle-o"></i> Châu Á</a></li>
				</ul>
			</li>
			<li>
				<a href="#">
					<i class="fa fa-heartbeat"></i>
					<span>Nhạc hot tháng 10</span>
				</a>
			</li>
			<li class="header">ĐÓNG GÓP</li>
			<li>
				<a href="#">
					<i class="fa fa-upload"></i>
					<span>Upload nhạc</span>
				</a>
			</li>
			<li>
				<a href="#">
					<i class="fa fa-video-camera"></i>
					<span>Upload video</span>
					<span class="pull-right-container">
						<small class="label pull-right bg-green">coming soon</small>
					</span>
				</a>
			</li>
		</ul>
		<!-- /.sidebar-menu -->
	</section>
	<!-- /.sidebar -->
</aside>