<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mpenyuluh extends CI_Model {

	public function __construct()
	{
		parent::__construct();

	}

	function index(){

	}

	function tampil_data_keseluruhan($namatabel) //gunakan ini untuk menampilkan tabel yg lebih spesifik 'where'
	{
		$this->db->select("*");
		$this->db->from($namatabel);
		
	 	$query = $this->db->get();
	 	return $query;
	}

	function tampil_data_where($namatabel,$array) //gunakan ini untuk menampilkan tabel yg lebih spesifik 'where'
	{
		$this->db->select("*");
		$this->db->from($namatabel);
		$this->db->where($array);
		// $this->db->limit(1);
	 	$query = $this->db->get();
	 	return $query;
	}

	function tampil_data_group_by($namatabel,$array,$kolum) //gunakan ini untuk menampilkan tabel yg lebih spesifik 'where'
	{
		$this->db->select("*");
		$this->db->from($namatabel);
		$this->db->where($array);
		$this->db->group_by($kolum);
	 	$query = $this->db->get();
	 	return $query;
	}


	function insert($namatabel,$array) 
	{
		return $this->db->insert($namatabel,$array);
	}

	function update($table,$array,$array_condition)
	{
		$this->db->where($array);
		$this->db->update($table, $array_condition);
	}

	function like($namatabel,$field,$like,$kategori)
	{
		if ($kategori == '') {
			$this->db->select("*");
			$this->db->from($namatabel);
			$this->db->like($field, $like, 'both'); 
			// $this->db->limit(1);
		 	$query = $this->db->get();
		 	return $query;
		}else{
			$this->db->select("*");
			$this->db->from($namatabel);
			$this->db->where(array('kategori'=>$kategori));
			$this->db->like($field, $like, 'both'); 
			// $this->db->limit(1);
		 	$query = $this->db->get();
		 	return $query;
		}
	}


	function kira_data($kode,$hari,$tanggal,$data)
	{	
		// $nik = $this->session->userdata('nik');
		$penyuluh = $this->session->userdata('penyuluh');

		$elemen_produksi = $this->tampil_data_keseluruhan('tb_elemen_produksi');

		// foreach ($elemen_produksi->result() as $key => $value) {
		// 	$no = $value->id_elemen;
		// 	$satuan[$no] = $data[$no];
		// 	$main['satuan'.$no] = $satuan;
		// }

		// return $main;

		$cek_lahan = $this->tampil_data_where('tb_lahan',array('id_lahan' => $kode, 'kecamatan' => $penyuluh['kecamatan'])); 

		foreach ($cek_lahan->result() as $key => $value);
		$luas =  $value->luas_lahan;
		$tek_tambak = $value->tek_tambak;
		$cek_tek_tambak =  $this->tampil_data_where('tb_tambak',array('id_tambak' => $tek_tambak));
		foreach ($cek_tek_tambak->result() as $key1 => $value1) ;
		$ket = json_decode($value1->ket);
		// $satuan = json_decode($value1->satuan);
		$biaya = 0;
		foreach ($elemen_produksi->result() as $key2 => $value2) {
			$no = $value2->id_elemen;
			$satu = $data[$no];
			$satu = str_replace(',', '', $satu);

			$harga = $ket->$no;
			$main['belakangsatuan'.$no] = $value2->satuan;


			if ($harga == '' and $harga == null) {
				$harga = '';
				
			}else{
				$harga = $harga;
			}

			if ($value2->id_elemen != 4) {
				$satu = $satu * $harga;
			}else{
				$satu = $satu * $harga * $hari;
			}
			$biaya = $biaya + $satu;
			$main['jumlah'.$no] = $satu;
			
			

		}
		$data1 = str_replace(',', '', $data[1]);
		


		$jumlah_produksi = round(($data1*0.02)+$hari-150); 
		$persiapan_lahan = $biaya * 10 / 100;

		$main['biayaproduksi'] = $biaya;
		$main['jumlahproduksi'] = $jumlah_produksi;
		$main['biayapersiapanlahan'] = $persiapan_lahan;
		$main['totalbiaya'] = $biaya + $persiapan_lahan;
		$ekor = $data1;
		$main['saiz'] = ceil(($ekor / $jumlah_produksi) - (($hari/($ekor / $jumlah_produksi))*13));

		if ($main['saiz'] >= 45) {
			$main['hargajual'] = 35000;
		}elseif ($main['saiz'] >= 30) {
			$main['hargajual'] = 60000;
		}elseif ($main['saiz'] >= 25) {
			$main['hargajual'] = 80000;
		}elseif ($main['saiz'] >= 20) {
			$main['hargajual'] = 110000;
		}elseif ($main['saiz'] >= 17) {
			$main['hargajual'] = 120000;
		}elseif ($main['saiz'] >= 8) {
			$main['hargajual'] = 180000;
		}elseif ($main['saiz'] >= 1) {
			$main['hargajual'] = 185000;
		}

		$main['nilaiproduksi'] = $main['hargajual'] * $jumlah_produksi;

		$main['keuntungan'] = $main['nilaiproduksi'] - $biaya - $persiapan_lahan;

		if ($main['keuntungan'] <= 0 ) {
			$main['status'] = 'Tidak Berhasil';
		}else{
			$main['status'] = 'Berhasil';
		}

		return $main;
	}


	function cari_data($kode,$hari)
	{	
		$penyuluh = $this->session->userdata('penyuluh');
		$kode = $kode;
		$hari = $hari;
		$elemen_produksi = $this->tampil_data_keseluruhan('tb_elemen_produksi');
		$cek_lahan = $this->tampil_data_where('tb_lahan',array('id_lahan' => $kode, 'kecamatan' => $penyuluh['kecamatan'])); 

		foreach ($cek_lahan->result() as $key => $value);
		$luas =  $value->luas_lahan;
		$tek_tambak = $value->tek_tambak;
		$cek_tek_tambak =  $this->tampil_data_where('tb_tambak',array('id_tambak' => $tek_tambak));
		foreach ($cek_tek_tambak->result() as $key1 => $value1) ;
		$ket = json_decode($value1->ket);
		$satuan = json_decode($value1->satuan);
		$biaya = 0;
		foreach ($elemen_produksi->result() as $key2 => $value2) {
			$no = $value2->id_elemen;
			$satu = $satuan->$no;
			$harga = $ket->$no;
			$main['belakangsatuan'.$no] = $value2->satuan;

			// echo $no;
			if ($value2->id_elemen != 4) {
				$jum = $satuan->$no * $luas;
				$jum = ceil($jum);
				$satuanjadi[$value2->id_elemen] = $jum;
				$elemen[$no] = $ket->$no * $jum  ;
			}else{
				$org = $satuan->$no *$luas;
				$org = ceil($org);
				$elemen[$no] = $ket->$no * $org * $hari;
			}

			

			if ($harga == '' and $harga == null) {
				$harga = '';
				
			}else{
				$harga = number_format($harga);
			}

			if ($satu == '' and $satu == null) {
				$satu = '';
			}else{
				$satu = $satu * $luas;
				$satu = ceil($satu);
			}

			$main['harga'.$no] = $harga;
			$main['satuan'.$no] = $satu;
			
			

		}

		foreach ($elemen_produksi->result() as $key2 => $value2) {
			$biaya = $biaya + $elemen[$value2->id_elemen];
			$main['jumlahbahan'.$value2->id_elemen]= $elemen[$value2->id_elemen];
		}
		


		$jumlah_produksi = round(($satuanjadi[1]*0.02)+$hari-150); 
		$persiapan_lahan = $biaya * 10 / 100;

		$main['biayaproduksi'] = $biaya;
		$main['jumlahproduksi'] = $jumlah_produksi;
		$main['biayapersiapanlahan'] = $persiapan_lahan;
		$main['totalbiaya'] = $biaya + $persiapan_lahan;
		$ekor = $main['satuan1'];
		$main['saiz'] = ceil(($ekor / $jumlah_produksi) - (($hari/($ekor / $jumlah_produksi))*13));

		if ($main['saiz'] >= 45) {
			$main['hargajual'] = 35000;
		}elseif ($main['saiz'] >= 30) {
			$main['hargajual'] = 60000;
		}elseif ($main['saiz'] >= 25) {
			$main['hargajual'] = 80000;
		}elseif ($main['saiz'] >= 20) {
			$main['hargajual'] = 110000;
		}elseif ($main['saiz'] >= 17) {
			$main['hargajual'] = 120000;
		}elseif ($main['saiz'] >= 8) {
			$main['hargajual'] = 180000;
		}elseif ($main['saiz'] >= 1) {
			$main['hargajual'] = 185000;
		}

		$main['nilaiproduksi'] = $main['hargajual'] * $jumlah_produksi;

		$main['keuntungan'] = $main['nilaiproduksi'] - $biaya - $persiapan_lahan;

		if ($main['keuntungan'] <= 0 ) {
			$main['status'] = 'Tidak Berhasil';
		}else{
			$main['status'] = 'Berhasil';
		}

		return $main;
	}



}