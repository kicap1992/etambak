<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">
	<meta name="description" content="">
	<meta name="author" content="">

	<title>SAPITA - <?=$header?></title>

	<!-- Main Styles -->
	<link rel="stylesheet" href="<?=base_url()?>assets/styles/style.min.css">
	
	<!-- Material Design Icon -->
	<link rel="stylesheet" href="<?=base_url()?>assets/fonts/material-design/css/materialdesignicons.css">

	<!-- mCustomScrollbar -->
	<link rel="stylesheet" href="<?=base_url()?>assets/plugin/datatables/media/css/dataTables.bootstrap.min.css">
	<link rel="stylesheet" href="<?=base_url()?>assets/plugin/datatables/extensions/Responsive/css/responsive.bootstrap.min.css">
	<!-- Sweet Alert -->
	<!-- <link rel="stylesheet" href="<?=base_url()?>assets/plugin/sweet-alert/sweetalert.css"> -->

	<link rel="stylesheet" href="<?php echo base_url() ?>sweet-alert/sweetalert.css">   
 
  	<script src="<?php echo base_url() ?>sweet-alert/sweetalert.js"></script>

	<style>
   
        #map_canvas {
          height: 600px;
          width: 100%;
          margin: 0px;
          padding: 0px
		}
		.nowrap {
		  white-space: nowrap ;
		}

    </style>

    <?php if ($this->uri->segment(2) == 'prediksi' or $this->uri->segment(2) == 'hasil_tahunan'): ?>
    	<link rel="stylesheet" href="<?php echo base_url() ?>/morris/morris.css">
    	<script src="<?php echo base_url() ?>/morris/jquery.min.js"></script>
		<script src="<?php echo base_url() ?>assets/plugin/chart/morris/raphael-min.js"></script>
		<script src="<?php echo base_url() ?>/morris/morris.min.js"></script>
    <?php endif ?>


</head>