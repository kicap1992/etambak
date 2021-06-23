		<div class="row small-spacing">
			<div class="col-xs-12">
				<div class="box-content">
					<h4 class="box-title">Luas Lahan Petambak : <span class="nowrap" id="luas1"></span> Ha	</h4>
					<h4 class="box-title">Jumlah Lahan : <?=count($lahan->result())?>	</h4>
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
					<div id="peta">

			    	</div>

					<div id="vertices"></div>
					<div id="map_canvas"></div>


					

				</div>

				<!-- /.box-content -->
			</div>

			<?php  
				$kira = count($cek_hasil->result()) - 1;
				$jumlah = 0;
				// print_r($kira);
				foreach ($cek_hasil->result() as $key => $value) {
					$hasil[$key] = $value->hasil;
				}

				// $jumlah = ($hasil[$kira-3] + $hasil[$kira-2] + $hasil[$kira-1])/3;
				$jumlah = ($hasil[$kira-3] + $hasil[$kira-2] + $hasil[$kira-1])/3;
				$hasil = $cek_hasil->result()[$kira]->hasil;
				$tahun = $cek_hasil->result_array()[$kira]['tahun'];
				$musim = $cek_hasil->result_array()[$kira]['musim'];
				// print_r($hasil[$kira]);
			?>
			<div class="row small-spacing">
				<div class="col-lg-6 col-md-6 col-xs-12">
					<div class="box-content bg-success text-white">
						<div class="statistics-box with-icon">
							<i class="ico small fa fa-diamond"></i>
							<p class="text text-white">Produksi Tahun <?=$tahun?> Musim <?=$musim?></p>
							<h2 class="counter"><?=number_format(round($hasil,0))?> Kg</h2>
						</div>
					</div>
					<!-- /.box-content -->
				</div>
				<!-- /.col-lg-3 col-md-6 col-xs-12 -->
				<div class="col-lg-6 col-md-6 col-xs-12">
					<div class="box-content bg-info text-white">
						<div class="statistics-box with-icon">
							<i class="ico small fa fa-download"></i>
							<p class="text text-white">Prediksi Tahun <?=$tahun?> Musim <?=$musim?></p>
							<h2 class="counter"><?=number_format(round($jumlah,0))?> Kg</h2>
						</div>
					</div>
					<!-- /.box-content -->
				</div>
				<!-- /.col-lg-3 col-md-6 col-xs-12 -->
				
			</div>

			<!-- /.col-xs-12 -->

			<!-- /.col-lg-6 col-xs-12 -->
		</div>