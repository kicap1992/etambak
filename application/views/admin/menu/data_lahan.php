		
		<div class="row small-spacing">
			<div class="col-xs-12">
				<div class="box-content card">
					<h4 class="box-title">Daftar Lahan</h4>
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
						<div id="disini_tabel" class="form-group">	
							<table id="tabel-data" class="table table-striped table-bordered display" style="width:100%">
								<thead>
									<tr>
										<th width="3%">No</th>
										<th>Kode Lahan</th>
										<th>Petambak</th>
										<th>Kecamatan</th>
										<th>Kelurahan</th>
										<th>Luas</th>
										<th>Teknologi Tambak</th>
										<th>Aksi</th>
									</tr>
								</thead>
								<tbody>

									<?php $i = 1; foreach ($lahan->result() as $key => $value) { 
										$cek_petambak =$this->madmin->tampil_data_where('tb_petambak',array('nik' => $value->nik_petambak));
										foreach ($cek_petambak->result() as $key1 => $value1) ;
										$cek_kecamatan = $this->madmin->tampil_data_where('tb_kecamatan',array('id_kecamatan' => $value->kecamatan));
										foreach ($cek_kecamatan->result() as $key2 => $value2) ;

										$cek_kelurahan = $this->madmin->tampil_data_where('tb_kelurahan',array('id_kelurahan' => $value->kelurahan));
										foreach ($cek_kelurahan->result() as $key3 => $value3) ;

										$cek_teknologi = $this->madmin->tampil_data_where('tb_tambak',array('id_tambak' => $value->tek_tambak));
										foreach ($cek_teknologi->result() as $key4 => $value4) ;
										?>
									<tr>
										<td><?=$i?></td>
										<td><?=$value->id_lahan?></td>
										<td><?=$value1->nama?></td>
										<td><?=$value2->kecamatan?></td>
										<td><?=$value3->kelurahan?></td>
										<td><?=$value->luas_lahan?></td>
										<td><?=$value4->tambak?></td>
										<td align="center"><a href="<?=base_url()?>admin/data_petambak/<?=$value->id_lahan?>"><button type="button" title="Lihat Informasi Lahan" class="btn btn-info btn-circle btn-sm waves-effect waves-light"><i class="ico fa fa-list-alt"></i></button></a></td>
									</tr>
									<?php $i++;} ?>
								</tbody>
							</table>
						</div>	
					</div>
					
				</div>

				

			</div>
		</div>


			


			