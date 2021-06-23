	<script src="<?=base_url()?>assets/scripts/jquery.min.js"></script>
	<script src="<?=base_url()?>assets/scripts/modernizr.min.js"></script>
	<script src="<?=base_url()?>assets/plugin/bootstrap/js/bootstrap.min.js"></script>
	<script src="<?=base_url()?>assets/plugin/nprogress/nprogress.js"></script>
	<script src="<?=base_url()?>assets/plugin/sweet-alert/sweetalert.min.js"></script>
	<script src="<?=base_url()?>assets/plugin/waves/waves.min.js"></script>

	<script src="<?=base_url()?>assets/plugin/datatables/media/js/jquery.dataTables.min.js"></script>
	<script src="<?=base_url()?>assets/plugin/datatables/media/js/dataTables.bootstrap.min.js"></script>

	<!-- <script src="<?=base_url()?>assets/toastr/toastr.min.js"></script>
  	<link rel="stylesheet" type="text/css" href="<?=base_url()?>assets/toastr/toastr.min.css"> -->

  	<script src="<?=base_url()?>assets/plugin/toastr/toastr.min.js"></script>
  	<link rel="stylesheet" type="text/css" href="<?=base_url()?>assets/plugin/toastr/toastr.css">

	<script >
		$(document).ready(function() {
		    $('#example').DataTable();
		    $('#example1').DataTable();
		} );


	</script>

<?php if ($this->session->flashdata('my404')): ?>
	<script type="text/javascript">
	    toastr.options = {
	      "closeButton": true,
	      "debug": false,
	      "progressBar": true,
	      "positionClass": "toast-top-right",
	      "showDuration": "300",
	      "hideDuration": "1000",
	      "timeOut": "5000",
	      "extendedTimeOut": "1000",
	      "showEasing": "swing",
	      "hideEasing": "linear",
	      "showMethod": "fadeIn",
	      "hideMethod": "fadeOut"
	    };

	    toastr.error("<?php echo  $this->session->flashdata('my404')?>");
  	</script> 
<?php endif ?>

<?php if ($this->session->flashdata('success')): ?>
	<script type="text/javascript">
	    toastr.options = {
	      "closeButton": true,
	      "debug": false,
	      "progressBar": true,
	      "positionClass": "toast-top-right",
	      "showDuration": "300",
	      "hideDuration": "1000",
	      "timeOut": "5000",
	      "extendedTimeOut": "1000",
	      "showEasing": "swing",
	      "hideEasing": "linear",
	      "showMethod": "fadeIn",
	      "hideMethod": "fadeOut"
	    };

	    
	    toastr.success("<?php echo  $this->session->flashdata('success')?>");
	    
	    
  	</script> 
<?php endif ?>

<?php if ($this->session->flashdata('error')): ?>
	<script type="text/javascript">
	    toastr.options = {
	      "closeButton": true,
	      "debug": false,
	      "progressBar": true,
	      "positionClass": "toast-top-right",
	      "showDuration": "300",
	      "hideDuration": "1000",
	      "timeOut": "5000",
	      "extendedTimeOut": "1000",
	      "showEasing": "swing",
	      "hideEasing": "linear",
	      "showMethod": "fadeIn",
	      "hideMethod": "fadeOut"
	    };

	    
	    toastr.error("<?php echo  $this->session->flashdata('error')?>");
	    
	    
  	</script> 
<?php endif ?>

<?php if ($this->uri->segment(2) == '' or $this->uri->segment(2) == null): ?>
	<script type="text/javascript">
		$.ajax({

			type: "post",
			url: "<?=base_url()?>home/json_hasil",
			// data: {inputannya: data}, // appears as $_GET['id'] @ your backend side
			// dataType: "html",
			success: function(data1) {
				// console.log(data1);
				var data = JSON.parse(data1);
				console.log(data);
				// window.location.replace("<?=base_url()?>admin/data_produksi/");
				new Morris.Line({
				  // ID of the element in which to draw the chart.
				  element: 'myfirstchart',
				  // Chart data records -- each entry in this array corresponds to a point on
				  // the chart.
				  data: data['ket'],
				  // The name of the data record attribute that contains x-values.
				  xkey: data['tahun'],
				  parseTime: false,
				  // A list of names of data record attributes that contain y-values.
				  ykeys: ['produksi','prediksi'],
				  // Labels for the ykeys -- will be displayed when you hover over the
				  // chart.
				  labels: ['Produksi','Prediksi'],
				  lineColors:['Green','Red']
				});
			}
		});
	</script>
