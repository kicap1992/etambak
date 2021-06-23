<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Penyuluh extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		// $this->load->helper('form');
		// $this->load->library('form_validation');

		$this->load->model('mpenyuluh');


		$penyuluh = $this->session->userdata('penyuluh');
		$cek_data_dulu = $this->mpenyuluh->tampil_data_where('tb_penyuluh',array('nik'=>$penyuluh['nik'], 'nama' => $penyuluh['nama']));

		if ($penyuluh != '' and $penyuluh != null) {
			if (count($cek_data_dulu->result()) > 0) {
				foreach ($cek_data_dulu->result() as $key => $value) ;
				$kecamatan = $value->kecamatan;
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
			$penyuluh = $this->session->userdata('penyuluh');
			$cek_kecamatan = $this->mpenyuluh->tampil_data_where('tb_kecamatan',array('id_kecamatan' => $penyuluh['kecamatan']));
			foreach ($cek_kecamatan->result() as $key => $value) ;
			$main['nama_kecamatan'] = $value->kecamatan;
			$main['no_kecamatan'] = $value->id_kecamatan;
			$main['cek_lahan_kecamatan'] = $this->mpenyuluh->tampil_data_where('tb_lahan', array('kecamatan' => $penyuluh['kecamatan']));
			$main['main']='penyuluh/main';
			$main['header']='Halaman Utama Penyuluh';
			$main['kecamatan'] = $this->mpenyuluh->tampil_data_keseluruhan('tb_kecamatan');
			// $main['lahan'] = $this->mpenyuluh->tampil_data_where('tb_lahan',array('nik_petambak' => $nik));

			$this->load->view('penyuluh/index',$main);
		}else{
			redirect('/penyuluh');
		}	
		
	}

	
	function analisa()
	{
		$main['header']='Halaman Analisa Penyuluh';
		$penyuluh = $this->session->userdata('penyuluh');
		$elemen_produksi = $this->mpenyuluh->tampil_data_keseluruhan('tb_elemen_produksi');
		if ($this->input->post('hari')!= '' and $this->input->post('hari') != null and $this->input->post('kode') != '' and $this->input->post('kode') != null) {
			$id = $this->input->post('kode');
			$hari = $this->input->post('hari');
			$cari = $this->mpenyuluh->cari_data($id,$hari);
			
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
						<input type="text" class="form-control"  value="Rp. <?=number_format($cari['biayaproduksi'])?>" title="Biaya Produksi" disabled="" name="biaya">
					</div>
					<div class="col-sm-4">
					</div>
				</div>
				<div class="form-group">
					<label for="inputEmail3" class="col-sm-4 control-label">Biaya Persiapan Lahan</label>
					<div class="col-sm-4">
						<input type="text" class="form-control"  value="Rp. <?=number_format($cari['biayapersiapanlahan'])?>" title="Biaya Produksi" disabled="" name="biaya">
					</div>
					<div class="col-sm-4">
					</div>
				</div>
				<div class="form-group">
					<label for="inputEmail3" class="col-sm-4 control-label">Jumlah Hasil Produksi</label>
					<div class="col-sm-4">
						<input type="text" class="form-control"  value="<?=number_format($cari['jumlahproduksi'])?> kg" title="Jumlah Hasil Produksi" disabled="">
					</div>
					<div class="col-sm-4">
					</div>
				</div>
			<?php 
			}


		}elseif ($this->uri->segment(3) != '' or $this->uri->segment(3) != null) {
			$id = $this->uri->segment(3);
			$cek_lahan = $this->mpenyuluh->tampil_data_where('tb_lahan',array('id_lahan' => $id, 'kecamatan' => $penyuluh['kecamatan'])); 
			if (count($cek_lahan->result())>0) {
				$main['lahan'] = $cek_lahan;
				$main['elemen_produksi'] = $this->mpenyuluh->tampil_data_keseluruhan('tb_elemen_produksi');
				$main['main']='penyuluh/menu/analisa_lahan';
				$this->load->view('penyuluh/index',$main);

			}else{
				$this->session->set_flashdata('error','<b>Error</b><br>Halaman Yang Diakses Tiada Dalam');
				redirect('/penyuluh');
			}

		}elseif ($this->uri->segment(3) == '') {
			$penyuluh = $this->session->userdata('penyuluh');
			$cek_kecamatan = $this->mpenyuluh->tampil_data_where('tb_kecamatan',array('id_kecamatan' => $penyuluh['kecamatan']));
			foreach ($cek_kecamatan->result() as $key => $value) ;
			$main['nama_kecamatan'] = $value->kecamatan;
			$main['no_kecamatan'] = $value->id_kecamatan;
			$main['cek_lahan_kecamatan'] = $this->mpenyuluh->tampil_data_where('tb_lahan', array('kecamatan' => $penyuluh['kecamatan']));
			$main['main']='penyuluh/menu/analisa';
			
			$main['kecamatan'] = $this->mpenyuluh->tampil_data_keseluruhan('tb_kecamatan');
			// $main['lahan'] = $this->mpenyuluh->tampil_data_where('tb_lahan',array('nik_petambak' => $nik));

			$this->load->view('penyuluh/index',$main);
		}else{
			redirect('/penyuluh');
		}	
	}


	function perkiraan_produksi()
	{
		$main['header']='Halaman Perkiraan Produksi Penyuluh';
		$penyuluh = $this->session->userdata('penyuluh');
		$elemen_produksi = $this->mpenyuluh->tampil_data_keseluruhan('tb_elemen_produksi');
		if ($this->input->post('hari')!= '' and $this->input->post('hari') != null and $this->input->post('kode') != '' and $this->input->post('kode') != null) {
			$id = $this->input->post('kode');
			$hari = $this->input->post('hari');
			$cari = $this->mpenyuluh->cari_data($id,$hari);
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
							<input type="text" class="form-control"  value="<?=$cari['jumlahproduksi']?> kg" title="Jumlah Produksi" disabled="">
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
										<input type="text" class="form-control"  title="Panen" value="<?=$tanggal?>" disabled="">
									</div>
								</div>
								<div class="form-group">
									<label for="inputPassword3" class="col-sm-3 control-label">Saiz</label>
									<div class="col-sm-9">
										<input type="text" class="form-control"  title="Saiz" value="+- <?=$cari['saiz']?> ekor/kg" disabled="">
									</div>
								</div>
								<div class="form-group">
									<label for="inputPassword3" class="col-sm-3 control-label">Total Biaya</label>
									<div class="col-sm-9">
										<input type="text" class="form-control"  title="Jumlah" value="Rp . <?=number_format($cari['totalbiaya'])?>" disabled="">
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
										<input type="text" class="form-control"  placeholder="Enter your email" title="Harga Jual" value="Rp. <?=number_format($cari['hargajual'])?>" disabled="">
									</div>
								</div>
								<div class="form-group">
									<label for="inputPassword3" class="col-sm-3 control-label">Nilai Produksi</label>
									<div class="col-sm-9">
										<input type="text" class="form-control"  title="Nilai" value="Rp. <?=number_format($cari['nilaiproduksi'])?>" disabled="">
									</div>
								</div>
								<div class="form-group">
									<label for="inputPassword3" class="col-sm-3 control-label">Keuntungan</label>
									<div class="col-sm-9">
										<input type="text" class="form-control"  title="Keuntungan" value="Rp. <?=number_format($cari['keuntungan'])?>" disabled="">
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
										<input type="text" class="form-control"  value="<?=$cari['status']?>" title="Status Produksi" disabled="">
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
			$cek_lahan = $this->mpenyuluh->tampil_data_where('tb_lahan',array('id_lahan' => $id, 'kecamatan' => $penyuluh['kecamatan'])); 
			if (count($cek_lahan->result())>0) {
				$main['lahan'] = $cek_lahan;
				$main['elemen_produksi'] = $this->mpenyuluh->tampil_data_keseluruhan('tb_elemen_produksi');
				$main['main']='penyuluh/menu/perkiraan_produksi_proses';
				$this->load->view('penyuluh/index',$main);
			}else{
				$this->session->set_flashdata('error','<b>Error</b><br>Halaman Yang Diakses Tiada Dalam');
				redirect('/penyuluh');
			}
		}elseif ($this->uri->segment(3) == '') {
			$penyuluh = $this->session->userdata('penyuluh');
			$cek_kecamatan = $this->mpenyuluh->tampil_data_where('tb_kecamatan',array('id_kecamatan' => $penyuluh['kecamatan']));
			foreach ($cek_kecamatan->result() as $key => $value) ;
			$main['nama_kecamatan'] = $value->kecamatan;
			$main['no_kecamatan'] = $value->id_kecamatan;
			$main['cek_lahan_kecamatan'] = $this->mpenyuluh->tampil_data_where('tb_lahan', array('kecamatan' => $penyuluh['kecamatan']));
			$main['main']='penyuluh/menu/perkiraan_produksi';
			
			$main['kecamatan'] = $this->mpenyuluh->tampil_data_keseluruhan('tb_kecamatan');
			// $main['lahan'] = $this->mpenyuluh->tampil_data_where('tb_lahan',array('nik_petambak' => $nik));

			$this->load->view('penyuluh/index',$main);
		}else{
			redirect('/penyuluh');
		}	
	}


	function transaksi()
	{
		$main['header']='Halaman Transaksi Penyuluh';
		$penyuluh = $this->session->userdata('penyuluh');
		$elemen_produksi = $this->mpenyuluh->tampil_data_keseluruhan('tb_elemen_produksi');
		if ($this->input->post('hari') != '' and $this->input->post('hari') != null and $this->input->post('data') != '' and $this->input->post('data') != null and $this->input->post('kode') != '' and $this->input->post('kode') != null and $this->input->post('tanggal') != '' and $this->input->post('tanggal') != null) {
			$elemen_produksi = $this->mpenyuluh->tampil_data_keseluruhan('tb_elemen_produksi');
			$kode = $this->input->post('kode');
			
			$hari = $this->input->post('hari');
			$tanggal = $this->input->post('tanggal');
			$data = $this->input->post('data');
			$keys = array_column($this->input->post('data'),'name');
			$values = array_column($this->input->post('data'),'value');
			$data = array_combine($keys, $values);
			$cari_data_harga = $this->mpenyuluh->tampil_data_where('tb_tambak',array('id_tambak' =>1));
			foreach ($cari_data_harga->result() as $key3 => $value3);
			$ket = json_decode($value3->ket);
			$cari = $this->mpenyuluh->kira_data($kode,$hari,$tanggal,$data);

			$tanggal_selesai = new DateTime($tanggal);
			$tanggal_selesai->modify('+'.$hari.' day');
			$tanggal_selesai =date('Y-m-d', strtotime($tanggal_selesai->format('Y-m-d')));

			$nama_elemen_coba;
			$nama_elemen = array();
			$jumlah_elemen_coba;
			$jumlah_elemen = array();
			foreach ($elemen_produksi->result() as $key4 => $value4) {
				$nama_elemen_coba = array($key4 => $value4->id_elemen);
				$nama_elemen = array_merge($nama_elemen,$nama_elemen_coba);

				$jumlahnya = str_replace( ',', '', $values[$key4]);
				$jumlah_elemen_coba = array($key4 => $jumlahnya);
				$jumlah_elemen = array_merge($jumlah_elemen,$jumlah_elemen_coba);
			}
			$array_elemen = array_combine($nama_elemen, $jumlah_elemen);
			$tahun_selesai = date('Y', strtotime($tanggal_selesai));

			if ($tanggal_selesai > date('Y-m-d',strtotime($tahun_selesai.'-06-30')) and $tanggal_selesai <= date('Y-m-d',strtotime($tahun_selesai.'-12-31'))) {

				$musim = 2;
				$array_full = array('tahun' => date($tahun_selesai),'musim'=> 2,'waktu_tebar' =>  $tanggal, 'masa_tumbuh' => $hari , 'masa_panen' => $tanggal_selesai ,'jumlah_produksi' => $cari['jumlahproduksi'], 'nilai_produksi' => $cari['nilaiproduksi'],'ket_elemen_produksi' => $array_elemen);
			}elseif ($tanggal_selesai >= date('Y-m-d',strtotime($tahun_selesai.'-01-31')) and $tanggal_selesai <= date('Y-m-d',strtotime($tahun_selesai.'-06-30'))) {
				
				$musim = 1;
				$array_full = array('tahun' => date($tahun_selesai),'musim'=> 1,'waktu_tebar' =>  $tanggal, 'masa_tumbuh' => $hari,'masa_panen' => $tanggal_selesai ,'jumlah_produksi' => $cari['jumlahproduksi'], 'nilai_produksi' => $cari['nilaiproduksi'], 'ket_elemen_produksi' => $array_elemen);
			}
			

			
			// $key = array_keys($array_info_1);
			// $val = array_values($array_info_1);

			// $new_key = array_merge($key, array_keys($array_elemen));
			// $new_val = array_merge($val, array_values($array_elemen));

			// $array_full = array(array_combine($new_key, $new_val));

			

			if ($this->input->post('no') == 'tabel') { 
				$cek_tabel_produksi = $this->mpenyuluh->tampil_data_where('tb_data_produksi_lahan',array("no_lahan" => $kode));
				
				if (count($cek_tabel_produksi->result()) > 0) {

					foreach ($cek_tabel_produksi->result() as $key5 => $value5) ;
					$ket = json_decode($value5->ket,true);

					// print_r($ket);
					// print_r('<br><br><br>');
					$array_baru_ini = null;
					$jika_ada = "tiada";
					foreach ($ket as $key6 => $value6) {
						// print_r($key6);
						if ($value6['tahun'] == $tahun_selesai and $value6['musim'] == $musim) {
							$ket[$key6]['waktu_tebar'] = $tanggal;
							$ket[$key6]['masa_tumbuh'] = $hari;
							$ket[$key6]['masa_panen'] = $tanggal_selesai;
							$ket[$key6]['jumlah_produksi'] = $cari['jumlahproduksi'];
							$ket[$key6]['nilai_produksi'] = $cari['nilaiproduksi'];
							$ket[$key6]['ket_elemen_produksi'] = $array_elemen;
							$jika_ada = 'ada';
							// unset($ket[$key6]); 
							// $array_baru_ini = $ket;
							break;
						}
					}

					if ($jika_ada == 'ada') {
						$array_baru_ini = $ket;
					}elseif ($jika_ada == 'tiada') {
						$array_baru_ini = array_merge(array($array_full),$ket);
					}
					// print_r($jika_ada);
					// print_r($array_baru_ini);
					// print_r(count($array_baru_ini));
					$this->mpenyuluh->update('tb_data_produksi_lahan',array("no_lahan" => $kode),array('ket'=> json_encode($array_baru_ini)));
				}else{
					$this->mpenyuluh->insert('tb_data_produksi_lahan',array("no_lahan" => $kode,'ket'=> json_encode(array($array_full))));
				}

				// print_r($tahun_selesai);
				// print_r($cari['jumlahproduksi']);

				$cek_tabel_hasil = $this->mpenyuluh->tampil_data_where('tb_hasil_produksi',array('tahun' => $tahun_selesai, 'musim' => $musim));
				// print_r(count($cek_tabel_hasil->result()));

				if (count($cek_tabel_hasil->result()) > 0) {
					$tampil_semua_produksi = $this->mpenyuluh->tampil_data_keseluruhan('tb_data_produksi_lahan');
					$hasil = 0;
					foreach ($tampil_semua_produksi->result() as $key => $value) {
						$ket = json_decode($value->ket);
						foreach ($ket as $key1 => $value1) {
							if ($value1->tahun == $tahun_selesai and $value1->musim == $musim) {
								$hasil = $hasil + $value1->jumlah_produksi;
								break;
							}
						}
					}

					$this->mpenyuluh->update('tb_hasil_produksi',array('tahun' => $tahun_selesai, 'musim' => $musim) , array('hasil' => $hasil));
					// print_r($hasil);
				}else{
					$this->mpenyuluh->insert('tb_hasil_produksi',array('tahun' => $tahun_selesai, 'musim' => $musim, 'hasil' => $cari['jumlahproduksi']));
				}

				// print_r($musim);
				?>
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
							<input type="text" class="form-control"  value="<?=number_format($cari['jumlahproduksi'])?> kg" title="Jumlah Produksi" disabled="">
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
										<input type="text" class="form-control"  title="Panen" value="<?=$tanggal?>" disabled="">
									</div>
								</div>
								<div class="form-group">
									<label for="inputPassword3" class="col-sm-3 control-label">Saiz</label>
									<div class="col-sm-9">
										<input type="text" class="form-control"  title="Saiz" value="+- <?=$cari['saiz']?> ekor/kg" disabled="">
									</div>
								</div>
								<div class="form-group">
									<label for="inputPassword3" class="col-sm-3 control-label">Total Biaya</label>
									<div class="col-sm-9">
										<input type="text" class="form-control"  title="Jumlah" value="Rp . <?=number_format($cari['totalbiaya'])?>" disabled="">
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
										<input type="text" class="form-control"  placeholder="Enter your email" title="Harga Jual" value="Rp. <?=number_format($cari['hargajual'])?>" disabled="">
									</div>
								</div>
								<div class="form-group">
									<label for="inputPassword3" class="col-sm-3 control-label">Nilai Produksi</label>
									<div class="col-sm-9">
										<input type="text" class="form-control"  title="Nilai" value="Rp. <?=number_format($cari['nilaiproduksi'])?>" disabled="">
									</div>
								</div>
								<div class="form-group">
									<label for="inputPassword3" class="col-sm-3 control-label">Keuntungan</label>
									<div class="col-sm-9">
										<input type="text" class="form-control"  title="Keuntungan" value="Rp. <?=number_format($cari['keuntungan'])?>" disabled="">
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
										<input type="text" class="form-control"  value="<?=$cari['status']?>" title="Status Produksi" disabled="">
									</div>
									<div class="col-sm-3">
									</div>
								</div>
							</div>
						</div>						
					</div>
				</div>
				<?php
			}elseif ($this->input->post('no') == 'tabel_transaksi') { 

				$data_transaksi_produksi = $this->mpenyuluh->tampil_data_where('tb_data_produksi_lahan', array('no_lahan' => $kode));
				?>
				<table id="tabel-data1" class="table table-bordered">
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
									<a href=""><button type="button" title="Lihat Transaksi Produksi" class="btn btn-info btn-circle btn-sm waves-effect waves-light"><i class="ico fa fa-list-alt"></i></button></a>
									<a href=""><button type="button" title="Edit Transaksi Produksi" class="btn btn-warning btn-circle btn-sm waves-effect waves-light"><i class="ico fa fa-file-text"></i></button></a>
								</td>
							</tr>
						<?php $i++; endforeach ?>
					<?php endforeach ?>
					<?php endif ?>
					</tbody>
				</table>
				<script>

				    $(document).ready(function(){
				        $('#tabel-data1').DataTable({
							"pageLength": 10,
							"searching": true,
							"paging":   true,
							"ordering": true,
							"info":     true,

				        });
				        
				    });
				</script>

				<script type="text/javascript">
					swal({
				        title: "Transaksi Produksi Berhasil Diupdate",
				        text: "Anda Bisa Mengeditnya Pada Tabel Yang Tersedia",
				        icon: "success",
				        // buttons: false,
				        dangerMode: true,
			         	confirmButtonText: 'Save',
				        showLoaderOnConfirm: true,
				  
			      	})
			      	.then((logout) => {
	        			if (logout) {
	        				window.location.replace("<?=base_url()?>penyuluh/transaksi/lihat/<?=$kode?>/<?=$tahun_selesai?>-<?=$musim?>");
	        			}
					});
				</script>
				<?php 
			}
		}elseif ($this->uri->segment(3) == 'lihat') {
			if (is_numeric($this->uri->segment(4))) {
				$id = $this->uri->segment(4);
				$cek_lahan = $this->mpenyuluh->tampil_data_where('tb_lahan',array('id_lahan' => $id, 'kecamatan' => $penyuluh['kecamatan'])); 
				if (count($cek_lahan->result())>0) {
					
					// echo "sini";
					$array = explode('-',$this->uri->segment(5));
					$data_transaksi_produksi = $this->mpenyuluh->tampil_data_where('tb_data_produksi_lahan', array('no_lahan' => $id));

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
							$main['elemen_produksi'] = $this->mpenyuluh->tampil_data_keseluruhan('tb_elemen_produksi');
							$main['data_transaksi_produksi'] = $this->mpenyuluh->tampil_data_where('tb_data_produksi_lahan', array('no_lahan' => $id));
							$main['kode_lahan'] = $id;
							$main['ket_nya'] = $array_ket;
							$main['main']='penyuluh/menu/transaksi_lihat';
							$this->load->view('penyuluh/index',$main);
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
		}elseif (is_numeric($this->uri->segment(3))) {
			$id = $this->uri->segment(3);
			$cek_lahan = $this->mpenyuluh->tampil_data_where('tb_lahan',array('id_lahan' => $id, 'kecamatan' => $penyuluh['kecamatan'])); 
			if (count($cek_lahan->result())>0) {
				$main['kode_lahan'] = $id;
				$main['lahan'] = $cek_lahan;
				$main['elemen_produksi'] = $this->mpenyuluh->tampil_data_keseluruhan('tb_elemen_produksi');
				$main['data_transaksi_produksi'] = $this->mpenyuluh->tampil_data_where('tb_data_produksi_lahan', array('no_lahan' => $id));
				$main['main']='penyuluh/menu/transaksi_proses';
				$this->load->view('penyuluh/index',$main);

			}else{
				$this->session->set_flashdata('error','<b>Error</b><br>Halaman Yang Diakses Tiada Dalam');
				redirect('/penyuluh');
			}
		}elseif ($this->uri->segment(3) == '') {
			$penyuluh = $this->session->userdata('penyuluh');
			$cek_kecamatan = $this->mpenyuluh->tampil_data_where('tb_kecamatan',array('id_kecamatan' => $penyuluh['kecamatan']));
			foreach ($cek_kecamatan->result() as $key => $value) ;
			$main['nama_kecamatan'] = $value->kecamatan;
			$main['no_kecamatan'] = $value->id_kecamatan;
			$main['cek_lahan_kecamatan'] = $this->mpenyuluh->tampil_data_where('tb_lahan', array('kecamatan' => $penyuluh['kecamatan']));
			$main['main']='penyuluh/menu/transaksi';
			
			$main['kecamatan'] = $this->mpenyuluh->tampil_data_keseluruhan('tb_kecamatan');
			// $main['lahan'] = $this->mpenyuluh->tampil_data_where('tb_lahan',array('nik_petambak' => $nik));

			$this->load->view('penyuluh/index',$main);
		}else{
			redirect('/penyuluh');
		}	
	
	}


	function logout()
	{
		$this->session->unset_userdata('penyuluh');
		$this->session->unset_userdata(array('nama','nik','level'));
		$this->session->set_flashdata('success', '<b>Anda Berhasil Logout</b><br>Terima Kasih Telah Menggunakan Sistem Ini');
		redirect('/home');
	}
	

}
?>