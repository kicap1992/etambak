		<div class="row small-spacing">
			<div class="col-xs-12">
				<div class="box-content">
					<div class="card-content">
						<form class="form-horizontal">
							<div class="form-group">
								<label for="inp-type-1" class="col-sm-3 control-label">PILIH KECAMATAN :</label>
								<div class="col-sm-6">
									<select class="form-control" onchange="changeFuncKecamatan(value);">
										<option value="">-Pilih Kecamatan</option>
										<?php foreach ($kecamatan->result() as $key => $value) { ?>
										<option value="<?=$value->id_kecamatan?>"><?=$value->kecamatan?></option>
										<?php } ?>										
									</select>
								</div>
								<div class="col-sm-3"></div>
							</div>							
						</form>
					</div>

					<div class="card-content">
						<form class="form-horizontal">
							<div class="form-group">
								<label for="inp-type-1" class="col-sm-3 control-label">PILIH KELURAHAN :</label>
								<div class="col-sm-6">
									<select class="form-control" disabled="">
										<option value="">-Sila Pilih Kecamatan Dulu</option>
									</select>
								</div>
								<div class="col-sm-3"></div>
							</div>
						</form>
					</div>


					<div class="card-content">
						<form class="form-horizontal">
							<div class="form-group">
								<label for="inp-type-1" class="col-sm-3 control-label">N I K :</label>
								<div class="col-sm-6">
									<input type="text" class="form-control" id="exampleInputEmail1" placeholder="Pilih Kecamatan dan Kelurahan Dulu" disabled="">
								</div>
								<div class="col-sm-3"></div>
							</div>
						</form>
					</div>

					<div class="card-content">
						<form class="form-horizontal">
							<div class="form-group">
								<label for="inp-type-1" class="col-sm-3 control-label">Nama Lengkap :</label>
								<div class="col-sm-6">
									<input type="text" class="form-control" id="exampleInputEmail1" placeholder="Pilih Kecamatan dan Kelurahan Dulu" disabled="">
								</div>
								<div class="col-sm-3"></div>
							</div>
						</form>
					</div>
				</div>
				<!-- /.box-content -->
			</div>


			<div class="col-xs-12">
				<div class="box-content">
					<!-- <div class="card-content">
						<form class="form-horizontal">
							<div class="form-group">
								<label for="inp-type-1" class="col-sm-3 control-label">ID LOKASI :</label>
								<div class="col-sm-6">
									<input type="text" class="form-control" id="exampleInputEmail1" placeholder="Otomatis">
								</div>
								<div class="col-sm-3"></div>
							</div>							
						</form>
					</div> -->

					<div class="card-content">
						<form class="form-horizontal">
							<div class="form-group">
								<label for="inp-type-1" class="col-sm-3 control-label">NO PBB :</label>
								<div class="col-sm-6">
									<input type="text" class="form-control" id="exampleInputEmail1" placeholder="Pilih Kecamatan dan Kelurahan Dulu" disabled="">
								</div>
								<div class="col-sm-3"></div>
							</div>
						</form>
					</div>


					<!-- <div class="card-content">
						<form class="form-horizontal">
							<div class="form-group">
								<label for="inp-type-1" class="col-sm-3 control-label">Luas Lahan: :</label>
								<div class="col-sm-6">
									<input type="text" class="form-control" id="exampleInputEmail1" placeholder="Otomatis">
								</div>
								<div class="col-sm-3"></div>
							</div>
						</form>
					</div> -->

					<div class="card-content">
						<form class="form-horizontal">
							<div class="form-group">
								<label for="inp-type-1" class="col-sm-3 control-label">Teknologi Tambak :</label>
								<div class="col-sm-6">
									<select class="form-control" disabled="">
										<option value="">-Pilih Kecamatan dan Kelurahan Dulu</option>
										<!-- <option value="1">1</option>
										<option value="2">2</option> -->
									</select>
								</div>
								<div class="col-sm-3"></div>
							</div>
						</form>
					</div>
				</div>
				<!-- /.box-content -->
			</div>


			<div class="col-xs-12">
				<div class="box-content">
					<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>

            		<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBw6bnAk0C2jIDDbz_dVRso9gUEnHLTH68&libraries=drawing,places,geometry"></script>
            		
            		<script type="text/javascript" >
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
								zoom: 16,
								center: new google.maps.LatLng(-2.247762, 119.373063),
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


<?php ///////////////// awal untuk kordinat//////////////////////////////////// ?>
                    
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

<?php ///////////////// akhir untuk kordinat//////////////////////////////////// ?>


<?php //////////////// awal untuk infowindows ///////////////////////////////// ?>
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

                     		map.fitBounds(bounds);
<?php //////////////// akhir untuk infowindows ///////////////////////////////// ?>

            			}


                    
                 
			            google.maps.event.addDomListener(window, 'load', initialize);
			            // document.getElementById('luas').value = luas;

			        </script>
			    	

					<div id="vertices"></div>
					<div id="map_canvas"></div>

				</div>
			</div>

			<div class="row small-spacing">
				<div class="col-lg-6 col-md-6 col-xs-12">
					<div class="box-content bg-success text-white">
						<div class="statistics-box with-icon">
							<i class="ico small fa fa-diamond"></i>
							<p class="text text-white">Produksi Sebelumnya</p>
							<h2 class="counter">?? Kg</h2>
						</div>
					</div>
					<!-- /.box-content -->
				</div>
				<!-- /.col-lg-3 col-md-6 col-xs-12 -->
				<div class="col-lg-6 col-md-6 col-xs-12">
					<div class="box-content bg-info text-white">
						<div class="statistics-box with-icon">
							<i class="ico small fa fa-download"></i>
							<p class="text text-white">Prediksi Produksi</p>
							<h2 class="counter">?? Kg</h2>
						</div>
					</div>
					<!-- /.box-content -->
				</div>
				<!-- /.col-lg-3 col-md-6 col-xs-12 -->
				
			</div>
			<!-- /.col-xs-12 -->

			<!-- /.col-lg-6 col-xs-12 -->
		</div>