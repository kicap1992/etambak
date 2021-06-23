		
		<div class="row small-spacing">
			
			<!-- /.col-lg-6 col-xs-12 -->

			<div class="col-lg-12 col-xs-12">
				<div class="box-content card white">
					<h4 class="box-title">Hasil Analisa Lahan</h4>
					<!-- /.box-title -->
						<div class="card-content">
							<?php foreach ($lahan->result() as $key => $value) ;?>
							<div class="form-horizontal">
								<div class="form-group">
									<label for="inputEmail3" class="col-sm-4 control-label">Kode Lahan</label>
									<div class="col-sm-4">
										<input type="text" class="form-control" id="inputEmail3" value="<?=$value->id_lahan?>" title="ID Lahan" disabled="">
									</div>
									<div class="col-sm-4">
									</div>
								</div>
								<div class="form-group">
									<label for="inputEmail3" class="col-sm-4 control-label">Jenis Tambak</label>
									<div class="col-sm-4">
										<input type="text" class="form-control" id="inputEmail3" value="<?=$value->tek_tambak?>" title="Jenis Tambak" disabled="">
									</div>
									<div class="col-sm-4">
									</div>
								</div>
							</div>
							<div class="form-horizontal">
								<table id="tabel-data" class="table table-striped table-bordered display" style="width:100%">
									<thead>
										<tr>
											<th>Bahan</th>
											<th>Satuan</th>
											<th>1%</th>
											<th>Jumlah</th>
										</tr>
									</thead>
									<tbody>
										<tr>
										<?php foreach ($elemen_produksi->result() as $key => $value): {
											// if ($value->id_elemen != 1) { ?>
										
										<tr>
											<td><?=$value->nama_elemen?></td>
											<td>?? <?=$value->satuan?></td>
											<td>??</td>
											<td>??</td>
										</tr>
										<?php } endforeach ?>
									</tbody>
								</table>
							</div>
							<div class="form-horizontal">
								<div class="form-group">
									<label for="inputEmail3" class="col-sm-4 control-label">Jumlah Produksi</label>
									<div class="col-sm-4">
										<input type="text" class="form-control" id="inputEmail3" value="?? kg" title="Jumlah Produksi" disabled="">
									</div>
									<div class="col-sm-4">
									</div>
								</div>
								
							</div>
							<div class="form-horizontal" style="text-align: center;">
								<button type="submit" class="btn btn-primary btn-sm waves-effect waves-light">Proses Pengujian</button>
								
							</div>
						</div>
					<!-- /.card-content -->
					
				</div>
				<!-- /.box-content -->

				

				
				<!-- /.box-content card white -->
			</div>
		</div>


			


			