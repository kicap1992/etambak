		
		<div class="row small-spacing">
			<div class="col-xs-12">
				<div class="box-content card">
					<h4 class="box-title">Form Hasil Produksi</h4>
					<div class="card-content">
						<form id="hasil_produksi">
							<table id="tabel-data" class="table table-striped table-bordered display" style="width:100%">
								<thead>
									<tr>
										<th width="5%">No</th>
										<th>Tahun</th>
										<th>Musim</th>
										<th width="20%">Hasil</th>
										<th>Prediksi</th>
									</tr>
								</thead>
								<tbody>
									<?php $i = 1; foreach ($data_produksi->result() as $key => $value): 
											$hasil[$i] = $value->hasil;
											if ($i != 1 and $i != 2 and $i != 3) {
												$prediksi = ($hasil[$i-3] + $hasil[$i-2] + $hasil[$i-1])/3;
											}else{
												$prediksi = '-';
											}
										?>
									<tr>
										<td><?=$i?></td>
										<td><?=$value->tahun?></td>
										<td><?=$value->musim?></td>
										<td>
											<?php if ($i<=20): ?>
											<input type="text"  style="width: 200px;" class="form-control" id="inputan<?=$value->no?>" placeholder="Jumlah Nener" name="<?=$value->no?>"  minlegth='5' maxlength='10' value="<?php if($value->hasil != '' or $value->hasil != null){ echo number_format($value->hasil);} ?>" disabled>	
											<?php endif ?>
											<?php if ($i>20): ?>
											<?=number_format($value->hasil)?>	
											<?php endif ?>
										</td>
										<td><?php  
												if ($i != 1 and $i != 2 and $i != 3) {
												echo round($prediksi,0);
											}else{
												echo $prediksi;
											}
											?>
										</td>
									</tr>
									<?php $i++; endforeach ?>
								</tbody>
							</table>
						</form>
						<div class="form-group">
							<br>
							<center>
								<button type="button" class="btn btn-success btn-sm waves-effect waves-light" onclick="update_hasil()" style="display: none;" id="button_update">Update Hasil Tahun 2010 - 2019</button> &nbsp &nbsp
								<button type="button" class="btn btn-danger btn-sm waves-effect waves-light" style="display: none;" id="button_cancel" onclick="cancel_button()" >Cancel</button>
								<button type="button" class="btn btn-warning btn-sm waves-effect waves-light" onclick="edit_kah()" id="edit_kah">Edit Hasil Tahun 2010 - 2019 ?</button>
							</center>
						</div>
					</div>
					
				</div>
			</div>

			<div class="col-xs-12">
				<div class="box-content card">
					<h4 class="box-title">Grafik Produksi Dan Prediksi</h4>
					<div class="card-content">
						<div id="myfirstchart" style="height: 400px;"></div>
					</div>
				</div>
			</div>
		</div>


			


			