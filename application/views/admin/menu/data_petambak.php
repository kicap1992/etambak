		
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

										<th>Aksi</th>
									</tr>
								</thead>
								<tbody>

									<?php $i = 1; foreach ($petambak->result() as $key => $value) { 
										?>
									<tr>
										<td><?=$i?></td>
										<td><?=$value->nik?></td>
										<td><?=$value->nama?></td>
										<td align="center"><a href="<?=base_url()?>admin/data_petambak1/<?=$value->nik?>"><button type="button" title="Analisa Produksi" class="btn btn-info btn-circle btn-sm waves-effect waves-light"><i class="ico fa fa-list-alt"></i></button></a></td>
									</tr>
									<?php $i++;} ?>
								</tbody>
							</table>
						</div>	
					</div>
					
				</div>

				

			</div>
		</div>


			


			