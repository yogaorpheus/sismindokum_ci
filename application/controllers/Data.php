<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Data extends CI_Controller {
	
	public function __construct() 
	{
		parent::__construct();
		//Example : $this->load->model('model_name');
		//Example : $this->load->helper(array('html', 'form', etc));
		$this->load->library('template');

		$this->load->model('status');
		$this->load->model('anggaran');
		$this->load->model('sertifikat');
	}

	public function load_data()
	{
		$data_content = $this->status->get_all_status();
		$data = array(
			'data_content' => $data_content);
		// print_r($data);
		// die();
		$this->template->load_view('data', 'data', $data);
	}

	//-------------------------------------- SEMUA DATA ANGGARAN DASAR -----------------------------------------------
	public function anggaran_dasar()
	{
		$data_anggaran_dasar = $this->anggaran->get_all_anggaran();
		$data = array(
			'data_anggaran_dasar'	=> $data_anggaran_dasar
			);

		$this->template->load_view('data', 'anggaran_dasar', $data);
	}
	//-------------------------- DATA APAPUN TERKAIT ANGGARAN DASAR BERAKHIR DISINI ----------------------------------

	//-------------------------------------- SEMUA FORM PERTANAHAN -----------------------------------------------
	public function pertanahan()
	{
		$data_pertanahan = $this->sertifikat->get_data_sertifikat("pertanahan");
		$data = array(
			'data_pertanahan' 	=> $data_pertanahan
			);

		$this->template->load_view('data', 'pertanahan', $data);
	}
	//-------------------------- FORM APAPUN TERKAIT PERTANAHAN BERAKHIR DISINI ----------------------------------

	//--------------------------------- SEMUA FORM SERTIFIKAT LAIK OPERASI -----------------------------------------------
	public function slo()
	{
		$jenis_distrik = $this->distrik->get_all_distrik();
		$lembaga = $this->lembaga->get_all_lembaga();

		$data = array(
			'distrik'	=> $jenis_distrik,
			'lembaga'	=> $lembaga
			);
		$this->template->load_view('form', 'slo', $data);
	}
	//--------------------- FORM APAPUN TERKAIT SERTIFIKAT LAIK OPERASI BERAKHIR DISINI ----------------------------------

	//-------------------------------------- SEMUA FORM SERTIFIKAT SDM -----------------------------------------------
	public function sertifikat_sdm()
	{

	}
	//-------------------------- FORM APAPUN TERKAIT SERTIFIKAT SDM BERAKHIR DISINI ----------------------------------

	//------------------------------------------ SEMUA FORM PERIZINAN -----------------------------------------------
	public function perizinan()
	{
		$jenis_distrik = $this->distrik->get_all_distrik();
		$lembaga = $this->lembaga->get_all_lembaga();

		$data = array(
			'distrik'	=> $jenis_distrik,
			'lembaga'	=> $lembaga
			);
		$this->template->load_view('form', 'perizinan', $data);
	}
	//------------------------------ FORM APAPUN TERKAIT PERIZINAN BERAKHIR DISINI ----------------------------------

	//-------------------------------------- SEMUA FORM PENGUJIAN ALAT K3 -----------------------------------------------
	public function pengujian_alat_k3()
	{
		$jenis_distrik = $this->distrik->get_all_distrik();
		$lembaga = $this->lembaga->get_all_lembaga();

		$data = array(
			'distrik'	=> $jenis_distrik,
			'lembaga'	=> $lembaga
			);
		$this->template->load_view('form', 'pengujian_alat_k3', $data);
	}
	//-------------------------- FORM APAPUN TERKAIT PENGUJIAN ALAT K3 BERAKHIR DISINI ----------------------------------

	//-------------------------------------------- SEMUA FORM LISENSI -----------------------------------------------
	public function lisensi()
	{
		$jenis_distrik = $this->distrik->get_all_distrik();
		$lembaga = $this->lembaga->get_all_lembaga();

		$data = array(
			'distrik'	=> $jenis_distrik,
			'lembaga'	=> $lembaga
			);
		$this->template->load_view('form', 'lisensi', $data);
	}
	//-------------------------------- FORM APAPUN TERKAIT LISENSI BERAKHIR DISINI ----------------------------------
}
