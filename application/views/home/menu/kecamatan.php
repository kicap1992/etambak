		<div class="row small-spacing">
			<div class="col-xs-12">
				<div class="box-content card">
					<h4 class="box-title">Luas Kota Parepare : <span class="nowrap" id="luas1"></span> Ha	</h4>
					<h4 class="box-title">Jumlah Tambak : <?=count($lahan->result())?>	</h4>

					<div class="box-content">
						
					
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
                      		
                      		<?php  
                      			if ($value->id_kecamatan == 1) {
                      				$color = "#5C00B3";
                      			}elseif ($value->id_kecamatan == 2) {
                      				$color = "#FFFF00";
                      			}elseif ($value->id_kecamatan == 3) {
                      				$color = "#0D0811";
                      			}elseif ($value->id_kecamatan == 4) {
                      				$color = "#B85612";
                      			}
                      		?>
                      		var polygon_<?=$value->id_kecamatan?> = new google.maps.Polygon({
                      			map: map,
                      			path: [<?=$value->kordinat?>],
                      			strokeColor: "#000000",
								strokeOpacity: 2,
								strokeWeight: 1,
								fillColor: "<?=$color?>",
								fillOpacity: 0.4,
                      		});



                      		<?php } ?>

<?php ////////////// sini akhir tampil kecamatan ////////////////////////// ?>

<?php ////////////// sini awal tampil lahan ////////////////////////// ?>
                    
                      		<?php foreach ($lahan->result() as $key => $value) { ?>
                      		
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
							
							for (var i = 0; i < polygon_<?=$value->id_kecamatan?>.getPath().getLength(); i++) {
		                        bounds.extend(polygon_<?=$value->id_kecamatan?>.getPath().getAt(i));
		                      }


                     		<?php } ?>
<?php ////////////// sini akhir infowindows kecamatan ////////////////////////// ?>


<?php ////////////// sini awal infowindows lahan ////////////////////////// ?>
                    
                     		<?php foreach ($lahan->result() as $key => $value) { 
                     			$cek_tek_tambak = $this->mhome->tampil_data_where('tb_tambak',array('id_tambak' => $value->tek_tambak));
								foreach ($cek_tek_tambak->result() as $key2 => $value2) ;
								$cek_kelurahan = $this->mhome->tampil_data_where('tb_kelurahan',array('id_kelurahan' => $value->kelurahan));
								foreach ($cek_kelurahan->result() as $key3 => $value3) ;
								$cek_kecamatan = $this->mhome->tampil_data_where('tb_kecamatan',array('id_kecamatan' => $value->kecamatan));
								foreach ($cek_kecamatan->result() as $key4 => $value4) ;
                     			?>
                     		
							google.maps.event.addListener(lahan_<?=$value->id_lahan?>, 'click', function(event) {
								var vertices = this.getPath();
								var luas = google.maps.geometry.spherical.computeArea(lahan_<?=$value->id_lahan?>.getPath()) / 10000;
								luas = numberWithCommas(luas.toFixed(2));
								var contentString ="<div class='form-group' >"+
													"<h5>ID Lahan: <?=$value->id_lahan?></h5>"+
													"<h5>Teknologi Tambak : <?=$value2->tambak?></h5>"+
								                    "<h5>Kecamatan : <?=$value4->kecamatan?></h5>"+
								                    "<h5>Kelurahan : <?=$value3->kelurahan?></h5>"+
								                    "<h5>Luas : "+luas + " Ha"+"</h5>"+
								                    '<center><a href="<?=base_url()?>home/data_petambak/<?=$value->id_lahan?>"><button type="button" title="Lihat Informasi Lahan" class="btn btn-info btn-circle btn-sm waves-effect waves-light"><i class="ico fa fa-list-alt"></i></button></a></center>'+
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


<?php ////////////// sini awal kira luas parepare ////////////////////////// ?>
                     		<?php foreach ($kecamatan->result()  as $key => $value) { ?>
                     		var luasl<?=$value->id_kecamatan?> =google.maps.geometry.spherical.computeArea(polygon_<?=$value->id_kecamatan?>.getPath());

                     		<?php } ?>

                     		var luaslahan = <?php foreach ($kecamatan->result() as $key => $value) { echo "luasl".$value->id_kecamatan."+";} ?>0;

                     		luaslahan = luaslahan / 10000;
     
                     		document.getElementById("luas1").innerHTML =  numberWithCommas(luaslahan.toFixed(2));

<?php ////////////// sini akhir kira luas parepare ////////////////////////// ?>                    		
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

			<div class="row small-spacing">
				<div class="col-xs-12">
					<div class="box-content card">
					<h4 class="box-title">Hasil Produksi Kecamatan</h4>
					<div class="card-content">
						<div class="form-group" style="overflow-x: auto" id="tabel_transaksi">
							<table id="tabel-data" class="table table-bordered">
								<thead>
									<tr>
										<th>No</th>
										<th>Tahun</th>
										<th>Musim</th>
										<th>Hasil Produksi</th>
									</tr>
								</thead>
								<tbody>
									<?php 
										$cek_musim = $this->mhome->tampil_data_keseluruhan('tb_hasil_produksi');
										foreach ($cek_musim->result() as $key => $value){ 
											if ($value->tahun >= 2020) {
												$hasil[$value->tahun.$value->musim] = 0;
											}
										}
										$i = 1;
										$cek_data = $this->mhome->produksi_kecamatan($this->uri->segment(3));
										// print_r(count($cek_data->result()));
										if (count($cek_data->result()) > 0) {
											foreach ($cek_data->result() as $key1 => $value1) {
												$ket = json_decode($value1->ket,true);
												foreach ($ket as $key2 => $value2) {
													// print_r($value2['jumlah_produksi']);print_r('<br>');
													$hasil[$value2['tahun'].$value2['musim']] = $hasil[$value2['tahun'].$value2['musim']] + $value2['jumlah_produksi'];
												}
											}
										}
										foreach ($cek_musim->result() as $key => $value){ 
											if ($value->tahun >= 2020) {
										?>
										<tr>
											<td><?=$i;$i++?></td>
											<td><?=$value->tahun?></td>
											<td><?=$value->musim?></td>
											<td><?=$hasil[$value->tahun.$value->musim]?></td>
										</tr>
									<?php } } ?>
								</tbody>
							</table>
						</div>
					</div>
				</div>
				</div>
			</div>


			
			
			<!-- /.col-xs-12 -->

			<!-- /.col-lg-6 col-xs-12 -->
		</div>