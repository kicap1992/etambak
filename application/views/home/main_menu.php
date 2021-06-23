<div class="main-menu">
	<header class="header">
		<a href="<?=base_url()?>" class="logo"><img src="<?=base_url()?>logo.png" width="25" height="25"> SAPITA</a>
		<!-- <button type="button" class="button-close fa fa-times js__menu_close"></button> -->
		<div class="user">
			<a href="#" class="avatar"><img src="<?=base_url()?>logo.png" alt="" width="50" height="50"></a>
			<h4><a href="#">Guest</a></h4>
			<!-- <h5 class="position">Administrator</h5> -->
			<!-- /.name -->
			
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


				<li <?php if ($this->uri->segment(2) == '' or $this->uri->segment(2) == 'data_petambak') { echo 'class="current"'; } ?>>
					<a class="waves-effect" href="<?=base_url()?>"><i class="menu-icon mdi mdi-view-dashboard"></i><span>Halaman Utama</span></a>
				</li>


				<!-- <li>
					<a class="waves-effect" href="index-2.html"><i class="menu-icon mdi mdi-desktop-mac"></i><span>ADMIN</span></a>					
				</li> -->


				<li <?php if ($this->uri->segment(2) == 'pendaftaran') { echo 'class="current"'; } ?>>
					<a class="waves-effect" href="<?=base_url()?>home/pendaftaran"><i class="menu-icon mdi mdi-cube-outline"></i><span>Pendaftaran</a>
					
				</li>


				<li>
					<a class="waves-effect" href="<?=base_url()?>home/login"><i class="menu-icon mdi mdi-calendar"></i><span>Login</span></a>
				</li>

				<li>
					&nbsp<br>&nbsp
				</li>


				
				


			</ul>
			<!-- /.menu js__accordion -->
			<!-- <h5 class="title">KECAMATAN</h5> -->
			<!-- /.title -->
			<!-- <ul class="menu js__accordion"> -->
				<!-- <li <?php if ($this->uri->segment(2) == 'kecamatan' and $this->uri->segment(3) == '1') { echo 'class="current"'; } ?>>
					<a class="waves-effect" href="<?=base_url()?>home/kecamatan/1"><i class="menu-icon mdi mdi-calendar"></i><span>BACUKIKI BARAT</span></a>
				</li>

				<li <?php if ($this->uri->segment(2) == 'kecamatan' and $this->uri->segment(3) == '2') { echo 'class="current"'; } ?>>
					<a class="waves-effect" href="<?=base_url()?>home/kecamatan/2"><i class="menu-icon mdi mdi-calendar"></i><span>BACUKIKI</span></a>
				</li>

				<li <?php if ($this->uri->segment(2) == 'kecamatan' and $this->uri->segment(3) == '4') { echo 'class="current"'; } ?>>
					<a class="waves-effect" href="<?=base_url()?>home/kecamatan/4"><i class="menu-icon mdi mdi-calendar"></i><span>UJUNG</span></a>
				</li>

				<li <?php if ($this->uri->segment(2) == 'kecamatan' and $this->uri->segment(3) == '3') { echo 'class="current"'; } ?>>
					<a class="waves-effect" href="<?=base_url()?>home/kecamatan/3"><i class="menu-icon mdi mdi-calendar"></i><span>SOREANG</span></a>
				</li>

				<?php foreach ($kecamatan->result() as $key => $value): ?>
					<li <?php if ($this->uri->segment(2) == 'kecamatan' and $this->uri->segment(3) == '<?=$value->id_kecamatan?>') { echo 'class="current"'; } ?>>
					<a class="waves-effect" href="<?=base_url()?>home/kecamatan/<?=$value->id_kecamatan?>"><i class="menu-icon mdi mdi-calendar"></i><span><?=$value->kecamatan?></span></a>
				</li>
				<?php endforeach ?> -->
			<!-- </ul> -->
			<!-- /.menu js__accordion -->
		</div>
		<!-- /.navigation -->
	</div>
	<!-- /.content -->
</div>