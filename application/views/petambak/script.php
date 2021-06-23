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
		function changeFuncLahan()
		{
			var value = $('select[name="lokasi_lahan"]').val();
			window.location.replace("<?=base_url()?>petambak/analisa/"+value);
		}
	</script>
	<script>
	    $(document).ready(function(){
	        $('#tabel-data').DataTable({
				"pageLength": 10,
				"searching": true,
				"paging":   true,
				"ordering": true,
				"info":     true,

	        });
	        
	    });
	</script>
<?php endif ?>

<?php if ($this->uri->segment(2) == 'analisa' ): ?>

	<?php if ($this->uri->segment(3) == '' and $this->uri->segment(3) == null): ?>
	<script type="text/javascript">
		function changeFuncLahan()
		{
			var value = $('select[name="lokasi_lahan"]').val();
			window.location.replace("<?=base_url()?>petambak/analisa/"+value);
		}
	</script>	
	<script>
	    $(document).ready(function(){
	        $('#tabel-data').DataTable({
				"pageLength": 10,
				"searching": true,
				"paging":   true,
				"ordering": true,
				"info":     true,

	        });
	        
	    });
	</script>
	<?php endif ?>

	

	<?php if ($this->uri->segment(3) != '' or $this->uri->segment(3) != null): ?>
	<script type="text/javascript">
		function changeFuncLahan()
		{
			var value = $('select[name="lokasi_lahan"]').val();
			if (value != '') {
				$.ajax({
					type: "post",
					url: "<?=base_url()?>petambak/analisa",
					data: {hari: value, kode: <?=$this->uri->segment(3)?>,id:1}, // appears as $_GET['id'] @ your backend side
					// dataType: "html",
					success: function(data1) {
						$('#tabel').html(data1);
					}
				});

				$.ajax({
					type: "post",
					url: "<?=base_url()?>petambak/analisa",
					data: {hari: value, kode: <?=$this->uri->segment(3)?>,id:2}, // appears as $_GET['id'] @ your backend side
					// dataType: "html",
					success: function(data1) {
						$('#sini_ganti').html(data1);
					}
				});
			}
		}
	</script>
	<script>
	    $(document).ready(function(){
	        $('#tabel-data').DataTable({
				"pageLength": 10,
				"searching": false,
				"paging":   false,
				"ordering": false,
				"info":     false,

	        });
	        
	    });
	</script>

	<?php endif ?>
<?php endif ?>


<?php if ($this->uri->segment(2) == 'perkiraan_produksi'): ?>

	<?php if ($this->uri->segment(3) == '' and $this->uri->segment(3) == null): ?>
	<script type="text/javascript">
		function changeFuncLahan()
		{
			var value = $('select[name="lokasi_lahan"]').val();
			window.location.replace("<?=base_url()?>petambak/perkiraan_produksi/"+value);
		}
	</script>
	<script>
	    $(document).ready(function(){
	        $('#tabel-data').DataTable({
				"pageLength": 10,
				"searching": true,
				"paging":   true,
				"ordering": true,
				"info":     true,

	        });
	        
	    });
	</script>
	<?php endif ?>

	<?php if ($this->uri->segment(3) != '' and $this->uri->segment(3) != 'null'): ?>
	<script type="text/javascript">
		function changeFuncLahan(a)
		{
			console.log(a);
			var reString = /^\d{4}-\d\d-\d\d$/;
			var tanggal = $("#tanggal").val();
			if (reString.test(tanggal)) {
			  console.log(tanggal);
			  $.ajax({
					type: "post",
					url: "<?=base_url()?>petambak/perkiraan_produksi",
					data: {hari: a, kode: <?=$this->uri->segment(3)?>, no:'tabel'}, // appears as $_GET['id'] @ your backend side
					// dataType: "html",
					success: function(data1) {
						// console.log(data1);
						$("#sinitabel").html(data1);
					}
				});

			   $.ajax({
					type: "post",
					url: "<?=base_url()?>petambak/perkiraan_produksi",
					data: {hari: a, kode: <?=$this->uri->segment(3)?>, tanggal: tanggal}, // appears as $_GET['id'] @ your backend side
					// dataType: "html",
					success: function(data1) {
						// console.log(data1);
						$("#detailsini").html(data1);
					}
				});

			   
			}else{
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

			    
			    toastr.warning("<b>Gagal</b><br>Tanggal Harus Dipilih Terlebih Dulu");
			}
			// var value = $('select[name="lokasi_lahan"]').val();
			// window.location.replace("<?=base_url()?>petambak/perkiraan_produksi/"+value);
		}
	</script>
	<?php endif ?>
	
<?php endif ?>

