<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Data_lama extends CI_Controller {
	
	public function __construct() 
	{
		parent::__construct();
		$this->load->library('template');

		$this->load->model('status');
		$this->load->model('anggaran');
		$this->load->model('sertifikat');
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
		$data_pertanahan_lama = $this->sertifikat->get_all_sertifikat_lama("pertanahan");
		$data = array(
			'data_pertanahan' 	=> $data_pertanahan
			);

		$this->template->load_view('data', 'pertanahan', $data);
	}
	//-------------------------- DATA APAPUN TERKAIT PERTANAHAN BERAKHIR DISINI ----------------------------------

	//--------------------------------- SEMUA DATA SERTIFIKAT LAIK OPERASI -----------------------------------------------
	public function slo()
	{
		$data_slo = $this->sertifikat->get_data_sertifikat("slo");
		$data = array(
			'data_slo' 	=> $data_slo
			);

		$this->template->load_view('data', 'slo', $data);
	}
	//--------------------- DATA APAPUN TERKAIT SERTIFIKAT LAIK OPERASI BERAKHIR DISINI ----------------------------------

	//-------------------------------------- SEMUA DATA SERTIFIKAT SDM -----------------------------------------------
	public function sertifikat_sdm()
	{

	}
	//-------------------------- DATA APAPUN TERKAIT SERTIFIKAT SDM BERAKHIR DISINI ----------------------------------

	//------------------------------------------ SEMUA DATA PERIZINAN -----------------------------------------------
	public function perizinan()
	{
		$data_perizinan = $this->sertifikat->get_data_sertifikat("perizinan");
		$data = array(
			'data_perizinan' 	=> $data_perizinan
			);

		$this->template->load_view('data', 'perizinan', $data);
	}
	//------------------------------ DATA APAPUN TERKAIT PERIZINAN BERAKHIR DISINI ----------------------------------

	//-------------------------------------- SEMUA DATA PENGUJIAN ALAT K3 -----------------------------------------------
	public function pengujian_alat_k3()
	{
		$data_pengujian = $this->sertifikat->get_data_sertifikat("pengujian alat k3");
		$data = array(
			'data_pengujian' 	=> $data_pengujian
			);

		$this->template->load_view('data', 'pengujian alat k3', $data);
	}
	//-------------------------- DATA APAPUN TERKAIT PENGUJIAN ALAT K3 BERAKHIR DISINI ----------------------------------

	//-------------------------------------------- SEMUA DATA LISENSI -----------------------------------------------
	public function lisensi()
	{
		$data_lisensi = $this->sertifikat->get_data_sertifikat("lisensi");
		$data = array(
			'data_lisensi' 	=> $data_lisensi
			);

		$this->template->load_view('data', 'lisensi', $data);
	}
	//-------------------------------- DATA APAPUN TERKAIT LISENSI BERAKHIR DISINI ----------------------------------
}
