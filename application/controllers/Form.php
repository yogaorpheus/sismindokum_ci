<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Form extends CI_Controller {
	
	public function __construct() 
	{
		parent::__construct();

		$this->load->library('template');
		$this->load->library('authentifier');

		$this->load->model('status');
		$this->load->model('distrik');
		$this->load->model('lembaga');
	}

	public function index()
	{
		$this->template->load_view('form', 'form');
	}

	public function load_form($nama_form)
	{
		$this->template->load_view(1, 'form', $nama_form);
	}

	//-------------------------------------- SEMUA FORM ANGGARAN DASAR -----------------------------------------------
	public function anggaran_dasar()
	{
		$status_anggaran = $this->status->get_status_by_nama_tabel('anggaran');
		$data = array('status' => $status_anggaran);
		$this->template->load_view('form', 'anggaran_dasar', $data);
	}
	//-------------------------- FORM APAPUN TERKAIT ANGGARAN DASAR BERAKHIR DISINI ----------------------------------

	//-------------------------------------- SEMUA FORM PERTANAHAN -----------------------------------------------
	public function pertanahan()
	{
		$jenis_distrik = $this->distrik->get_all_distrik();
		$lembaga = $this->lembaga->get_all_lembaga();
		
		$data = array(
			'distrik' 	=> $jenis_distrik,
			'lembaga'	=> $lembaga
			);
		$this->template->load_view('form', 'pertanahan', $data);
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
