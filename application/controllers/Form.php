<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Form extends CI_Controller {
	
	public function __construct() 
	{
		parent::__construct();

		$this->load->library('template');
		$this->load->library('authentifier');
		$this->authentifier->session_check();

		$this->load->model('status');
		$this->load->model('distrik');
		$this->load->model('lembaga');
		$this->load->model('dasar_hukum');
		$this->load->model('menu');
		$this->load->model('jenis_sertifikat');
		$this->load->model('sub_jenis_sertifikat');
		$this->load->model('unit');
		$this->load->model('remainder');
	}

	public function index()
	{
		$this->template->load_view('form', 'form');
	}

	public function load_form($nama_form)
	{
		$this->template->load_view('form', $nama_form);
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

		$id_menu2 = $this->menu->get_id_menu2('pertanahan');
		$dasar_hukum = $this->dasar_hukum->get_dasar_hukum_by_menu($id_menu2);

		$id_jenis_sertifikat = $this->jenis_sertifikat->get_id_jenis_sertifikat('pertanahan');
		//$sub_jenis_sertifikat = $this->sub_jenis_sertifikat->get_sub_jenis_by_id_jenis_sertifikat($id_jenis_sertifikat);

		$remainder = $this->remainder->get_all_remainder();
		
		$data = array(
			'distrik' 				=> $jenis_distrik,
			'lembaga'				=> $lembaga,
			'dasar_hukum'			=> $dasar_hukum,
			'remainder'				=> $remainder
			);
		$this->template->load_view('form', 'pertanahan', $data);
	}
	//-------------------------- FORM APAPUN TERKAIT PERTANAHAN BERAKHIR DISINI ----------------------------------

	//--------------------------------- SEMUA FORM SERTIFIKAT LAIK OPERASI -----------------------------------------------
	public function slo()
	{
		$jenis_distrik = $this->distrik->get_all_distrik();
		$lembaga = $this->lembaga->get_all_lembaga();

		$unit = $this->unit->get_all_unit_by_kode_distrik($this->authentifier->get_user_detail()['kode_distrik_pegawai'], "Aktif");

		$id_menu2 = $this->menu->get_id_menu2('slo');
		$dasar_hukum = $this->dasar_hukum->get_dasar_hukum_by_menu($id_menu2);

		$remainder = $this->remainder->get_all_remainder();

		$data = array(
			'distrik' 		=> $jenis_distrik,
			'lembaga'		=> $lembaga,
			//'dasar_hukum'	=> $dasar_hukum,
			'unit'			=> $unit,
			'remainder'		=> $remainder
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

		$id_menu2 = $this->menu->get_id_menu2('perizinan');
		$dasar_hukum = $this->dasar_hukum->get_dasar_hukum_by_menu($id_menu2);

		$id_jenis_sertifikat = $this->jenis_sertifikat->get_id_jenis_sertifikat('perizinan');
		//$sub_jenis_sertifikat = $this->sub_jenis_sertifikat->get_sub_jenis_by_id_jenis_sertifikat($id_jenis_sertifikat);

		$remainder = $this->remainder->get_all_remainder();

		$data = array(
			'distrik' 				=> $jenis_distrik,
			'lembaga'				=> $lembaga,
			'dasar_hukum'			=> $dasar_hukum,
			'remainder'				=> $remainder
			);
		$this->template->load_view('form', 'perizinan', $data);
	}
	//------------------------------ FORM APAPUN TERKAIT PERIZINAN BERAKHIR DISINI ----------------------------------

	//-------------------------------------- SEMUA FORM PENGUJIAN ALAT K3 -----------------------------------------------
	public function pengujian_alat_k3()
	{
		$jenis_distrik = $this->distrik->get_all_distrik();
		$lembaga = $this->lembaga->get_all_lembaga();

		$id_menu2 = $this->menu->get_id_menu2('pengujian alat k3');
		$dasar_hukum = $this->dasar_hukum->get_dasar_hukum_by_menu($id_menu2);

		$id_jenis_sertifikat = $this->jenis_sertifikat->get_id_jenis_sertifikat('pengujian alat k3');
		///$sub_jenis_sertifikat = $this->sub_jenis_sertifikat->get_sub_jenis_by_id_jenis_sertifikat($id_jenis_sertifikat);

		$remainder = $this->remainder->get_all_remainder();

		$data = array(
			'distrik' 				=> $jenis_distrik,
			'lembaga'				=> $lembaga,
			'dasar_hukum'			=> $dasar_hukum,
			'remainder'				=> $remainder
			);
		$this->template->load_view('form', 'pengujian_alat_k3', $data);
	}
	//-------------------------- FORM APAPUN TERKAIT PENGUJIAN ALAT K3 BERAKHIR DISINI ----------------------------------

	//-------------------------------------------- SEMUA FORM LISENSI -----------------------------------------------
	public function lisensi()
	{
		$jenis_distrik = $this->distrik->get_all_distrik();
		$lembaga = $this->lembaga->get_all_lembaga();

		$id_menu2 = $this->menu->get_id_menu2('lisensi');
		$dasar_hukum = $this->dasar_hukum->get_dasar_hukum_by_menu($id_menu2);

		$remainder = $this->remainder->get_all_remainder();

		$data = array(
			'distrik' 		=> $jenis_distrik,
			'lembaga'		=> $lembaga,
			//'dasar_hukum'	=> $dasar_hukum,
			'remainder'		=> $remainder
			);
		$this->template->load_view('form', 'lisensi', $data);
	}
	//-------------------------------- FORM APAPUN TERKAIT LISENSI BERAKHIR DISINI ----------------------------------
}
