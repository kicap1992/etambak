		
		<div class="row small-spacing">
			<div class="col-lg-12 col-xs-12">
				<div class="box-content card white">
					<h4 class="box-title">Informasi Analisa Lahan</h4>
					<!-- /.box-title -->
					<?php foreach ($lahan->result() as $key => $value); ?>
					<div class="card-content">
						<div class="form-horizontal">
							<div class="form-group">
								<label for="inputEmail3" class="col-sm-4 control-label">Kode Lahan</label>
								<div class="col-sm-4">
									<input type="text" class="form-control" id="inputEmail3" value="<?=$value->id_lahan?>" title="ID Lahan" disabled="">
								</div>
								<div class="col-sm-4">
								</div>
							</div>
							<?php  
							$cek_tambak = $this->mpetambak->tampil_data_where('tb_tambak',array('id_tambak'=>$value->tek_tambak));
							foreach ($cek_tambak->result() as $key1 => $value1) ;
							$nama_tambak = $value1->tambak;
							?>
							<div class="form-group">
								<label for="inputEmail3" class="col-sm-4 control-label">Luas Tambak</label>
								<div class="col-sm-4">
									<input type="text" class="form-control" id="inputEmail3" value="<?=$value->luas_lahan?>Ha" title="Luas Tambak" disabled="">
								</div>
								<div class="col-sm-4">
								</div>
							</div>
							<div class="form-group">
								<label for="inputEmail3" class="col-sm-4 control-label">Teknologi Tambak</label>
								<div class="col-sm-4">
									<input type="text" class="form-control" id="inputEmail3" value="<?=$nama_tambak?>" title="Teknologi Tambak" disabled="">
								</div>
								<div class="col-sm-4">
								</div>
							</div>
							<div class="form-group">
								<label for="inputEmail3" class="col-sm-4 control-label">Periode</label>
								<?php  
									$tahun = date("Y");
									if (date("m") < 7) {
										$musim =  "1";
									}else{
										$musim = "2";
									}
								?>
								<div class="col-sm-2">
									<input type="text" class="form-control" id="inputEmail3" value="<?=$musim?>" title="Musim" disabled="">
								</div>
								<div class="col-sm-2">
									<input type="text" class="form-control" id="inputEmail3" value="<?=$tahun?>" title="Tahun" disabled="">
								</div>
								<div class="col-sm-4">
								</div>
							</div>
							<div class="form-group">
								<label for="inputEmail3" class="col-sm-4 control-label">Masa Tumbuh</label>
								<div class="col-sm-4">
									<select class="form-control" onchange="changeFuncLahan(value);" name="lokasi_lahan">
										<option value="" disabled="" selected="">-Sila Pilih Masa Tumbuh</option>
										<option value="60" >60 Hari</option>
										<option value="90" >90 Hari</option>
										<option value="150" >150 Hari</option>
														
									</select>
								</div>
								<div class="col-sm-4">
								</div>
							</div>
						</div>
					</div>
					<!-- /.card-content -->
				</div>
				<!-- /.box-content -->
			</div>
			<!-- /.col-lg-6 col-xs-12 -->

			<div class="col-lg-12 col-xs-12">
				<div class="box-content card white">
					<h4 class="box-title">Hasil Analisa Lahan</h4>
					<!-- /.box-title -->
					<div class="card-content" id="tabel">
						<table id="tabel-data" class="table table-striped table-bordered display" style="width:100%">
							<thead>
								<tr>
									<th>Bahan</th>
									<th>Harga</th>
									<th>Satuan</th>
									<th width="20%">Jumlah</th>
								</tr>
							</thead>
							<tbody>
								<tr>
								<?php 
								$ket = json_decode($value1->ket);
								$satuan = json_decode($value1->satuan);
								$r = 1;
								// print_r($satuan->$r);
								foreach ($elemen_produksi->result() as $key2 => $value2):
									$no = $value2->id_elemen; 
									$satu = $satuan->$no;
									$harga = $ket->$no;

									if ($harga == '' and $harga == null) {
										$harga = '';
									}else{
										$harga = number_format($harga);
									}

									if ($satu == '' and $satu == null) {
										$satu = '';
									}else{
										$satu = $satu * $value->luas_lahan;
										$satu = number_format(ceil($satu));
									}
								?>


								<tr>
									<td><?=$value2->nama_elemen?></td>
									<td>Rp. <?=$harga?></td>
									<td><?=$satu?> <?=$value2->satuan?></td>
									<td>Rp. ??</td>
								</tr>
								<?php  endforeach ?>
							</tbody>
						</table>
					</div>
					<!-- /.card-content -->
					<div class="form-horizontal" id="sini_ganti">
						<div class="form-group">
							<label for="inputEmail3" class="col-sm-4 control-label">Biaya Produksi</label>
							<div class="col-sm-4">
								<input type="text" class="form-control" id="inputEmail3" value="Rp. ??" title="Biaya Produksi" disabled="" name="biaya">
							</div>
							<div class="col-sm-4">
							</div>
						</div>
						<div class="form-group">
							<label for="inputEmail3" class="col-sm-4 control-label">Biaya Persiapan Lahan</label>
							<div class="col-sm-4">
								<input type="text" class="form-control" id="inputEmail3" value="Rp. ??" title="Biaya Produksi" disabled="" name="biaya">
							</div>
							<div class="col-sm-4">
							</div>
						</div>
						<div class="form-group">
							<label for="inputEmail3" class="col-sm-4 control-label">Jumlah Hasil Produksi</label>
							<div class="col-sm-4">
								<input type="text" class="form-control" id="inputEmail3" value="?? Kg" title="Jumlah Hasil Produksi" disabled="">
							</div>
							<div class="col-sm-4">
							</div>
						</div>
					</div>
				</div>
				<!-- /.box-content -->

				

				
				<!-- /.box-content card white -->
			</div>
		</div>


			


			