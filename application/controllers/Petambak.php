<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Petambak extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		// $this->load->helper('form');
		// $this->load->library('form_validation');

		$this->load->model('mpetambak');


		$session_nik = $this->session->userdata('nik');
		$session_nama = $this->session->userdata('nama');
		$session_level = $this->session->userdata('level');
		$cek_data_dulu = $this->mpetambak->tampil_data_where('tb_petambak',array('nik'=>$session_nik, 'nama' => $session_nama));

		if ($session_nik != '' and $session_nik != null and $session_nama != '' and $session_nama != null and $session_level == 'Petambak') {
			if (count($cek_data_dulu->result()) > 0) {
				// redirect('/petambak');
				// echo "<script>console.log('heheheh')</script>";
			}else{
				$this->session->set_flashdata('error', '<b>Error</b><br>Halaman Yang Diakses Tiada Dalam Sistem');
				redirect('/home');
			}
		}else{
			$this->session->set_flashdata('error', '<b>Error</b><br>Halaman Yang Diakses Tiada Dalam Sistem');
			redirect('/home');
		}
	}
	
	function index()
	{	
		if ($this->uri->segment(2) == '') {
			$nama = $this->session->userdata('nama');
			$nik = $this->session->userdata('nik');
			// $this->session->flashdata('success');
			$main['nama'] = $nama;
			$main['main']='petambak/main';
			$main['header']='Halaman Utama Petambak';
			$main['kecamatan'] = $this->mpetambak->tampil_data_keseluruhan('tb_kecamatan');
			$main['lahan'] = $this->mpetambak->tampil_data_where('tb_lahan',array('nik_petambak' => $nik));

			$this->load->view('petambak/index',$main);
			// echo "sini halaman petambak";
		}else{
			redirect('/petambak');
		}
		
	}

	function analisa()
	{
		$nama = $this->session->userdata('nama');
		$nik = $this->session->userdata('nik');
		$main['nama'] = $nama;
		$elemen_produksi = $this->mpetambak->tampil_data_keseluruhan('tb_elemen_produksi');
		$main['main']='petambak/menu/analisa';
		$main['header']='Halaman Analisa';
		$main['kecamatan'] = $this->mpetambak->tampil_data_keseluruhan('tb_kecamatan');
		$main['lahan'] = $this->mpetambak->tampil_data_where('tb_lahan',array('nik_petambak' => $nik));


		if ($this->input->post('hari')!= '' and $this->input->post('hari') != null and $this->input->post('kode') != '' and $this->input->post('kode') != null) {
			$id = $this->input->post('kode');
			$hari = $this->input->post('hari');
			$cari = $this->mpetambak->cari_data($id,$hari);
			
			if ($this->input->post('id') == 1) { ?>
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
						// $r = 1;
						// print_r($satuan->$r);
						foreach ($elemen_produksi->result() as $key2 => $value2):?>


						<tr>
							<td><?=$value2->nama_elemen?></td>
							<td>Rp. <?=$cari['harga'.$value2->id_elemen]?></td>
							<td><?=number_format($cari['satuan'.$value2->id_elemen])?> <?=$value2->satuan?></td>
							<td>Rp. <?=number_format($cari['jumlahbahan'.$value2->id_elemen])?></td>
						<?php  endforeach ?>
					</tbody>
				</table>
				<script>
				    $(document).ready(function(){
				        $('#tabel-data').DataTable({
							"pageLength": 10,
							"searching": false,
							"paging":   false,
							"ordering": false,
							"info":     false,

				        });
				        
				    });	    
				</script>
			<?php }elseif ($this->input->post('id') == 2) {?>

				<div class="form-group">
					<label for="inputEmail3" class="col-sm-4 control-label">Biaya Produksi</label>
					<div class="col-sm-4">
						<input type="text" class="form-control" id="inputEmail3" value="Rp. <?=number_format($cari['biayaproduksi'])?>" title="Biaya Produksi" disabled="" name="biaya">
					</div>
					<div class="col-sm-4">
					</div>
				</div>
				<div class="form-group">
					<label for="inputEmail3" class="col-sm-4 control-label">Biaya Persiapan Lahan</label>
					<div class="col-sm-4">
						<input type="text" class="form-control" id="inputEmail3" value="Rp. <?=number_format($cari['biayapersiapanlahan'])?>" title="Biaya Produksi" disabled="" name="biaya">
					</div>
					<div class="col-sm-4">
					</div>
				</div>
				<div class="form-group">
					<label for="inputEmail3" class="col-sm-4 control-label">Jumlah Hasil Produksi</label>
					<div class="col-sm-4">
						<input type="text" class="form-control" id="inputEmail3" value="<?=number_format($cari['jumlahproduksi'])?> kg" title="Jumlah Hasil Produksi" disabled="">
					</div>
					<div class="col-sm-4">
					</div>
				</div>
			<?php 
			}


		}elseif ($this->uri->segment(3) != '' or $this->uri->segment(3) != null) {
			$id = $this->uri->segment(3);
			$cek_lahan = $this->mpetambak->tampil_data_where('tb_lahan',array('id_lahan' => $id, 'nik_petambak' => $nik)); 
			if (count($cek_lahan->result())>0) {
				$main['lahan'] = $cek_lahan;
				$main['elemen_produksi'] = $this->mpetambak->tampil_data_keseluruhan('tb_elemen_produksi');
				$main['main']='petambak/menu/analisa_lahan';
				$this->load->view('petambak/index',$main);

			}else{
				$this->session->set_flashdata('error','<b>Error</b><br>Halaman Yang Diakses Tiada Dalam');
				redirect('/petambak');
			}

		}elseif ($this->uri->segment(3) == '') {
			$this->load->view('petambak/index',$main);
		}else{
			redirect('/petambak/analisa');
		}
		
	}

	// function pengujian()
	// {
	// 	// echo "sini pengujian";
	// 	$nama = $this->session->userdata('nama');
	// 	$nik = $this->session->userdata('nik');
	// 	$main['main']='petambak/menu/pengujian';
	// 	$main['header']='Halaman Pengujian';
	// 	$main['kecamatan'] = $this->mpetambak->tampil_data_keseluruhan('tb_kecamatan');
	// 	$main['lahan'] = $this->mpetambak->tampil_data_where('tb_lahan',array('nik_petambak' => $nik));

	// 	if ($this->uri->segment(3) != '' or $this->uri->segment(3) != null) {
	// 		$id = $this->uri->segment(3);
	// 		$cek_lahan = $this->mpetambak->tampil_data_where('tb_lahan',array('id_lahan' => $id, 'nik_petambak' => $nik)); 
	// 		if (count($cek_lahan->result())>0) {
	// 			$main['lahan'] = $cek_lahan;
	// 			$main['elemen_produksi'] = $this->mpetambak->tampil_data_keseluruhan('tb_elemen_produksi');
	// 			$main['main']='petambak/menu/pengujian_proses';
	// 			$this->load->view('petambak/index',$main);

	// 		}else{
	// 			$this->session->set_flashdata('error','<b>Error</b><br>Halaman Yang Diakses Tiada Dalam');
	// 			redirect('/petambak');
	// 		}
	// 	}else{
	// 		$this->load->view('petambak/index',$main);
	// 	}
		
	// }

	function perkiraan_produksi()
	{
		// echo "sini pengujian";
		$elemen_produksi = $this->mpetambak->tampil_data_keseluruhan('tb_elemen_produksi');
		$nama = $this->session->userdata('nama');
		$nik = $this->session->userdata('nik');
		$main['nama'] = $nama;
		$main['main']='petambak/menu/perkiraan_produksi';
		$main['header']='Halaman Perkiraan Produksi';
		$main['kecamatan'] = $this->mpetambak->tampil_data_keseluruhan('tb_kecamatan');
		$main['lahan'] = $this->mpetambak->tampil_data_where('tb_lahan',array('nik_petambak' => $nik));

		if ($this->input->post('hari')!= '' and $this->input->post('hari') != null and $this->input->post('kode') != '' and $this->input->post('kode') != null) {
			$id = $this->input->post('kode');
			$hari = $this->input->post('hari');
			$cari = $this->mpetambak->cari_data($id,$hari);
			if ($this->input->post('no') == 'tabel') { ?>
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
							<?php foreach ($elemen_produksi->result() as $key => $value):?>
							<tr>
								<td><?=$value->nama_elemen?></td>
								<td>Rp. <?=$cari['harga'.$value->id_elemen]?></td>
								<td><?=number_format($cari['satuan'.$value->id_elemen])?> <?=$value->satuan?></td>
								<td>Rp. <?=number_format($cari['jumlahbahan'.$value->id_elemen])?></td>
							</tr>
							<?php  endforeach ?>
						</tbody>
					</table>
				</div>
				<div class="form-horizontal">
					<div class="form-group">
						<label for="inputEmail3" class="col-sm-5 control-label">Jumlah Produksi</label>
						<div class="col-sm-4">
							<input type="text" class="form-control" id="inputEmail3" value="<?=$cari['jumlahproduksi']?> kg" title="Jumlah Produksi" disabled="">
						</div>
						<div class="col-sm-3">
						</div>
					</div>
				</div>


				<?php
			}elseif ($this->input->post('tanggal')) { 
				$tanggal = $this->input->post('tanggal');
				$tanggal =  date('Y-m-d', strtotime($tanggal. ' + '.$hari.' days'));
				$tanggal = date("d/m/Y", strtotime($tanggal));

				?>
				<div class="col-lg-6 col-xs-12">
					<div class="box-content card white">
						<!-- /.box-title -->
						<div class="card-content">
							<div class="form-horizontal">
								<div class="form-group">
									<label for="inputEmail3" class="col-sm-3 control-label">Panen</label>
									<div class="col-sm-9">
										<input type="text" class="form-control" id="inputEmail3" title="Panen" value="<?=$tanggal?>" disabled="">
									</div>
								</div>
								<div class="form-group">
									<label for="inputPassword3" class="col-sm-3 control-label">Saiz</label>
									<div class="col-sm-9">
										<input type="text" class="form-control" id="inputPassword3" title="Saiz" value="+- <?=$cari['saiz']?> ekor/kg" disabled="">
									</div>
								</div>
								<div class="form-group">
									<label for="inputPassword3" class="col-sm-3 control-label">Total Biaya</label>
									<div class="col-sm-9">
										<input type="text" class="form-control" id="inputPassword3" title="Jumlah" value="Rp . <?=number_format($cari['totalbiaya'])?>" disabled="">
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
										<input type="text" class="form-control" id="inputEmail3" placeholder="Enter your email" title="Harga Jual" value="Rp. <?=number_format($cari['hargajual'])?>" disabled="">
									</div>
								</div>
								<div class="form-group">
									<label for="inputPassword3" class="col-sm-3 control-label">Nilai Produksi</label>
									<div class="col-sm-9">
										<input type="text" class="form-control" id="inputPassword3" title="Nilai" value="Rp. <?=number_format($cari['nilaiproduksi'])?>" disabled="">
									</div>
								</div>
								<div class="form-group">
									<label for="inputPassword3" class="col-sm-3 control-label">Keuntungan</label>
									<div class="col-sm-9">
										<input type="text" class="form-control" id="inputPassword3" title="Keuntungan" value="Rp. <?=number_format($cari['keuntungan'])?>" disabled="">
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
										<input type="text" class="form-control" id="inputEmail3" value="<?=$cari['status']?>" title="Status Produksi" disabled="">
									</div>
									<div class="col-sm-3">
									</div>
								</div>
							</div>
						</div>						
					</div>
				</div>
				<?php
			}
		}elseif ($this->uri->segment(3) != '' or $this->uri->segment(3) != null) {
			$id = $this->uri->segment(3);
			$cek_lahan = $this->mpetambak->tampil_data_where('tb_lahan',array('id_lahan' => $id, 'nik_petambak' => $nik)); 
			if (count($cek_lahan->result())>0) {
				$main['lahan'] = $cek_lahan;
				$main['elemen_produksi'] = $this->mpetambak->tampil_data_keseluruhan('tb_elemen_produksi');
				$main['main']='petambak/menu/perkiraan_produksi_proses';
				$this->load->view('petambak/index',$main);
			}else{
				$this->session->set_flashdata('error','<b>Error</b><br>Halaman Yang Diakses Tiada Dalam');
				redirect('/petambak');
			}
		}else{
			$this->load->view('petambak/index',$main);
		}
		
	}

	function transaksi()
	{
		// echo "sini pengujian";
		$nama = $this->session->userdata('nama');
		$nik = $this->session->userdata('nik');
		$main['nama'] = $nama;
		$main['main']='petambak/menu/transaksi';
		$main['header']='Halaman Perkiraan Produksi';
		$main['kecamatan'] = $this->mpetambak->tampil_data_keseluruhan('tb_kecamatan');
		$main['lahan'] = $this->mpetambak->tampil_data_where('tb_lahan',array('nik_petambak' => $nik));

		if ($this->input->post('hari') != '' and $this->input->post('hari') != null and $this->input->post('data') != '' and $this->input->post('data') != null and $this->input->post('kode') != '' and $this->input->post('kode') != null and $this->input->post('tanggal') != '' and $this->input->post('tanggal') != null) {
			$elemen_produksi = $this->mpetambak->tampil_data_keseluruhan('tb_elemen_produksi');
			$kode = $this->input->post('kode');
			$hari = $this->input->post('hari');
			$tanggal = $this->input->post('tanggal');
			$data = $this->input->post('data');
			$keys = array_column($this->input->post('data'),'name');
			$values = array_column($this->input->post('data'),'value');
			$data = array_combine($keys, $values);
			$cari_data_harga = $this->mpetambak->tampil_data_where('tb_tambak',array('id_tambak' =>1));
			foreach ($cari_data_harga->result() as $key3 => $value3);
			$ket = json_decode($value3->ket);
			$cari = $this->mpetambak->kira_data($kode,$hari,$tanggal,$data);

			if ($this->input->post('no') == 'tabel') { ?>
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
							?>
							<tr>
								<td><?=$value2->nama_elemen?></td>
								<td>Rp. <?=$harga?> </td>
								<td>
									<input type="text"  style="width: 200px;" class="form-control" id="inputan<?=$value2->id_elemen?>" placeholder="Jumlah <?=$value2->nama_elemen?>" name="<?=$value2->id_elemen?>" value="<?=$data[$no]?>" minlegth='5' maxlength='10'>
								</td>
								<td>Rp . <?=number_format($cari['jumlah'.$no])?></td>
							</tr>
							<?php  endforeach ?>
						</tbody>
					</table>
				</form>
				<div class="form-horizontal">
					<div class="form-group">
						<label for="inputEmail3" class="col-sm-5 control-label">Jumlah Produksi</label>
						<div class="col-sm-4">
							<input type="text" class="form-control" id="inputEmail3" value="<?=number_format($cari['jumlahproduksi'])?> kg" title="Jumlah Produksi" disabled="">
						</div>
						<div class="col-sm-3">
						</div>
					</div>
				</div>

				<script>
				    $(document).ready(function(){
				        $('#tabel-data').DataTable({
							"pageLength": 10,
							"searching": false,
							"paging":   false,
							"ordering": false,
							"info":     false,

				        });
				        
				    });
				</script>
				<script type="text/javascript">
				<?php foreach ($elemen_produksi->result() as $key => $value): ?>
				
				    var elem = document.getElementById("inputan<?=$value->id_elemen?>");

				    elem.addEventListener("keydown",function(event){
				        var key = event.which;
				        if((key<48 || key>57) && key != 8) event.preventDefault();
				    });

				    elem.addEventListener("keyup",function(event){
				        var value = this.value.replace(/,/g,"");
				        this.dataset.currentValue=parseInt(value);
				        var caret = value.length-1;
				        while((caret-3)>-1)
				        {
				            caret -= 3;
				            value = value.split('');
				            value.splice(caret+1,0,",");
				            value = value.join('');
				        }
				        this.value = value;
				    });
				   
				
				<?php endforeach ?>
				</script>
				<?php
			}elseif ($this->input->post('no') == 'detail') {
				$tanggal = $this->input->post('tanggal');
				$tanggal =  date('Y-m-d', strtotime($tanggal. ' + '.$hari.' days'));
				$tanggal = date("d/m/Y", strtotime($tanggal));

				?>
				<div class="col-lg-6 col-xs-12">
					<div class="box-content card white">
						<!-- /.box-title -->
						<div class="card-content">
							<div class="form-horizontal">
								<div class="form-group">
									<label for="inputEmail3" class="col-sm-3 control-label">Panen</label>
									<div class="col-sm-9">
										<input type="text" class="form-control" id="inputEmail3" title="Panen" value="<?=$tanggal?>" disabled="">
									</div>
								</div>
								<div class="form-group">
									<label for="inputPassword3" class="col-sm-3 control-label">Saiz</label>
									<div class="col-sm-9">
										<input type="text" class="form-control" id="inputPassword3" title="Saiz" value="+- <?=$cari['saiz']?> ekor/kg" disabled="">
									</div>
								</div>
								<div class="form-group">
									<label for="inputPassword3" class="col-sm-3 control-label">Total Biaya</label>
									<div class="col-sm-9">
										<input type="text" class="form-control" id="inputPassword3" title="Jumlah" value="Rp . <?=number_format($cari['totalbiaya'])?>" disabled="">
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
										<input type="text" class="form-control" id="inputEmail3" placeholder="Enter your email" title="Harga Jual" value="Rp. <?=number_format($cari['hargajual'])?>" disabled="">
									</div>
								</div>
								<div class="form-group">
									<label for="inputPassword3" class="col-sm-3 control-label">Nilai Produksi</label>
									<div class="col-sm-9">
										<input type="text" class="form-control" id="inputPassword3" title="Nilai" value="Rp. <?=number_format($cari['nilaiproduksi'])?>" disabled="">
									</div>
								</div>
								<div class="form-group">
									<label for="inputPassword3" class="col-sm-3 control-label">Keuntungan</label>
									<div class="col-sm-9">
										<input type="text" class="form-control" id="inputPassword3" title="Keuntungan" value="Rp. <?=number_format($cari['keuntungan'])?>" disabled="">
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
										<input type="text" class="form-control" id="inputEmail3" value="<?=$cari['status']?>" title="Status Produksi" disabled="">
									</div>
									<div class="col-sm-3">
									</div>
								</div>
							</div>
						</div>						
					</div>
				</div>
				<?php
			}
		}elseif ($this->uri->segment(3) == 'lihat') {
			if (is_numeric($this->uri->segment(4))) {
				$id = $this->uri->segment(4);
				$cek_lahan = $this->mpetambak->tampil_data_where('tb_lahan',array('id_lahan' => $id, 'nik_petambak' => $nik)); 
				if (count($cek_lahan->result())>0) {
					
					// echo "sini";
					$array = explode('-',$this->uri->segment(5));
					$data_transaksi_produksi = $this->mpetambak->tampil_data_where('tb_data_produksi_lahan', array('no_lahan' => $id));

					if (count($data_transaksi_produksi->result())>0) {
						foreach ($data_transaksi_produksi->result() as $key => $value) ;
						$ket = json_decode($value->ket,true);
						// print_r(count($ket));
						$ada = 0;
						$array_ket = null;
						foreach ($ket as $key1 => $value1) {
							if ($value1['tahun'] == $array[0] and $value1['musim'] == $array[1]) {
								$ada = 1;
								$array_ket = $value1;
								break;
							}
						}

						if ($ada == 1) {
							// echo "sini tampilan";
							$main['lahan'] = $cek_lahan;
							$main['elemen_produksi'] = $this->mpetambak->tampil_data_keseluruhan('tb_elemen_produksi');
							$main['data_transaksi_produksi'] = $this->mpetambak->tampil_data_where('tb_data_produksi_lahan', array('no_lahan' => $id));
							$main['kode_lahan'] = $id;
							$main['ket_nya'] = $array_ket;
							$main['main']='petambak/menu/transaksi_lihat';
							$this->load->view('petambak/index',$main);
							// print_r($main['ket']);
						}elseif ($ada == 0) {
							echo "bukan tampilan";
						}
					}else{
						echo "tiada";
					}
				}else{
					// $this->session->set_flashdata('error','<b>Error</b><br>Halaman Yang Diakses Tiada Dalam');
					// redirect('/penyuluh');
					echo "bukan";
				}
			}else{
				echo "bukan";
			}
		}elseif ($this->uri->segment(3) != '' or $this->uri->segment(3) != null) {
			$id = $this->uri->segment(3);
			$cek_lahan = $this->mpetambak->tampil_data_where('tb_lahan',array('id_lahan' => $id, 'nik_petambak' => $nik)); 
			if (count($cek_lahan->result())>0) {
				$main['lahan'] = $cek_lahan;
				$main['data_transaksi_produksi'] = $this->mpetambak->tampil_data_where('tb_data_produksi_lahan', array('no_lahan' => $id));
				$main['elemen_produksi'] = $this->mpetambak->tampil_data_keseluruhan('tb_elemen_produksi');
				$main['main']='petambak/menu/transaksi_proses';
				$this->load->view('petambak/index',$main);

			}else{
				$this->session->set_flashdata('error','<b>Error</b><br>Halaman Yang Diakses Tiada Dalam');
				redirect('/petambak');
			}
		}else{
			$this->load->view('petambak/index',$main);
		}
		
	}


	function penambahan()
	{		
		$nama = $this->session->userdata('nama');
		$nik = $this->session->userdata('nik');
		// $this->session->flashdata('success');

		$main['main']='petambak/menu/penambahan_lahan';
		$main['header']='Halaman Utama Petambak';
		$main['kecamatan'] = $this->mpetambak->tampil_data_keseluruhan('tb_kecamatan');
		$main['tek_tambak'] = $this->mpetambak->tampil_data_keseluruhan('tb_tambak');
		$main['lahan'] = $this->mpetambak->tampil_data_where('tb_lahan',array('nik_petambak' => $nik));

		if ($this->uri->segment(3) == 'pilih_kelurahan') {
			if ($this->input->post('kecamatan') =='' or $this->input->post('kecamatan') == null) {
				$this->session->set_flashdata('error', '<b>Error</b><br>Halaman Yang Diakses Tiada Dalam Sistem');
				redirect('/petambak/penambahan');
			}else{
				$cek_kelurahan = $this->mpetambak->tampil_data_where('tb_kelurahan',array('id_kecamatan' => $this->input->post('kecamatan'))); ?>

				<option value="">-Pilih Kelurahan</option>
				<?php foreach ($cek_kelurahan->result() as $key => $value) { ?>
				<option value="<?=$value->id_kelurahan?>"><?=$value->kelurahan?></option>
				<?php } ?>

				<script type="text/javascript">
					function changeFuncKelurahan($i) {
						var value = $i;
						if (value == '' || value == null) {
							// console.log(value);
							$('#peta').html('');
						}else{
							// console.log(value);
							$.ajax({

				              type: "post",
				              url: "<?=base_url()?>petambak/peta",
				              data: {kecamatan : '<?=$this->input->post("kecamatan")?>',kelurahan: value}, // appears as $_GET['id'] @ your backend side
				              // dataType: "json",
				              success: function(data1) {

				                // console.log(data1);
				                $('#peta').html(data1);
				               
				              }

				            });
						}
						
					}
				</script>
				
			<?php }
		}else{
			$this->load->view('petambak/index',$main);
		}

		
		// echo "sini halaman petambak";
	}

	function logout()
	{
		$this->session->unset_userdata('penyuluh');
		$this->session->unset_userdata(array('nama','nik','level'));
		$this->session->set_flashdata('success', '<b>Anda Berhasil Logout</b><br>Terima Kasih Telah Menggunakan Sistem Ini');
		redirect('/home');
	}


	function peta()
	{
		$kecamatan = $this->mpetambak->tampil_data_keseluruhan('tb_kecamatan');
		$lahan = $this->mpetambak->tampil_data_keseluruhan('tb_lahan');

		if ($this->input->post('kecamatan')!=null or $this->input->post('kecamatan') != '') {
			$id_kecamatan = $this->input->post('kecamatan');
			if ($this->input->post('kelurahan') != null or $this->input->post('kelurahan') != '') {
				$id_kelurahan = $this->input->post('kelurahan'); 
				$cek_peta_kelurahan = $this->mpetambak->tampil_data_where('tb_kelurahan',array('id_kecamatan'=> $id_kecamatan,'id_kelurahan' => $id_kelurahan));
				$result_html = '<div class="box-content">
				<div class="col-lg-12 col-xs-12">
				<input type="button"  class="btn btn-info waves-effect waves-light" id="enablePolygon" value="Tanda Kordinat Tambak" name="enablePolygon" />
				<input type="button" class="btn btn-danger waves-effect waves-light" id="resetPolygon" value="Reset Kembali Kordinat" style="display: none;" />
				<input type="hidden" name="point" id="coords">
				<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBw6bnAk0C2jIDDbz_dVRso9gUEnHLTH68&libraries=drawing,places,geometry&callback=initialize"></script>
				<script type="text/javascript">
				

				var all_overlays = [];
  				var geocoder;

  				function numberWithCommas(x) {
			      return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
			    }
		  		function initialize() {
		    		var map = new google.maps.Map(
		      			document.getElementById("map_canvas"), {
		        		center: new google.maps.LatLng(-4.07288599, 119.62768555),
		        		zoom: 8,
		        		mapTypeId: "roadmap"
		      		});
		      		
		     
		 			bounds = new google.maps.LatLngBounds();
		 			';
					 

				foreach ($lahan->result() as $key => $value) {
					if ($value->tek_tambak == 1) {
          				$color = "#FE2D00";
          			}elseif ($value->tek_tambak == 2) {
          				$color = "#77FE00";
          			}elseif ($value->tek_tambak == 3) {
          				$color = "#1F00FE";
          			}

          			$result_html .= 'var lahan_'.$value->id_lahan.'= new google.maps.Polygon({
                      			map: map,
                      			path: ['.$value->point.'],
                      			strokeColor: "#000000",
								strokeOpacity: 2,
								strokeWeight: 1,
								fillColor: "'.$color.'",
								fillOpacity: 0.4,
                      		});';
				}



	         	foreach ($cek_peta_kelurahan->result() as $key => $value) {
	         		
	          		$result_html .= 'var polygon'.$value->id_kelurahan.'   = new google.maps.Polygon({
	                    map: map,
	                    path: ['.$value->kordinat.' ],
	                    name: "polygon'.$value->id_kelurahan.'",
	                    strokeColor: "#000000",
	                    strokeOpacity: 2,
	                    strokeWeight: 1,
	                    fillColor: "#B85612",
	                    fillOpacity: 0.4,
	                  });

	                  var polyOptions = {
							    strokeWeight: 0,
							    fillOpacity: 0.45,
							    editable: true,
							    fillColor: "#FF1493"
							  };
							  var selectedShape;

							  var drawingManager = new google.maps.drawing.DrawingManager({
							    drawingMode: google.maps.drawing.OverlayType.POLYGON,
							    drawingControl: false,
							    markerOptions: {
							      draggable: true
							    },
							    polygonOptions: polyOptions
							  });

							  $("#enablePolygon").click(function() {
							    drawingManager.setMap(map);
							    drawingManager.setDrawingMode(google.maps.drawing.OverlayType.POLYGON);
							    	$("#enablePolygon").hide();
							  });

							  $("#resetPolygon").click(function() {
							    if (selectedShape) {
							      selectedShape.setMap(null);
							    }
							    drawingManager.setMap(null);
							    $("#showonPolygon").hide();
							    document.getElementById("luas_lahan").value = "";
							    $("#resetPolygon").hide();
							    $("#enablePolygon").show();
							  });
							  google.maps.event.addListener(drawingManager, "polygoncomplete", function(polygon) {
							     var area = google.maps.geometry.spherical.computeArea(selectedShape.getPath());
							     var area1 = google.maps.geometry.spherical.computeArea(selectedShape.getPath());
							    //  $("#areaPolygon").html(area.toFixed(2)+" Sq meters");
							    area = area/10000;
							    area1 = area1/10000;
							    area = numberWithCommas(area.toFixed(2))+" Ha";
							    area1 = area1.toFixed(3);
							    document.getElementById("luas_lahan").value = area;
							    document.getElementById("luas_lahan1").value = area1;
							    var coordStr = "";
							    for (var i = 0; i < polygon.getPath().getLength(); i++) {
							      coordStr +="{lat: "+ polygon.getPath().getAt(i).lat() + ",  lng: "+
							      polygon.getPath().getAt(i).lng()+"},\n"
							      ;
							    }
							    document.getElementById("coords").value = coordStr;
							    // console.log(coordStr);
							    $("#resetPolygon").show();
							  });

							  function clearSelection() {
							    if (selectedShape) {
							      selectedShape.setEditable(false);
							      selectedShape = null;
							    }
							  }


							  function setSelection(shape) {
							    clearSelection();
							    selectedShape = shape;
							    shape.setEditable(true);
							  }

							  google.maps.event.addListener(drawingManager,'."'overlaycomplete'".', function(e) {
							    all_overlays.push(e);
							    if (e.type != google.maps.drawing.OverlayType.MARKER) {
							      // Switch back to non-drawing mode after drawing a shape.
							      drawingManager.setDrawingMode(null);

							      // Add an event listener that selects the newly-drawn shape when the user
							      // mouses down on it.
							      var newShape = e.overlay;
							      newShape.type = e.type;
							      google.maps.event.addListener(newShape, "click", function() {
							        setSelection(newShape);
							      });
							      setSelection(newShape);
							    }
							  });

	                  for (var i = 0; i < polygon'.$value->id_kelurahan.'.getPath().getLength(); i++) {
                       		 bounds.extend(polygon'.$value->id_kelurahan.'.getPath().getAt(i));
                  		}';
	          	}


				$result_html .='	map.fitBounds(bounds);
							  }
						</script>				    
						<div id="map_canvas"></div></div></div>
						<center><button type="button" class="btn btn-lg waves-effect waves-light" onclick="heheh()">Lakukkan Pendaftaran</button></center>	';


				$result_html .= '<script>
					function heheh(){
					var kecamatan = $('."'".'select[name="kecamatan"]'."'".').val();
					var kelurahan = $('."'".'select[name="kelurahan"]'."'".').val();
					var pbb = $('."'".'input[name="pbb"]'."'".').val();
					var point = $('."'".'input[name="point"]'."'".').val();
					var tambak = $('."'".'select[name="tambak"]'."'".').val();
					var luas_lahan = $('."'".'input[name="luas_lahan"]'."'".').val();

					console.log(kecamatan);
					console.log(kelurahan);
					console.log(pbb);
					console.log(point);
					console.log(tambak);
					console.log(luas_lahan);

					if(pbb.length < 16 || pbb == "" || pbb == null){
						$('."'".'input[name="pbb"]'."'".').focus();
						toastr.options = {
					      "closeButton": true,
					      "debug": false,
					      "progressBar": true,
					      "positionClass": "toast-top-right",
					      "showDuration": "300",
					      "hideDuration": "1000",
					      "timeOut": "5000",
					      "extendedTimeOut": "1000",
					      "showEasing": "swing",
					      "hideEasing": "linear",
					      "showMethod": "fadeIn",
					      "hideMethod": "fadeOut"
					    };

					    toastr.error("<b>Error</b><br>No PBB harus Panjang 16 Karakter");
					} else if(tambak == "" || tambak == null){
						$('."'".'select[name="tambak"]'."'".').focus();
						toastr.options = {
					      "closeButton": true,
					      "debug": false,
					      "progressBar": true,
					      "positionClass": "toast-top-right",
					      "showDuration": "300",
					      "hideDuration": "1000",
					      "timeOut": "5000",
					      "extendedTimeOut": "1000",
					      "showEasing": "swing",
					      "hideEasing": "linear",
					      "showMethod": "fadeIn",
					      "hideMethod": "fadeOut"
					    };

					    toastr.error("<b>Error</b><br>Teknologi Tambak Harus Dipilih");
					} else if(point == "" || point == null){
						$('."'".'input[name="enablePolygon"]'."'".').focus();
						toastr.options = {
					      "closeButton": true,
					      "debug": false,
					      "progressBar": true,
					      "positionClass": "toast-top-right",
					      "showDuration": "300",
					      "hideDuration": "1000",
					      "timeOut": "5000",
					      "extendedTimeOut": "1000",
					      "showEasing": "swing",
					      "hideEasing": "linear",
					      "showMethod": "fadeIn",
					      "hideMethod": "fadeOut"
					    };

					    toastr.error("<b>Error</b><br>Kordinat Tambak Harus Ditanda");
					} else {
						$.ajax({

			              type: "post",
			              url: "'.base_url().'petambak/pendaftaran_tambak/",
			              data: {kecamatan: kecamatan,kelurahan: kelurahan,pbb : pbb, tambak :tambak, point : point, luas_lahan: luas_lahan}, 
			              // dataType: "json",
			              success: function(data1) {


			                if (data1 == "true2") {
			                	$('."'".'input[name="pbb"]'."'".').focus();
								toastr.options = {
							      "closeButton": true,
							      "debug": false,
							      "progressBar": true,
							      "positionClass": "toast-top-right",
							      "showDuration": "300",
							      "hideDuration": "1000",
							      "timeOut": "5000",
							      "extendedTimeOut": "1000",
							      "showEasing": "swing",
							      "hideEasing": "linear",
							      "showMethod": "fadeIn",
							      "hideMethod": "fadeOut"
							    };

							    toastr.warning("<b>Error</b><br>No PBB Yang Dimasukkan Telah Terdaftar Dalam Sistem<br>Silakan Cek Kembali No PBB Yang Dimasukkan");
			                }else if (data1 == "false") {
			                	window.location.href ="'.base_url().'petambak";
			                }
			              }

			            });
					}
								}


				</script>';

				echo $result_html;

					

				
			}else{  

				$cek_peta_kecamatan = $this->mpetambak->tampil_data_where('tb_kecamatan',array('id_kecamatan'=> $id_kecamatan));
				$result_html = '<div class="box-content">
				<div class="col-lg-12 col-xs-12"><script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBw6bnAk0C2jIDDbz_dVRso9gUEnHLTH68&libraries=drawing,places&sensor=false&callback=initialize"></script>
				<script type="text/javascript">
		  		function initialize() {
		    		var map = new google.maps.Map(
		      			document.getElementById("map_canvas"), {
		        		center: new google.maps.LatLng(-4.07288599, 119.62768555),
		        		zoom: 8,
		        		mapTypeId: "roadmap"
		      		});
		     
		 			bounds = new google.maps.LatLngBounds();
		 			';
					 
	         	foreach ($cek_peta_kecamatan->result() as $key => $value) {
	         		
	          		$result_html .= 'var polygon'.$value->id_kecamatan.'   = new google.maps.Polygon({
	                    map: map,
	                    path: ['.$value->kordinat.' ],
	                    name: "polygon'.$value->id_kecamatan.'",
	                    strokeColor: "#000000",
	                    strokeOpacity: 2,
	                    strokeWeight: 1,
	                    fillColor: "#B85612",
	                    fillOpacity: 0.4,
	                  });

	                  for (var i = 0; i < polygon'.$value->id_kecamatan.'.getPath().getLength(); i++) {
                       		 bounds.extend(polygon'.$value->id_kecamatan.'.getPath().getAt(i));
                  		}';
	          	}

		               
				$result_html .='	map.fitBounds(bounds);
							  }
						</script>				    
						<div id="map_canvas"></div></div></div>';

				echo $result_html;
			}
		}else{
			$this->session->set_flashdata('error', '<b>Error</b><br>Halaman Yang Diakses Tiada Dalam Sistem');
			redirect('/petambak/penambahan');
		}

	}

	function pendaftaran_tambak()
	{
		$kecamatan = $this->input->post('kecamatan');
		$kelurahan = $this->input->post('kelurahan');
		$nik =  $this->session->userdata('nik');
		$nama =  $this->session->userdata('nama');
		$pbb = $this->input->post('pbb');
		$tambak = $this->input->post('tambak');
		$point = $this->input->post('point');
		$luas_lahan = $this->input->post('luas_lahan');


		$cek_pbb = $this->mpetambak->tampil_data_where('tb_lahan',array('no_pbb' => $pbb));

		if (count($cek_pbb->result()) > 0) {
			
			echo "true2";
		}else{
			$this->mpetambak->insert('tb_lahan',array('nik_petambak' => $nik, 'no_pbb' => $pbb ,'tek_tambak' => $tambak, 'point' => $point, 'kecamatan' => $kecamatan , 'kelurahan' => $kelurahan, 'luas_lahan' => $luas_lahan));
			$this->session->set_flashdata('success', '<b>Success</b><br>Anda Telah Mendaftar Lahan Yang Baru');
			echo "false";
		}
	}


	function try1()
	{


		// $cari = $this->cari_data(17,90);
		// $elemen_produksi = $this->mpetambak->tampil_data_keseluruhan('tb_elemen_produksi');
		// // $main['harga'.$no] = $harga;
		// // $main['satuan'.$no] = $satu;
		// // $main['jumlahbahan'.$no] = $elemen[$no];
		// // $main['biayaproduksi'] = $biya;
		// // $main['jumlahproduksi'] = $jumlah_produksi;
		// // $main['biayapersiapanlahan'] = $persiapan_lahan;

		// // print_r($cari);

		// foreach ($elemen_produksi->result() as $key => $value) {
		// 	echo $cari['harga'.$value->id_elemen].' -- ' .$cari['satuan'.$value->id_elemen].$value->satuan.'--'. $cari['jumlahbahan'.$value->id_elemen].'<br>';
		// }
		// print_r($cari['biayaproduksi'].'<br>');
		// print_r($cari['jumlahproduksi'].'<br>');
		// print_r($cari['biayapersiapanlahan'].'<br>');

	}

	function try2()
	{
		$cari = $this->mpetambak->kira_data(17,100,'',$data);
		print_r($cari);
	}

	

	

}
?>