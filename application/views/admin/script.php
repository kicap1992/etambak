	<script src="<?=base_url()?>assets/scripts/jquery.min.js"></script>
	<script src="<?=base_url()?>assets/scripts/modernizr.min.js"></script>
	<script src="<?=base_url()?>assets/plugin/bootstrap/js/bootstrap.min.js"></script>
	<script src="<?=base_url()?>assets/plugin/nprogress/nprogress.js"></script>
	<!-- <script src="<?=base_url()?>assets/plugin/sweet-alert/sweetalert.min.js"></script> -->
	<script src="<?=base_url()?>assets/plugin/waves/waves.min.js"></script>

	

	<!-- <script src="<?=base_url()?>assets/toastr/toastr.min.js"></script>
  	<link rel="stylesheet" type="text/css" href="<?=base_url()?>assets/toastr/toastr.min.css"> -->
  	<script src="<?=base_url()?>assets/plugin/datatables/media/js/jquery.dataTables.min.js"></script>
	<script src="<?=base_url()?>assets/plugin/datatables/media/js/dataTables.bootstrap.min.js"></script>

  	<script src="<?=base_url()?>assets/plugin/toastr/toastr.min.js"></script>
  	<link rel="stylesheet" type="text/css" href="<?=base_url()?>assets/plugin/toastr/toastr.css">

  	<script src="<?php echo base_url() ?>sweet-alert/sweetalert.js"></script>


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

		function changeFuncKecamatan($i) {
			var value = $i;
			if (value == '' || value == null) {
				$.ajax({

					type: "post",
					url: "<?=base_url()?>admin/peta",
					data: {data: "ambil"}, // appears as $_GET['id'] @ your backend side
					dataType: "html",
					success: function(data1) {
						 $('#peta').html(data1);
						// console.log(data1);

					}

				});
			}else{
				$.ajax({

					type: "post",
					url: "<?=base_url()?>admin/peta_kecamatan",
					data: {kecamatan: value}, // appears as $_GET['id'] @ your backend side
					dataType: "html",
					success: function(data1) {
						 $('#peta').html(data1);
						// console.log(data1);

					}

				});

			}
			
		}



	</script>

	<script type="text/javascript">
		$.ajax({

			type: "post",
			url: "<?=base_url()?>admin/peta",
			data: {data: 'ambil'}, // appears as $_GET['id'] @ your backend side
			dataType: "html",
			success: function(data1) {
				 $('#peta').html(data1);
				// console.log(data1);

			}

		});
	</script>
<?php endif ?>


<?php if ($this->uri->segment(2)== 'data_petambak'): ?>
	
	<script>
	    $(document).ready(function(){
	        $('#tabel-data').DataTable({
	          "pageLength": 50
	        });
	    });
 	</script>

 	<script type="text/javascript">
 		function changeFuncKecamatan($i) {
			var value = $i;
			if (value == '' || value == null) {
				value=0;
				$.ajax({

					type: "post",
					url: "<?=base_url()?>admin/data_petambak",
					data: {kecamatan: value}, // appears as $_GET['id'] @ your backend side
					dataType: "html",
					success: function(data1) {
						$('#disini_tabel').html(data1);

					}

				});
			}else{
				$.ajax({

					type: "post",
					url: "<?=base_url()?>admin/data_petambak",
					data: {kecamatan: value}, // appears as $_GET['id'] @ your backend side
					dataType: "html",
					success: function(data1) {
						$('#disini_tabel').html(data1);

					}

				});

			}
			
		}
 	</script>
<?php endif ?>

<?php if ($this->uri->segment(2)== 'data_petambak1'): ?>
	<?php if ($this->uri->segment(3) == ''): ?>
		<script>
		    $(document).ready(function(){
		        $('#tabel-data').DataTable({
		          "pageLength": 50
		        });
		    });
	 	</script>
	<?php endif ?>
<?php endif ?>

<?php if ($this->uri->segment(2)== 'data_penyuluh'): ?>
	<?php if ($this->uri->segment(3) == ''): ?>
		<script>
		    $(document).ready(function(){
		        $('#tabel-data').DataTable({
		          "pageLength": 50
		        });
		    });
	 	</script>
	<?php endif ?>
<?php endif ?>


