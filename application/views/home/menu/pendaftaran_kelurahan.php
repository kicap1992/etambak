		
		<div class="row small-spacing">
			<div class="col-xs-12">
				<div class="box-content">
					<div class="card-content">
						<form class="form-horizontal">
							<div class="form-group">
								<label for="inp-type-1" class="col-sm-3 control-label">PILIH KECAMATAN :</label>
								<div class="col-sm-6">
									<select class="form-control" onchange="changeFuncKecamatan(value);" name="kecamatan">
										<option value="" se>-Pilih Kecamatan</option>
										<?php foreach ($kecamatan->result() as $key => $value) { 
											if ($this->uri->segment(3) == $value->id_kecamatan) {
												$selected = "selected";
											}else{
												$selected = '';
											}
										?>
										<option value="<?=$value->id_kecamatan?>" <?=$selected?>><?=$value->kecamatan?></option>
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
									<select class="form-control" onchange="changeFuncKelurahan(value);" name="kelurahan">
										<option value="">-Pilih Kelurahan</option>
										<?php foreach ($kelurahan->result() as $key => $value) { 
											if ($this->uri->segment(4) == $value->id_kelurahan) {
												$selected = "selected";
											}else{
												$selected = '';
											}
										?>
										<option value="<?=$value->id_kelurahan?>" <?=$selected?>><?=$value->kelurahan?></option>
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
								<label for="inp-type-1" class="col-sm-3 control-label">N I K :</label>
								<div class="col-sm-6">
									<input type="text" class="form-control" id="nik" placeholder="Masukkan N I K" name="nik" minlength="16" maxlength="16">
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
									<input type="text" class="form-control" id="exampleInputEmail1" placeholder="Masukkan Nama Lengkap" name="nama">
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
									<input type="text" class="form-control" id="pbb" placeholder="Masukkan Nomor PBB" name="pbb" minlength="16" maxlength="16">
								</div>
								<div class="col-sm-3"></div>
							</div>
						</form>
					</div>


					<div class="card-content">
						<form class="form-horizontal">
							<div class="form-group">
								<label for="inp-type-1" class="col-sm-3 control-label">Luas Lahan: :</label>
								<div class="col-sm-6">
									<input type="text" class="form-control" id="luas_lahan" placeholder="Otomatis" disabled="">
									<input type="hidden" name="luas_lahan" id="luas_lahan1">
								</div>
								<div class="col-sm-3"></div>
							</div>
						</form>
					</div>

					<div class="card-content">
						<form class="form-horizontal">
							<div class="form-group">
								<label for="inp-type-1" class="col-sm-3 control-label">Teknologi Tambak :</label>
								<div class="col-sm-6">
									<select class="form-control" name="tambak">
										<option value="">-Pilih Teknologi Tambak</option>
										<?php foreach ($tambak->result() as $key => $value) { ?>
										<option value="<?=$value->id_tambak?>"><?=$value->tambak?></option>
										<?php } ?>
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
					<input type="button"  class="btn btn-info waves-effect waves-light" id="enablePolygon" value="Tanda Kordinat Tambak" name="enablePolygon" />
					<input type="button" class="btn btn-danger waves-effect waves-light" id="resetPolygon" value="Reset Kembali Kordinat" style="display: none;" />
					<input type="hidden" name ="point" id="coords">
					<div id="showonPolygon" ><b>Area:</b>  <span id="areaPolygon">&nbsp;</span>			
					</div> <br><br>
					<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>

            		<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBw6bnAk0C2jIDDbz_dVRso9gUEnHLTH68&libraries=drawing,places,geometry"></script>
            		
            		<script type="text/javascript" >
						var infowindow = new google.maps.InfoWindow({
							size: new google.maps.Size(150, 50)
						});

						var all_overlays = [];
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


                    
                      		<?php foreach ($kelurahan_terpilih->result() as $key => $value) { ?>
                      		
                      		
                      		var polygon_<?=$value->id_kelurahan?> = new google.maps.Polygon({
                      			map: map,
                      			path: [<?=$value->kordinat?>],
                      			strokeColor: "#000000",
								strokeOpacity: 2,
								strokeWeight: 1,
								fillColor: "#B85612",
								fillOpacity: 0.4,
                      		});



                      		<?php } ?>



							var polyOptions = {
							    strokeWeight: 0,
							    fillOpacity: 0.45,
							    editable: true,
							    fillColor: '#FF1493'
							  };
							  var selectedShape;

							  var drawingManager = new google.maps.drawing.DrawingManager({
							    drawingMode: google.maps.drawing.OverlayType.POLYGON,
							    drawingControl: false,
							    markerOptions: {
							      draggable: true
							    },
							    polygonOptions: polyOptions
							  });

							  $('#enablePolygon').click(function() {
							    drawingManager.setMap(map);
							    drawingManager.setDrawingMode(google.maps.drawing.OverlayType.POLYGON);
							    	$('#enablePolygon').hide();
							  });

							  $('#resetPolygon').click(function() {
							    if (selectedShape) {
							      selectedShape.setMap(null);
							    }
							    drawingManager.setMap(null);
							    $('#showonPolygon').hide();
							    $('#resetPolygon').hide();
							    $('#enablePolygon').show();
							  });
							  
							  google.maps.event.addListener(drawingManager, 'polygoncomplete', function(polygon) {
							     var area = google.maps.geometry.spherical.computeArea(selectedShape.getPath());
							     var area1 = google.maps.geometry.spherical.computeArea(selectedShape.getPath());
							     $('#areaPolygon').html(area.toFixed(2)+' Sq meters');
							    area = area/10000;
							    area1 = area1/10000;
							    area = numberWithCommas(area.toFixed(2))+" Ha";
							    area1 = area1.toFixed(3);
							    document.getElementById("luas_lahan").value = area;
							    document.getElementById("luas_lahan1").value = area1;
							    var coordStr = "";
							    for (var i = 0; i < polygon.getPath().getLength(); i++) {
							      coordStr +="{lat: "+ polygon.getPath().getAt(i).lat() + ",  lng: "+
							      polygon.getPath().getAt(i).lng()+"},\n"
							      ;
							    }
							    document.getElementById("coords").value = coordStr;
							    // console.log(coordStr);
							    $('#resetPolygon').show();
							  });

							  function clearSelection() {
							    if (selectedShape) {
							      selectedShape.setEditable(false);
							      selectedShape = null;
							    }
							  }


							  function setSelection(shape) {
							    clearSelection();
							    selectedShape = shape;
							    shape.setEditable(true);
							  }

							  google.maps.event.addListener(drawingManager, 'overlaycomplete', function(e) {
							    all_overlays.push(e);
							    if (e.type != google.maps.drawing.OverlayType.MARKER) {
							      // Switch back to non-drawing mode after drawing a shape.
							      drawingManager.setDrawingMode(null);

							      // Add an event listener that selects the newly-drawn shape when the user
							      // mouses down on it.
							      var newShape = e.overlay;
							      newShape.type = e.type;
							      google.maps.event.addListener(newShape, 'click', function() {
							        setSelection(newShape);
							      });
							      setSelection(newShape);
							    }
							  });

                      		<?php foreach ($kelurahan_terpilih->result() as $key => $value) { 
                      				$cek_nama_kecamatan = $this->mhome->tampil_data_where('tb_kecamatan',array());
                      				foreach ($cek_nama_kecamatan->result() as $key1 => $value1) ;
                      				$nama_kecamatan = $value1->kecamatan;

                      		?>
                     		
							google.maps.event.addListener(polygon_<?=$value->id_kelurahan?>, 'click', function(event) {
								var vertices = this.getPath();
								var luas = google.maps.geometry.spherical.computeArea(polygon_<?=$value->id_kelurahan?>.getPath()) / 10000;
								luas = numberWithCommas(luas.toFixed(2));
								var contentString ="<div class='form-group' >"+
								                    "<h5>Kecamatan : <?=$nama_kecamatan?></h5>"+
								                    "<h5>Kelurahan : <?=$value->kelurahan?></h5>"+
								                    "<h5>Luas : "+luas + " Ha"+"</h5>"+
								                    "</div>";

								infowindow.setContent(contentString);
								infowindow.setPosition(event.latLng);
								infowindow.open(map);
							});
							
							for (var i = 0; i < polygon_<?=$value->id_kelurahan?>.getPath().getLength(); i++) {
		                        bounds.extend(polygon_<?=$value->id_kelurahan?>.getPath().getAt(i));
		                      }


                     		<?php } ?>

                     		map.fitBounds(bounds);


            			}


                    
                 
			            google.maps.event.addDomListener(window, 'load', initialize);

			        </script>
			    	

					<div id="vertices"></div>
					<div id="map_canvas"></div><br><br>
					<center><button type="button" class="btn btn-lg waves-effect waves-light" onclick="heheh()">Lakukkan Pendaftaran</button></center>	
					
					
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