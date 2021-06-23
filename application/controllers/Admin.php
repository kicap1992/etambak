<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		// $this->load->helper('form');
		// $this->load->library('form_validation');

		// $this->load->model('mlogin');
		// if ($this->uri->segment(2)!="hahaha") {
		// 	redirect('/home');
		// }

		$this->load->model('madmin');


		$session_nik = $this->session->userdata('nik');
		$session_nama = $this->session->userdata('nama');
		$session_level = $this->session->userdata('level');
		$cek_data_dulu = $this->madmin->tampil_data_where('tb_admin',array('nik_admin'=>$session_nik, 'nama' => $session_nama));

		if ($session_nik != '' and $session_nik != null and $session_nama != '' and $session_nama != null and $session_level == 'Admin') {
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
			$main['cek_hasil'] =  $this->madmin->tampil_data_keseluruhan('tb_hasil_produksi');
			$main['main']='admin/main';
			$main['header']='Halaman Utama Admin';
			$main['kecamatan'] = $this->madmin->tampil_data_keseluruhan('tb_kecamatan');
			$main['lahan'] = $this->madmin->tampil_data_keseluruhan('tb_lahan');

			
			$this->load->view('admin/index',$main);		
		}else{
			redirect('/admin');
		}	
	}

	function data_petambak()
	{
		$main['main']='admin/menu/data_lahan';
		$main['header']='Halaman Data Lahan';
		$main['kecamatan'] = $this->madmin->tampil_data_keseluruhan('tb_kecamatan');
		$main['lahan'] = $this->madmin->tampil_data_keseluruhan('tb_lahan');

		if ($this->input->post('kecamatan')!=null or $this->input->post('kecamatan')!='') {
			if ($this->input->post('kecamatan') == 0) { ?>
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

					<?php $i = 1; foreach ($main['lahan']->result() as $key => $value) { 
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
						<td align="center"><a href="<?=base_url()?>admin/data_petambak/<?=$value->id_lahan?>"><button type="button" title="Analisa Produksi" class="btn btn-info btn-circle btn-sm waves-effect waves-light"><i class="ico fa fa-list-alt"></i></button></a></td>
					</tr>
					<?php $i++;} ?>
				</tbody>
			</table>

			<script>
			    $(document).ready(function(){
			        $('#tabel-data').DataTable({
			          "pageLength": 50
			        });
			    });
		 	</script>
				
			<?php }else{ 
				$lahan = $this->madmin->tampil_data_where('tb_lahan',array('kecamatan'=>$this->input->post('kecamatan')))
			?>
			<table id="tabel-data" class="table table-striped table-bordered display" style="width:100%">
				<thead>
					<tr>
						<th width="3%">No</th>
						<th>Kode Lahan</th>
						<th>Petambak</th>
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

						$cek_kelurahan = $this->madmin->tampil_data_where('tb_kelurahan',array('id_kelurahan' => $value->kelurahan));
						foreach ($cek_kelurahan->result() as $key3 => $value3) ;

						$cek_teknologi = $this->madmin->tampil_data_where('tb_tambak',array('id_tambak' => $value->tek_tambak));
						foreach ($cek_teknologi->result() as $key4 => $value4) ;
						?>
					<tr>
						<td><?=$i?></td>
						<td><?=$value->id_lahan?></td>
						<td><?=$value1->nama?></td>
						<td><?=$value3->kelurahan?></td>
						<td><?=$value->luas_lahan?></td>
						<td><?=$value4->tambak?></td>
						<td align="center"><a href="<?=base_url()?>admin/data_petambak/<?=$value->id_lahan?>"><button type="button" title="Analisa Produksi" class="btn btn-info btn-circle btn-sm waves-effect waves-light"><i class="ico fa fa-list-alt"></i></button></a></td>
					</tr>
					<?php $i++;} ?>
				</tbody>
			</table>

			<script>
			    $(document).ready(function(){
			        $('#tabel-data').DataTable({
			          "pageLength": 50
			        });
			    });
		 	</script>
			<?php }
		}elseif ($this->uri->segment(3) == 'lihat') {
			if (is_numeric($this->uri->segment(4))) {
				$id = $this->uri->segment(4);
				$cek_lahan = $this->madmin->tampil_data_where('tb_lahan',array('id_lahan' => $id)); 
				if (count($cek_lahan->result())>0) {
					
					// echo "sini";
					$array = explode('-',$this->uri->segment(5));
					$data_transaksi_produksi = $this->madmin->tampil_data_where('tb_data_produksi_lahan', array('no_lahan' => $id));

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
							$main['elemen_produksi'] = $this->madmin->tampil_data_keseluruhan('tb_elemen_produksi');
							$main['data_transaksi_produksi'] = $this->madmin->tampil_data_where('tb_data_produksi_lahan', array('no_lahan' => $id));
							$main['kode_lahan'] = $id;
							$main['ket_nya'] = $array_ket;
							$main['main']='admin/menu/data_lahan_lihat_detail';
							$this->load->view('admin/index',$main);
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
			// echo "sini";
			$id = $this->uri->segment(3);
			$cek_lahan = $this->madmin->tampil_data_where('tb_lahan',array('id_lahan' => $id)); 
			if (count($cek_lahan->result())>0) {
				$main['lahan'] = $cek_lahan;
				$main['data_transaksi_produksi'] = $this->madmin->tampil_data_where('tb_data_produksi_lahan', array('no_lahan' => $id));
				$main['elemen_produksi'] = $this->madmin->tampil_data_keseluruhan('tb_elemen_produksi');
				$main['main']='admin/menu/data_lahan_lihat';
				$this->load->view('admin/index',$main);

			}else{
				$this->session->set_flashdata('error','<b>Error</b><br>Halaman Yang Diakses Tiada Dalam');
				redirect('/admin');
			}
		}elseif ($this->uri->segment(3) == '') {
			$this->load->view('admin/index',$main);	
		}else{
			redirect('/admin/data_petambak');
		}
		
	}

	function data_petambak1()
	{
		$main['main']='admin/menu/data_petambak';
		$main['header']='Halaman Data Petambak';
		// $main['kecamatan'] = $this->madmin->tampil_data_keseluruhan('tb_lahan');
		$main['petambak'] = $this->madmin->tampil_data_keseluruhan('tb_petambak');

		if (is_numeric($this->uri->segment(3))) {
			$main['main']='admin/menu/data_petambak_lihat';
			$main['header']='Halaman Utama Petambak';
			$main['kecamatan'] = $this->madmin->tampil_data_keseluruhan('tb_kecamatan');
			$cek_petambak = $this->madmin->tampil_data_where('tb_petambak',array('nik' => $this->uri->segment(3)));
			foreach ($cek_petambak->result() as $key => $value) ;
			$main['nama'] = $value->nama;
			$main['lahan'] = $this->madmin->tampil_data_where('tb_lahan',array('nik_petambak' => $this->uri->segment(3)));

			$this->load->view('admin/index',$main);
		}elseif ($this->uri->segment(3) == '') {
			$this->load->view('admin/index',$main);	
		}else{
			redirect('/admin/data_petambak1');
		}
	}

	function data_penyuluh()
	{
		$main['main']='admin/menu/data_penyuluh';
		$main['header']='Halaman Data Penyuluh';
		// $main['kecamatan'] = $this->madmin->tampil_data_keseluruhan('tb_lahan');
		$main['penyuluh'] = $this->madmin->tampil_data_keseluruhan('tb_penyuluh');
		if ($this->uri->segment(3) == '') {
			$this->load->view('admin/index',$main);	
		}else{
			redirect('/admin/data_penyuluh');
		}
	}

	function data_produksi()
	{
		$main['main']='admin/menu/data_produksi';
		$main['header']='Halaman Data Produksi';
		$main['teknologi_tambak'] =  $this->madmin->tampil_data_keseluruhan('tb_tambak');
		// $main['kecamatan'] = $this->madmin->tampil_data_keseluruhan('tb_kecamatan');
		// $main['lahan'] = $this->madmin->tampil_data_keseluruhan('tb_lahan');
		$main['produksi'] = $this->madmin->tampil_data_keseluruhan('tb_elemen_produksi');

		if ($this->input->post('no') !='' and $this->input->post('no') != null) {
			/////ini untuk hapus elemen/////
			$this->madmin->delete('tb_elemen_produksi',array('id_elemen' => $this->input->post('no')));
			$tek_tambak = $this->madmin->tampil_data_keseluruhan('tb_tambak');
			foreach ($tek_tambak->result() as $key => $value) {
				$ket = json_decode($value->ket,true);
				$satuan = json_decode($value->satuan,true);
				$keterangan = \array_diff_key($ket, [$this->input->post('no') => ""]);
				$satuanbaru = \array_diff_key($ket, [$this->input->post('no') => ""]);

				$keterangan = json_encode($keterangan);
				$satuanbaru = json_encode($satuanbaru);
				$this->madmin->update('tb_tambak',array('id_tambak'=>$value->id_tambak),array('ket' => $keterangan,'satuan' => $satuanbaru));
			}
			
			$this->session->set_flashdata('success', '<b>Success</b><br>ELemen Produksi Telah Berhasil Dihapus');
		}elseif ($this->input->post('data_produksi') !='' and $this->input->post('data_produksi') != null) {
			/////ini untuk tambah elemen /////
			$keys = array_column($this->input->post('data_produksi'),'name');
			$values = array_column($this->input->post('data_produksi'),'value');
			
			$array = array_combine($keys, $values); 
			$this->madmin->insert('tb_elemen_produksi',$array);
			$tampil_data_last = $this->madmin->tampil_data_last('tb_elemen_produksi','id_elemen');
			foreach ($tampil_data_last->result() as $key1 => $value1);
			$kodenya = $value1->id_elemen;
			$tek_tambak = $this->madmin->tampil_data_keseluruhan('tb_tambak');
			foreach ($tek_tambak->result() as $key => $value) {
				$array_baru = array($kodenya=>'');

				// $array2 = array('1' => '1', '2' => '2', '3'=> '3');
				$ket = json_decode($value->ket,true);

				$key = array_keys($ket);
				$val = array_values($ket);

				$new_key = array_merge($key, array_keys($array_baru));
				$new_val = array_merge($val, array_values($array_baru));

				$keterangan = json_encode(array_combine($new_key, $new_val));

				$satuan = json_decode($value->satuan,true);

				$key1 = array_keys($satuan);
				$val1 = array_values($satuan);

				$new_key1 = array_merge($key1, array_keys($array_baru));
				$new_val1 = array_merge($val1, array_values($array_baru));

				$satuanbaru = json_encode(array_combine($new_key1, $new_val1));
				$this->madmin->update('tb_tambak',array('id_tambak'=>$value->id_tambak),array('ket' => $keterangan,'satuan' => $satuanbaru));
			}
			$this->session->set_flashdata('success', '<b>Success</b><br>Elemen Produksi Baru Berhasil Ditambah');
		}elseif ($this->input->post('data_produksi_tambak') !='' and $this->input->post('data_produksi_tambak') != null and $this->input->post('kode') != '' and $this->input->post('kode') != null) {

			if ($this->input->post('kode') == 1) {
				$x = "Tradisional";
			}elseif ($this->input->post('kode') == 2) {
				$x = "Semi Modern";
			}elseif ($this->input->post('kode') == 3) {
				$x = "Modern";
			}


			$keys = array_column($this->input->post('data_produksi_tambak'),'name');
			$values = array_column($this->input->post('data_produksi_tambak'),'value');
			
			$array = array_combine($keys, $values); 
			// $i = 1;
			$ket = '{';
			foreach ($main['produksi']->result() as $key => $value) {
				$harga = str_replace(',', '', $array[$value->id_elemen]);

				$ket .='"'.$value->id_elemen.'":'.'"'.$harga.'",';
			}
			$ket = rtrim($ket,',');
			$ket.='}';
			
			$this->madmin->update('tb_tambak',array('id_tambak' => $this->input->post('kode')),array('ket' => $ket));
			$this->session->set_flashdata('success', '<b>Berhasil<br>Elemen Produksi Tambak '.$x.'<b><br>Berhasil Diupdate');

			
		}elseif ($this->input->post('satuan_produksi_tambak') !='' and $this->input->post('satuan_produksi_tambak') != null and $this->input->post('kode') != '' and $this->input->post('kode') != null) {

			if ($this->input->post('kode') == 1) {
				$x = "Tradisional";
			}elseif ($this->input->post('kode') == 2) {
				$x = "Semi Modern";
			}elseif ($this->input->post('kode') == 3) {
				$x = "Modern";
			}
			$keys = array_column($this->input->post('satuan_produksi_tambak'),'name');
			$values = array_column($this->input->post('satuan_produksi_tambak'),'value');
			
			$array = array_combine($keys, $values); 
			// $i = 1;
			$ket = '{';
			foreach ($main['produksi']->result() as $key => $value) {
				$harga = str_replace(',', '', $array[$value->id_elemen]);

				$ket .='"'.$value->id_elemen.'":'.'"'.$harga.'",';
			}
			$ket = rtrim($ket,',');
			$ket.='}';
			
			// echo $x;
			$this->madmin->update('tb_tambak',array('id_tambak' => $this->input->post('kode')),array('satuan' => $ket));
			$this->session->set_flashdata('success', '<b>Berhasil<br>Elemen Produksi Tambak '.$x.'<b><br>Berhasil Diupdate');

			
		}else{
			$this->load->view('admin/index',$main);	
		}
		
	}

	function data_produksi1(){
		$main['produksi'] = $this->madmin->tampil_data_keseluruhan('tb_elemen_produksi');
		if ($this->input->post('data_produksi_tambak') !='' and $this->input->post('data_produksi_tambak') != null and $this->input->post('kode') != '' and $this->input->post('kode') != null) {

			if ($this->input->post('kode') == 1) {
				$x = "Tradisional";
			}elseif ($this->input->post('kode') == 2) {
				$x = "Semi Modern";
			}elseif ($this->input->post('kode') == 3) {
				$x = "Modern";
			}


			$keys = array_column($this->input->post('data_produksi_tambak'),'name');
			$values = array_column($this->input->post('data_produksi_tambak'),'value');
			
			$array = array_combine($keys, $values); 
			// $i = 1;
			$ket = '{';
			foreach ($main['produksi']->result() as $key => $value) {
				$harga = str_replace(',', '', $array[$value->id_elemen]);

				$ket .='"'.$value->id_elemen.'":'.'"'.$harga.'",';
			}
			$ket = rtrim($ket,',');
			$ket.='}';
			
			$this->madmin->update('tb_tambak',array('id_tambak' => $this->input->post('kode')),array('ket' => $ket));
			$this->session->set_flashdata('success', '<b>Berhasil<br>Elemen Produksi Tambak '.$x.'<b><br>Berhasil Diupdate');

			
		}elseif ($this->input->post('satuan_produksi_tambak') !='' and $this->input->post('satuan_produksi_tambak') != null and $this->input->post('kode') != '' and $this->input->post('kode') != null) {

			if ($this->input->post('kode') == 1) {
				$x = "Tradisional";
			}elseif ($this->input->post('kode') == 2) {
				$x = "Semi Modern";
			}elseif ($this->input->post('kode') == 3) {
				$x = "Modern";
			}
			$keys = array_column($this->input->post('satuan_produksi_tambak'),'name');
			$values = array_column($this->input->post('satuan_produksi_tambak'),'value');
			
			$array = array_combine($keys, $values); 
			// $i = 1;
			$ket = '{';
			foreach ($main['produksi']->result() as $key => $value) {
				$harga = str_replace(',', '', $array[$value->id_elemen]);

				$ket .='"'.$value->id_elemen.'":'.'"'.$harga.'",';
			}
			$ket = rtrim($ket,',');
			$ket.='}';
			
			// echo $x;
			$this->madmin->update('tb_tambak',array('id_tambak' => $this->input->post('kode')),array('satuan' => $ket));
			$this->session->set_flashdata('success', '<b>Berhasil<br>Elemen Produksi Tambak '.$x.'<b><br>Berhasil Diupdate');

			
		}
	}

	function prediksi()
	{
		// echo "sini tampilan prediksi";
		$main['main']='admin/menu/prediksi';
		$main['header']='Halaman Prediksi';
		$main['data_produksi'] = $this->madmin->tampil_data_keseluruhan('tb_hasil_produksi');

		if ($this->input->post('inputannya') != '' and $this->input->post('inputannya') != null) {
			$data = $this->input->post('inputannya');

			$keys = array_column($data ,'name');
			$values = array_column($data ,'value');

			$array = array_combine($keys, $values);

			foreach ($array as $key => $value) {
				$nomor = str_replace( ',', '', $value );
				$this->madmin->update('tb_hasil_produksi',array('no' => $key),array('hasil' => $nomor));
				// print_r($key);
			}
			$this->session->set_flashdata('success', '<b>Berhasil Terupdate</b><br>Hasil Produksi Dari Tahun 2010 Hingga 2019 Berhasil Terupdate');
		}elseif ($this->uri->segment(3) == 'prediksi') {
			$main['main']='admin/menu/proses_prediksi';
			$this->load->view('admin/index',$main);

		}else{
			$this->load->view('admin/index',$main);
		}
	}

	function json_hasil()
	{
		$cek_data = $this->madmin->tampil_data_keseluruhan('tb_hasil_produksi');
		$kira = count($cek_data->result());

		$i = 1;
		$coba = null;
		$teks= '['; /// idperlukan untuk teks JSON
		foreach ($cek_data->result() as $key => $value) {
			

			$hasil[$i] = $value->hasil;
			// if ($i!=1) {
			// 	$array_baru = array_merge($array_baru,$array);
			// }

			/////// batas awal kalau pakai teks di php ////////
			if ($i != 1 and $i !=2 and $i != 3) {
				$jumlah = ($hasil[$i-3] + $hasil[$i-2] + $hasil[$i-1])/3;

				// print_r($jumlah);print_r('<br>');
				$teks .= '{"tahun":"'.$value->tahun.'-'.$value->musim.'","produksi":'. $value->hasil.',"prediksi":'. round($jumlah,2).'},';
			}else{
				$kosong = 0;
				$teks .= '{"tahun":"'.$value->tahun.'-'.$value->musim.'","produksi":'. $value->hasil.',"prediksi":'.$kosong.'},';
			}
			////// batas akhir kalau pakai teks di php //////

			///// batas awal kalo pakai array php ////////
			if ($i != 1 and $i !=2 and $i != 3) {
				$jumlah = ($hasil[$i-3] + $hasil[$i-2] + $hasil[$i-1])/3;
				$arraycoba[$i]= array(array('tahun' => $value->tahun.'-'.$value->musim, 'produksi' => $value->hasil,'prediksi' => round($jumlah,0)));
				$coba = array_merge($coba,$arraycoba[$i-1]);
				
			}else{
				$arraycoba[$i]= array(array('tahun' => $value->tahun.'-'.$value->musim, 'produksi' => $value->hasil,'prediksi' => 0));
				if ($i == 1) {
				
				}elseif ($i == 2) {
					$coba = array_merge($arraycoba[$i-1],$arraycoba[$i]);
				}elseif ($i ==3 ){
					$coba = array_merge($coba,$arraycoba[$i-1]);
				}

			}
			///// batas akhir kalo pakai array php /////
			$i++;
		}

		/////// ini untuk tampung array last ///// 
		$coba = array_merge($coba,$arraycoba[$kira]);
		/////// ini untuk tampung array last ///// 
		// print_r($kira);

		$teks = mb_substr($teks, 0, -1); /// diperlukan untuk teks JSON
		$teks.= ']'; /// diperlukan untuk teks JSON

		// print_r($coba);
		// print_r($teks);
		// unset($array_baru[0]);
		// print_r(json_encode($coba));
		// $array_baru =(object) $array_baru;
		

		// $array_baru = json_encode($array_baru);
		// $array_baru = json_decode($array_baru,true);
		// print_r(json_encode($array_baru));
		// print_r('<br><br>');

		

		// $data = '[{"tahun":2008,"produksi":20,"prediksi":25},{"tahun":2009,"produksi":10,"prediksi":19},{"tahun":2010,"produksi":5,"prediksi":17},{"tahun":2011,"produksi":5,"prediksi":14},{"tahun":2012,"produksi":20,"prediksi":10}]';

		$array_baru11 = array('tahun' => 'tahun');
		// $array_baru1 = array('ket' => $coba);

		// print_r(json_encode($array_baru1));

		// print_r(json_decode($data,true));

		print_r(json_encode(array_merge($array_baru11,array('ket' => $coba))));
		
	}

	function hasil_kecamatan()
	{
		// echo "sini tampilan prediksi";
		$main['lahan'] = $this->madmin->tampil_data_keseluruhan('tb_lahan');

		$main['main']='admin/menu/hasil_kecamatan';
		$main['header']='Halaman Hasil Kecamatan';
		$main['kecamatan'] = $this->madmin->tampil_data_keseluruhan('tb_kecamatan');



		if ($this->input->post('kecamatan')!=null or $this->input->post('kecamatan')!='') {
			if ($this->input->post('kecamatan') == 0) { ?>
			<table id="tabel-data" class="table table-striped table-bordered display" style="width:100%">
				<thead>
					<tr>
						<th>ID Lokasi</th>
						<th>Nama Petambak</th>
						<th>Kecamatan</th>
						<th>Kelurahan</th>
						<th>Luas</th>
						<th>Teknologi Tambak</th>
						<th>Aksi</th>
					</tr>
				</thead>
				<tbody>

					<?php foreach ($main['lahan']->result() as $key => $value) { $cek_petambak =$this->madmin->tampil_data_where('tb_petambak',array('nik' => $value->nik_petambak));
						foreach ($cek_petambak->result() as $key1 => $value1) ;
						$cek_kecamatan = $this->madmin->tampil_data_where('tb_kecamatan',array('id_kecamatan' => $value->kecamatan));
						foreach ($cek_kecamatan->result() as $key2 => $value2) ;

						$cek_kelurahan = $this->madmin->tampil_data_where('tb_kelurahan',array('id_kelurahan' => $value->kelurahan));
						foreach ($cek_kelurahan->result() as $key3 => $value3) ;

						$cek_teknologi = $this->madmin->tampil_data_where('tb_tambak',array('id_tambak' => $value->tek_tambak));
						foreach ($cek_teknologi->result() as $key4 => $value4) ;
						?>
					<tr>
						<td><?=$value->id_lahan?></td>
						<td><?=$value1->nama?></td>
						<td><?=$value2->kecamatan?></td>
						<td><?=$value3->kelurahan?></td>
						<td><?=$value->luas_lahan?></td>
						<td><?=$value4->tambak?></td>
						<td align="center"><a href="<?=base_url()?>admin/data_petambak/<?=$value->id_lahan?>"><button type="button" title="Lihat Informasi Lahan" class="btn btn-info btn-circle btn-sm waves-effect waves-light"><i class="ico fa fa-list-alt"></i></button></a></td>
					</tr>
					<?php } ?>
				</tbody>
			</table>

			<script>
			    $(document).ready(function(){
			        $('#tabel-data').DataTable({
			        	"aLengthMenu": [[15, 30, 45, ,60, -1], [15, 30, 45, 60 ,"All"]],
		        		"iDisplayLength": 15
						// "pageLength": 5,
						// "searching": false,
						// "paging":   false,
						// "ordering": false,
						// "info":     false,

			        });
			        
			    });
			</script>
				
			<?php }else{ 
				$lahan = $this->madmin->tampil_data_where('tb_lahan',array('kecamatan'=>$this->input->post('kecamatan')))
			?>
			<table id="tabel-data" class="table table-striped table-bordered display" style="width:100%">
				<thead>
					<tr>
						<th>ID Lokasi</th>
						<th>Nama Petambak</th>
						<th>Kelurahan</th>
						<th>Luas</th>
						<th>Teknologi Tambak</th>
						<th>Aksi</th>
					</tr>
				</thead>
				<tbody>

					<?php foreach ($lahan->result() as $key => $value) { $cek_petambak =$this->madmin->tampil_data_where('tb_petambak',array('nik' => $value->nik_petambak));
						foreach ($cek_petambak->result() as $key1 => $value1) ;

						$cek_kelurahan = $this->madmin->tampil_data_where('tb_kelurahan',array('id_kelurahan' => $value->kelurahan));
						foreach ($cek_kelurahan->result() as $key3 => $value3) ;

						$cek_teknologi = $this->madmin->tampil_data_where('tb_tambak',array('id_tambak' => $value->tek_tambak));
						foreach ($cek_teknologi->result() as $key4 => $value4) ;
						?>
					<tr>
						<td><?=$value->id_lahan?></td>
						<td><?=$value1->nama?></td>
						<td><?=$value3->kelurahan?></td>
						<td><?=$value->luas_lahan?></td>
						<td><?=$value4->tambak?></td>
						<td align="center"><a href="<?=base_url()?>admin/data_petambak/<?=$value->id_lahan?>"><button type="button" title="Lihat Informasi Lahan" class="btn btn-info btn-circle btn-sm waves-effect waves-light"><i class="ico fa fa-list-alt"></i></button></a></td>
					</tr>
					<?php } ?>
				</tbody>
			</table>

			<script>
			    $(document).ready(function(){
			        $('#tabel-data').DataTable({
			        	"aLengthMenu": [[15, 30, 45, ,60, -1], [15, 30, 45, 60 ,"All"]],
		        		"iDisplayLength": 15
						// "pageLength": 5,
						// "searching": false,
						// "paging":   false,
						// "ordering": false,
						// "info":     false,

			        });
			        
			    });
			</script>
			<?php }
		}else{
			$this->load->view('admin/index',$main);	
		}
	}

	function hasil_tahunan()
	{
		$main['main']='admin/menu/prediksi';
		$main['header']='Halaman Prediksi';
		$main['data_produksi'] = $this->madmin->tampil_data_keseluruhan('tb_hasil_produksi');

		if ($this->input->post('inputannya') != '' and $this->input->post('inputannya') != null) {
			$data = $this->input->post('inputannya');

			$keys = array_column($data ,'name');
			$values = array_column($data ,'value');

			$array = array_combine($keys, $values);

			foreach ($array as $key => $value) {
				$nomor = str_replace( ',', '', $value );
				$this->madmin->update('tb_hasil_produksi',array('no' => $key),array('hasil' => $nomor));
				// print_r($key);
			}
			$this->session->set_flashdata('success', '<b>Berhasil Terupdate</b><br>Hasil Produksi Dari Tahun 2010 Hingga 2019 Berhasil Terupdate');
		}elseif ($this->uri->segment(3) == 'prediksi') {
			$main['main']='admin/menu/proses_prediksi';
			$this->load->view('admin/index',$main);

		}else{
			$this->load->view('admin/index',$main);
		}
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
		if ($this->input->post('data') == 'ambil') {
			$kecamatan = $this->madmin->tampil_data_keseluruhan('tb_kecamatan');
			$lahan = $this->madmin->tampil_data_keseluruhan('tb_lahan');
			?>
					<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBw6bnAk0C2jIDDbz_dVRso9gUEnHLTH68&libraries=drawing,places,geometry&callback=initialize"></script>
					<script type="text/javascript">
						var infowindow;
          				var geocoder;

          				function numberWithCommas(x) {
					      return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
					    }

          				function initialize() {
          					infowindow = new google.maps.InfoWindow();
                			var geolib = google.maps.geometry.spherical;
                
							var myOptions = {
								zoom: 12,
								center: new google.maps.LatLng(-4.0741291, 119.63409424),
								mapTypeControl: true,
								mapTypeControlOptions: {
								style: google.maps.MapTypeControlStyle.DROPDOWN_MENU
								},
								navigationControl: true,
								mapTypeId: 'roadmap'
							}
							map = new google.maps.Map(document.getElementById("map_canvas"),myOptions);

							google.maps.event.addListener(map, 'click', function() {
								infowindow.close();
							});

							bounds = new google.maps.LatLngBounds();

<?php ////////////// sini awal tampil kecamatan ////////////////////////// ?>
                    
                      		<?php foreach ($kecamatan->result() as $key => $value) { ?>
                      		
                      		
                      		var polygon_<?=$value->id_kecamatan?> = new google.maps.Polygon({
                      			map: map,
                      			path: [<?=$value->kordinat?>],
                      			strokeColor: "#000000",
								strokeOpacity: 2,
								strokeWeight: 1,
								fillColor: "#B85612",
								fillOpacity: 0.4,
                      		});



                      		<?php } ?>

<?php ////////////// sini akhir tampil kecamatan ////////////////////////// ?>

<?php ////////////// sini awal tampil lahan ////////////////////////// ?>
                    
                      		<?php foreach ($lahan->result() as $key => $value) { ?>
                      		
                      		<?php  
                      			if ($value->tek_tambak == 1) {
                      				$color = "#FE2D00";
                      			}elseif ($value->tek_tambak == 2) {
                      				$color = "#77FE00";
                      			}elseif ($value->tek_tambak == 3) {
                      				$color = "#1F00FE";
                      			}
                      		?>
                      		var lahan_<?=$value->id_lahan?> = new google.maps.Polygon({
                      			map: map,
                      			path: [<?=$value->point?>],
                      			strokeColor: "#000000",
								strokeOpacity: 2,
								strokeWeight: 1,
								fillColor: "<?=$color?>",
								fillOpacity: 0.4,
                      		});



                      		<?php } ?>

<?php ////////////// sini akhir tampil lahan ////////////////////////// ?>

<?php ////////////// sini awal infowindows kecamatan ////////////////////////// ?>
                    
                     		<?php foreach ($kecamatan->result() as $key => $value) { ?>
                     		
							google.maps.event.addListener(polygon_<?=$value->id_kecamatan?>, 'click', function(event) {
								var vertices = this.getPath();
								var luas = google.maps.geometry.spherical.computeArea(polygon_<?=$value->id_kecamatan?>.getPath()) / 10000;
								luas = numberWithCommas(luas.toFixed(2));
								var contentString ="<div class='form-group' >"+
								                    "<h5>Kecamatan : <?=$value->kecamatan?></h5>"+
								                    "<h5>Luas : "+luas + " Ha"+"</h5>"+
								                    "</div>";

								infowindow.setContent(contentString);
								infowindow.setPosition(event.latLng);
								infowindow.open(map);
							});
							
							 for (var i = 0; i < polygon_<?=$value->id_kecamatan?>.getPath().getLength(); i++) {
		                         bounds.extend(polygon_<?=$value->id_kecamatan?>.getPath().getAt(i));
		                       }


                     		<?php } ?>
<?php ////////////// sini akhir infowindows kecamatan ////////////////////////// ?>


<?php ////////////// sini awal infowindows lahan ////////////////////////// ?>
                    
                     		<?php foreach ($lahan->result() as $key => $value) { 
                     			$cek_tek_tambak = $this->madmin->tampil_data_where('tb_tambak',array('id_tambak' => $value->tek_tambak));
								foreach ($cek_tek_tambak->result() as $key2 => $value2) ;
								$cek_kelurahan = $this->madmin->tampil_data_where('tb_kelurahan',array('id_kelurahan' => $value->kelurahan));
								foreach ($cek_kelurahan->result() as $key3 => $value3) ;
								$cek_kecamatan = $this->madmin->tampil_data_where('tb_kecamatan',array('id_kecamatan' => $value->kecamatan));
								foreach ($cek_kecamatan->result() as $key4 => $value4) ;
                     			?>
                     		
							google.maps.event.addListener(lahan_<?=$value->id_lahan?>, 'click', function(event) {
								var vertices = this.getPath();
								var luas = google.maps.geometry.spherical.computeArea(lahan_<?=$value->id_lahan?>.getPath()) / 10000;
								luas = numberWithCommas(luas.toFixed(2));
								var contentString ="<div class='form-group' >"+
													"<h5>ID Lahan: <?=$value->id_lahan?></h5>"+
													"<h5>Teknologi Tambak : <?=$value2->tambak?></h5>"+
								                    "<h5>Kecamatan : <?=$value4->kecamatan?></h5>"+
								                    "<h5>Kelurahan : <?=$value3->kelurahan?></h5>"+
								                    "<h5>Luas : "+luas + " Ha"+"</h5>"+
								                    '<center><a href="<?=base_url()?>admin/data_petambak/<?=$value->id_lahan?>"><button type="button" title="Lihat Informasi Lahan" class="btn btn-info btn-circle btn-sm waves-effect waves-light"><i class="ico fa fa-list-alt"></i></button></a></center>'+
								                    "</div>";

								infowindow.setContent(contentString);
								infowindow.setPosition(event.latLng);
								infowindow.open(map);
							});
							
							for (var i = 0; i < lahan_<?=$value->id_lahan?>.getPath().getLength(); i++) {
		                        bounds.extend(lahan_<?=$value->id_lahan?>.getPath().getAt(i));
		                      }


                     		<?php } ?>
<?php ////////////// sini akhir infowindows lahan ////////////////////////// ?>


<?php ////////////// sini awal kira luas lahan petambak ////////////////////////// ?>
                     		<?php foreach ($lahan->result()  as $key => $value) { ?>
                     		var luasl<?=$value->id_lahan?> =google.maps.geometry.spherical.computeArea(lahan_<?=$value->id_lahan?>.getPath());

                     		<?php } ?>

                     		var luaslahan = <?php foreach ($lahan->result() as $key => $value) { echo "luasl".$value->id_lahan."+";} ?>0;

                     		luaslahan = luaslahan / 10000;
     
                     		document.getElementById("luas1").innerHTML =  numberWithCommas(luaslahan.toFixed(2));

<?php ////////////// sini akhir kira luas lahan petambak ////////////////////////// ?>                    		
                     		map.fitBounds(bounds);

                     		 


              
            			}


                    
                 
			            //google.maps.event.addDomListener(window, 'load', initialize);
			            // document.getElementById('luas').value = luas;

			        </script>


	<?php }else{
			redirect('/admin');
		}
	}

	function peta_kecamatan()
	{
		if ($this->input->post('kecamatan') != '' and $this->input->post('kecamatan') != null) {
	 	 
			$id_kecamatan = $this->input->post('kecamatan');
			$kecamatan = $this->madmin->tampil_data_where('tb_kecamatan',array('id_kecamatan'=>$id_kecamatan));
			$lahan = $this->madmin->tampil_data_where('tb_lahan',array('kecamatan'=>$id_kecamatan));
			?>
					<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBw6bnAk0C2jIDDbz_dVRso9gUEnHLTH68&libraries=drawing,places,geometry&callback=initialize"></script>
					<script type="text/javascript">
						var infowindow;
          				var geocoder;

          				function numberWithCommas(x) {
					      return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
					    }

          				function initialize() {
          					infowindow = new google.maps.InfoWindow();
                			var geolib = google.maps.geometry.spherical;
                
							var myOptions = {
								zoom: 12,
								center: new google.maps.LatLng(-4.0741291, 119.63409424),
								mapTypeControl: true,
								mapTypeControlOptions: {
								style: google.maps.MapTypeControlStyle.DROPDOWN_MENU
								},
								navigationControl: true,
								mapTypeId: 'roadmap'
							}
							map = new google.maps.Map(document.getElementById("map_canvas"),myOptions);

							google.maps.event.addListener(map, 'click', function() {
								infowindow.close();
							});

							bounds = new google.maps.LatLngBounds();

							////////////// sini awal tampil kecamatan ////////////////////////// 
                    
                      		<?php foreach ($kecamatan->result() as $key => $value) { ?>
                      		
                      		
                      		var polygon_<?=$value->id_kecamatan?> = new google.maps.Polygon({
                      			map: map,
                      			path: [<?=$value->kordinat?>],
                      			strokeColor: "#000000",
								strokeOpacity: 2,
								strokeWeight: 1,
								fillColor: "#B85612",
								fillOpacity: 0.4,
                      		});



                      		<?php } ?>

<?php ////////////// sini akhir tampil kecamatan ////////////////////////// ?>

<?php ////////////// sini awal tampil lahan ////////////////////////// ?>
                    
                      		<?php foreach ($lahan->result() as $key => $value) { ?>
                      		
                      		<?php  
                      			if ($value->tek_tambak == 1) {
                      				$color = "#FE2D00";
                      			}elseif ($value->tek_tambak == 2) {
                      				$color = "#77FE00";
                      			}elseif ($value->tek_tambak == 3) {
                      				$color = "#1F00FE";
                      			}
                      		?>
                      		var lahan_<?=$value->id_lahan?> = new google.maps.Polygon({
                      			map: map,
                      			path: [<?=$value->point?>],
                      			strokeColor: "#000000",
								strokeOpacity: 2,
								strokeWeight: 1,
								fillColor: "<?=$color?>",
								fillOpacity: 0.4,
                      		});



                      		<?php } ?>

<?php ////////////// sini akhir tampil lahan ////////////////////////// ?>

<?php ////////////// sini awal infowindows kecamatan ////////////////////////// ?>
                    
                     		<?php foreach ($kecamatan->result() as $key => $value) { ?>
                     		
							google.maps.event.addListener(polygon_<?=$value->id_kecamatan?>, 'click', function(event) {
								var vertices = this.getPath();
								var luas = google.maps.geometry.spherical.computeArea(polygon_<?=$value->id_kecamatan?>.getPath()) / 10000;
								luas = numberWithCommas(luas.toFixed(2));
								var contentString ="<div class='form-group' >"+
								                    "<h5>Kecamatan : <?=$value->kecamatan?></h5>"+
								                    "<h5>Luas : "+luas + " Ha"+"</h5>"+
								                    "</div>";

								infowindow.setContent(contentString);
								infowindow.setPosition(event.latLng);
								infowindow.open(map);
							});
							
							 for (var i = 0; i < polygon_<?=$value->id_kecamatan?>.getPath().getLength(); i++) {
		                         bounds.extend(polygon_<?=$value->id_kecamatan?>.getPath().getAt(i));
		                       }


                     		<?php } ?>
<?php ////////////// sini akhir infowindows kecamatan ////////////////////////// ?>


<?php ////////////// sini awal infowindows lahan ////////////////////////// ?>
                    
                     		<?php foreach ($lahan->result() as $key => $value) { 
                     			$cek_tek_tambak = $this->madmin->tampil_data_where('tb_tambak',array('id_tambak' => $value->tek_tambak));
								foreach ($cek_tek_tambak->result() as $key2 => $value2) ;
								$cek_kelurahan = $this->madmin->tampil_data_where('tb_kelurahan',array('id_kelurahan' => $value->kelurahan));
								foreach ($cek_kelurahan->result() as $key3 => $value3) ;
								$cek_kecamatan = $this->madmin->tampil_data_where('tb_kecamatan',array('id_kecamatan' => $value->kecamatan));
								foreach ($cek_kecamatan->result() as $key4 => $value4) ;
                     			?>
                     		
							google.maps.event.addListener(lahan_<?=$value->id_lahan?>, 'click', function(event) {
								var vertices = this.getPath();
								var luas = google.maps.geometry.spherical.computeArea(lahan_<?=$value->id_lahan?>.getPath()) / 10000;
								luas = numberWithCommas(luas.toFixed(2));
								var contentString ="<div class='form-group' >"+
													"<h5>ID Lahan: <?=$value->id_lahan?></h5>"+
													"<h5>Teknologi Tambak : <?=$value2->tambak?></h5>"+
								                    "<h5>Kecamatan :<?=$value4->kecamatan?></h5>"+
								                    "<h5>Kelurahan :<?=$value3->kelurahan?></h5>"+
								                    "<h5>Luas : "+luas + " Ha"+"</h5>"+
								                    '<center><a href="<?=base_url()?>admin/data_petambak/<?=$value->id_lahan?>"><button type="button" title="Lihat Informasi Lahan" class="btn btn-info btn-circle btn-sm waves-effect waves-light"><i class="ico fa fa-list-alt"></i></button></a></center>'+
								                    "</div>";

								infowindow.setContent(contentString);
								infowindow.setPosition(event.latLng);
								infowindow.open(map);
							});
							
							for (var i = 0; i < lahan_<?=$value->id_lahan?>.getPath().getLength(); i++) {
		                        bounds.extend(lahan_<?=$value->id_lahan?>.getPath().getAt(i));
		                      }


                     		<?php } ?>
<?php ////////////// sini akhir infowindows lahan ////////////////////////// ?>


<?php ////////////// sini awal kira luas lahan petambak ////////////////////////// ?>
                     		<?php foreach ($lahan->result()  as $key => $value) { ?>
                     		var luasl<?=$value->id_lahan?> =google.maps.geometry.spherical.computeArea(lahan_<?=$value->id_lahan?>.getPath());

                     		<?php } ?>

                     		var luaslahan = <?php foreach ($lahan->result() as $key => $value) { echo "luasl".$value->id_lahan."+";} ?>0;

                     		luaslahan = luaslahan / 10000;
     
                     		document.getElementById("luas1").innerHTML =  numberWithCommas(luaslahan.toFixed(2));

<?php ////////////// sini akhir kira luas lahan petambak ////////////////////////// ?>                    		
                     		map.fitBounds(bounds);

                     		 


              
            			}


                    
                 
			            //google.maps.event.addDomListener(window, 'load', initialize);
			            // document.getElementById('luas').value = luas;

			        </script>


	<?php }else{
			redirect('/admin');
		}
	}


	function try2()
	{
		// $tek_tambak = $this->madmin->tampil_data_keseluruhan('tb_tambak');
		// $kode = 4;

		$array1 = array('6'=>'4');

		$array2 = array('1' => '1', '2' => '2', '3'=> '3');
		$a = array_merge($array2,$array1);

		$key = array_keys($array2);
		$val = array_values($array2);

		$new_key = array_merge($key, array_keys($array1));
		$new_val = array_merge($val, array_values($array1));

		$mantap = array_combine($new_key, $new_val);
		print_r($mantap);
	}

	function try1()
	{
		$tek_tambak = $this->madmin->tampil_data_keseluruhan('tb_tambak');
		$kode = 4;

		$array = array( '5' =>'');
		foreach ($tek_tambak->result() as $key => $value) ;
			// $ket = json_decode($value->ket,true);
			$ket = Array ( 1 => 1 ,2 => 2 ,3 => 3, 4 => 4 );
			$result=array_push($array,$ket);

			$ha = \array_diff_key($ket, [2 => ""]);

			// $ha = array_diff( $, [401] )
			echo json_encode($ket);
			// $try = array_push($ket,$array);
			// print_r($try);


			// $ket = rtrim($ket,'}');
			// $ket.=',"5":""}';

			$satuan = $value->satuan;
			// $satuan = rtrim($satuan,'}');
			// $satuan.=',"5":""}';
			// echo $satuan;
		// }
	}

	

	

	

}
?>