<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Data_lama extends CI_Controller {
	
	public function __construct() 
	{
		parent::__construct();
		$this->load->library('template');
		$this->load->library('authentifier');
		$this->authentifier->session_check();

		$this->load->model('anggaran');
		$this->load->model('sertifikat');
		$this->load->model('sdm');
	}

	//-------------------------------------- SEMUA DATA ANGGARAN DASAR -----------------------------------------------
	public function anggaran_dasar()
	{
		$data_anggaran_lama = $this->anggaran->get_all_anggaran_by_status("tidak aktif");
		$data = array(
			'data_anggaran_lama'	=> $data_anggaran_lama
			);

		$this->template->load_view('data_lama', 'anggaran_dasar', $data);
	}
	//-------------------------- DATA APAPUN TERKAIT ANGGARAN DASAR BERAKHIR DISINI ----------------------------------

	//-------------------------------------- SEMUA DATA PERTANAHAN -----------------------------------------------
	public function pertanahan()
	{
		$data_pertanahan = $this->sertifikat->get_all_sertifikat_lama("pertanahan", $this->authentifier->get_user_detail()['kode_distrik_pegawai']);
		$data = array(
			'data_pertanahan' 	=> $data_pertanahan
			);

		$this->template->load_view('data_lama', 'pertanahan', $data);
	}
	//-------------------------- DATA APAPUN TERKAIT PERTANAHAN BERAKHIR DISINI ----------------------------------

	//--------------------------------- SEMUA DATA SERTIFIKAT LAIK OPERASI -----------------------------------------------
	public function slo()
	{
		$data_slo = $this->sertifikat->get_all_sertifikat_lama("slo", $this->authentifier->get_user_detail()['kode_distrik_pegawai']);
		$data = array(
			'data_slo' 	=> $data_slo
			);

		$this->template->load_view('data_lama', 'slo', $data);
	}
	//--------------------- DATA APAPUN TERKAIT SERTIFIKAT LAIK OPERASI BERAKHIR DISINI ----------------------------------

	//-------------------------------------- SEMUA DATA SERTIFIKAT SDM -----------------------------------------------
	public function sertifikat_sdm()
	{
		$data_sdm = $this->sdm->get_all_data_sdm($this->authentifier->get_user_detail()['kode_distrik_pegawai'], "Kadaluarsa");
		$data = array(
			'data_sdm'	=> $data_sdm
			);
		$this->template->load_view('data_lama', 'sertifikat_sdm', $data);
	}
	//-------------------------- DATA APAPUN TERKAIT SERTIFIKAT SDM BERAKHIR DISINI ----------------------------------

	//------------------------------------------ SEMUA DATA PERIZINAN -----------------------------------------------
	public function perizinan()
	{
		$data_perizinan = $this->sertifikat->get_all_sertifikat_lama("perizinan", $this->authentifier->get_user_detail()['kode_distrik_pegawai']);
		$data = array(
			'data_perizinan' 	=> $data_perizinan
			);

		$this->template->load_view('data_lama', 'perizinan', $data);
	}
	//------------------------------ DATA APAPUN TERKAIT PERIZINAN BERAKHIR DISINI ----------------------------------

	//-------------------------------------- SEMUA DATA PENGUJIAN ALAT K3 -----------------------------------------------
	public function pengujian_alat_k3()
	{
		$data_pengujian = $this->sertifikat->get_all_sertifikat_lama("pengujian alat k3", $this->authentifier->get_user_detail()['kode_distrik_pegawai']);
		$data = array(
			'data_pengujian' 	=> $data_pengujian
			);

		$this->template->load_view('data_lama', 'pengujian_alat_k3', $data);
	}
	//-------------------------- DATA APAPUN TERKAIT PENGUJIAN ALAT K3 BERAKHIR DISINI ----------------------------------

	//-------------------------------------------- SEMUA DATA LISENSI -----------------------------------------------
	public function lisensi()
	{
		$data_lisensi = $this->sertifikat->get_all_sertifikat_lama("lisensi", $this->authentifier->get_user_detail()['kode_distrik_pegawai']);
		$data = array(
			'data_lisensi' 	=> $data_lisensi
			);

		$this->template->load_view('data_lama', 'lisensi', $data);
	}
	//-------------------------------- DATA APAPUN TERKAIT LISENSI BERAKHIR DISINI ----------------------------------
}
