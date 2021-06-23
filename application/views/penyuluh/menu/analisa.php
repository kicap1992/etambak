		<div class="row small-spacing">
			<div class="col-xs-12">
				<div class="box-content card">
					<h4 class="box-title">List Lahan Kabupaten <?=$nama_kecamatan?></h4>
					<div class="card-content">
						<div class="form-horizontal">
							<div class="form-group">
								<?php  
									$cek_jumlah_petambak = $this->mpenyuluh->tampil_data_group_by('tb_lahan',array('kecamatan' => $no_kecamatan),'nik_petambak');
								?>
								<label class="col-sm-4 control-label">Jumlah Petambak</label>
								<div class="col-sm-5">
									<input type="text" disabled="" class="form-control" value="<?=count($cek_jumlah_petambak->result())?>">
								</div>
								<div class="col-sm-3"></div>
							</div>
							<div class="form-group">
								<label class="col-sm-4 control-label">Jumlah Lahan</label>
								<div class="col-sm-5">
									<input type="text" disabled="" class="form-control" value="<?=count($cek_lahan_kecamatan->result())?>">
								</div>
								<div class="col-sm-3"></div>
							</div>
						</div>
						<div class="form-group" style="overflow-x: auto">
							<table id="tabel-data" class="table table-striped table-bordered display" style="width:100%">
								<thead>
									<tr>
										<th>No</th>
										<th>Kode Lahan</th>
										<th>Petambak</th>
										<th>No PBB</th>
										<th>Jenis Tambak</th>
										<th>Luas</th>
										<th>Kelurahan</th>
										<th>Aksi</th>
									</tr>
								</thead>
								<tbody>
								<?php $i =1; foreach ($cek_lahan_kecamatan->result() as $key => $value): 
									$cek_petambak = $this->mpenyuluh->tampil_data_where('tb_petambak',array('nik' => $value->nik_petambak));
									foreach ($cek_petambak->result() as $key1 => $value1) ;
									$cek_tek_tambak = $this->mpenyuluh->tampil_data_where('tb_tambak',array('id_tambak' => $value->tek_tambak));
									foreach ($cek_tek_tambak->result() as $key2 => $value2) ;
									$cek_kelurahan = $this->mpenyuluh->tampil_data_where('tb_kelurahan',array('id_kelurahan' => $value->kelurahan));
									foreach ($cek_kelurahan->result() as $key3 => $value3) ;
									
									?>
									<tr>
										<td><?=$i?></td>
										<td><?=$value->id_lahan?></td>
										<td><?=$value1->nama?></td>
										<td><?=$value->no_pbb?></td>
										<td><?=$value2->tambak?></td>
										<td><?=$value->luas_lahan?></td>
										<td><?=$value3->kelurahan?></td>
										<td>
											<a href="<?=base_url()?>penyuluh/analisa/<?=$value->id_lahan?>"><button type="button" title="Analisa Produksi" class="btn btn-info btn-circle btn-sm waves-effect waves-light"><i class="ico fa fa-list-alt"></i></button></a>
											
										</td>
									</tr>
								<?php $i++; endforeach ?>
								</tbody>
							</table>
						</div>
					</div>
				</div>				
			</div>


			<div class="col-xs-12">
				<div class="box-content card">
					<h4 class="box-title">Luas Lahan Petambak : <span class="nowrap" id="luas1"></span> Ha	</h4>
					<h4 class="box-title">Jumlah Lahan : <?=count($cek_lahan_kecamatan->result())?>	</h4>

					<div class="card-content">
						<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>

	            		<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBw6bnAk0C2jIDDbz_dVRso9gUEnHLTH68&libraries=drawing,places,geometry"></script>
	            		<script type="text/javascript">
							var infowindow = new google.maps.InfoWindow({
								size: new google.maps.Size(150, 50)
							});

	          				var geocoder;

	          				function numberWithCommas(x) {
						      return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
						    }

	          				function initialize() {
	                			var geolib = google.maps.geometry.spherical;
	                
								var myOptions = {
									zoom: 12,
									center: new google.maps.LatLng(-4.0741291, 119.63409424),
									mapTypeControl: true,
									mapTypeControlOptions: {
									style: google.maps.MapTypeControlStyle.DROPDOWN_MENU
									},
									navigationControl: true,
									mapTypeId: 'roadmap'
								}
								map = new google.maps.Map(document.getElementById("map_canvas"),myOptions);

								google.maps.event.addListener(map, 'click', function() {
									infowindow.close();
								});

								bounds = new google.maps.LatLngBounds();

	<?php ////////////// sini awal tampil kecamatan ////////////////////////// ?>
	                    
	                      		<?php foreach ($kecamatan->result() as $key => $value) { ?>
	                      		
	                      		
	                      		var polygon_<?=$value->id_kecamatan?> = new google.maps.Polygon({
	                      			map: map,
	                      			path: [<?=$value->kordinat?>],
	                      			strokeColor: "#000000",
									strokeOpacity: 2,
									strokeWeight: 1,
									fillColor: "#B85612",
									fillOpacity: 0.4,
	                      		});



	                      		<?php } ?>

	<?php ////////////// sini akhir tampil kecamatan ////////////////////////// ?>

	<?php ////////////// sini awal tampil lahan ////////////////////////// ?>
	                    
	                      		<?php foreach ($cek_lahan_kecamatan->result() as $key => $value) { ?>
	                      		
	                      		<?php  
	                      			if ($value->tek_tambak == 1) {
	                      				$color = "#FE2D00";
	                      			}elseif ($value->tek_tambak == 2) {
	                      				$color = "#77FE00";
	                      			}elseif ($value->tek_tambak == 3) {
	                      				$color = "#1F00FE";
	                      			}
	                      		?>
	                      		var lahan_<?=$value->id_lahan?> = new google.maps.Polygon({
	                      			map: map,
	                      			path: [<?=$value->point?>],
	                      			strokeColor: "#000000",
									strokeOpacity: 2,
									strokeWeight: 1,
									fillColor: "<?=$color?>",
									fillOpacity: 0.4,
	                      		});



	                      		<?php } ?>

	<?php ////////////// sini akhir tampil lahan ////////////////////////// ?>

	<?php ////////////// sini awal infowindows kecamatan ////////////////////////// ?>
	                    
	                     		<?php foreach ($kecamatan->result() as $key => $value) { ?>
	                     		
								google.maps.event.addListener(polygon_<?=$value->id_kecamatan?>, 'click', function(event) {
									var vertices = this.getPath();
									var luas = google.maps.geometry.spherical.computeArea(polygon_<?=$value->id_kecamatan?>.getPath()) / 10000;
									luas = numberWithCommas(luas.toFixed(2));
									var contentString ="<div class='form-group' >"+
									                    "<h5>Kecamatan : <?=$value->kecamatan?></h5>"+
									                    "<h5>Luas : "+luas + " Ha"+"</h5>"+
									                    "</div>";

									infowindow.setContent(contentString);
									infowindow.setPosition(event.latLng);
									infowindow.open(map);
								});
								
								// for (var i = 0; i < polygon_<?=$value->id_kecamatan?>.getPath().getLength(); i++) {
			                        // bounds.extend(polygon_<?=$value->id_kecamatan?>.getPath().getAt(i));
			                      // }


	                     		<?php } ?>
	<?php ////////////// sini akhir infowindows kecamatan ////////////////////////// ?>


	<?php ////////////// sini awal infowindows lahan ////////////////////////// ?>
	                    
	                     		<?php foreach ($cek_lahan_kecamatan->result() as $key => $value) { 
	                     			$cek_tek_tambak = $this->mpenyuluh->tampil_data_where('tb_tambak',array('id_tambak' => $value->tek_tambak));
									foreach ($cek_tek_tambak->result() as $key2 => $value2) ;
									$cek_kelurahan = $this->mpenyuluh->tampil_data_where('tb_kelurahan',array('id_kelurahan' => $value->kelurahan));
									foreach ($cek_kelurahan->result() as $key3 => $value3) ;
	                     			?>
	                     		
								google.maps.event.addListener(lahan_<?=$value->id_lahan?>, 'click', function(event) {
									var vertices = this.getPath();
									var luas = google.maps.geometry.spherical.computeArea(lahan_<?=$value->id_lahan?>.getPath()) / 10000;
									luas = numberWithCommas(luas.toFixed(2));
									var contentString ="<div class='form-group' >"+
														"<h5>ID Lahan: <?=$value->id_lahan?></h5>"+
														"<h5>Teknologi Tambak : <?=$value2->tambak?></h5>"+
									                    "<h5>Kecamatan : <?=$nama_kecamatan?></h5>"+
									                    "<h5>Kelurahan : <?=$value3->kelurahan?></h5>"+
									                    "<h5>Luas : "+luas + " Ha"+"</h5>"+
									                    '<center><a href="<?=base_url()?>penyuluh/analisa/<?=$value->id_lahan?>"><button type="button" title="Analisa Produksi" class="btn btn-info btn-circle btn-sm waves-effect waves-light"><i class="ico fa fa-list-alt"></i></button></a></center> '+
									                    "</div>";

									infowindow.setContent(contentString);
									infowindow.setPosition(event.latLng);
									infowindow.open(map);
								});
								
								for (var i = 0; i < lahan_<?=$value->id_lahan?>.getPath().getLength(); i++) {
			                        bounds.extend(lahan_<?=$value->id_lahan?>.getPath().getAt(i));
			                      }


	                     		<?php } ?>
	<?php ////////////// sini akhir infowindows lahan ////////////////////////// ?>


	<?php ////////////// sini awal kira luas lahan petambak ////////////////////////// ?>
	                     		<?php foreach ($cek_lahan_kecamatan->result()  as $key => $value) { ?>
	                     		var luasl<?=$value->id_lahan?> =google.maps.geometry.spherical.computeArea(lahan_<?=$value->id_lahan?>.getPath());

	                     		<?php } ?>

	                     		var luaslahan = <?php foreach ($cek_lahan_kecamatan->result() as $key => $value) { echo "luasl".$value->id_lahan."+";} ?>0;

	                     		luaslahan = luaslahan / 10000;
	     
	                     		document.getElementById("luas1").innerHTML =  numberWithCommas(luaslahan.toFixed(2));

	<?php ////////////// sini akhir kira luas lahan petambak ////////////////////////// ?>                    		
	                     		map.fitBounds(bounds);

	                     		 


	              
	            			}


	                    
	                 
				            google.maps.event.addDomListener(window, 'load', initialize);
				            // document.getElementById('luas').value = luas;

				        </script>

						<div id="vertices"></div>
						<div id="map_canvas"></div>

					</div>

					

					

				</div>
				<!-- /.box-content -->
			</div>

			<!-- /.col-xs-12 -->

			<!-- /.col-lg-6 col-xs-12 -->
		</div>