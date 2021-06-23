		
		<div class="row small-spacing">
			
			<!-- /.col-lg-6 col-xs-12 -->

			<div class="col-lg-12 col-xs-12">
				<div class="box-content card white">
					<h4 class="box-title">Form Perkiraan Produksi</h4>
					<!-- /.box-title -->
						<div class="card-content">
							<?php foreach ($lahan->result() as $key => $value) ;
								$cari_data_harga = $this->mpetambak->tampil_data_where('tb_tambak',array('id_tambak' =>$value->tek_tambak));
								foreach ($cari_data_harga->result() as $key3 => $value3);
								$ket = json_decode($value3->ket);
							?>
							<div class="form-horizontal">
								<div class="form-group">
									<label for="inputEmail3" class="col-sm-5 control-label">Kode Lahan</label>
									<div class="col-sm-4">
										<input type="text" class="form-control" id="inputEmail3" value="<?=$value->id_lahan?>" title="ID Lahan" disabled="">
									</div>
									<div class="col-sm-3">
									</div>
								</div>
								<div class="form-group">
									<label for="inputEmail3" class="col-sm-5 control-label">Luas Lahan</label>
									<div class="col-sm-4">
										<input type="text" class="form-control" id="inputEmail3" value="<?=$value->luas_lahan?> Ha" title="Luas Lahan" disabled="">
									</div>
									<div class="col-sm-3">
									</div>
								</div>
								<div class="form-group">
									<label for="inputEmail3" class="col-sm-5 control-label">Jenis Tambak</label>
									<div class="col-sm-4">
										<input type="text" class="form-control" id="inputEmail3" value="<?=$value3->tambak?>" title="Jenis Tambak" disabled="">
									</div>
									<div class="col-sm-3">
									</div>
								</div>
								<div class="form-group">
									<label for="inputEmail3" class="col-sm-5 control-label">Waktu Tebar</label>
									<div class="col-sm-4">
										<input type="date" class="form-control" id="tanggal"  title="Waktu Tebar"  min="2020-01-01">
									</div>
									<div class="col-sm-3">
									</div>
								</div>
								<div class="form-group">
									<label for="inp-type-1" class="col-sm-5 control-label">Masa Tumbuh :</label>
									<div class="col-sm-4">
										<select class="form-control" onchange="changeFuncLahan(value);" name="lokasi_lahan">
											<option value="" disabled="" selected="">-Sila Pilih Masa Pertumbuhan</option>
											<option value="60" >60</option>
											<option value="90" >90</option>
											<option value="150" >150</option>
										</select>
									</div>
									<div class="col-sm-3"></div>
								</div>		
							</div>

							<div id="sinitabel">
								<div class="form-horizontal" style="overflow-x: auto">
									<table id="tabel-data" class="table table-striped table-bordered display" style="width:100%">
										<thead>
											<tr>
												<th>Bahan</th>
												<th>Harga</th>
												<th>Satuan</th>
												<th>Jumlah</th>
											</tr>
										</thead>
										<tbody>
											<tr>
											<?php 
											$ket = json_decode($value3->ket);
											$satuan = json_decode($value3->satuan);
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
												<td>Rp. <?=$harga?> </td>
												<td>?? <?=$value2->satuan?></td>
												<td>??</td>
											</tr>
											<?php  endforeach ?>
										</tbody>
									</table>
								</div>
								<div class="form-horizontal">
									<div class="form-group">
										<label for="inputEmail3" class="col-sm-5 control-label">Jumlah Produksi</label>
										<div class="col-sm-4">
											<input type="text" class="form-control" id="inputEmail3" value="?? kg" title="Jumlah Produksi" disabled="">
										</div>
										<div class="col-sm-3">
										</div>
									</div>
								</div>
							</div>
							
						</div>
					<!-- /.card-content -->
					
				</div>
				<!-- /.box-content -->

				

				
				<!-- /.box-content card white -->
			</div>


			<div id="detailsini">
				<div class="col-lg-6 col-xs-12">
					<div class="box-content card white">
						<!-- /.box-title -->
						<div class="card-content">
							<div class="form-horizontal">
								<div class="form-group">
									<label for="inputEmail3" class="col-sm-3 control-label">Panen</label>
									<div class="col-sm-9">
										<input type="text" class="form-control" id="inputEmail3" title="Panen" value="tanggal??" disabled="">
									</div>
								</div>
								<div class="form-group">
									<label for="inputPassword3" class="col-sm-3 control-label">Saiz</label>
									<div class="col-sm-9">
										<input type="text" class="form-control" id="inputPassword3" title="Saiz" value="+- 7/kg" disabled="">
									</div>
								</div>
								<div class="form-group">
									<label for="inputPassword3" class="col-sm-3 control-label">Jumlah</label>
									<div class="col-sm-9">
										<input type="text" class="form-control" id="inputPassword3" title="Jumlah" value="?? kg" disabled="">
									</div>
								</div>
								
							</div>
						</div>
						<!-- /.card-content -->
					</div>
					<!-- /.box-content -->
				</div>
				<!-- /.col-lg-6 col-xs-12 -->

				<div class="col-lg-6 col-xs-12">
					<div class="box-content card white">
						<!-- /.box-title -->
						<div class="card-content">
							<div class="form-horizontal">
								<div class="form-group">
									<label for="inputEmail3" class="col-sm-3 control-label">Harga Jual</label>
									<div class="col-sm-9">
										<input type="text" class="form-control" id="inputEmail3" placeholder="Enter your email" title="Harga Jual" value="Rp. ??" disabled="">
									</div>
								</div>
								<div class="form-group">
									<label for="inputPassword3" class="col-sm-3 control-label">Nilai</label>
									<div class="col-sm-9">
										<input type="text" class="form-control" id="inputPassword3" title="Nilai" value="Rp. ??" disabled="">
									</div>
								</div>
								<div class="form-group">
									<label for="inputPassword3" class="col-sm-3 control-label">Keuntungan</label>
									<div class="col-sm-9">
										<input type="text" class="form-control" id="inputPassword3" title="Keuntungan" value="Rp. ??" disabled="">
									</div>
								</div>
								
							</div>
						</div>
						<!-- /.card-content -->
					</div>
					<!-- /.box-content -->
				</div>

				<div class="col-lg-12 col-xs-12">
					<div class="box-content card white">
						<!-- /.box-title -->
							<div class="card-content">
								<div class="form-horizontal">
									<div class="form-group">
										<label for="inputEmail3" class="col-sm-5 control-label">Status Produksi</label>
										<div class="col-sm-4">
											<input type="text" class="form-control" id="inputEmail3" value="Berhasil/Tidak Berhasil" title="Status Produksi" disabled="">
										</div>
										<div class="col-sm-3">
										</div>
									</div>
									
								</div>

								
								
								
							</div>
						<!-- /.card-content -->
						
					</div>
					<!-- /.box-content -->

					

					
					<!-- /.box-content card white -->
				</div>
			</div>
		</div>


			


			