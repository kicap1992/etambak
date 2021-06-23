		
		<div class="row small-spacing">
			<?php  
				$tahunnya = explode('-',$this->uri->segment(5));
			?>
			<!-- /.col-lg-6 col-xs-12 -->
			<div class="col-xs-12 col-lg-12">
				<div class="box-content card">
					<h4 class="box-title">Daftar Transaksi Produksi</h4>
					<div class="card-content">
						<div class="form-group" style="overflow-x: auto" id="tabel_transaksi">
							<table id="tabel-data" class="table table-bordered">
								<thead>
									<tr>
										<th>No</th>
										<th>Tahun</th>
										<th>Musim</th>
										<th>Aksi</th>	
									</tr>
								</thead>
								<tbody>
								<?php if (count($data_transaksi_produksi->result())>0): ?>
								<?php foreach ($data_transaksi_produksi->result() as $key => $value): 
									$ket = json_decode($value->ket);
									?>
									<?php $i=1; foreach ($ket as $key1 => $value1): ?>
										<tr>
											<td><?=$i?></td>
											<td><?=$value1->tahun?></td>
											<td><?=$value1->musim?></td>
											<td align="center">
												<a href="<?=base_url()?>admin/data_petambak/lihat/<?=$kode_lahan?>/<?=$value1->tahun?>-<?=$value1->musim?>"><button type="button" title="Lihat Transaksi Produksi" class="btn btn-info btn-circle btn-sm waves-effect waves-light"><i class="ico fa fa-list-alt"></i></button></a>
												
											</td>
										</tr>
									<?php $i++; endforeach ?>
								<?php endforeach ?>
								<?php endif ?>
								</tbody>
							</table>
						</div>
					</div>
				</div>
			</div>


			<div class="col-lg-12 col-xs-12">
				<div class="box-content card ">
					<h4 class="box-title">Form Transaksi Produksi  Tahun <?=$tahunnya[0]?> Musim <?=$tahunnya[1]?> </h4>
					<!-- /.box-title -->
						<div class="card-content">
							<?php foreach ($lahan->result() as $key => $value) ;
								$cari_data_harga = $this->madmin->tampil_data_where('tb_tambak',array('id_tambak' =>$value->tek_tambak));
								foreach ($cari_data_harga->result() as $key3 => $value3);
								$ket = json_decode($value3->ket);
							?>
							<div class="form-horizontal">
								<div class="form-group">
									<label for="inputEmail3" class="col-sm-5 control-label">Kode Lahan</label>
									<div class="col-sm-4">
										<input type="text" class="form-control"  value="<?=$value->id_lahan?>" title="ID Lahan" disabled="">
									</div>
									<div class="col-sm-3">
									</div>
								</div>
								<div class="form-group">
									<label for="inputEmail3" class="col-sm-5 control-label">Luas Lahan</label>
									<div class="col-sm-4">
										<input type="text" class="form-control"  value="<?=$value->luas_lahan?> Ha" title="Luas Lahan" disabled="">
									</div>
									<div class="col-sm-3">
									</div>
								</div>
								<div class="form-group">
									<label for="inputEmail3" class="col-sm-5 control-label">Jenis Tambak</label>
									<div class="col-sm-4">
										<input type="text" class="form-control"  value="<?=$value3->tambak?>" title="Jenis Tambak" disabled="">
									</div>
									<div class="col-sm-3">
									</div>
								</div>
								<div class="form-group">
									<label for="inputEmail3" class="col-sm-5 control-label">Waktu Tebar</label>
									<div class="col-sm-4">
										<?php
											$min_date  = date('Y-m-d');
											$min_date =  new DateTime($min_date);
											$min_date->modify('-30 day');
											$min_date =date('Y-m-d', strtotime($min_date->format('Y-m-d')));


											$max_date  = date('Y-m-d');
											$max_date =  new DateTime($max_date);
											$max_date->modify('+30 day');
											$max_date =date('Y-m-d', strtotime($max_date->format('Y-m-d')));
											// print_r($ket_nya);
											$produksi_pya = $ket_nya['ket_elemen_produksi'];
											// print_r($produksi_pya);
											$jumlah_produksi = round(($produksi_pya[1]*0.02)+$ket_nya['masa_tumbuh']-150);

											$ekor = $produksi_pya[1];
											$saiz = ceil(($ekor / $jumlah_produksi) - (($ket_nya['masa_tumbuh']/($ekor / $jumlah_produksi))*13));

											foreach ($produksi_pya as $key4 => $value4) {
												if ($key4 != 4) {
													$jumlah_ini[$key4] = $value4;
												}else{
													$jumlah_ini[$key4] = $value4 * $ket_nya['masa_tumbuh'];
												}
											}

											if ($saiz >= 45) {
												$hargajual = 35000;
											}elseif ($saiz >= 30) {
												$hargajual = 60000;
											}elseif ($saiz >= 25) {
												$hargajual = 80000;
											}elseif ($saiz >= 20) {
												$hargajual = 110000;
											}elseif ($saiz >= 17) {
												$hargajual = 120000;
											}elseif ($saiz >= 8) {
												$hargajual = 180000;
											}elseif ($saiz >= 1) {
												$hargajual = 185000;
											}
											// print_r($jumlah_ini);

											$nilaiproduksi = $hargajual * $jumlah_produksi;


										?>
										<input type="date" class="form-control" id="tanggal"  title="Waktu Tebar"  min="<?=$min_date?>" max="<?=$max_date?>" value="<?=$ket_nya['waktu_tebar']?>" disabled>
									</div>
									<div class="col-sm-3">
									</div>
								</div>
								<div class="form-group">
									<label for="inp-type-1" class="col-sm-5 control-label">Masa Tumbuh :</label>
									<div class="col-sm-4">
										<select class="form-control" id="masa_tumbuh" disabled="">
											<option value="" disabled="">-Sila Pilih Masa Pertumbuhan</option>
											<option value="60" <?php if ($ket_nya['masa_tumbuh'] == 60): ?>selected <?php endif ?>>60</option>
											<option value="90" <?php if ($ket_nya['masa_tumbuh'] == 90): ?>selected <?php endif ?>>90</option>
											<option value="150" <?php if ($ket_nya['masa_tumbuh'] == 150): ?>selected <?php endif ?> >150</option>
										</select>
									</div>
									<div class="col-sm-3"></div>
								</div>		
							</div>

							<div id="sinitabel">
								<form class="form-horizontal" style="overflow-x: auto" id="elemen_produksi">
									<table id="tabel-data" class="table table-striped table-bordered display" style="width:100%">
										<thead>
											<tr>
												<th>Bahan</th>
												<th>Harga</th>
												<th width="20%">Satuan</th>
												<th>Jumlah</th>
											</tr>
										</thead>
										<tbody>
											<tr>
											<?php 
											$ket = json_decode($value3->ket);
											$satuan = json_decode($value3->satuan);
											$r = 1;
											$biaya = 0;
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

												
												$jumlah = $jumlah_ini[$value2->id_elemen] * $ket->$no;

												// if ($produksi_pya['Tenaga']) {
												// 	$satu = $satu * $harga;
												// }else{
												// 	$satu = $satu * $harga * $hari;
												// }
												$biaya = $biaya + $jumlah;
											?>
											<tr>
												<td><?=$value2->nama_elemen?></td>
												<td>Rp. <?=$harga?> </td>
												<td>
													<input type="text"  style="width: 200px;" class="form-control" id="inputan<?=$no?>" placeholder="Jumlah <?=$value2->nama_elemen?>" name="<?=$value2->id_elemen?>"  minlegth='5' maxlength='10' value='<?=number_format($produksi_pya[$value2->id_elemen])?>' disabled>
												</td>
												<td>Rp. <?=number_format($jumlah)?></td>
											</tr>
											<?php  endforeach ; 
												$persiapan_lahan = $biaya * 10 / 100;
												$totalbiaya = $biaya + $persiapan_lahan;
												$keuntungan = $nilaiproduksi - $biaya - $persiapan_lahan;
												if ($keuntungan <= 0 ) {
													$status = 'Tidak Berhasil';
												}else{
													$status = 'Berhasil';
												}
											?>
										</tbody>
									</table>
								</form>
								<div class="form-horizontal">
									<div class="form-group">
										<label for="inputEmail3" class="col-sm-5 control-label">Jumlah Produksi</label>
										<div class="col-sm-4">
											<input type="text" class="form-control"  value="<?=number_format($jumlah_produksi)?> kg" title="Jumlah Produksi" disabled="">
										</div>
										<div class="col-sm-3">
										</div>
									</div>
								</div>
							</div>

							<div class="form-horizontal">
								<div class="form-group">
									<center><button type="button" class="btn btn-primary btn-sm waves-effect waves-light" onclick="submitdata()" id="button_submit" style="display: none">Proses Transaksi Produksi</button> &nbsp &nbsp <a href="<?=base_url()?>penyuluh/transaksi/lihat/<?=$this->uri->segment(4).'/'.$this->uri->segment(5)?>"><button type="button" class="btn btn-danger btn-sm waves-effect waves-light" id="button_batal" style="display: none">Batal Edit</button></a><button type="button" class="btn btn-warning btn-sm waves-effect waves-light" onclick="editdata()" id="button_edit" style="display: none">Edit Transaksi Produksi ?</button></center>
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
										<input type="text" class="form-control"  title="Panen" value="<?=$ket_nya['masa_panen']?>" disabled="">
									</div>
								</div>
								<div class="form-group">
									<label for="inputPassword3" class="col-sm-3 control-label">Saiz</label>
									<div class="col-sm-9">
										<input type="text" class="form-control"  title="Saiz" value="+- <?=$saiz?> ekor/kg" disabled="">
									</div>
								</div>
								<div class="form-group">
									<label for="inputPassword3" class="col-sm-3 control-label">Total Biaya</label>
									<div class="col-sm-9">
										<input type="text" class="form-control"  title="Jumlah" value="Rp . <?=number_format($totalbiaya)?>" disabled="">
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
						<div class="card-content">
							<div class="form-horizontal">
								<div class="form-group">
									<label for="inputEmail3" class="col-sm-3 control-label">Harga Jual</label>
									<div class="col-sm-9">
										<input type="text" class="form-control"  placeholder="Enter your email" title="Harga Jual" value="Rp. <?=number_format($hargajual)?>" disabled="">
									</div>
								</div>
								<div class="form-group">
									<label for="inputPassword3" class="col-sm-3 control-label">Nilai Produksi</label>
									<div class="col-sm-9">
										<input type="text" class="form-control"  title="Nilai" value="Rp. <?=number_format($nilaiproduksi)?>" disabled="">
									</div>
								</div>
								<div class="form-group">
									<label for="inputPassword3" class="col-sm-3 control-label">Keuntungan</label>
									<div class="col-sm-9">
										<input type="text" class="form-control"  title="Keuntungan" value="Rp. <?=number_format($keuntungan)?>" disabled="">
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>

				<div class="col-lg-12 col-xs-12">
					<div class="box-content card white">
						<div class="card-content">
							<div class="form-horizontal">
								<div class="form-group">
									<label for="inputEmail3" class="col-sm-5 control-label">Status Produksi</label>
									<div class="col-sm-4">
										<input type="text" class="form-control"  value="<?=$status?>" title="Status Produksi" disabled="">
									</div>
									<div class="col-sm-3">
									</div>
								</div>
							</div>
						</div>						
					</div>
				</div>
			</div>
		</div>


			


			