<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Sertifikat_data extends CI_Controller {

	public function __construct() 
	{
		parent::__construct();
		
		$this->load->library('authentifier');

		$this->load->model('sertifikat');
		$this->load->model('dasar_hukum');
		$this->load->model('jenis_sertifikat');
	}

	// BERIKUT ADALAH METHOD YANG AKAN DIGUNAKAN UNTUK MENAMBAH DATA PADA SETIAP SERTIFIKAT
	public function tambah_pertanahan()
	{
		$input = $this->input->post();

		$id_jenis_sertifikat = $this->jenis_sertifikat->get_id_jenis_sertifikat('pertanahan');
		$tanggal_terbit = DateTime::createFromFormat('m/d/Y', $input['tanggal_terbit'])->format('Y-m-d');
		$tanggal_berakhir = DateTime::createFromFormat('m/d/Y', $input['tanggal_berakhir'])->format('Y-m-d');

		$data = array(
			'id_dasar_hukum_sertifikat'	=> $input['referensi_pertanahan'],
			'id_lembaga_sertifikat'		=> $input['lembaga'],
			'id_jenis_sertifikat'		=> $id_jenis_sertifikat,
			'id_sub_jenis_sertifikat'	=> $input['jenis_sertifikat'],
			'id_distrik_sertifikat'		=> $input['distrik'],
			'no_sertifikat'				=> $input['no_sertifikat'],
			'judul_sertifikat'			=> $input['lokasi_sertifikat'],
			'tanggal_sertifikasi'		=> $tanggal_terbit,
			'tanggal_kadaluarsa'		=> $tanggal_berakhir,
			'file_sertifikat'			=> $input['lampiran'],			// belum tahu cara menyimpan file ke dalam sub folder
			'keterangan'				=> $input['keterangan'],
			'jabatan_pic'				=> $this->authentifier->get_user_detail()['posisi_pegawai'],
			'dibuat_oleh'				=> $this->authentifier->get_user_detail()['id_pegawai']
			);

		$result = $this->sertifikat->tambah_data_pertanahan($data);
		
		if ($result)
		{
			// Insert data sukses
			$this->authentifier->set_flashdata('error', 1);
		}
		else
		{
			// Insert data gagal
			$this->authentifier->set_flashdata('error', 2);
		}

		return redirect('form/pertanahan');
	}
}
