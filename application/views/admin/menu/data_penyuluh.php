		
		<div class="row small-spacing">
			<div class="col-xs-12">
				<div class="box-content card">
					<h4 class="box-title">Daftar Petambak</h4>
					<div class="card-content">
						
						<div id="disini_tabel" class="form-group">	
							<table id="tabel-data" class="table table-striped table-bordered display" style="width:100%">
								<thead>
									<tr>
										<th width="3%">No</th>
										<th>N I K </th>
										<th>Nama</th>
										<th>Wilayah</th>
										<th>Aksi</th>
									</tr>
								</thead>
								<tbody>

									<?php $i = 1; foreach ($penyuluh->result() as $key => $value) { 
										$cek_kecamatan = $this->madmin->tampil_data_where('tb_kecamatan',array('id_kecamatan' => $value->kecamatan));
										foreach ($cek_kecamatan->result() as $key1 => $value1) ;
										?>
									<tr>
										<td><?=$i?></td>
										<td><?=$value->nik?></td>
										<td><?=$value->nama?></td>
										<td><?=$value1->kecamatan?></td>
										<td align="center"><button type="button" title="Analisa Produksi" class="btn btn-info btn-circle btn-sm waves-effect waves-light"><i class="ico fa fa-list-alt"></i></button></td>
									</tr>
									<?php $i++;} ?>
								</tbody>
							</table>
						</div>	
					</div>
					
				</div>

				

			</div>
		</div>


			


			