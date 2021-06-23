		
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
									<select class="form-control" onchange="changeFuncKelurahan(value);" name="kelurahan" id="kelurahan" disabled>
										<option value="">-Sila Pilih Kecamatan Dulu</option>
										
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
										<?php foreach ($tek_tambak->result() as $key => $value) { ?>
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


			<div class="col-xs-12" id="peta">

			</div>
		</div>