<?php if ($this->uri->segment(2) == 'transaksi'): ?>

	<?php if ($this->uri->segment(3) == '' or $this->uri->segment(3) == null): ?>
	<script type="text/javascript">
		function changeFuncLahan()
		{
			var value = $('select[name="lokasi_lahan"]').val();
			window.location.replace("<?=base_url()?>petambak/transaksi/"+value);
		}
	</script>
		
	<?php endif ?>


	<?php if ($this->uri->segment(3) != null or $this->uri->segment(3) != ''): ?>
	
	<script type="text/javascript">
	<?php foreach ($elemen_produksi->result() as $key => $value): ?>
	
	    var elem = document.getElementById("inputan<?=$value->id_elemen?>");

	    elem.addEventListener("keydown",function(event){
	        var key = event.which;
	        if((key<48 || key>57) && key != 8) event.preventDefault();
	    });

	    elem.addEventListener("keyup",function(event){
	        var value = this.value.replace(/,/g,"");
	        this.dataset.currentValue=parseInt(value);
	        var caret = value.length-1;
	        while((caret-3)>-1)
	        {
	            caret -= 3;
	            value = value.split('');
	            value.splice(caret+1,0,",");
	            value = value.join('');
	        }
	        this.value = value;
	    });
	   
	
	<?php endforeach ?>
	</script>
	<script type="text/javascript">
		function submitdata()
		{
			// console.log(a);
			var reString = /^\d{4}-\d\d-\d\d$/;
			var tanggal = $("#tanggal").val();
			var masa_tumbuh = $("#masa_tumbuh").val();
			// console.log(tanggal);
			// if (reString.test(tanggal)) {
			//   // console.log(tanggal);
			 
			// }
			var data = $('#elemen_produksi').serializeArray();
			var $emptyFields = $('#elemen_produksi :input').filter(function() {
	            return $.trim(this.value) === "";
	            // return this.name;
	        });

	        if (!$emptyFields.length) {
	        	if (reString.test(tanggal)) {
				  if (masa_tumbuh == '' || masa_tumbuh == null) {
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

					    toastr.error("<b>Error</b><br>Masa Tumbuh Harus Dipilih");
				  }else{
				  		$.ajax({
							type: "post",
							url: "<?=base_url()?>petambak/transaksi",
							data: {hari: masa_tumbuh, data : data, kode: <?=$this->uri->segment(3)?>, tanggal: tanggal,no:'tabel'}, // appears as $_GET['id'] @ your backend side
							// dataType: "html",
							success: function(data1) {
								// console.log(data1);
								$("#sinitabel").html(data1);
							}
						});

					  	$.ajax({
							type: "post",
							url: "<?=base_url()?>petambak/transaksi",
							data: {hari: masa_tumbuh, data : data, kode: <?=$this->uri->segment(3)?>, tanggal: tanggal, no : 'detail'}, // appears as $_GET['id'] @ your backend side
							// dataType: "html",
							success: function(data1) {
								console.log(data1);
								$("#detailsini").html(data1);
							}
						});
				  }
				}else{
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

				    toastr.error("<b>Error</b><br>Tanggal Harus Terisi");
				}
	        }else{
	        	// console.log('tiada');
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

			    toastr.error("<b>Error</b><br>Semua Input Form Pada Field Satuan Harus Terisi");
	        }

		}
	</script>	

	<script>
	    $(document).ready(function(){
	        $('#tabel-data').DataTable({
				"pageLength": 10,
				"searching": true,
				"paging":   true,
				"ordering": true,
				"info":     true,

	        });
	        
	    });
	</script>
	
	<?php endif ?>


	
<?php endif ?>

<?php if ($this->uri->segment(2) == 'penambahan'): ?>
	<script type="text/javascript">

		function changeFuncKecamatan($i) {
			var value = $i;
			if (value == '' || value == null) {
				// console.log('kosong bosku');
				$('#kelurahan').html('<option>-Sila Pilih Kecamatan Dulu</option>');
				$('#kelurahan').attr('disabled','disabled');
				$('#peta').html('');
			}else{
				$.ajax({

	              type: "post",
	              url: "<?=base_url()?>petambak/penambahan/pilih_kelurahan",
	              data: {kecamatan: value}, // appears as $_GET['id'] @ your backend side
	              // dataType: "json",
	              success: function(data1) {

	                // console.log(data1);
	                $('#kelurahan').html(data1);
	                $('#kelurahan').removeAttr('disabled');;
	              }

	            });
	            $.ajax({

	              type: "post",
	              url: "<?=base_url()?>petambak/peta",
	              data: {kecamatan: value}, // appears as $_GET['id'] @ your backend side
	              // dataType: "json",
	              success: function(data1) {
	              	 $('#peta').html(data1);
	                console.log(data1);
	               
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
	   
	    setInputFilter(document.getElementById("pbb"), function(value) {
	      return /^-?\d*$/.test(value); });
	   
	</script>
<?php endif ?>



	
	

	

	<script src="<?=base_url()?>assets/scripts/main.min.js"></script>