<?php if ($this->uri->segment(2)== 'data_produksi'): ?>

	<script type="text/javascript">
		function myFunction(a) {
			if (a == 0) {
				var x = $("#myDIV");
				var xx = document.getElementById("myDIV");
			}else if (a == 1) {
				var x = $("#myDIV1");
				var xx = document.getElementById("myDIV1");
			}else if (a == 2) {
				var x = $("#myDIV2");
				var xx = document.getElementById("myDIV2");
			}

			
			if (xx.style.display === "none") {
				x.slideToggle();
			} else {
				x.slideToggle();
			}
		}

	</script>

	<script type="text/javascript">
	<?php foreach ($produksi->result() as $key => $value): ?>
	
	    var elem = document.getElementById("inputan<?=$value->id_elemen?>tradisional");

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
	<?php foreach ($produksi->result() as $key => $value): ?>
	
	    var elem = document.getElementById("inputan<?=$value->id_elemen?>semi_modern");

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
	<?php foreach ($produksi->result() as $key => $value): ?>
	
	    var elem = document.getElementById("inputan<?=$value->id_elemen?>modern");

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
	<?php foreach ($produksi->result() as $key => $value): ?>
	
	    var elem = document.getElementById("elemen<?=$value->id_elemen?>tradisional");

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
	<?php foreach ($produksi->result() as $key => $value): ?>
	
	    var elem = document.getElementById("elemen<?=$value->id_elemen?>semi_modern");

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
	<?php foreach ($produksi->result() as $key => $value): ?>
	
	    var elem = document.getElementById("elemen<?=$value->id_elemen?>modern");

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
	


	<script>
	    $(document).ready(function(){
	        $('#tabel-data').DataTable({
				"pageLength": 50,
				"searching": false,
				"paging":   false,
				"ordering": true,
				"info":     false,

	        });
	        
	    });
	</script>

	

	<script type="text/javascript">
		function hahah(){
			console.log('sini');
		}

		function update_tambak(a){
			
			if (a == 1) {
				x = 'tradisional';
				xx ='Tradisional';
			}else if(a == 2) {
				x = 'semi_modern';
				xx ='Semi Modern';
			}else if(a == 3) {
				x = 'modern';
				xx ='Modern';
			}

			var data = $('#elemen_produksi_'+x).serializeArray();

			
		 	var $emptyFields = $('#elemen_produksi_'+x+' :input').filter(function() {
	            return $.trim(this.value) === "";
	            // return this.name;
	        });

	        if (!$emptyFields.length) {
	            // console.log("form has been filled");
	            $.ajax({

					type: "post",
					url: "<?=base_url()?>admin/data_produksi",
					data: {data_produksi_tambak: data, kode : a}, // appears as $_GET['id'] @ your backend side
					// dataType: "html",
					success: function(data1) {
						window.location.replace("<?=base_url()?>admin/data_produksi/");
					}

				});
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

			    toastr.error("<b>Error</b><br>Semua Data Pada Form Elemen Produksi TambaK "+xx+" Harus Terisi");
	        }	
		}

		function satuan_produksi(a){
			if (a == 1) {
				x = 'tradisional';
				xx ='Tradisional';
			}else if(a == 2) {
				x = 'semi_modern';
				xx ='Semi Modern';
			}else if(a == 3) {
				x = 'modern';
				xx ='Modern';
			}

			var data = $('#satuan_produksi_'+x).serializeArray();
	 		<?php foreach ($produksi->result() as $key => $value): ?>
	 		var elemen<?=$value->id_elemen?> = $('#satuan_produksi_'+x+' #elemen<?=$value->id_elemen?>'+x) ;
	 		<?php endforeach ?>

	 		<?php
	 		$if = '';  
	 		foreach ($produksi->result() as $key => $value) {
	 			$if.='if (elemen'.$value->id_elemen.'.val() == "" ) {
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

					    toastr.error("<b>Error</b><br>Kolum Inputan '.$value->nama_elemen.' Harus Terisi");
					    elemen'.$value->id_elemen.'.focus();

	 				}else ';
	 		} echo $if;?>{

	 			$.ajax({

					type: "post",
					url: "<?=base_url()?>admin/data_produksi",
					data: {satuan_produksi_tambak: data, kode : a}, // appears as $_GET['id'] @ your backend side
					// dataType: "html",
					success: function(data1) {
						
						window.location.replace("<?=base_url()?>admin/data_produksi/");
					}
				});
	 		}
		}
	</script>

	<script type="text/javascript">
		function hapus_elemen(a,b){
			// alert(a);
			swal({
		        title: "Hapus Faktor Produksi?",
		        text: "Anda akan menghapus faktor produksi \n"+b,
		        icon: "warning",
		        buttons: true,
		        dangerMode: true,
	      	})
		      .then((logout) => {
		        if (logout) {
		        	$.ajax({

						type: "post",
						url: "<?=base_url()?>admin/data_produksi",
						data: {no: a}, // appears as $_GET['id'] @ your backend side
						// dataType: "html",
						success: function(data1) {
							
							// console.log(data1);
							window.location.replace("<?=base_url()?>admin/data_produksi/");
						}

					});
		        } 
	      	});
		}

		function tambah_satuan(){
			var data = $('#penambahan_produksi').serializeArray();
			var fp = $("#faktor_produksi");
			var satuan = $("#satuan_input");
			console.log(data);
			if (fp.val() == '' || fp.val() == null) {
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

			    toastr.error("<b>Error</b><br>Faktor Produksi Harus Diisi");
			    fp.focus();
			}else if(satuan.val() == '' || satuan.val() == null) {
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

			    toastr.error("<b>Error</b><br>Satuan Faktor Produksi Harus Diisi");
			    satuan.focus();
			}else{
				$.ajax({

					type: "post",
					url: "<?=base_url()?>admin/data_produksi",
					data: {data_produksi: data}, // appears as $_GET['id'] @ your backend side
					// dataType: "html",
					success: function(data1) {
						
						// console.log(data1);
						window.location.replace("<?=base_url()?>admin/data_produksi/");
					}

				});
			}
		}
	</script>
		