<?php endif ?>

<?php if ($this->uri->segment(2) == 'data_petambak'): ?>
	<script>
	    $(document).ready(function(){
	        $('#tabel-data').DataTable();
	    });
 	</script>
<?php endif ?>

<?php if ($this->uri->segment(2) == 'pendaftaran'): ?>
	<script type="text/javascript">

		function changeFuncKecamatan($i) {
			var value = $i;
			if (value == '' || value == null) {
				window.location.replace("<?=base_url()?>home/pendaftaran/");
			}else{
				window.location.replace("<?=base_url()?>home/pendaftaran/"+value);
			}
			
		}

		<?php if ($this->uri->segment(3) != null or $this->uri->segment(3) != '') { ?>
		function changeFuncKelurahan($i) {
			var value = $i;
			if (value == '' || value == null) {
				window.location.replace("<?=base_url()?>home/pendaftaran/<?=$this->uri->segment(3)?>");
			}else{
				window.location.replace("<?=base_url()?>home/pendaftaran/<?=$this->uri->segment(3)?>/"+value);
			}
			
		}

		<?php } ?>

	</script>

	<script type="text/javascript">
		function heheh(){
			var kecamatan = $('select[name="kecamatan"]').val();
			var kelurahan = $('select[name="kelurahan"]').val();
			var nik = $('input[name="nik"]').val();
			var nama = $('input[name="nama"]').val();
			var pbb = $('input[name="pbb"]').val();
			var point = $('input[name="point"]').val();
			var tambak = $('select[name="tambak"]').val();
			var luas_lahan = $('input[name="luas_lahan"]').val();
			// console.log(point);
			if(nik.length < 16 || nik == '' || nik == null){
				$('input[name="nik"]').focus();
				toastr.options = {
			      "closeButton": true,
			      "debug": false,
			      "progressBar": true,
			      "positionClass": "toast-top-right",
			      "showDuration": "300",
			      "hideDuration": "1000",
			      "timeOut": "5000",
			      "extendedTimeOut": "1000",
			      "showEasing": "swing",
			      "hideEasing": "linear",
			      "showMethod": "fadeIn",
			      "hideMethod": "fadeOut"
			    };

			    toastr.error("<b>Error</b><br>NIK harus Panjang 16 Karakter");
			}else if(nama == '' || nama == null){
				$('input[name="nama"]').focus();
				toastr.options = {
			      "closeButton": true,
			      "debug": false,
			      "progressBar": true,
			      "positionClass": "toast-top-right",
			      "showDuration": "300",
			      "hideDuration": "1000",
			      "timeOut": "5000",
			      "extendedTimeOut": "1000",
			      "showEasing": "swing",
			      "hideEasing": "linear",
			      "showMethod": "fadeIn",
			      "hideMethod": "fadeOut"
			    };

			    toastr.error("<b>Error</b><br>Nama Harus Terisi");
			}else if(pbb.length < 16 || pbb == '' || pbb == null){
				$('input[name="pbb"]').focus();
				toastr.options = {
			      "closeButton": true,
			      "debug": false,
			      "progressBar": true,
			      "positionClass": "toast-top-right",
			      "showDuration": "300",
			      "hideDuration": "1000",
			      "timeOut": "5000",
			      "extendedTimeOut": "1000",
			      "showEasing": "swing",
			      "hideEasing": "linear",
			      "showMethod": "fadeIn",
			      "hideMethod": "fadeOut"
			    };

			    toastr.error("<b>Error</b><br>No PBB harus Panjang 16 Karakter");
			} else if(tambak == '' || tambak == null){
				$('select[name="tambak"]').focus();
				toastr.options = {
			      "closeButton": true,
			      "debug": false,
			      "progressBar": true,
			      "positionClass": "toast-top-right",
			      "showDuration": "300",
			      "hideDuration": "1000",
			      "timeOut": "5000",
			      "extendedTimeOut": "1000",
			      "showEasing": "swing",
			      "hideEasing": "linear",
			      "showMethod": "fadeIn",
			      "hideMethod": "fadeOut"
			    };

			    toastr.error("<b>Error</b><br>Teknologi Tambak Harus Dipilih");
			} else if(point == '' || point == null){
				$('input[name="enablePolygon"]').focus();
				toastr.options = {
			      "closeButton": true,
			      "debug": false,
			      "progressBar": true,
			      "positionClass": "toast-top-right",
			      "showDuration": "300",
			      "hideDuration": "1000",
			      "timeOut": "5000",
			      "extendedTimeOut": "1000",
			      "showEasing": "swing",
			      "hideEasing": "linear",
			      "showMethod": "fadeIn",
			      "hideMethod": "fadeOut"
			    };

			    toastr.error("<b>Error</b><br>Kordinat Tambak Harus Ditanda");
			} else {
				// console.log(kecamatan);
				// console.log(kelurahan);
				// console.log(nik);
				// console.log(nama);
				// console.log(pbb);
				// console.log(tambak);
				// console.log(point);
				$.ajax({

	              type: "post",
	              url: "<?=base_url()?>home/pendaftaran_tambak/",
	              data: {kecamatan: kecamatan,kelurahan: kelurahan, nik: nik, nama : nama , pbb : pbb, tambak :tambak, point : point, luas_lahan: luas_lahan}, // appears as $_GET['id'] @ your backend side
	              // dataType: "json",
	              success: function(data1) {

	                // console.log(data1);
	                // window.location.href ="<?=base_url()?>";

	                if (data1 == 'true1') {
	                	$('input[name="nik"]').focus();
						toastr.options = {
					      "closeButton": true,
					      "debug": false,
					      "progressBar": true,
					      "positionClass": "toast-top-right",
					      "showDuration": "300",
					      "hideDuration": "1000",
					      "timeOut": "5000",
					      "extendedTimeOut": "1000",
					      "showEasing": "swing",
					      "hideEasing": "linear",
					      "showMethod": "fadeIn",
					      "hideMethod": "fadeOut"
					    };

					    toastr.warning("<b>Error</b><br>NIK Yang Dimasukkan Telah Terdaftar Dalam Sistem<br>Silakan Login Untuk Menambah Lahan");
	                }else if (data1 == 'true2') {
	                	$('input[name="pbb"]').focus();
						toastr.options = {
					      "closeButton": true,
					      "debug": false,
					      "progressBar": true,
					      "positionClass": "toast-top-right",
					      "showDuration": "300",
					      "hideDuration": "1000",
					      "timeOut": "5000",
					      "extendedTimeOut": "1000",
					      "showEasing": "swing",
					      "hideEasing": "linear",
					      "showMethod": "fadeIn",
					      "hideMethod": "fadeOut"
					    };

					    toastr.warning("<b>Error</b><br>No PBB Yang Dimasukkan Telah Terdaftar Dalam Sistem<br>Silakan Cek Kembali No PBB Yang Dimasukkan");
	                }else if (data1 == 'false') {
	                	window.location.href ="<?=base_url()?>";
	                }
	              }

	            });
			}
		}
	</script>

	<script type="text/javascript">
	    function setInputFilter(textbox, inputFilter) {
	        ["input", "keydown", "keyup", "mousedown", "mouseup", "select", "contextmenu", "drop"].forEach(function(event) {
	          textbox.addEventListener(event, function() {
	            if (inputFilter(this.value)) {
	              this.oldValue = this.value;
	              this.oldSelectionStart = this.selectionStart;
	              this.oldSelectionEnd = this.selectionEnd;
	            } else if (this.hasOwnProperty("oldValue")) {
	              this.value = this.oldValue;
	              this.setSelectionRange(this.oldSelectionStart, this.oldSelectionEnd);
	            } else {
	              this.value = "";
	            }
	          });
	        });
	      }


	    // Install input filters.
	    setInputFilter(document.getElementById("nik"), function(value) {
	      return /^-?\d*$/.test(value); });
	    setInputFilter(document.getElementById("pbb"), function(value) {
	      return /^-?\d*$/.test(value); });
	   
	</script>
<?php endif ?>

<?php if ($this->uri->segment(2) == 'kecamatan'): ?>
	<script >
		$(document).ready(function() {
		    $('#tabel-data').DataTable();
		} );


	</script>
<?php endif ?>
	
	

	

	<script src="<?=base_url()?>assets/scripts/main.min.js"></script>