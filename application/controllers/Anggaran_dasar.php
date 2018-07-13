<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Anggaran_dasar extends CI_Controller {

	public function __construct() 
	{
		parent::__construct();

		$this->load->library('authentifier');
		
		$this->load->model('anggaran');
	}

	public function tambah_anggaran_dasar()
	{
		$input = $this->input->post();

		$tanggal_rups_sirkuler = DateTime::createFromFormat('m/d/Y', $input['tanggal_rups_sirkuler'])->format('Y-m-d');
		$tanggal_akta = DateTime::createFromFormat('m/d/Y', $input['tanggal_akta'])->format('Y-m-d');

		$insert_data = array(
			'tanggal_rups_sirkuler'		=> $tanggal_rups_sirkuler,
			'tahun_anggaran'			=> $input['tahun_anggaran'],
			'tanggal_akta_anggaran'		=> $tanggal_akta,
			'no_akta_anggaran'			=> $input['no_akta'],
			'no_penerimaan_anggaran'	=> $input['nomor_penerimaan'],
			'file_anggaran_1'			=> $input['lampiran1'],
			'file_anggaran_2'			=> $input['lampiran2'],
			'status_anggaran'			=> $input['status'],
			'jabatan_pic'				=> $this->authentifier->get_user_detail()['posisi_pegawai'],
			'dibuat_oleh'				=> $this->authentifier->get_user_detail()['id_pegawai']
			);

		$result = $this->anggaran->insert_anggaran_dasar($insert_data);

		return redirect ('form/anggaran_dasar');
	}
}