<?php endif ?>


<?php if ($this->uri->segment(2)== 'prediksi' or $this->uri->segment(2)== 'hasil_tahunan'): ?>
	<?php if ($this->uri->segment(3) == '' or $this->uri->segment(3) == null): ?>
		<script>
		    $(document).ready(function(){
		        $('#tabel-data').DataTable({
		        	"aLengthMenu": [[20, 40, 60, ,80, -1], [20, 40, 60, 80 ,"All"]],
	        		"iDisplayLength": 20
					// "pageLength": 5,
					// "searching": false,
					// "paging":   false,
					// "ordering": false,
					// "info":     false,

		        });
		        
		    });
		</script>

		<script type="text/javascript">
			<?php foreach ($data_produksi->result() as $key => $value): ?>
			
			    var elem = document.getElementById("inputan<?=$value->no?>");

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

			function update_hasil()
			{
				var data = $('#hasil_produksi').serializeArray();
				data = jQuery.grep(data, function(value) {
	              return value['name'] != 'tabel-data_length';
	            });
	            console.log(data);
		 		<?php foreach ($data_produksi->result() as $key => $value): ?>
		 			<?php if ($value->no <= 20): ?>
		 		var inputan<?=$value->no?> = $('#inputan<?=$value->no?>') ;		
		 			<?php endif ?>
		 		<?php endforeach ?>

		 		<?php
		 		$if = '';  
		 		foreach ($data_produksi->result() as $key => $value) {
		 			if ($value->no <= 20) {
		 				$if.='if (inputan'.$value->no.'.val() == "" ) {
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

						    toastr.error("<b>Error</b><br>Kolum Inputan '.$value->no.' Harus Terisi");
						    inputan'.$value->no.'.focus();

		 				}else ';
		 			}
		 			
		 		} echo $if;?>{
		 			// console.log('sini');
		 			$.ajax({

						type: "post",
						url: "<?=base_url()?>admin/prediksi",
						data: {inputannya: data}, // appears as $_GET['id'] @ your backend side
						// dataType: "html",
						success: function(data1) {
							// console.log(data1);
							window.location.replace("<?=base_url()?>admin/prediksi/");
						}
					});
		 		}
			}
				
		</script>

		<script type="text/javascript">

			function edit_kah(){
				<?php  
				foreach ($data_produksi->result() as $key => $value) {
		 			if ($value->no <= 20) {?>
		 				$("#inputan<?=$value->no?>").prop("disabled", false);
		 				<?php
		 			}
		 		}
		 		?>

		 		$('#edit_kah').hide();
		 		$('#button_update').show();
		 		$('#button_cancel').show();
			}

			function cancel_button(){
				<?php  
				foreach ($data_produksi->result() as $key => $value) {
		 			if ($value->no <= 20) {?>
		 				$("#inputan<?=$value->no?>").prop("disabled", true);
		 				$("#inputan<?=$value->no?>").val("<?=number_format($value->hasil)?>");
		 				<?php
		 			}
		 		}
		 		?>

		 		$('#edit_kah').show();
		 		$('#button_update').hide();
		 		$('#button_cancel').hide();
			}

			$.ajax({

				type: "post",
				url: "<?=base_url()?>admin/json_hasil",
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
	
<?php endif ?>


<?php if ($this->uri->segment(2)== 'hasil_kecamatan'): ?>
	<script>
	    $(document).ready(function(){
	        $('#tabel-data').DataTable({
	        	"aLengthMenu": [[15, 30, 45, ,60, -1], [15, 30, 45, 60 ,"All"]],
        		"iDisplayLength": 15
				// "pageLength": 5,
				// "searching": false,
				// "paging":   false,
				// "ordering": false,
				// "info":     false,

	        });
	        
	    });
	</script>

	<script type="text/javascript">
 		function changeFuncKecamatan($i) {
			var value = $i;
			if (value == '' || value == null) {
				value=0;
				$.ajax({

					type: "post",
					url: "<?=base_url()?>admin/hasil_kecamatan",
					data: {kecamatan: value}, // appears as $_GET['id'] @ your backend side
					dataType: "html",
					success: function(data1) {
						$('#disini_tabel').html(data1);

					}

				});
			}else{
				$.ajax({

					type: "post",
					url: "<?=base_url()?>admin/hasil_kecamatan",
					data: {kecamatan: value}, // appears as $_GET['id'] @ your backend side
					dataType: "html",
					success: function(data1) {
						$('#disini_tabel').html(data1);

					}

				});

			}
			
		}
 	</script>
<?php endif ?>



	



	
	

	

	<script src="<?=base_url()?>assets/scripts/main.min.js"></script>