		
		<div class="row small-spacing">
			<!-- <div class="col-lg-5 col-xs-12">
				<div class="box-content card">
					<h4 class="box-title">Form Penambahan Elemen Produksi</h4>
					<div class="card-content">
						<form id="penambahan_produksi">
							<div class="form-group">
								<label for="inputEmail3" class="control-label">Faktor Produksi</label>
								<input type="text" name="nama_elemen" id="faktor_produksi" class="form-control" placeholder="Masukkan Faktor Produksi">
							</div>
							<div class="form-group">
								<label for="inputEmail3" class="control-label">Satuan</label>
								<input type="text" name="satuan" id="satuan_input" class="form-control" placeholder="Masukkan Satuan Faktor Produksi">
							</div>
							
						</form>
						<div class="form-group">
							<center><button type="submit" class="btn btn-info btn-sm waves-effect waves-light" onclick="tambah_satuan()">Tambah Elemen Produksi</button></center>
						</div>
					</div>
				</div>

				<div class="box-content card">
					<h4 class="box-title">Form Elemen Produksi</h4>
					<div class="card-content">
						<form>
							<table id="tabel-data" class="table table-striped table-bordered display">
								<thead>
									<tr>
										<th width="7%"><center>Id</center></th>
										<th>Faktor Produksi</th>
										<th>Satuan</th>
										<th>Aksi</th>
									</tr>
								</thead>
								<tbody>
									<?php foreach ($produksi->result() as $key => $value) {?>
									<tr>
										<td align="center"><?=$value->id_elemen?></td>
										<td><?=$value->nama_elemen?></td>
										<td><?=$value->satuan?></td>
										<td><button type="button" title="Hapus Elemen?" class="btn btn-danger btn-circle btn-sm waves-effect waves-light" onclick="hapus_elemen(<?=$value->id_elemen?>,'<?=$value->nama_elemen?>')"><i class="ico fa fa-trash"></i></button></td>
									</tr>
									<?php } ?>
								</tbody>
							</table>
						</form>
					</div>
				</div>
			</div> -->



			<div class="col-lg-12 col-xs-12">
				<div class="box-content card">
					<h4 class="box-title" style="cursor: pointer;" onclick="myFunction(0)">Elemen Produksi Untuk Tambak Tradisional</h4>
					<div style="overflow-x: auto; display: none;" class="card-content" id="myDIV">
						<form id="elemen_produksi_tradisional">
							<table id="tabel-data" class="table table-striped table-bordered display">
								<thead>
									<tr>
										<th width="7%"><center>Id</center></th>
										<th>Faktor Produksi</th>
										<th>Satuan</th>
										<th width="30%">Harga</th>
									</tr>
								</thead>
								<tbody>
									<?php foreach ($produksi->result() as $key => $value) {?>
									<tr>
										<td align="center"><?=$value->id_elemen?></td>
										<td><?=$value->nama_elemen?></td>
										<td><?=$value->satuan?></td>
										<?php
										$data_keterangan  = $this->madmin->tampil_data_where('tb_tambak',array('id_tambak' => 1)); 
										foreach ($data_keterangan->result() as $key1 => $value1) {
											$keterangan = json_decode($value1->ket);
											$kode = $value->id_elemen;
											$harganya = $keterangan->$kode;
											if ($harganya == '' or $harganya == null) {
												$harganya = '';
											}else{
												$harganya = number_format($harganya);
											}
										}
										?>
										<td><input type="text"  style="width: 275px;" class="form-control" id="inputan<?=$value->id_elemen?>tradisional" placeholder="Masukkan Harga <?=$value->nama_elemen?>/<?=$value->satuan?>" name="<?=$value->id_elemen?>" value="<?=$harganya?>" minlegth='5' maxlength='10'></td>
									</tr>
									<?php } ?>
								</tbody>
							</table>
						</form>
						<div class="form-horizontal">
							<div class="form-group">
								<center><button type="button" class="btn btn-sm waves-effect waves-light" onclick="update_tambak(1)">Update Elemen Produksi Tambak Tradisional</button></center>
							</div>
						</div><br><br>


						<div class="box-content card white">
							<h4 class="box-title">Jumlah Satuan Per / 1 Hektar</h4>
							<div class="card-content">
								<form id="satuan_produksi_tradisional">
									<?php foreach ($produksi->result() as $key => $value): ?>
									<div class="form-group">
										<label for="inputEmail3" class="control-label"><?=$value->nama_elemen?></label>

										<?php
										$data_keterangan  = $this->madmin->tampil_data_where('tb_tambak',array('id_tambak' => 1)); 
										foreach ($data_keterangan->result() as $key1 => $value1) {
											$satuan = json_decode($value1->satuan);
											$kode = $value->id_elemen;
											$satuannya = $satuan->$kode;
											if ($satuannya == '' or $satuannya == null) {
												$satuannya = '';
											}else{
												$satuannya = number_format($satuannya);
											}
										}
										?>
										<input type="text" name="<?=$value->id_elemen?>" id="elemen<?=$value->id_elemen?>tradisional" class="form-control" placeholder="Masukkan Satuan <?=$value->nama_elemen?> / 1 Hektar" minlength="2" maxlength="10" value="<?=$satuannya?>">
									</div>	
									<?php endforeach ?>
								</form>
								<div class="form-group">
									<center><button  class="btn btn-info btn-sm waves-effect waves-light" onclick="satuan_produksi(1)">Update Satuan Produksi Tambak Tradisional</button></center>
								</div>
							</div>	
						</div>						
					</div>						
				</div>


				<div class="box-content card">
					<h4 class="box-title" style="cursor: pointer;" onclick="myFunction(1)">Elemen Produksi Untuk Tambak Semi Modern</h4>
					<div style="overflow-x: auto ; display: none;" class="card-content" id="myDIV1">
						<form id="elemen_produksi_semi_modern">
							<table id="tabel-data" class="table table-striped table-bordered display">
								<thead>
									<tr>
										<th width="7%"><center>Id</center></th>
										<th>Faktor Produksi</th>
										<th>Satuan</th>
										<th width="30%">Harga</th>
									</tr>
								</thead>
								<tbody>
									<?php foreach ($produksi->result() as $key => $value) {?>
									<tr>
										<td align="center"><?=$value->id_elemen?></td>
										<td><?=$value->nama_elemen?></td>
										<td><?=$value->satuan?></td>
										<?php
										$data_keterangan  = $this->madmin->tampil_data_where('tb_tambak',array('id_tambak' => 2)); 
										foreach ($data_keterangan->result() as $key1 => $value1) {
											$keterangan = json_decode($value1->ket);
											$kode = $value->id_elemen;
											$harganya = $keterangan->$kode;
											if ($harganya == '' or $harganya == null) {
												$harganya = '';
											}else{
												$harganya = number_format($harganya);
											}
										}
										?>
										<td><input type="text"  style="width: 275px;" class="form-control" id="inputan<?=$value->id_elemen?>semi_modern" placeholder="Masukkan Harga <?=$value->nama_elemen?>/<?=$value->satuan?>" name="<?=$value->id_elemen?>" value="<?=$harganya?>" minlegth='5' maxlength='10'></td>
									</tr>
									<?php } ?>
								</tbody>
							</table>
						</form>
						<div class="form-horizontal">
							<div class="form-group">
								<center><button type="button" class="btn btn-sm waves-effect waves-light" onclick="update_tambak(2)">Update Elemen Produksi Tambak Tradisional</button></center>
							</div>
						</div><br><br>


						<div class="box-content card white">
							<h4 class="box-title">Jumlah Satuan Per / 1 Hektar</h4>
							<div class="card-content">
								<form id="satuan_produksi_semi_modern">
									<?php foreach ($produksi->result() as $key => $value): ?>
									<div class="form-group">
										<label for="inputEmail3" class="control-label"><?=$value->nama_elemen?></label>

										<?php
										$data_keterangan  = $this->madmin->tampil_data_where('tb_tambak',array('id_tambak' => 2)); 
										foreach ($data_keterangan->result() as $key1 => $value1) {
											$satuan = json_decode($value1->satuan);
											$kode = $value->id_elemen;
											$satuannya = $satuan->$kode;
											if ($satuannya == '' or $satuannya == null) {
												$satuannya = '';
											}else{
												$satuannya = number_format($satuannya);
											}
										}
										?>
										<input type="text" name="<?=$value->id_elemen?>" id="elemen<?=$value->id_elemen?>semi_modern" class="form-control" placeholder="Masukkan Satuan <?=$value->nama_elemen?> / 1 Hektar" minlength="2" maxlength="10" value="<?=$satuannya?>">
									</div>	
									<?php endforeach ?>
								</form>
								<div class="form-group">
									<center><button  class="btn btn-info btn-sm waves-effect waves-light" onclick="satuan_produksi(2)">Update Satuan Produksi Tambak Tradisional</button></center>
								</div>
							</div>	
						</div>						
					</div>						
				</div>


				<div class="box-content card">
					<h4 class="box-title" style="cursor: pointer;" onclick="myFunction(2)">Elemen Produksi Untuk Tambak Semi Modern</h4>
					<div style="overflow-x: auto; display: none;" class="card-content" id="myDIV2">
						<form id="elemen_produksi_modern">
							<table id="tabel-data" class="table table-striped table-bordered display">
								<thead>
									<tr>
										<th width="7%"><center>Id</center></th>
										<th>Faktor Produksi</th>
										<th>Satuan</th>
										<th width="30%">Harga</th>
									</tr>
								</thead>
								<tbody>
									<?php foreach ($produksi->result() as $key => $value) {?>
									<tr>
										<td align="center"><?=$value->id_elemen?></td>
										<td><?=$value->nama_elemen?></td>
										<td><?=$value->satuan?></td>
										<?php
										$data_keterangan  = $this->madmin->tampil_data_where('tb_tambak',array('id_tambak' => 3)); 
										foreach ($data_keterangan->result() as $key1 => $value1) {
											$keterangan = json_decode($value1->ket);
											$kode = $value->id_elemen;
											$harganya = $keterangan->$kode;
											if ($harganya == '' or $harganya == null) {
												$harganya = '';
											}else{
												$harganya = number_format($harganya);
											}
										}
										?>
										<td><input type="text"  style="width: 275px;" class="form-control" id="inputan<?=$value->id_elemen?>modern" placeholder="Masukkan Harga <?=$value->nama_elemen?>/<?=$value->satuan?>" name="<?=$value->id_elemen?>" value="<?=$harganya?>" minlegth='5' maxlength='10'></td>
									</tr>
									<?php } ?>
								</tbody>
							</table>
						</form>
						<div class="form-horizontal">
							<div class="form-group">
								<center><button type="button" class="btn btn-sm waves-effect waves-light" onclick="update_tambak(3)">Update Elemen Produksi Tambak Tradisional</button></center>
							</div>
						</div><br><br>


						<div class="box-content card white">
							<h4 class="box-title">Jumlah Satuan Per / 1 Hektar</h4>
							<div class="card-content">
								<form id="satuan_produksi_modern">
									<?php foreach ($produksi->result() as $key => $value): ?>
									<div class="form-group">
										<label for="inputEmail3" class="control-label"><?=$value->nama_elemen?></label>

										<?php
										$data_keterangan  = $this->madmin->tampil_data_where('tb_tambak',array('id_tambak' => 3)); 
										foreach ($data_keterangan->result() as $key1 => $value1) {
											$satuan = json_decode($value1->satuan);
											$kode = $value->id_elemen;
											$satuannya = $satuan->$kode;
											if ($satuannya == '' or $satuannya == null) {
												$satuannya = '';
											}else{
												$satuannya = number_format($satuannya);
											}
										}
										?>
										<input type="text" name="<?=$value->id_elemen?>" id="elemen<?=$value->id_elemen?>modern" class="form-control" placeholder="Masukkan Satuan <?=$value->nama_elemen?> / 1 Hektar" minlength="2" maxlength="10" value="<?=$satuannya?>">
									</div>	
									<?php endforeach ?>
								</form>
								<div class="form-group">
									<center><button  class="btn btn-info btn-sm waves-effect waves-light" onclick="satuan_produksi(3)">Update Satuan Produksi Tambak Tradisional</button></center>
								</div>
							</div>	
						</div>
					</div>						
				</div>
			</div>
		</div>


			


			