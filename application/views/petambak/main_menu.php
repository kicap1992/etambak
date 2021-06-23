<div class="main-menu">
	<header class="header">
		<a href="index-2.html" class="logo"><img src="<?=base_url()?>logo.png" width="25" height="25"> SAPITA</a>
		<!-- <button type="button" class="button-close fa fa-times js__menu_close"></button> -->
		<div class="user">
			<a href="#" class="avatar"><img src="<?=base_url()?>logo.png" alt="" width="50" height="50"></a>
			<h4><a href="profile.html"><?=$this->session->userdata('nama')?></a></h4>
			<h5 class="position"><?=$this->session->userdata('level')?></h5>
			<!-- /.name -->
			<div class="control-wrap js__drop_down">
				<i class="fa fa-caret-down js__drop_down_button"></i>
				<div class="control-list">
					<div class="control-item"><a href="profile.html"><i class="fa fa-user"></i> Profile</a></div>
					<div class="control-item"><a href="#"><i class="fa fa-sign-out"></i> Log out</a></div>
				</div>
				<!-- /.control-list -->
			</div>
			
			<!-- /.control-wrap -->
		</div>
		<!-- /.user -->
	</header>
	<!-- /.header -->
	<div class="content">

		<div class="navigation">
			<h5 class="title">Menu</h5>
			<!-- /.title -->
			<ul class="menu js__accordion">


				<li <?php if ($this->uri->segment(2) == '') { echo 'class="current"'; } ?>>
					<a class="waves-effect" href="<?=base_url()?>petambak"><i class="menu-icon mdi mdi-view-dashboard"></i><span>Halaman Utama</span></a>
				</li>


				<!-- <li>
					<a class="waves-effect" href="index-2.html"><i class="menu-icon mdi mdi-desktop-mac"></i><span>ADMIN</span></a>					
				</li> -->


				<li <?php if ($this->uri->segment(2) == 'analisa' or $this->uri->segment(2) == 'pengujian') { echo 'class="current"'; } ?>>
					<!-- <a class="waves-effect" href="<?=base_url()?>home/pendaftaran"><i class="menu-icon mdi mdi-cube-outline"></i><span>Pendaftaran</a> -->
					<a class="waves-effect "href="<?=base_url()?>petambak/analisa"><i class="menu-icon mdi mdi-desktop-mac"></i><span>Analisa Produksi</span></a>
					
					
				</li>


				<li <?php if ($this->uri->segment(2) == 'perkiraan_produksi') { echo 'class="current"'; } ?>>
					<a class="waves-effect" href="<?=base_url()?>petambak/perkiraan_produksi"><i class="menu-icon mdi mdi-calendar"></i><span>Perkiraan Produksi</span></a>
				</li>

				<li <?php if ($this->uri->segment(2) == 'transaksi') { echo 'class="current"'; } ?>>
					<a class="waves-effect" href="<?=base_url()?>petambak/transaksi"><i class="menu-icon mdi mdi-desktop-mac"></i><span>Transaksi Produksi</span></a>
					
				</li>

				<li <?php if ($this->uri->segment(2) == 'penambahan') { echo 'class="current"'; } ?>>
					<a class="waves-effect" href="<?=base_url()?>petambak/penambahan"><i class="menu-icon mdi mdi-calendar"></i><span>Penambahan Lahan</span></a>
				</li>

				<li>
					<a class="waves-effect" href="<?=base_url()?>petambak/logout"><i class="menu-icon mdi mdi-calendar"></i><span>Logout</span></a>
				</li>

				<li>
					&nbsp<br>&nbsp
				</li>


				
				


			</ul>
			<!-- /.menu js__accordion -->
			
		</div>
		<!-- /.navigation -->
	</div>
	<!-- /.content -->
</div>