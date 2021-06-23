<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

	// var $table = $this->mhome->;
	public function __construct()
	{
		parent::__construct();
		// $this->load->helper('form');
		// $this->load->library('form_validation');

		$this->load->model('mhome');
		
	}
	
	function index()
	{

		if ($this->uri->segment(2) == '') {
			$main['main']='home/main';
			$main['header']='Halaman Utama';
			$main['kecamatan'] = $this->mhome->tampil_data_keseluruhan('tb_kecamatan');
			$main['lahan'] = $this->mhome->tampil_data_keseluruhan('tb_lahan');
			$main['cek_hasil'] =  $this->mhome->tampil_data_keseluruhan('tb_hasil_produksi');

			$this->load->view('home/index',$main);
			
			// echo $this->uri->segment(2);
			// echo "string";
		}else{
			redirect('/home');
		}
		
	}

	function data_petambak()
	{
		if ($this->uri->segment(3) == 'lihat') {
			if (is_numeric($this->uri->segment(4))) {
				$id = $this->uri->segment(4);
				$cek_lahan = $this->mhome->tampil_data_where('tb_lahan',array('id_lahan' => $id)); 
				if (count($cek_lahan->result())>0) {
					
					// echo "sini";
					$array = explode('-',$this->uri->segment(5));
					$data_transaksi_produksi = $this->mhome->tampil_data_where('tb_data_produksi_lahan', array('no_lahan' => $id));

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
							$main['elemen_produksi'] = $this->mhome->tampil_data_keseluruhan('tb_elemen_produksi');
							$main['data_transaksi_produksi'] = $this->mhome->tampil_data_where('tb_data_produksi_lahan', array('no_lahan' => $id));
							$main['kode_lahan'] = $id;
							$main['ket_nya'] = $array_ket;
							$main['main']='home/menu/data_lahan_lihat_detail';
							$this->load->view('home/index',$main);
							// print_r($main['ket']);
						}elseif ($ada == 0) {
							redirect('/home');
						}
					}else{
						redirect('/home');
					}
				}else{
					// $this->session->set_flashdata('error','<b>Error</b><br>Halaman Yang Diakses Tiada Dalam');
					// redirect('/penyuluh');
					redirect('/home');
				}
			}else{
				echo "bukan";
			}
		}elseif (is_numeric($this->uri->segment(3))) {
			// echo "sini";
			$id = $this->uri->segment(3);
			$cek_lahan = $this->mhome->tampil_data_where('tb_lahan',array('id_lahan' => $id)); 
			if (count($cek_lahan->result())>0) {
				$main['header']='Halaman Utama Lahan';
				$main['kecamatan'] = $this->mhome->tampil_data_keseluruhan('tb_kecamatan');
				$main['lahan'] = $cek_lahan;
				$main['data_transaksi_produksi'] = $this->mhome->tampil_data_where('tb_data_produksi_lahan', array('no_lahan' => $id));
				$main['elemen_produksi'] = $this->mhome->tampil_data_keseluruhan('tb_elemen_produksi');
				$main['main']='home/menu/data_lahan_lihat';
				$this->load->view('home/index',$main);

			}else{
				// $this->session->set_flashdata('error','<b>Error</b><br>Halaman Yang Diakses Tiada Dalam');
				redirect('/home');
			}
		}else{
			redirect('/home');
		}
	}

	function json_hasil()
	{
		$cek_data = $this->mhome->tampil_data_keseluruhan('tb_hasil_produksi');
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

	function pendaftaran()
	{
		
		$main['header']='Halaman Pendaftaran';
		$main['kecamatan'] = $this->mhome->tampil_data_keseluruhan('tb_kecamatan');
		if ($this->uri->segment(3) != '' or $this->uri->segment(3) != null) {
			$id_kecamatan = $this->uri->segment(3);
			$cek_kecamatan = $this->mhome->tampil_data_where('tb_kecamatan',array('id_kecamatan' => $id_kecamatan));
			if (count($cek_kecamatan->result())>0) {
				
				$main['kecamatan_terpilih'] = $cek_kecamatan;
				$main['kelurahan'] =  $this->mhome->tampil_data_where('tb_kelurahan',array('id_kecamatan' => $id_kecamatan)); 
				if ($this->uri->segment(4) != '' or $this->uri->segment(4) != null) {
					$id_kelurahan = $this->uri->segment(4);
					$cek_kelurahan = $this->mhome->tampil_data_where('tb_kelurahan',array('id_kecamatan' => $id_kecamatan,'id_kelurahan' => $id_kelurahan)); 
					if (count($cek_kelurahan->result())>0) {
						$main['main']='home/menu/pendaftaran_kelurahan';
						$main['kelurahan_terpilih'] = $cek_kelurahan;
						$main['tambak'] = $this->mhome->tampil_data_keseluruhan('tb_tambak');;
						$this->load->view('home/index',$main);
					}else{
						echo "tiada kelurahan";
					}
				}else{
					$main['main']='home/menu/pendaftaran_kecamatan';
					$this->load->view('home/index',$main);
				}
			}else{
				echo "tiada";
			}
		}else{
			$main['main']='home/menu/pendaftaran';
			$this->load->view('home/index',$main);
		}
		
	}

	function pendaftaran_tambak()
	{
		$kecamatan = $this->input->post('kecamatan');
		$kelurahan = $this->input->post('kelurahan');
		$nik = $this->input->post('nik');
		$nama = $this->input->post('nama');
		$pbb = $this->input->post('pbb');
		$tambak = $this->input->post('tambak');
		$point = $this->input->post('point');
		$luas_lahan = $this->input->post('luas_lahan');

		$cek_nik = $this->mhome->tampil_data_where('tb_petambak',array('nik' => $nik));
		$cek_pbb = $this->mhome->tampil_data_where('tb_lahan',array('no_pbb' => $pbb));

		if (count($cek_nik->result()) > 0) {
			
			echo "true1";
		}elseif (count($cek_pbb->result()) > 0) {
			
			echo "true2";
		}else{
			$this->mhome->insert('tb_petambak',array('nik' => $nik, 'nama' => $nama));
			$this->mhome->insert('tb_user',array('nik_user' => $nik, 'username' => $nik, 'password' => '12345678', 'level' => 'petambak'));
			$this->mhome->insert('tb_lahan',array('nik_petambak' => $nik, 'no_pbb' => $pbb ,'tek_tambak' => $tambak, 'point' => $point, 'kecamatan' => $kecamatan , 'kelurahan' => $kelurahan, 'luas_lahan' => $luas_lahan));
			$this->session->set_flashdata('success', '<b>Success</b><br>Anda Berhasil Terdaftar Dalam Sistem<br>Silakan Login Ke Sistem Dengan NIK Menjadi Username dan Password Default = 12345678');
			echo "false";
		}
	}


	function login()
	{
		if ($this->input->post('login')) {
			$username = $this->input->post('username');
			$password = $this->input->post('password');

			$cek_data = $this->mhome->tampil_data_where('tb_user',array('username' => $username,'password' => $password));

			if (count($cek_data->result()) > 0) {
				// echo "username ada";
				foreach ($cek_data->result() as $key => $value);
				if ($value->level == 'admin') {
					$cek_data_admin = $this->mhome->tampil_data_where('tb_admin',array('nik_admin' => $value->nik_admin));
					foreach ($cek_data_admin->result() as $key2 => $value2);
					$nik_admin = $value2->nik_admin;
					$nama_admin = $value2->nama;
					$jabatan_admin = $value2->jabatan;
					$this->session->set_userdata(array('nik' => $nik_admin,'nama'=>$nama_admin,'jabatan'=>$jabatan_admin,'level'=>'Admin'));
					$this->session->set_flashdata('success', '<b>SELAMAT DATANG</b><br>Admin '.$nama_admin.' telah berhasil login');
					redirect('/admin');
				}elseif ($value->level == 'petambak') {
					$cek_data_petambak = $this->mhome->tampil_data_where('tb_petambak',array('nik' => $value->nik_user));
					foreach ($cek_data_petambak->result() as $key2 => $value2);
					$nik_petambak = $value2->nik;
					$nama_petambak = $value2->nama;
					$this->session->set_userdata(array('nik' => $nik_petambak,'nama'=>$nama_petambak,'level'=>'Petambak'));
					$this->session->set_flashdata('success', '<b>SELAMAT DATANG</b><br>Petambak '.$nama_petambak.' telah berhasil login');
					redirect('/petambak');
				}elseif($value->level == 'penyuluh') {
					$cek_data_penyuluh = $this->mhome->tampil_data_where('tb_penyuluh',array('nik' => $value->nik_penyuluh));
					// print_r(count($cek_data_penyuluh->result()));
					foreach ($cek_data_penyuluh->result() as $key2 => $value2);
					$nik_penyuluh = $value2->nik;
					$nama_penyuluh = $value2->nama;

					// echo $nama_peyuluh;
					$this->session->set_userdata('penyuluh', array('nik' => $nik_penyuluh,'nama'=>$nama_penyuluh,'kecamatan'=> $value2->kecamatan,'level'=>'Petambak'));
					$this->session->set_flashdata('success', '<b>SELAMAT DATANG</b><br>Penyuluh '.$nama_penyuluh.' telah berhasil login');
					redirect('/penyuluh');
				}
				// $this->session->set_userdata('nik',)
			}else{
				$this->session->set_flashdata('warning', '<b>Error</b><br>Username dan Password Yang Dimasukkan Salah');
				redirect('/home/login');			
			}
		}else{
			$main['header']='Halaman Pendaftaran';
			$this->load->view('home/login',$main);
		}
		
	}

	function kecamatan()
	{
		if ($this->uri->segment(2) == 'kecamatan') {
			// $kecamatan = $this->uri->segment(3);
			$main['main']='home/menu/kecamatan';
			$main['header']='Halaman Utama';
			$main['kecamatan'] = $this->mhome->tampil_data_where('tb_kecamatan', array('id_kecamatan' => $this->uri->segment(3)));
			$main['lahan'] = $this->mhome->tampil_data_where('tb_lahan',array('kecamatan' => $this->uri->segment(3)));
			$main['cek_hasil'] =  $this->mhome->tampil_data_keseluruhan('tb_hasil_produksi');

			$this->load->view('home/index',$main);
		}else{
			redirect('/home');
		}
	}

	function destroy_segala()
	{
		// $this->session->sess_destroy();
		$this->session->set_userdata('nik',1234);
		$this->session->set_userdata('nama','asdasdas');
		$this->session->set_userdata('level','Petambak');
	}



	// function petanya() {
	// 	$peta = '';

	// 	$peta = json_decode($peta);
	// 	print_r($peta[0]->kordinat);
	// }
	

	

}
?>